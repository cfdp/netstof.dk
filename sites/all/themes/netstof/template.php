<?php

/**
 * @file
 * Process theme data.
 *
 * Use this file to run your theme specific implimentations of theme functions,
 * such preprocess, process, alters, and theme function overrides.
 *
 * Preprocess and process functions are used to modify or create variables for
 * templates and theme functions. They are a common theming tool in Drupal, often
 * used as an alternative to directly editing or adding code to templates. Its
 * worth spending some time to learn more about these functions - they are a
 * powerful way to easily modify the output of any template variable.
 * 
 * Preprocess and Process Functions SEE: http://drupal.org/node/254940#variables-processor
 * 1. Rename each function and instance of "netstof" to match
 *    your subthemes name, e.g. if your theme name is "footheme" then the function
 *    name will be "footheme_preprocess_hook". Tip - you can search/replace
 *    on "netstof".
 * 2. Uncomment the required function to use.
 */


/**
 * Preprocess variables for the html template.
 */
/* -- Delete this line to enable.
function netstof_preprocess_html(&$vars) {
  global $theme_key;

  // Two examples of adding custom classes to the body.
  
  // Add a body class for the active theme name.
  // $vars['classes_array'][] = drupal_html_class($theme_key);

  // Browser/platform sniff - adds body classes such as ipad, webkit, chrome etc.
  // $vars['classes_array'][] = css_browser_selector();

}
// */


/**
 * Process variables for the html template.
 */
/* -- Delete this line if you want to use this function
function netstof_process_html(&$vars) {
}
// */


/**
 * Override or insert variables for the page templates.
 */
/* -- Delete this line if you want to use these functions
function netstof_preprocess_page(&$vars) {
}
function netstof_process_page(&$vars) {
}
// */


/**
 * Override or insert variables into the node templates.
 */
/* -- Delete this line if you want to use these functions
function netstof_preprocess_node(&$vars) {
}
function netstof_process_node(&$vars) {
}
// */


/**
 * Override or insert variables into the comment templates.
 */
/* -- Delete this line if you want to use these functions
function netstof_preprocess_comment(&$vars) {
}
function netstof_process_comment(&$vars) {
}
// */


/**
 * Override or insert variables into the block templates.
 */
/* -- Delete this line if you want to use these functions
function netstof_preprocess_block(&$vars) {
}
function netstof_process_block(&$vars) {
}
// */

/*
function netstof_menu_link(array $variables) {
  $element = $variables['element'];
  $sub_menu = '';

  if($element["#original_link"]["menu_name"]=="main-menu") {

	  if($element["#original_link"]["depth"]==1) {
	  	$element["#title"] = "";
	  }
	
	  if ($element['#below']) {
	    $sub_menu = drupal_render($element['#below']);
	  }
	  
	  $output = l($element['#title'], $element['#href'], $element['#localized_options']);
	  return '<li' . drupal_attributes($element['#attributes']) . '>' . $output . $sub_menu . "</li>\n";
  }
}
*/

/**
 * MENU LINKS
 */
function netstof_menu_link(array $variables) {

  $element = $variables['element'];
  $sub_menu = '';
  $element['#localized_options']['html'] = TRUE;

  /* Even/odd class on menu items */
  static $count = 0;
  $zebra = ($count % 2) ? 'even' : 'odd';
  $count++;
  $element['#attributes']['class'][] = $zebra;
    
  if(isset($element["#bid"]["delta"]) && $element["#bid"]["delta"]==1) {
	  if ($element['#below']) {
	    $sub_menu = drupal_render($element['#below']);
	  }
	
	  /**
	   * Add menu item's description below the menu title
	   * Source: fusiondrupalthemes.com/forum/using-fusion/descriptions-under-main-menu
	   */
	  if ($element['#original_link']['menu_name'] == "main-menu" && isset($element['#localized_options']['attributes']['title'])){
	    $element['#title'] .= '<em>' . $element['#localized_options']['attributes']['title'] . '</em>';
	  }
	  
	  $output = l($element['#title'], $element['#href'], $element['#localized_options']);
	  return '<li' . drupal_attributes($element['#attributes']) . '>' . $output . $sub_menu . "</li>\n";
  }
  else {
 	  if ($element['#below']) {
	    $sub_menu = drupal_render($element['#below']);
	  }
	  $output = l($element['#title'], $element['#href'], $element['#localized_options']);
	  return '<li' . drupal_attributes($element['#attributes']) . '>' . $output . $sub_menu . "</li>\n";
  }
}

/**
 * First and Last classes for blocks
 */
function netstof_block_list($region) {
  // Code referenced from Fusion Core theme.
  $drupal_list = block_list($region);
  if (module_exists('context') && $context = context_get_plugin('reaction', 'block')) {
    $context_list = $context->block_list($region);
    $drupal_list = array_merge($context_list, $drupal_list);
  }
  return $drupal_list;
}
/**
* Implements template_preprocess_block().
*/
function netstof_preprocess_block(&$vars) {
  // Adds 'first' and 'last' class to blocks for styling.
  $block_count = count(netstof_block_list($vars['block']->region));
  if ($vars['block_id'] == 1 || $block_count == 1) {
    $vars['classes_array'][] = 'block-first';
  }
  if ($vars['block_id'] == $block_count) {
    $vars['classes_array'][] = 'block-last';
  }
}
