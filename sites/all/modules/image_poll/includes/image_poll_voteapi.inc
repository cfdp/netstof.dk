<?php

/*
 * @file
 * Image Poll Vote API Include
 * 
 * Handles function calls related to voting and selection of votes.
 */

/**
 * Get all votes related to a node by content type and node id.
 *
 * @param $nid
 * Node ID of an Image Poll.
 * @param $behavior
 * Behavior dictates how results are tabulated and displayed.
 * @return
 *   An array containing the key:
 *     'choices' which matches the index of each choice with its tallied votes.
 *     'total' which is the total of all votes
 */
function image_poll_get_votes($nid) {
  $criteria = array();
  $criteria['entity_id'] = $nid;
  $criteria['entity_type'] = 'image_poll';

  $results = votingapi_select_votes($criteria);
  $tabulated = image_poll_default_vote($results);
  

  return $tabulated;
}

function image_poll_default_vote($results) {
  $tallied = array();
  $total = 0;
  $points = 0;
  $totalpoints = 0;
  foreach ($results as $result) {
    $points = (int) $result['value'];
    if (isset($tallied[$result['tag']])) {
      $tallied[$result['tag']] += $points;
      ;
    } else {
      $tallied[$result['tag']] = $points;
    }
    $totalpoints += $points;
    $total++;
  }

  $tabulated = image_poll_calculate_percentage($tallied, $totalpoints);

  return array('choices' => $tabulated, 'total' => $total);
}

/**
 * Return keyed array with percentages for each index.
 *
 * @param $tallied 
 * Array containing totals per choice index
 * @param $total
 * Total number of votes
 * @return
 *   A keyed array containing:
 *   index = the index of the choice
 *   percentage = the percentage of votes
 *   votes = the number of votes received
 */
function image_poll_calculate_percentage($tallied, $total) {
  $tabulated = array();

  foreach ($tallied as $key => $value) {
    $percentage = floor((int) $value / (int) $total * 100);
    $tabulated[] = array('index' => $key, 'percentage' => $percentage, 'votes' => $value);
  }

  return $tabulated;
}

/*
 * Check for user's eligibility to vote on a given poll.
 * 
 * Provides a series of fall-through tests to determine user's ability to vote.
 * 
 * @param $node
 * The poll node.
 * @return
 * Returns TRUE or FALSE.
 * 
 */

function image_poll_user_eligibility($node) {
  if (!user_access('vote on polls')) {
    return FALSE;
  }
  global $user;
  $data = image_poll_get_data($node);

  if ($data->write_in && !user_access('add write-ins')) {
    return FALSE;
  }

  if ($data->mode === 'cookie' && isset($_COOKIE[$node->type . $node->nid])) {
    return FALSE;
  }

  if ($data->mode === 'normal') {
    $criteria = array();
    $criteria['entity_id'] = $node->nid;
    $criteria['entity_type'] = $node->type;

    if ($user->uid) {
      $criteria['uid'] = $user->uid;
    } else {
      $criteria['vote_source'] = ip_address();
    }
    $results = votingapi_select_votes($criteria);

    if ($results) {
      return FALSE;
    }
  }

  return TRUE;
}

/**
 * Add votes for a given poll.
 *
 * @param $vote
 * A keyed array that is used to determine the method in which the vote will be
 * tracked and what values will be passed to votingapi
 *   $vote['type'] The content type - either image_poll or image_poll_ranking
 *   $vote['tag'] = Tag corresponds to the index of the selected choice
 *   $vote['nid'] = The node ID of poll being voted on
 *   $vote['mode'] = normal, cookie, or unlimited
 *   $vote['duration'] = duration is minutes that the cookie will last if one is 
 *                       set.
 */
function image_poll_add_votes($vote) {
  global $user;
  // normal voting uses the voteapi to record user id or ip based on authentication
  if ($vote['mode'] === 'normal') {
    $votes = array(
      'entity_type' => $vote['type'],
      'entity_id' => $vote['nid'],
      'value' => $vote['value'],
      'tag' => $vote['tag'],
    );
  } else {
    // unlimited and cookie voting simply add values to the votingapi and bypass 
    // user id and ip as source. Ttime stamp instead of ip will prevent a unique 
    // id from being tied to these voters.
    if ($vote['mode'] === 'cookie') {
      // necessary to pass Drupal's $cookie_domain to get this to stick.
      // Raw cookies are safe in this case as we're only passing a static value 
      // to mark that this user voted on their machine.
      global $cookie_domain;
      setrawcookie($vote['type'] . $vote['nid'], 'vote', time() + (60 * $vote['duration']), '/', $cookie_domain);
    }

    $votes = array(
      'entity_type' => $vote['type'],
      'entity_id' => $vote['nid'],
      'value' => $vote['value'],
      'tag' => $vote['tag'],
      'uid' => '',
      'vote_source' => time(),
    );
  }

  votingapi_set_votes($votes, $criteria = NULL);
}

/*
 * Process votes cast via checkboxes
 * 
 * Checkbox values returned by form_state have a different structure
 * than radio buttons.  We need an array of indexes representing
 * items selected from list of choices.
 * 
 * @param $choices
 * An array containing available choices in the poll
 * @param $votes
 * Text of choices selected from the form_state. Need to match them up with
 * choices saved in the node.
 * @return
 * Returns an array of the the unique IDs of the choices selected by the user.
 * 
 */

function image_poll_checkbox_selected($choices, $votes) {
  $selected = array();
  $count = count($choices);

  for ($i = 0; $i < $count; $i++) {
    $choice = strip_tags($choices[$i]['choice']);
    if (isset($votes[$choice]) && !is_numeric($votes[$choice]) && !empty($votes[$choice])) {
      $selected[] = $choices[$i]['choice_id'];
    }
  }
  return $selected;
}

/*
 * Process votes cast via radio buttons
 * 
 * Radio buttons returns a string rather than an array.  
 * 
 * @param $choices
 * An array containing available choices in the poll
 * @param $vote
 * Text of choice selected from the form_state. Need to match it up with
 * choices saved in the node.
 * @return
 * Returns the unique ID of the choice selected by the user.
 */

function image_poll_radio_selected($choices, $vote) {

  $selected = array();
  $count = count($choices);

  for ($i = 0; $i < $count; $i++) {
    $choice = strip_tags($choices[$i]['choice']);

    if ($choice == strip_tags($vote)) {
      $selected[] = $choices[$i]['choice_id'];
    }
  }

  return $selected;
}

/**
 * Return unique choice ids for a given node id and user id.
 *
 * @param $nid
 * The node ID of the poll to be examined for the current user.
 * @return
 * Returns an array of unique choice IDs selected by the user.
 */
function image_poll_get_user_votes($nid) {
  global $user;
  $votes = array();
  $criteria = array();
  $criteria['entity_id'] = $nid;
  $criteria['entity_type'] = 'image_poll';

  if ($user->uid) {
    $criteria['uid'] = $user->uid;
  } else {
    $criteria['vote_source'] = ip_address();
  }

  $results = votingapi_select_votes($criteria);

  if ($results) {
    foreach ($results as $result) {
      $votes[] = $result['tag'];
    }
  }

  return $votes;
}