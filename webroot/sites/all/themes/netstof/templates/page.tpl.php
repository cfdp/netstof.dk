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

          <div id="logo">
            <a href="/">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 622.9 166.9"><path class="a" d="M98.3,97.5V41.1H41.9V97.5ZM58.1,57.3h24v24h-24Z" transform="translate(-10.4 -9.9)"/><path class="b" d="M197.1,125.1V87.3c0-14-4.6-20.3-16.5-20.3-7.1,0-13.4,2.5-16.8,8v50.1H149.5v-69h12.1l1,6.2a30.1,30.1,0,0,1,20.1-7.6c20.7,0,28.7,12.9,28.7,32.6v37.8Z" transform="translate(-10.4 -9.9)"/><path class="b" d="M235.3,91.9c1.9,17,12.4,22.3,24.1,22.3a49.7,49.7,0,0,0,20.3-4.6l1.4,11.6a53.5,53.5,0,0,1-23.1,5.3c-24.5,0-37.4-16.5-37.4-36.2S233,54.7,254.2,54.7c17.4,0,30,11.1,30,29.5a36.1,36.1,0,0,1-.7,7.7Zm.9-9.8h33.4c0-8.5-4.6-15.1-15.4-15.1S238.4,72.9,236.2,82.1Z" transform="translate(-10.4 -9.9)"/><path class="b" d="M329.1,126.5H317.4c-13,0-18.2-8.5-18.2-17.1v-42H288l1.2-11.3h10V39.6l14.3-1.4V56.1h17V67.4h-17V102c0,12.2.8,13,13,13h3.8Z" transform="translate(-10.4 -9.9)"/><path class="b" d="M335.2,120.8l1.5-13c3.4,2.8,11.9,7,21.4,7s12.6-3.5,12.6-8.3c0-6.7-7.3-9.2-13.4-10.9-9.5-2.7-21-6-21-19.8,0-10.2,6.6-21.1,25.7-21.1a40.2,40.2,0,0,1,19.8,4.8l-1.6,12.6a26.7,26.7,0,0,0-17.6-6.6c-7.3,0-12.7,2.6-12.7,8.8s5.8,8,15.9,10.9c7.7,2.3,19.5,6.5,19.5,20.9,0,8.8-4.6,20.4-26.6,20.4C346.9,126.5,338.7,123.2,335.2,120.8Z" transform="translate(-10.4 -9.9)"/><path class="b" d="M429.9,126.5H418.2c-13,0-18.2-8.5-18.2-17.1v-42H388.8L390,56.1h10V39.6l14.3-1.4V56.1h17V67.4h-17V102c0,12.2.8,13,13,13h3.8Z" transform="translate(-10.4 -9.9)"/><path class="b" d="M435.7,90.7c0-19.9,12.6-36,34.4-36s34.6,16.1,34.6,36-12.7,35.8-34.6,35.8S435.7,110.4,435.7,90.7Zm14.5,0c0,14.5,7.2,23.5,19.9,23.5s20-9,20-23.5S483,67,470.1,67,450.2,76,450.2,90.7Z" transform="translate(-10.4 -9.9)"/><path class="b" d="M532.7,67.4v57.7H518.4V67.4H507.2l1.6-11.3h9.6V38.9c0-10.4,5.5-18.8,16.3-18.8,8.4,0,11,.6,14.8,1.6l-1.8,11.9a29.9,29.9,0,0,0-8.1-1.2c-6.1,0-6.9,2.7-6.9,14.9v8.8h17.4V67.4Z" transform="translate(-10.4 -9.9)"/><path class="b" d="M553.6,125.1V118h7.1v7.1Z" transform="translate(-10.4 -9.9)"/><path class="b" d="M591.9,125.1l-.6-3.5a13.9,13.9,0,0,1-9.8,4.2c-9.6,0-16.1-8-16.1-17.9s5.9-18,16.1-18c3.3,0,7,.8,9.7,3.6V72.6h7.1v52.5Zm-19.2-17.2c0,6.6,3.5,11.8,9.3,11.8s9.8-3.8,9.8-11.7-4.6-11.9-9.8-11.9S572.7,101,572.7,107.9Z" transform="translate(-10.4 -9.9)"/><path class="b" d="M605.3,125.1V72.6h7.1v33.1l12.1-15.1h8.4l-13.7,16.1,14,18.4h-8.4l-12.4-16.8v16.8Z" transform="translate(-10.4 -9.9)"/><path class="b" d="M26.8,168.3l-5.2-9.2H16.8v9.2H13.1V144.4h8.1c4.8,0,8.2,1.7,8.2,7a7.3,7.3,0,0,1-4.2,6.8l5.5,10.1Zm-10-20.9v8.3h4.5c2.6,0,4.3-1.3,4.3-4.2s-1.4-4.1-4.8-4.1Z" transform="translate(-10.4 -9.9)"/><path class="b" d="M46.3,168.7h-.7c-2.6,0-3.5-.9-4.2-2.3a6.6,6.6,0,0,1-5.1,2.3,4.8,4.8,0,0,1-5.1-5c0-4.7,6-5.9,9.9-6-.1-2.8-1.2-3.5-3.5-3.5a8,8,0,0,0-4.5,1.4l-.4-2.8a11.3,11.3,0,0,1,5.9-1.7c4.1,0,5.9,2,5.9,7.7v3.8c0,2.5.3,3.3,1.8,3.3h.4Zm-5.2-8.6c-4,.1-6.3,1.1-6.3,3.4s.9,2.4,2.5,2.4a5.2,5.2,0,0,0,3.8-1.9Zm-5.9-14.5a3.2,3.2,0,0,1,3.5-3.1c2.4,0,3.6,1.5,3.6,3.1s-1.2,3-3.6,3S35.2,147.2,35.2,145.6Zm1.7,0a1.7,1.7,0,0,0,1.8,1.8,1.8,1.8,0,0,0,1.9-1.8,1.8,1.8,0,0,0-1.9-1.8A1.7,1.7,0,0,0,36.9,145.6Z" transform="translate(-10.4 -9.9)"/><path class="b" d="M60.3,168.3l-.2-1.7a6.8,6.8,0,0,1-4.8,2.1c-4.7,0-7.9-3.9-7.9-8.8s2.9-8.8,7.9-8.8a6.2,6.2,0,0,1,4.7,1.8V142.7h3.5v25.6ZM51,159.9c0,3.3,1.7,5.8,4.5,5.8s4.8-1.9,4.8-5.7-2.2-5.9-4.8-5.9S51,156.6,51,159.9Z" transform="translate(-10.4 -9.9)"/><path class="b" d="M65.8,171.8c0-1.1.5-2.8,2.9-3.8a2.5,2.5,0,0,1-1.7-2.2,2.9,2.9,0,0,1,1.9-2.4,6.4,6.4,0,0,1-2.8-5.5,6.5,6.5,0,0,1,6.9-6.8,7.3,7.3,0,0,1,4.1,1.2,8.3,8.3,0,0,1,3.9-.9h.6l-.4,2.3H78.6a6.5,6.5,0,0,1,1.3,4,6.5,6.5,0,0,1-6.8,6.7,8.3,8.3,0,0,1-2.2-.3,1,1,0,0,0-.6.9c0,.8,1.3,1,4.9,1.6S82,168,82,171.5s-2.9,5.4-8.3,5.4S65.8,174.1,65.8,171.8Zm5.7-2.9c-1.5.5-2.6,1.5-2.6,2.8s1.7,2.6,4.8,2.6,4.9-1.2,4.9-2.6-1.7-2-4.4-2.4Zm-2.2-11.1c0,2.5,1.5,4,3.7,4s3.7-1.7,3.7-4.1-1.4-3.9-3.7-3.9S69.3,155.5,69.3,157.8Z" transform="translate(-10.4 -9.9)"/><path class="b" d="M83.3,148.1v-3.7h3.5v3.7Zm0,20.2V151.5h3.5v16.8Z" transform="translate(-10.4 -9.9)"/><path class="b" d="M98.3,168.3H94.8l-6.4-16.8h3.7l4.5,12.8,4.4-12.8h3.7Z" transform="translate(-10.4 -9.9)"/><path class="b" d="M117.9,168.3v-9.2c0-3.4-1.1-5-4-5a4.7,4.7,0,0,0-4.1,2v12.2h-3.5V151.5h3l.2,1.5a7.3,7.3,0,0,1,4.9-1.9c5.1,0,7,3.2,7,8v9.2Z" transform="translate(-10.4 -9.9)"/><path class="b" d="M124.7,148.1v-3.7h3.5v3.7Zm0,20.2V151.5h3.5v16.8Z" transform="translate(-10.4 -9.9)"/><path class="b" d="M143.2,168.3v-9.2c0-3.4-1.1-5-4-5a4.6,4.6,0,0,0-4.1,2v12.2h-3.5V151.5h2.9l.3,1.5a7.3,7.3,0,0,1,4.9-1.9c5,0,7,3.2,7,8v9.2Z" transform="translate(-10.4 -9.9)"/><path class="b" d="M148.8,171.8a4.2,4.2,0,0,1,2.9-3.8,2.4,2.4,0,0,1-1.6-2.2,2.8,2.8,0,0,1,1.8-2.4,6.7,6.7,0,0,1-2.8-5.5,6.5,6.5,0,0,1,6.9-6.8,7.1,7.1,0,0,1,4.1,1.2,8.8,8.8,0,0,1,4-.9h.5l-.3,2.3h-2.7a6.1,6.1,0,0,1,1.4,4,6.5,6.5,0,0,1-6.8,6.7,7.3,7.3,0,0,1-2.2-.3,1.1,1.1,0,0,0-.7.9c0,.8,1.3,1,4.9,1.6s6.8,1.3,6.8,4.8-2.8,5.4-8.3,5.4S148.8,174.1,148.8,171.8Zm5.7-2.9c-1.4.5-2.6,1.5-2.6,2.8s1.7,2.6,4.8,2.6,5-1.2,5-2.6-1.8-2-4.5-2.4Zm-2.1-11.1c0,2.5,1.4,4,3.7,4s3.6-1.7,3.6-4.1-1.4-3.9-3.7-3.9S152.4,155.5,152.4,157.8Z" transform="translate(-10.4 -9.9)"/><path class="b" d="M172.4,159.9c0-4.8,3-8.8,8.4-8.8s8.4,4,8.4,8.8-3.1,8.8-8.4,8.8S172.4,164.7,172.4,159.9Zm3.5,0c0,3.6,1.8,5.8,4.9,5.8s4.9-2.2,4.9-5.8-1.8-5.8-4.9-5.8S175.9,156.3,175.9,159.9Z" transform="translate(-10.4 -9.9)"/><path class="b" d="M214.1,168.3v-9.6c0-3.1-1.1-4.6-3.7-4.6s-4.1,2.4-4.1,4.2v10h-3.4v-9.2c0-4-1.4-5-3.8-5a4.5,4.5,0,0,0-4,2v12.2h-3.5V151.5h2.8l.3,1.6a6.8,6.8,0,0,1,4.8-2,6,6,0,0,1,5.5,3.1,6.5,6.5,0,0,1,6-3.1c4.4,0,6.6,2.7,6.6,7.6v9.6Z" transform="translate(-10.4 -9.9)"/><path class="b" d="M241.7,168.7H241c-2.6,0-3.5-.9-4.2-2.3a6.6,6.6,0,0,1-5.1,2.3,4.8,4.8,0,0,1-5.1-5c0-4.7,5.9-5.9,9.8-6,0-2.8-1.1-3.5-3.4-3.5a8,8,0,0,0-4.5,1.4l-.4-2.8a11,11,0,0,1,5.8-1.7c4.1,0,6,2,6,7.7v3.8c0,2.5.2,3.3,1.8,3.3h.4Zm-5.2-8.6c-4.1.1-6.3,1.1-6.3,3.4s.9,2.4,2.5,2.4a5.2,5.2,0,0,0,3.8-1.9Z" transform="translate(-10.4 -9.9)"/><path class="b" d="M249.3,168.7h-1.2c-3.2,0-4.3-2-4.3-4.2V142.7h3.4v20c0,2.8.4,3.2,2.5,3.2Z" transform="translate(-10.4 -9.9)"/><path class="b" d="M251.5,168.3V142.7H255v16.1l5.9-7.3H265l-6.7,7.8,6.8,9H261l-6-8.2v8.2Z" transform="translate(-10.4 -9.9)"/><path class="b" d="M264.9,159.9c0-4.8,3.1-8.8,8.4-8.8s8.5,4,8.5,8.8-3.2,8.8-8.5,8.8S264.9,164.7,264.9,159.9Zm3.5,0c0,3.6,1.8,5.8,4.9,5.8s4.9-2.2,4.9-5.8-1.7-5.8-4.9-5.8S268.4,156.3,268.4,159.9Z" transform="translate(-10.4 -9.9)"/><path class="b" d="M295.4,168.3v-9c0-3.7-1-5.2-3.8-5.2a4.4,4.4,0,0,0-3.9,2v12.2h-3.5V142.7h3.5v10.2a5.9,5.9,0,0,1,4.4-1.8c5,0,6.8,3.4,6.8,8.2v9Z" transform="translate(-10.4 -9.9)"/><path class="b" d="M301.1,159.9c0-4.8,3.1-8.8,8.5-8.8s8.4,4,8.4,8.8-3.1,8.8-8.4,8.8S301.1,164.7,301.1,159.9Zm3.6,0c0,3.6,1.7,5.8,4.9,5.8s4.8-2.2,4.8-5.8-1.7-5.8-4.8-5.8S304.7,156.3,304.7,159.9Z" transform="translate(-10.4 -9.9)"/><path class="b" d="M325.9,168.7h-1.2c-3.1,0-4.3-2-4.3-4.2V142.7h3.5v20c0,2.8.3,3.2,2.4,3.2Z" transform="translate(-10.4 -9.9)"/><path class="b" d="M328.8,172.1l-.8-.5,1.2-3-1.2-.3v-3.4h3.7v3.4Z" transform="translate(-10.4 -9.9)"/><path class="b" d="M353.3,168.3v-9c0-3.7-1-5.2-3.8-5.2a4.5,4.5,0,0,0-4,2v12.2H342V142.7h3.5v10.2a5.9,5.9,0,0,1,4.4-1.8c5,0,6.9,3.4,6.9,8.2v9Z" transform="translate(-10.4 -9.9)"/><path class="b" d="M373.8,168.7h-.7c-2.6,0-3.5-.9-4.1-2.3a6.9,6.9,0,0,1-5.2,2.3,4.8,4.8,0,0,1-5.1-5c0-4.7,6-5.9,9.9-6,0-2.8-1.1-3.5-3.5-3.5a8.2,8.2,0,0,0-4.5,1.4l-.4-2.8a11.3,11.3,0,0,1,5.9-1.7c4.1,0,6,2,6,7.7v3.8c0,2.5.2,3.3,1.8,3.3h.4Zm-5.2-8.6c-4,.1-6.3,1.1-6.3,3.4s.9,2.4,2.5,2.4a4.9,4.9,0,0,0,3.8-1.9Z" transform="translate(-10.4 -9.9)"/><path class="b" d="M375,167.3l.4-3.2a8.8,8.8,0,0,0,5.2,1.7c2.1,0,3.1-.9,3.1-2s-1.8-2.3-3.3-2.7-5.1-1.5-5.1-4.8,1.6-5.2,6.3-5.2a9.3,9.3,0,0,1,4.8,1.2l-.4,3.1a6.5,6.5,0,0,0-4.3-1.6c-1.8,0-3.1.6-3.1,2.1s1.4,2,3.9,2.7,4.8,1.6,4.8,5.1-1.2,5-6.5,5A10.9,10.9,0,0,1,375,167.3Z" transform="translate(-10.4 -9.9)"/><path class="b" d="M400.8,168.3v-9c0-3.7-1-5.2-3.8-5.2a4.4,4.4,0,0,0-3.9,2v12.2h-3.5V142.7h3.5v10.2a5.9,5.9,0,0,1,4.4-1.8c5,0,6.8,3.4,6.8,8.2v9Z" transform="translate(-10.4 -9.9)"/><path class="b" d="M413.6,159.9c0-4.8,3-8.8,8.4-8.8s8.4,4,8.4,8.8-3.1,8.8-8.4,8.8S413.6,164.7,413.6,159.9Zm3.5,0c0,3.6,1.8,5.8,4.9,5.8s4.9-2.2,4.9-5.8-1.8-5.8-4.9-5.8S417.1,156.3,417.1,159.9Z" transform="translate(-10.4 -9.9)"/><path class="b" d="M431.7,171.8a4.2,4.2,0,0,1,2.9-3.8,2.5,2.5,0,0,1-1.7-2.2,2.9,2.9,0,0,1,1.9-2.4,6.7,6.7,0,0,1-2.8-5.5,6.5,6.5,0,0,1,6.9-6.8,7.1,7.1,0,0,1,4.1,1.2,8.8,8.8,0,0,1,4-.9h.5l-.3,2.3h-2.7a6.1,6.1,0,0,1,1.4,4,6.5,6.5,0,0,1-6.8,6.7,8.5,8.5,0,0,1-2.3-.3,1.1,1.1,0,0,0-.6.9c0,.8,1.3,1,4.9,1.6s6.8,1.3,6.8,4.8-2.8,5.4-8.3,5.4S431.7,174.1,431.7,171.8Zm5.7-2.9c-1.4.5-2.6,1.5-2.6,2.8s1.7,2.6,4.8,2.6,5-1.2,5-2.6-1.8-2-4.5-2.4Zm-2.1-11.1c0,2.5,1.4,4,3.7,4s3.6-1.7,3.6-4.1-1.4-3.9-3.7-3.9S435.3,155.5,435.3,157.8Z" transform="translate(-10.4 -9.9)"/><path class="b" d="M470.1,168.7h-.7c-2.6,0-3.5-.9-4.2-2.3a6.6,6.6,0,0,1-5.1,2.3,4.8,4.8,0,0,1-5.1-5c0-4.7,6-5.9,9.9-6-.1-2.8-1.2-3.5-3.5-3.5a8,8,0,0,0-4.5,1.4l-.4-2.8a11.3,11.3,0,0,1,5.9-1.7c4.1,0,5.9,2,5.9,7.7v3.8c0,2.5.3,3.3,1.8,3.3h.4Zm-5.2-8.6c-4,.1-6.3,1.1-6.3,3.4s.9,2.4,2.5,2.4a5.2,5.2,0,0,0,3.8-1.9Z" transform="translate(-10.4 -9.9)"/><path class="b" d="M483.8,168.3v-9.2c0-3.4-1.1-5-4-5a4.7,4.7,0,0,0-4.1,2v12.2h-3.5V151.5h3l.2,1.5a7.3,7.3,0,0,1,4.9-1.9c5.1,0,7,3.2,7,8v9.2Z" transform="translate(-10.4 -9.9)"/><path class="b" d="M502.5,168.3l-.3-1.7a6.4,6.4,0,0,1-4.8,2.1c-4.6,0-7.8-3.9-7.8-8.8s2.9-8.8,7.8-8.8a6.3,6.3,0,0,1,4.8,1.8V142.7h3.5v25.6Zm-9.4-8.4c0,3.3,1.8,5.8,4.6,5.8s4.8-1.9,4.8-5.7-2.2-5.9-4.8-5.9S493.1,156.6,493.1,159.9Z" transform="translate(-10.4 -9.9)"/><path class="b" d="M517.5,154.6h-1.2a4.3,4.3,0,0,0-3.6,2v11.7h-3.6V151.5h3l.3,2.4c1.6-1.8,3.3-2.9,5.3-2.9h.5Z" transform="translate(-10.4 -9.9)"/><path class="b" d="M521.8,160.2c.5,4.2,3,5.5,5.9,5.5a11.1,11.1,0,0,0,5-1.2l.3,2.9a13.2,13.2,0,0,1-5.6,1.3c-6,0-9.2-4.1-9.2-8.9s3.1-8.7,8.3-8.7,7.3,2.7,7.3,7.2a13.7,13.7,0,0,1-.2,1.9Zm.2-2.4h8.2a3.4,3.4,0,0,0-3.7-3.7C523.9,154.1,522.6,155.6,522,157.8Z" transform="translate(-10.4 -9.9)"/><path class="b" d="M542.3,167.3l.3-3.2a8.9,8.9,0,0,0,5.3,1.7c2.1,0,3-.9,3-2s-1.7-2.3-3.2-2.7-5.2-1.5-5.2-4.8,1.6-5.2,6.3-5.2a9.3,9.3,0,0,1,4.8,1.2l-.3,3.1a7,7,0,0,0-4.3-1.6c-1.8,0-3.2.6-3.2,2.1s1.5,2,3.9,2.7,4.8,1.6,4.8,5.1-1.1,5-6.5,5A10.2,10.2,0,0,1,542.3,167.3Z" transform="translate(-10.4 -9.9)"/><path class="b" d="M565.4,168.7h-2.9a4,4,0,0,1-4.4-4.2V154.2h-2.8l.4-2.7h2.4v-4.1l3.5-.3v4.4h4.1v2.7h-4.1v8.5c0,3,.2,3.2,3.2,3.2h.9Z" transform="translate(-10.4 -9.9)"/><path class="b" d="M566.8,159.9c0-4.8,3.1-8.8,8.4-8.8s8.5,4,8.5,8.8-3.1,8.8-8.5,8.8S566.8,164.7,566.8,159.9Zm3.6,0c0,3.6,1.7,5.8,4.8,5.8s4.9-2.2,4.9-5.8-1.7-5.8-4.9-5.8S570.4,156.3,570.4,159.9Z" transform="translate(-10.4 -9.9)"/><path class="b" d="M590.5,154.2v14.1H587V154.2h-2.7l.4-2.7H587v-4.2c0-2.6,1.4-4.6,4-4.6a10,10,0,0,1,3.6.4l-.4,2.9-2-.3c-1.5,0-1.7.6-1.7,3.6v2.2h4.2v2.7Z" transform="translate(-10.4 -9.9)"/><path class="b" d="M601.3,154.2v14.1h-3.5V154.2h-2.7l.3-2.7h2.4v-4.2c0-2.6,1.3-4.6,4-4.6a10,10,0,0,1,3.6.4l-.5,2.9-1.9-.3c-1.5,0-1.7.6-1.7,3.6v2.2h4.2v2.7Z" transform="translate(-10.4 -9.9)"/><path class="b" d="M609.8,160.2c.4,4.2,3,5.5,5.9,5.5a10.7,10.7,0,0,0,4.9-1.2l.4,2.9a13.3,13.3,0,0,1-5.7,1.3c-5.9,0-9.1-4.1-9.1-8.9s3-8.7,8.2-8.7,7.3,2.7,7.3,7.2a12.8,12.8,0,0,1-.1,1.9Zm.2-2.4h8.2a3.4,3.4,0,0,0-3.8-3.7A4.3,4.3,0,0,0,610,157.8Z" transform="translate(-10.4 -9.9)"/><path class="b" d="M632.6,154.6h-1.3a4.1,4.1,0,0,0-3.5,2v11.7h-3.7V151.5h3.1l.2,2.4c1.7-1.8,3.3-2.9,5.3-2.9h.6Z" transform="translate(-10.4 -9.9)"/><path class="b" d="M10.4,128.7a380.8,380.8,0,0,1,56.4-4.6V72c-17.3,0-34.6.2-51.8.3A387.5,387.5,0,0,1,10.4,128.7ZM51.7,87.1c-.1,7.5-.3,14.9-.5,22.4-7.7.3-15.4.7-23.1,1.4.6-7.8,1.1-15.5,1.4-23.2Z" transform="translate(-10.4 -9.9)"/><path class="a" d="M44.4,94.5l-.3,8.1-8.2.4c.2-2.8.3-5.5.5-8.2Z" transform="translate(-10.4 -9.9)"/><path class="b" d="M15,66.4H66.8V14.4A367.6,367.6,0,0,1,10.4,9.9,390,390,0,0,1,15,66.4ZM29.5,50.9c-.3-7.7-.8-15.4-1.4-23.1,7.7.6,15.3,1,23.1,1.3.2,7.4.4,14.9.5,22.3Z" transform="translate(-10.4 -9.9)"/><path class="a" d="M44.4,44.1,44.1,36l-8.2-.4c.2,2.8.3,5.5.5,8.2Z" transform="translate(-10.4 -9.9)"/><path class="b" d="M129.8,9.9a367.6,367.6,0,0,1-56.4,4.5V66.5h51.7A390.3,390.3,0,0,1,129.8,9.9ZM88.4,51.4c.1-7.4.3-14.9.6-22.3,7.7-.3,15.4-.7,23.1-1.3-.7,7.7-1.1,15.4-1.4,23.1Z" transform="translate(-10.4 -9.9)"/><path class="a" d="M95.8,44.1l.3-8.1,8.1-.4c-.1,2.8-.3,5.5-.4,8.2Z" transform="translate(-10.4 -9.9)"/><path class="b" d="M125.1,72.3C108,72.2,90.7,72,73.4,72v52.1a380.8,380.8,0,0,1,56.4,4.6A387.7,387.7,0,0,1,125.1,72.3ZM110.7,87.7c.3,7.7.7,15.4,1.4,23.2-7.7-.7-15.4-1.1-23.1-1.4-.3-7.5-.5-14.9-.6-22.4Z" transform="translate(-10.4 -9.9)"/><path class="a" d="M95.8,94.5l.3,8.1,8.1.4c-.1-2.8-.3-5.5-.4-8.2Z" transform="translate(-10.4 -9.9)"/></svg></a>
          </div>

        <?php if ($site_name || $site_slogan): ?>
          <!-- start: Site name and Slogan hgroup -->
          <hgroup<?php print $hgroup_attributes; ?>>

            <?php if ($site_name): ?>
              <div<?php print $site_name_attributes; ?>><?php print $site_name; ?></div>
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
    <div class="hamburger-icon">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 30 23" class="burger"> <path class="line" d="M1.4,3h27.3C29.4,3,30,2.3,30,1.5S29.4,0,28.6,0H1.4C0.6,0,0,0.7,0,1.5S0.6,3,1.4,3z"></path> <path class="line" d="M28.6,10H1.4C0.6,10,0,10.7,0,11.5S0.6,13,1.4,13h27.3c0.8,0,1.4-0.7,1.4-1.5S29.4,10,28.6,10z"></path> <path class="line" d="M28.6,20H1.4C0.6,20,0,20.7,0,21.5S0.6,23,1.4,23h27.3c0.8,0,1.4-0.7,1.4-1.5S29.4,20,28.6,20z"></path> </svg>
    </div>
    <?php print render($page['header']); ?>
  </header>
</div>

<div id="header-btm-container">
	<div class="container">
		<a href="/paaroerende" title="Artikler og rådgivning for pårørende"><img src="<?php print $base_path.drupal_get_path("theme","netstof").$variables['paaroerende_img'];?>" id="find-hjaelp" alt="Skilt som linker til side med hjælp til pårørende" /></a>
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

<div id="cfdp-website-links">
    <div class="cfdp-website-link-items">
      <h3>Kender du vores andre rådgivninger?</h3>
      <div class="cfdp-website-link-item first"><a href="https://cyberhus.dk"><img src="/sites/all/themes/netstof/images/cyberhus-dark.png" alt="cyberhus" /></a></div>
      <div class="cfdp-website-link-item middle"><a href="https://netstof.dk"><img src="/sites/all/themes/netstof/images/netstof-dark.png" alt="netstof" /></a></div>
      <div class="cfdp-website-link-item middle"><a href="https://mitassist.dk/"><img src="/sites/all/themes/netstof/images/mitassist-dark.png" alt="mitassist" /></a></div>
      <div class="cfdp-website-link-item last"><a href="https://gruppechat.dk"><img src="/sites/all/themes/netstof/images/gruppechat-dark.png" alt="gruppechat" /></a></div>
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
