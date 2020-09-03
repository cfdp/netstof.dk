<?php
/**
 * @file
 * Adaptivetheme implementation to display the basic html structure of a single
 * Drupal page.
 *
 * Adaptivetheme Variables:
 * - $html_attributes: structure attributes, includes the lang and dir attributes
 *   by default, use $vars['html_attributes_array'] to add attributes in preprcess
 * - $polyfills: prints IE conditional polyfill scripts enabled via theme
 *   settings.
 * - $skip_link_target: prints an ID for the skip navigation target, set in
 *   theme settings.
 * - $is_mobile: Bool, requires the Browscap module to return TRUE for mobile
 *   devices. Use to test for a mobile context.
 *
 * Available Variables:
 * - $css: An array of CSS files for the current page.
 * - $language: (object) The language the site is being displayed in.
 *   $language->language contains its textual representation.
 *   $language->dir contains the language direction. It will either be 'ltr' or 'rtl'.
 * - $rdf_namespaces: All the RDF namespace prefixes used in the HTML document.
 * - $grddl_profile: A GRDDL profile allowing agents to extract the RDF data.
 * - $head_title: A modified version of the page title, for use in the TITLE
 *   tag.
 * - $head_title_array: (array) An associative array containing the string parts
 *   that were used to generate the $head_title variable, already prepared to be
 *   output as TITLE tag. The key/value pairs may contain one or more of the
 *   following, depending on conditions:
 *   - title: The title of the current page, if any.
 *   - name: The name of the site.
 *   - slogan: The slogan of the site, if any, and if there is no title.
 * - $head: Markup for the HEAD section (including meta tags, keyword tags, and
 *   so on).
 * - $styles: Style tags necessary to import all CSS files for the page.
 * - $scripts: Script tags necessary to load the JavaScript files and settings
 *   for the page.
 * - $page_top: Initial markup from any modules that have altered the
 *   page. This variable should always be output first, before all other dynamic
 *   content.
 * - $page: The rendered page content.
 * - $page_bottom: Final closing markup from any modules that have altered the
 *   page. This variable should always be output last, after all other dynamic
 *   content.
 * - $classes String of classes that can be used to style contextually through
 *   CSS.
 *
 * @see template_preprocess()
 * @see template_preprocess_html()
 * @see template_process()
 * @see adaptivetheme_preprocess_html()
 * @see adaptivetheme_process_html()
 */
?><!DOCTYPE html>
<!--[if IEMobile 7]><html class="iem7"<?php print $html_attributes; ?>><![endif]-->
<!--[if lte IE 6]><html class="lt-ie9 lt-ie8 lt-ie7"<?php print $html_attributes; ?>><![endif]-->
<!--[if (IE 7)&(!IEMobile)]><html class="lt-ie9 lt-ie8"<?php print $html_attributes; ?>><![endif]-->
<!--[if IE 8]><html class="lt-ie9"<?php print $html_attributes; ?>><![endif]-->
<!--[if (gte IE 9)|(gt IEMobile 7)]><!--><html<?php print $html_attributes . $rdf_namespaces; ?>><!--<![endif]-->
<head>
<?php print $head; ?>
<title><?php print $head_title; ?></title>
<?php print $styles; ?>
<?php print $scripts; ?>
<?php print $polyfills; ?>
</head>
<body class="<?php print $classes; ?>"<?php print $attributes; ?>>

  <div class="mobile-menu-overlay">
      <span class="close-menu">
          <svg width="200" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 23" class="close-menu-btn"> <path class="cross" d="M14.1,11.5l8.6-8.6c0.5-0.5,0.5-1.4-0.1-2c-0.6-0.6-1.5-0.6-2-0.1L12,9.4L3.4,0.8C2.9,0.3,2,0.3,1.4,0.9c-0.6,0.6-0.6,1.5-0.1,2l8.6,8.6l-8.6,8.6c-0.5,0.5-0.5,1.4,0.1,2c0.6,0.6,1.5,0.6,2,0.1l8.6-8.6l8.6,8.6c0.5,0.5,1.4,0.5,2-0.1c0.6-0.6,0.6-1.5,0.1-2L14.1,11.5z"></path> </svg>
      </span>
      <?php
            $block = module_invoke('menu_block', 'block_view', 1);
            print render($block['content']);
       ?>
  </div>

  <div id="skip-link">
    <a href="<?php print $skip_link_target; ?>" class="element-invisible element-focusable"><?php print t('Skip to main content'); ?></a>
  </div>


    <div class="header-search">

        <?php
            $block = module_invoke('search', 'block_view', 'search');
            print render($block);
        ?>
        <span class="close-search">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 23" class="close-search-btn">
            <path class="cross" d="M14.1,11.5l8.6-8.6c0.5-0.5,0.5-1.4-0.1-2c-0.6-0.6-1.5-0.6-2-0.1L12,9.4L3.4,0.8C2.9,0.3,2,0.3,1.4,0.9c-0.6,0.6-0.6,1.5-0.1,2l8.6,8.6l-8.6,8.6c-0.5,0.5-0.5,1.4,0.1,2c0.6,0.6,1.5,0.6,2,0.1l8.6-8.6l8.6,8.6c0.5,0.5,1.4,0.5,2-0.1c0.6-0.6,0.6-1.5,0.1-2L14.1,11.5z"></path>
            </svg>
        </span>

    </div>



  <?php print $page_top; ?>
  <?php print $page; ?>
  <?php print $page_bottom; ?>

</body>
</html>
