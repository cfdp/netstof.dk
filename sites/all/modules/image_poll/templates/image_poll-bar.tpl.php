<?php
/**
 * @file
 * Default template for an Image Poll bar - based on default Drupal Poll template.
 *
 * Variables available:
 * - $title: The title of the poll.
 * - $votes: The number of votes for this choice
 * - $percentage: The percentage of votes for this choice.
 * - $vote: The choice number of the current user's vote.
 * - $voted: Set to TRUE if the user voted for this choice.
 * - $image_placeholder: This is a hash value that will be replaced by the image corresponding to this choice.
 *   The actual images can be themed via theme_image_poll_field_image_image().
 *
 * @see
 * - image_poll-bar.tpl.php provided by image_poll module.
 * - theme_image_poll_field_image_image().
 */

// add extra class to wrapper so that user's selected vote can have a different style.
$voted_class = '';
$voted_span = $cancel_form;
if ($voted) {
    $voted_class = ' voted';
    $voted_span = '';
}
?>
<div class="poll-bar<?php print $voted_class; ?>">
  <?php print $voted_span; ?>
  <div class="choice-text">
    <div class="text"><?php print $title; ?></div>
  </div>
  <div class="image choice-image"><?php print $image_placeholder; ?></div>
  <div class="votes-wrapper">
    <div class="votes">
      <div class="total-votes">
    <?php print format_plural($votes, '1 vote', '@count votes'); ?>
      </div>
    </div>
  </div>
</div>