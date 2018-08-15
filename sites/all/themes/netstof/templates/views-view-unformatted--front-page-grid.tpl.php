<?php

/**
 * @file
 * Default simple view template to display a list of rows.
 *
 * @ingroup views_templates
 */
?>
    <?php if (!empty($title)): ?>
    <h3>
        <?php print $title; ?>
    </h3>
    <?php endif; ?>
    <?php foreach ($rows as $id => $row): ?>
    
    <?php if ($id == 0): ?>
        <div class="views-row-image first" style="background-image:url(sites/all/themes/netstof/images/front-view-fill-large.png);">
        </div>
    <?php endif; ?>
     <?php if ($id == 4): ?>
        <div class="views-row-image last" style="background-image:url(sites/all/themes/netstof/images/front-view-fill-small.png);">
        </div>
    <?php endif; ?>

    <div<?php if ($classes_array[$id]) { print ' class="' . $classes_array[$id] . '"'; } ?>>
    <?php print $row; ?>
    </div>
    <?php endforeach; ?>