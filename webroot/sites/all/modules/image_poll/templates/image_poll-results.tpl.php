<?php
/**
 * @file
 * Default template for wrapping bar results - includes count of votes.
 *
 * Variables available:
 * - $nid: The nid of the poll
 * - $cancel_form: Provides a form for deleting user's votes when they have
 *   permission to do so.
 * - $bars: The output of all styled bars displaying votes.
 * - $total: Total number of votes.
 * - $voted: An array indicating which unique choice ids were selected by the user.
 *
 */
?>
<div class="poll" id="image_poll-<?php print $nid; ?>">
  	<div class="poll-wrapper">
    	<?php print $bars; ?>
    	<div class="question-mark"></div>
    	<?php /*<div class="total"><?php print t('Total votes: @total', array('@total' => $total)); ?></div>
		*/?>
	</div>
</div>
<?php
  $node = node_load($nid);
  $sharing_url = "http://netstof.dk/node/" . $nid;
  $sharing_text = "Afstemning: $node->title";
  $sharing_text_encoded = urlencode($sharing_text);
?>
<div id="share-buttons">
  <!-- Facebook -->
  <a href="http://www.facebook.com/sharer.php?u=<?php print $sharing_url; ?>" target="_blank"><img src="/<?php print drupal_get_path('module', 'image_poll'); ?>/img/social/facebook.png" alt="Facebook" /></a>
  <!-- Twitter -->
  <a href="http://twitter.com/share?url=<?php print $sharing_url; ?>&text=<?php print $sharing_text_encoded; ?>" target="_blank"><img src="/<?php print drupal_get_path('module', 'image_poll'); ?>/img/social/twitter.png" alt="Twitter" /></a>
  <!-- Google+ -->
  <a href="https://plus.google.com/share?url=<?php print $sharing_url; ?>" target="_blank"><img src="/<?php print drupal_get_path('module', 'image_poll'); ?>/img/social/google.png" alt="Google" /></a>
  <!-- Email -->
  <a href="mailto:?Subject=<?php print $sharing_text_encoded; ?>&Body=%20<?php print $sharing_url; ?>"><img src="/<?php print drupal_get_path('module', 'image_poll'); ?>/img/social/email.png" alt="Email" /></a>
</div>
