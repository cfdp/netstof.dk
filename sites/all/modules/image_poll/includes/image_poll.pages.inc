<?php

/*
 * @file
 * Image Poll Pages Include
 * 
 * All items in this document are responsible for generating the tab (menu local) pages
 * that are used for administering an individual poll.
 */

/*
 * Generates page for administering individual voters on a poll.  Enables administrator
 * to clear all votes. For users that can view votes but not administer them, the button
 * is not displayed.
 * 
 * @param $node
 * An image_poll node
 * @return
 * Markup displayed by menu callback for this page. 
 */

function image_poll_votes_page($node) {
  $data = image_poll_get_data($node);

  $output = t('This table lists all the recorded votes for this poll.');
  if ($data->mode == 'unlimited') {
    $output = t('With unlimited voting, a timestamp is used to identify unique votes.  If it is important to identify users by ID or IP, switch to normal voting mode which will use your Voting API settings to record votes.');
  } elseif ($data->mode == 'cookie') {
    $output = t('With cookie-based voting, a timestamp is used to identify unique votes while the poll\'s id is set in the cookie to limit votes for a limited time.  If it is important to identify users by ID or IP, switch to normal voting mode which will use your Voting API settings to record votes.');
  } else {
    $output = t('If anonymous users are allowed to vote, they will be identified by the IP address of the computer they used when they voted.');
  }

  $header = array();
  $header[] = array('data' => t('Visitor'), 'field' => 'uid');
  $header[] = array('data' => t('Date'), 'field' => 'timestamp', 'sort' => 'asc');
  $header[] = array('data' => t('Choice'), 'tag');

  $nid = $node->nid;

  $query = db_select('votingapi_vote', 'v')
    ->condition('entity_id', $nid)
    ->extend('PagerDefault')
    ->limit(20)
    ->extend('TableSort')
    ->orderByHeader($header)
    ->fields('v', array(
    'uid',
    'timestamp',
    'tag',
    'vote_source',
    ));

  $results = $query->execute();
  $user_obj = NULL;
  $rows = array();
  foreach ($results as $item) {
    $user_id = $item->uid;

    if (!$user_id) {
      $user_id = $item->vote_source;
    } else {
      $user_obj = user_load($user_id);
      if ($user_obj) {
        $user_id = l($user_obj->name, 'user/' . $user_id);
      }
    }

    $rows[] = array(
      'data' => array(
        $user_id,
        format_date($item->timestamp),
        image_poll_match_tag_to_choice($data->choices, $item->tag),
      )
    );
  }

  if ($rows) {
    $output .= theme('table', array(
      'header' => $header,
      'rows' => $rows,
      )
    );

    $output .= theme('pager', array('tags' => array()));
    if (user_access('administer polls')) {
      $rendered_form = drupal_get_form('image_poll_clear_votes_form');
      $output .= drupal_render($rendered_form);
    }
  } else {
    $output .= '<hr /><p>' . t('No votes are currently recorded for %title', array('%title' => $node->title)) . '</p>';
  }

  return $output;
}

function image_poll_match_tag_to_choice($choices, $tag) {
  foreach ($choices as $choice) {
    if ($choice['choice_id'] == $tag) {
      return $choice['choice'];
    }
  }
  return;
}

/*
 * Clear votes form element for the vote display page.
 */

function image_poll_clear_votes_form($form, &$form_state) {
  $nid = (int) check_plain(arg(1));

  $form['reset'] = array(
    '#value' => t('Clear all votes'),
    '#type' => 'submit',
  );
  $form['#action'] = url('node/' . $nid . '/image_poll/votes/clear');
  return $form;
}

function image_poll_clear_votes_page($node) {

  $output = drupal_get_form('image_poll_clear_votes_confirm_form', $node->nid, $node->title);

  return $output;
}

/**
 * Display a clear votes confirmation form.
 */
function image_poll_clear_votes_confirm_form($form, &$form_state, $nid, $title) {
  $form = array();
  $form['#nid'] = $nid;
  $confirm_question = t('Are you sure you want to clear all votes for %title?', array('%title' => $title));
  $form['question'] = array('#value' => '<h2>' . $confirm_question . '</h2>');
  $form = confirm_form($form, $confirm_question, 'node/' . $nid . '/admin/votes', t('This will delete all votes that have been cast for %title.', array('%title' => $title)), t('Clear all votes'), t('Cancel'));
  unset($form['#theme']);
  return $form;
}

function image_poll_clear_votes_confirm_form_submit($form, &$form_state) {
  $nid = (int) check_plain(arg(1));
  db_delete('votingapi_vote')
    ->condition('entity_id', $nid)
    ->condition('entity_type', 'image_poll')
    ->execute();
  drupal_goto('node/' . $nid);
}

/*
 * Display Write-in node management tab page.
 * 
 * @param $node
 * And image_poll node
 */

function image_poll_writeins_page($node) {
  $output = '';

  $rendered_form = drupal_get_form('image_poll_promote_writein_form', $node);
  $output .= drupal_render($rendered_form);
  $rendered_form = drupal_get_form('image_poll_merge_writein_form', $node);
  $output .= drupal_render($rendered_form);

  return $output;
}

/*
 * Generates form used to promote write-in options to normal status on the write-in node
 * management tab page.
 */

function image_poll_promote_writein_form($form, &$form_state, $node) {

  $data = image_poll_get_data($node);
  $count = count($data->choices);

  $options = array();

  for ($i = 0; $i < $count; $i++) {
    if ($data->choices[$i]['write_in']) {
      $options[] = strip_tags($data->choices[$i]['choice']);
    }
  }
  $form['#id'] = 'image_poll-promote_writein';

  if ($options) {

    $form['promote_writein'] = array(
      '#type' => 'fieldset',
      '#title' => t('Promote write-ins'),
      '#description' => t('Write-ins can be converted to regular choices. This is useful if users cannot see past write-ins but you want to promote specific write-ins so that they can be seen by users who vote in the future.'),
    );

    $form['promote_writein']['choices'] = array(
      '#type' => 'checkboxes',
      '#title' => '',
      '#options' => drupal_map_assoc($options),
    );

    $form['promote_writein']['submit'] = array(
      '#type' => 'submit',
      '#value' => t('Promote'),
    );
  } else {
    $form['promote_writein'] = array(
      '#type' => 'fieldset',
      '#title' => t('Promote write-ins'),
      '#description' => t('There are currently no write-ins available to promote.'),
    );
  }

  return $form;
}

/*
 * Submit function for image_poll_promote_writein_form.
 */

function image_poll_promote_writein_form_submit($form, &$form_state) {
  $selected = array();
  $nid = $form_state['build_info']['args'][0]->nid;

  $options = $form['promote_writein']['choices']['#options'];

  foreach ($options as $option) {
    if ($form['promote_writein']['choices'][$option]['#checked']) {
      $selected[] = strtolower(strip_tags($option));
    }
  }

  if ($selected) {

    $node = node_load($nid);

    if ($node) {
      $lang = $node->language;

      if (!isset($node->image_poll_choice[$lang])) {
        $lang = 'und';
      }

      $node_choices = $node->image_poll_choice[$lang];
      $updated_choices = array();
      foreach ($node_choices as $item) {
        $choice = strtolower(strip_tags($item['choice']));
        if (in_array($choice, $selected)) {
          $updated_choices[] = array('choice' => $item['choice'], 'write_in' => 0, 'choice_id' => $item['choice_id']);
        } else {
          $updated_choices[] = array('choice' => $item['choice'], 'write_in' => $item['write_in'], 'choice_id' => $item['choice_id']);
        }
      }
      $node->image_poll_choice[$lang] = $updated_choices;
      node_save($node);
    }
  }
}

/*
 * Provides form for merging write-in section of the Write-ins administration
 * node page.
 */

function image_poll_merge_writein_form($form, &$form_state, $node) {
  $lang = $node->language;

  if (!isset($node->image_poll_choice[$node->language])) {
    $lang = 'und';
  }

  $choices = $node->image_poll_choice[$lang];
  $count = count($choices);

  $options = array();
  $all = array();

  $form['#id'] = 'image_poll-merge_writein';
  for ($i = 0; $i < $count; $i++) {
    if ($choices[$i]['write_in']) {
      $options[] = strip_tags($choices[$i]['choice']);
    } else {
      $all[] = strip_tags($choices[$i]['choice']);
    }
  }

  if ($options && $all) {

    $form['merge_writein'] = array(
      '#type' => 'fieldset',
      '#title' => t('Merge write-ins'),
      '#description' => t('This will delete the write-in and change any votes for it into votes for the selected choice.'),
    );

    $form['merge_writein']['choices'] = array(
      '#type' => 'select',
      '#title' => t('Merge'),
      '#options' => drupal_map_assoc($options),
    );

    $form['merge_writein']['all_choices'] = array(
      '#type' => 'select',
      '#title' => t('into'),
      '#options' => drupal_map_assoc($all),
    );

    $form['merge_writein']['submit'] = array(
      '#type' => 'submit',
      '#value' => t('Merge'),
    );
  } else {
    $form['merge_writein'] = array(
      '#type' => 'fieldset',
      '#title' => t('Merge write-ins'),
      '#description' => t('There are currently no write-ins to promote.'),
    );
  }

  return $form;
}

/*
 * Submit function for merging write-in votes.
 * 
 */

function image_poll_merge_writein_form_submit($form, &$form_state) {
  $lang = $form_state['build_info']['args'][0]->language;

  if (!isset($form_state['build_info']['args'][0]->image_poll_choice[$lang])) {
    $lang = 'und';
  }

  $merge_from = strtolower($form['merge_writein']['choices']['#value']);
  $merge_to = strtolower($form['merge_writein']['all_choices']['#value']);
  $nid = $form_state['build_info']['args'][0]->nid;
  $choices = $form_state['build_info']['args'][0]->image_poll_choice[$lang];

  $from_tag = '';
  $to_tag = '';
  // match up unique choice id with selected choice
  foreach ($choices as $choice) {
    if (strtolower(strip_tags($choice['choice'])) == $merge_from) {
      $from_tag = $choice['choice_id'];
    } elseif (strtolower(strip_tags($choice['choice'])) == $merge_to) {
      $to_tag = $choice['choice_id'];
    }
  }

  // no matches, no merge
  if (!$from_tag || !$to_tag) {
    drupal_set_message(t('Unidentifed index for index merging.'));
    return;
  }

  // get votes that belonged to the merge from value
  $criteria = array('entity_id' => $nid, 'tag' => $from_tag);
  $merge_fromVotes = votingapi_select_votes($criteria);

  // transfer merge from votes to new vote object and update votingapi
  foreach ($merge_fromVotes as $vote) {
    $votes = array(
      'entity_type' => 'image_poll',
      'entity_id' => $nid,
      'value' => $vote['value'],
      'tag' => $to_tag,
      'uid' => $vote['uid'],
      'vote_source' => $vote['vote_source'],
    );

    votingapi_set_votes($votes);
  }
  // remove votes for merge from tag
  votingapi_delete_votes($merge_fromVotes);

  // remove choice from node.
  $node = node_load($nid);

  if ($node) {
    $lang = $node->language;

    if (!isset($node->image_poll_choice[$node->language])) {
      $lang = 'und';
    }
    $node_choices = $node->image_poll_choice[$lang];
    $updated_choices = array();
    foreach ($node_choices as $item) {
      $id = $item['choice_id'];
      if ($id != $from_tag) {
        $updated_choices[] = $item;
      }
    }
    $node->image_poll_choice[$lang] = $updated_choices;
    node_save($node);
  }
}

/*
 * Display the poll's results for users with appropriate permissions
 * 
 * @param $node
 * And image_poll node
 */

function image_poll_results_page($node) {
  drupal_add_css(drupal_get_path('module', 'image_poll') . '/css/image_poll.css', array('group' => CSS_DEFAULT, 'every_page' => TRUE));
  $data = image_poll_get_data($node);
  $output = '';

  if ($node) {
    $output = image_poll_display_results($node->nid, $data, 1);
  }

  return $output;
}