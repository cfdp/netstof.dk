<?php
/**
 * @file
 * Adaptivetheme implementation to display a single Drupal page.
 *
 * Available variables:
 *
 * Adaptivetheme supplied variables:
 * - $site_logo: Themed logo - linked to front with alt attribute.
 * - $site_name: Site name linked to the homepage.
 * - $site_name_unlinked: Site name without any link.
 * - $hide_site_name: Toggles the visibility of the site name.
 * - $visibility: Holds the class .element-invisible or is empty.
 * - $primary_navigation: Themed Main menu.
 * - $secondary_navigation: Themed Secondary/user menu.
 * - $primary_local_tasks: Split local tasks - primary.
 * - $secondary_local_tasks: Split local tasks - secondary.
 * - $tag: Prints the wrapper element for the main content.
 * - $is_mobile: Bool, requires the Browscap module to return TRUE for mobile
 *   devices. Use to test for a mobile context.
 * - *_attributes: attributes for various site elements, usually holds id, class
 *   or role attributes.
 *
 * General utility variables:
 * - $base_path: The base URL path of the Drupal installation. At the very
 *   least, this will always default to /.
 * - $directory: The directory the template is located in, e.g. modules/system
 *   or themes/bartik.
 * - $is_front: TRUE if the current page is the front page.
 * - $logged_in: TRUE if the user is registered and signed in.
 * - $is_admin: TRUE if the user has permission to access administration pages.
 *
 * Site identity:
 * - $front_page: The URL of the front page. Use this instead of $base_path,
 *   when linking to the front page. This includes the language domain or
 *   prefix.
 * - $logo: The path to the logo image, as defined in theme configuration.
 * - $site_slogan: The slogan of the site, empty when display has been disabled
 *   in theme settings.
 *
 * Navigation:
 * - $main_menu (array): An array containing the Main menu links for the
 *   site, if they have been configured.
 * - $secondary_menu (array): An array containing the Secondary menu links for
 *   the site, if they have been configured.
 * - $breadcrumb: The breadcrumb trail for the current page.
 *
 * Page content (in order of occurrence in the default page.tpl.php):
 * - $title_prefix (array): An array containing additional output populated by
 *   modules, intended to be displayed in front of the main title tag that
 *   appears in the template.
 * - $title: The page title, for use in the actual HTML content.
 * - $title_suffix (array): An array containing additional output populated by
 *   modules, intended to be displayed after the main title tag that appears in
 *   the template.
 * - $messages: HTML for status and error messages. Should be displayed
 *   prominently.
 * - $tabs (array): Tabs linking to any sub-pages beneath the current page
 *   (e.g., the view and edit tabs when displaying a node).
 * - $action_links (array): Actions local to the page, such as 'Add menu' on the
 *   menu administration interface.
 * - $feed_icons: A string of all feed icons for the current page.
 * - $node: The node object, if there is an automatically-loaded node
 *   associated with the page, and the node ID is the second argument
 *   in the page's path (e.g. node/12345 and node/12345/revisions, but not
 *   comment/reply/12345).
 *
 * Core Regions:
 * - $page['help']: Dynamic help text, mostly for admin pages.
 * - $page['highlighted']: Items for the highlighted content region.
 * - $page['content']: The main content of the current page.
 * - $page['sidebar_first']: Items for the first sidebar.
 * - $page['sidebar_second']: Items for the second sidebar.
 * - $page['header']: Items for the header region.
 * - $page['footer']: Items for the footer region.
 *
 * Adaptivetheme Regions:
 * - $page['leaderboard']: full width at the very top of the page
 * - $page['menu_bar']: menu blocks placed here will be styled horizontal
 * - $page['secondary_content']: full width just above the main columns
 * - $page['content_aside']: like a main content bottom region
 * - $page['tertiary_content']: full width just above the footer
 *
 * @see template_preprocess()
 * @see template_preprocess_page()
 * @see template_process()
 * @see adaptivetheme_preprocess_page()
 * @see adaptivetheme_process_page()
 */
?>

<div id="header-container">
    
  <header class="container">

    <?php if ($site_logo || $site_name || $site_slogan): ?>
      <!-- start: Branding -->
      <div<?php print $branding_attributes; ?>>

        <?php if ($site_logo): ?>
          <div id="logo">
            <?php print $site_logo; ?>
          </div>
        <?php endif; ?>

        <?php if ($site_name || $site_slogan): ?>
          <!-- start: Site name and Slogan hgroup -->
          <hgroup<?php print $hgroup_attributes; ?>>

            <?php if ($site_name): ?>
              <h1<?php print $site_name_attributes; ?>><?php print $site_name; ?></h1>
            <?php endif; ?>

            <?php if ($site_slogan): ?>
              <h2<?php print $site_slogan_attributes; ?>><?php print $site_slogan; ?></h2>
            <?php endif; ?>

          </hgroup><!-- /end #name-and-slogan -->
        <?php endif; ?>

      </div><!-- /end #branding -->
    <?php endif; ?>

    <!-- region: Header -->
      <div class="search-icon active">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 25 25" class="svg-search"><path class="search-svg" d="M18,16.1l7,7L23.1,25l-7-7A9.9,9.9,0,0,1,10,20,10,10,0,1,1,20,10,9.9,9.9,0,0,1,18,16.1Zm-8,1.3A7.4,7.4,0,1,0,2.7,10,7.4,7.4,0,0,0,10,17.4Z"></path></svg>       
    </div>
    <?php print render($page['header']); ?>
  </header>
</div>

<div id="header-btm-container">
	<div class="container">
		<a href="/paaroerende" title="Artikler og rådgivning for pårørende"><img src="<?php print $base_path.drupal_get_path("theme","netstof").$variables['paaroerende_img'];?>" id="find-hjaelp" /></a>
	</div>
</div>

<div id="page" class="container <?php print $classes; ?>">
    
    <div id="columns" class="search-mobile clearfix">
        <?php
            $block = module_invoke('search', 'block_view', 'search');
            print render($block); 
        ?>
    </div>

  <!-- Messages and Help -->
  <?php print $messages; ?>
  <?php print render($page['help']); ?>

  <div id="columns" class="columns clearfix">

    <!-- regions: Sidebar top -->
    <?php $sidebar_top = render($page['sidebar_top']); print $sidebar_top; ?>

    <div id="content-column" class="content-column" role="main">

      <div class="content-inner clearfix">

        <<?php print $tag; ?> id="main-content">

          <?php print render($title_prefix); // Does nothing by default in D7 core ?>

          <?php if ($title || $primary_local_tasks || $secondary_local_tasks || $action_links = render($action_links)): ?>
            <header<?php print $content_header_attributes; ?>>

          	  <?php
          	  /* Hide titles on all node and forum pages */
          	  $show_title = TRUE;

          	  if(arg(0)=="node" && is_numeric(arg(1))) {
					  $show_title = false;
          	  }
          	  else if(arg(0)=="forum" && is_numeric(arg(1))) {
	          	  $show_title = false;
          	  }
          	  ?>

              <?php if ($title && $show_title): ?>
                <h1 id="page-title">
                  <?php print $title; ?>
                </h1>
              <?php endif; ?>

              <?php if ($primary_local_tasks || $secondary_local_tasks || $action_links): ?>
                <div id="tasks">

                  <?php if ($primary_local_tasks): ?>
                    <ul class="tabs primary clearfix"><?php print render($primary_local_tasks); ?></ul>
                  <?php endif; ?>

                  <?php if ($secondary_local_tasks): ?>
                    <ul class="tabs secondary clearfix"><?php print render($secondary_local_tasks); ?></ul>
                  <?php endif; ?>

                  <?php if ($action_links = render($action_links)): ?>
                    <ul class="action-links clearfix"><?php print $action_links; ?></ul>
                  <?php endif; ?>

                </div>
              <?php endif; ?>

            </header>
          <?php endif; ?>

          <!-- region: Main Content -->
          <?php if(!$is_front): ?>
            <div id="content" class="region">
              <?php print render($page["content"]); ?>
            </div>
            <div id="content-btm-shadow"></div>
          <?php endif; ?>

          <!-- region: Main Content Front Page or Pårørende Front Page-->
          <?php if($is_front  || (request_path() == "paaroerende")): ?>
            <div id="content-btm" class="region">
              <?php print render($page["content_front"]); ?>
            </div>
          <?php endif; ?>

          <!-- Feed icons (RSS, Atom icons etc -->
          <?php //print $feed_icons; ?>

          <?php print render($title_suffix); // Prints page level contextual links ?>

        </<?php print $tag; ?>><!-- /end #main-content -->

      </div><!-- /end .content-inner -->
    </div><!-- /end #content-column -->

    <!-- region: Sidebar first -->
    <?php $sidebar_first = render($page['sidebar_first']); print $sidebar_first; ?>

  </div><!-- /end #columns -->

  <!-- region: Featured -->
  <?php if($is_front || (request_path() == "paaroerende")) print render($page['featured']); ?>

</div>

<!-- Breadcrumbs -->
<?php if ($breadcrumb): print $breadcrumb; endif; ?>

<!-- region: Footer -->
<?php if ($page['footer']): ?>

<div id="footer-container">

	<div id="footer-top" class="container">
	  <?php print render($page['footer_top']); ?>
	</div>

	<footer class="container">
	  <?php print render($page['footer']); ?>
	</footer>

	<div id="scroll-top">
		<a href="#"></a>
	</div>

</div>

<div id="footer-white">
	<div id="footer-btm" class="container">
	  <?php print render($page['footer_btm']); ?>
	</div>
</div>

<?php endif; ?>

<!-- region: Tabs Right -->
<?php if ($page['tabs_right']): ?>
	  <?php print render($page['tabs_right']); ?>
<?php endif; ?>
