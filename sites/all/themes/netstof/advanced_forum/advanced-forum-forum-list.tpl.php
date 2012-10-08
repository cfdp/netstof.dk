<?php
/**
 * @file
 * Default theme implementation to display a list of forums and containers.
 *
 * Available variables:
 * - $forums: An array of forums and containers to display. It is keyed to the
 *   numeric id's of all child forums and containers.
 * - $forum_id: Forum id for the current forum. Parent to all items within
 *   the $forums array.
 *
 * Each $forum in $forums contains:
 * - $forum->is_container: Is TRUE if the forum can contain other forums. Is
 *   FALSE if the forum can contain only topics.
 * - $forum->depth: How deep the forum is in the current hierarchy.
 * - $forum->zebra: 'even' or 'odd' string used for row class.
 * - $forum->name: The name of the forum.
 * - $forum->link: The URL to link to this forum.
 * - $forum->description: The description of this forum.
 * - $forum->new_topics: True if the forum contains unread posts.
 * - $forum->new_url: A URL to the forum's unread posts.
 * - $forum->new_text: Text for the above URL which tells how many new posts.
 * - $forum->old_topics: A count of posts that have already been read.
 * - $forum->total_posts: The total number of posts in the forum.
 * - $forum->last_reply: Text representing the last time a forum was posted or
 *   commented in.
 * - $forum->forum_image: If used, contains an image to display for the forum.
 *
 * @see template_preprocess_forum_list()
 * @see theme_forum_list()
 */
?>

<?php
/*
  The $tables variable holds the individual tables to be shown. A table is
  either created from a root level container or added as needed to hold root
  level forums. The following code will loop through each of the tables.
  In each table, it loops through the items in the table. These items may be
  subcontainers or forums. Subcontainers are printed simply with the name
  spanning the entire table. Forums are printed out in more detail. Subforums
  have already been attached to their parent forums in the preprocessing code
  and will display under their parents.
 */
?>

<?php foreach ($tables as $table_id => $table): ?>
  <?php $table_info = $table['table_info']; ?>
	<div id="forum-wrapper">
    <?php foreach ($table['items'] as $item_id => $item): ?>
	
	<div class="forum-item">
		<div>
		<?php if (!empty($item->forum_image)): ?>
		<div class="forum-icon">
		<?php print $item->forum_image; ?>
		</div>
		<?php endif; ?>
		<div class="forum-name">
		<a href="<?php print $item->link; ?>"><?php print $item->name; ?></a>
		</div>
		<div class="forum-number-topics">
		<?php print t("Topics").": ".$item->total_topics ?>
		</div>
		<div class="forum-number-posts">
		<?php print t("Posts").": ".$item->total_posts ?>
		</div>
		<?php if (!empty($item->description)): ?>
		<div class="forum-description">
		<?php print $item->description; ?>
		</div>
		<?php endif; ?>
		<div class="forum-last-reply">
		<strong>Seneste indlæg:</strong>
		<?php print $item->last_post ?>
		</div>
		<div class="goto-forum">
			<a href="<?php print $item->link; ?>" class="goto-link">Gå til forum</a>
			<a href="/node/add/forum" class="add-link tooltip" title="Opret et nyt emne i dette forum"></a>
		</div>
		</div>
	</div>
	
    <?php endforeach; ?>
	</div>
<?php endforeach; ?>
