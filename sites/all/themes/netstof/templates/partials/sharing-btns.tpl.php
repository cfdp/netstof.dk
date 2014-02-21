<?php $sharing_text_encoded = urlencode($sharing_text); ?>
<div id="share-buttons">
  <!-- Facebook -->
  <a href="http://www.facebook.com/sharer.php?u=<?php print $sharing_url; ?>" target="_blank"><img src="/<?php print path_to_theme(); ?>/images/social/facebook.png" alt="Facebook" /></a>
  <!-- Twitter -->
  <a href="http://twitter.com/share?url=<?php print $sharing_url; ?>&text=<?php print $sharing_text_encoded; ?>" target="_blank"><img src="/<?php print path_to_theme(); ?>/images/social/twitter.png" alt="Twitter" /></a>
  <!-- Google+ -->
  <a href="https://plus.google.com/share?url=<?php print $sharing_url; ?>" target="_blank"><img src="/<?php print path_to_theme(); ?>/images/social/google.png" alt="Google" /></a>
  <!-- Email -->
  <a href="mailto:?Subject=<?php print $sharing_text_encoded; ?>&Body=%20<?php print $sharing_url; ?>"><img src="/<?php print path_to_theme(); ?>/images/social/email.png" alt="Email" /></a>
</div>