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
/**
 * Override or insert variables into the page template.
 */
function netstof_preprocess_page(&$variables, $hook) {
	if (isset($variables['node'])) {  
    $variables['theme_hook_suggestions'][] = 'page__type__'. $variables['node']->type;
    $variables['theme_hook_suggestions'][] = "page__node__" . $variables['node']->nid;
  }
}

/**
 * ALTER SEARCH BOX
 */
function netstof_form_alter(&$form, $form_state, $form_id) {

	switch ($form_id)  {
		case 'search_block_form':
			$form["search_block_form"]["#default_value"] = "Søg på netstof.dk";
			// On blur / On focus
		    $form['search_block_form']['#attributes']['onblur'] = "if (this.value == '') {this.value = 'Søg på netstof.dk';}";
		    $form['search_block_form']['#attributes']['onfocus'] = "if (this.value == 'Søg på netstof.dk') {this.value = '';}";
		break;

		case 'custom_search_blocks_form_1':
			$form["custom_search_blocks_form_1"]["#default_value"] = "Søg i brevkassen";
			// On blur / On focus
		    $form['custom_search_blocks_form_1']['#attributes']['onblur'] = "if (this.value == '') {this.value = 'Søg i brevkassen';}";
		    $form['custom_search_blocks_form_1']['#attributes']['onfocus'] = "if (this.value == 'Søg i brevkassen') {this.value = '';}";
		break;
	}
}
