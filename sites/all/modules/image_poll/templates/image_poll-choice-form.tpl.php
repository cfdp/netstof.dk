<?php
/**
 * @file
 * Theme implementation to display image_poll choice form with image fields.
 *
 * - TODO: $nid: The nid of the image_poll. Needs to be set in form.
 * - TODO: $title: The title of the image_poll. Needs to be set in form (or grabbed from nid in preprocess).
 * - $choices: The radio buttons or checkboxes for the choices in the image_poll.
 * - $images: The choice images, with keys corresponding to $choices. These can be themed via theme_image_poll_field_image_image().
 * - $write_in: The write-in field, if it is set.
 * - $message: Poll message (validation error, etc.), if set.
 * - $submit: The vote button.
 * - $hidden: Hidden variables that need to be rendered for the form to function.
 *
 * @see
 * - template_preprocess_image_poll_field_image_choice_form()
 * - theme_image_poll_field_image_image().
 *
 * @ingroup themeable
 */
?>

<div class="poll image_poll">
  <div class="image_poll-choice-form image_poll-field-image-choice-form">

<?php $i = '0';?>

    <div class="choices">
      <?php foreach ($choices as $key => $choice) { ?>
        <div class="choice choice-<?php print $key ?>">
          <div class="choice-text"><?php print $choice; ?></div>
          <?php if (!empty($images)): ?>
            <div class="choice-image"><?php print $images[$key]?></div>
            <?php if ($i == '0'){ ?>
            <div class="question-mark"></div>
            <?php $i = '1';} ?>
          <?php endif; ?>
        </div>
      <?php } ?>

      <?php if (isset($write_in)): ?>
        <?php print $write_in; ?>
      <?php endif; ?>
    </div>

  <?php if (isset($message)): ?>
    <?php print $message; ?>
  <?php endif; ?>

  <?php print $submit; ?>
  <?php print $hidden; ?>
  </div>
</div>
<h1>choiceform</h1>
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
