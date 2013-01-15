<?php

/**
 * @file
 *
 * Theme implementation: Template for each forum post whether node or comment.
 *
 * All variables available in node.tpl.php and comment.tpl.php for your theme
 * are available here. In addition, Advanced Forum makes available the following
 * variables:
 *
 * - $top_post: TRUE if we are formatting the main post (ie, not a comment)
 * - $reply_link: Text link / button to reply to topic.
 * - $total_posts: Number of posts in topic (not counting first post).
 * - $new_posts: Number of new posts in topic, and link to first new.
 * - $links_array: Unformatted array of links.
 * - $account: User object of the post author.
 * - $name: User name of post author.
 * - $author_pane: Entire contents of the Author Pane template.
 */
?>

<?php /* if ($top_post): ?>
  <?php print $topic_header ?>
<?php endif; */ ?>

<div id="<?php print $post_id; ?>" class="<?php print $classes; ?>" <?php print $attributes; ?>>
  <div class="forum-post-top"></div>
  <div class="forum-post-info clearfix">
  <div class="forum-post-wrapper">

    <div class="forum-post-panel-main clearfix">
      <?php if (!empty($title)): ?>
      	<?php
      	/**
      	 * Prints the forum category icon
      	 */ 
      	if($top_post) {
      		$term = taxonomy_term_load($node->taxonomy_forums[LANGUAGE_NONE][0]["tid"]);
      		print "<div id='forum-icon'>";
      		print "<a href='/".arg(0, drupal_get_path_alias())."/".arg(1, drupal_get_path_alias())."'><img src='".image_style_url("forum-icon", $term->field_ikon[LANGUAGE_NONE][0]["uri"])."' /></a>";
      		print "</div>";
      		?>
      		<div id="forum-headline">
    	    	<span><a href="/<?php print arg(0, drupal_get_path_alias())."/".arg(1, drupal_get_path_alias()); ?>">Debat</a></span><br />
	        	<h1><?php print $title; ?></h1>
			</div>
      	<?php
      	}
      	else {
      	?>
        <div class="forum-post-title">
          <?php print $title; ?>
        </div>
      <?php } ?>
      <?php endif; ?>
      
      <?php if (!empty($author_pane)): ?>
        <?php print $author_pane; ?>
      <?php endif; ?>
      
      <div class="forum-posted-on">
      <?php print $date ?>

      <?php
      // This whole section is for printing the "new" marker. With core comment
      // we just need to check a variable. With Node Comment, we need to do
      // extra work to keep the views caching used for Node Comment from
      //caching the new markers.
      ?>
      <?php if (!$top_post): ?>
        <?php if (!empty($new)): ?>
          <a id="new"><span class="new">(<?php print $new ?>)</span></a>
        <?php endif; ?>

        <?php if (!empty($first_new)): ?>
          <?php print $first_new; ?>
        <?php endif; ?>

        <?php if (!empty($new_output)): ?>
          <?php print $new_output; ?>
        <?php endif; ?>
      <?php endif; ?>
      </div>  <?php // End of posted on div ?>

    <?php if (!empty($in_reply_to)): ?>
   	 <span class="forum-in-reply-to"><?php print $in_reply_to; ?></span>
    <?php endif; ?>

    <?php // Add a note when a post is unpublished so it doesn't rely on theming. ?>
    <?php if (!$node->status): ?>
      <span class="unpublished-post-note"><?php print t("Unpublished post") ?></span>
    <?php endif; ?>

  </div> <?php // End of post info div ?>

      
      <div class="forum-post-content">
        <?php
          // We hide the comments and links now so that we can render them later.
          hide($content['taxonomy_forums']);
          hide($content['comments']);
          hide($content['links']);
          if (!$top_post)
            hide($content['body']);
          print render($content);
        ?>
      </div>

      <?php if (!empty($signature)): ?>
        <div class="author-signature">
          <?php print $signature ?>
        </div>
      <?php endif; ?>
    </div>
  </div> <?php // End of post wrapper div ?>

  <div class="forum-post-footer clearfix">

    <div class="forum-post-links">
      <?php print render($content['links']); ?>
    </div>
  </div> <?php // End of footer div ?>
  <div class="forum-post-btm"></div>  
</div> <?php // End of main wrapping div ?>

<?php print render($content['comments']); ?>
