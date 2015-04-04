<?php

/**
 * @file
 * Integration with the Features module API.
 */

/**
 * Implements hook_features_export_options().
 */
function block_class_features_export_options() {
  $query = db_select('block_class', 'bc');
  $query->addExpression("CONCAT(bc.module, ':', bc.delta)");
  $blocks = $query->execute()->fetchAllKeyed(0, 0);

  natcasesort($blocks);
  return $blocks;
}

/**
 * Implements hook_features_export().
 */
function block_class_features_export($data, &$export, $module_name = '') {
  $pipe = array();

  $export['dependencies']['features'] = 'features';
  $export['dependencies']['block_class'] = 'block_class';

  foreach ($data as $component) {
    $export['features']['block_class'][$component] = $component;
  }

  return $pipe;
}

/**
 * Implements hook_features_export_render().
 */
function block_class_features_export_render($module, $data) {
  $query = db_select('block_class', 'bc');
  $query->addExpression("CONCAT(bc.module, ':', bc.delta)", 'id');
  $query->addField('bc', 'css_class');
  $classes = $query->execute()->fetchAllKeyed(1, 0);

  $code = array();
  foreach ($data as $id) {
    if (isset($classes[$id])) {
      list($module, $delta) = explode(':', $id);
      $css_classes = $classes[$id];
      $code[$id] = compact('module', 'delta', 'css_classes');
    }
  }

  $code = "  return " . features_var_export($code, '  ') . ";";

  return array('block_class_features_default_class' => $code);
}

/**
 * Implements hook_features_revert().
 */
function block_class_features_revert($module) {
  block_class_features_rebuild($module);
}

/**
 * Implements hook_features_rebuild().
 */
function block_class_features_rebuild($module) {
  $blocks = module_invoke($module, 'block_class_features_default_class');
  if ($blocks) {
    foreach ($blocks as $block) {
      db_delete('block_class')->condition('module', $block['module'])->condition('delta', $block['delta'])->execute();
      if (!empty($block['css_classes'])) {
        $id = db_insert('block_class')
          ->fields(array(
            'module' => $block['module'],
            'delta' => $block['delta'],
            'css_class' => $block['css_classes'],
          ))
          ->execute();
      }
    }
  }
}
