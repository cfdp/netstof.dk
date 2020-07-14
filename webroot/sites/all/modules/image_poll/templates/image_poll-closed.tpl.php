<?php

drupal_add_js(drupal_get_path('module', 'image_poll') .'/js/image_poll.js');
/**
 * @file
 * Default template that displays closed messaging when a poll is not available.
 *
 * - $data:
 *   object containing the following fields.
 *   choices:
 *      array containing:
 *        choice_id = the unique hex id of the choice
 *        choice =    The text for a given choice.
 *        write_in =  a boolean value indicating whether or not the choice was a
 *                    write in.
 *   mode:            The mode used to store the vote: normal, cookie, unlimited
 *   cookie_duration: (int) If mode is cookie, the number of minutes to delay votes.
 *   state:           Is the poll 'open' or 'close'
 *   behavior:        approval or pool - determines how to treat multiple vote/user
 *                    tally. When plugin is installed, voting will default to tabulating
 *                    values returned from voting API.
 *   max_choices:     (int) How many choices a user can select per vote.
 *   show_results:    When to display results - aftervote, afterclose or never.
 *   write_in:        Boolean - all write-in voting.
 *   block:           Boolean - Poll can be displayed as a block.
 */
?>
<div class="poll">
    <div class="poll-closed">
       <p><?php print t('Thank you for participating.  The poll is now closed.'); ?></p>
    </div>
</div>