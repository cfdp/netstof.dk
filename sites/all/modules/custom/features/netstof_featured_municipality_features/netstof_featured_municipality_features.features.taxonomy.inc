<?php
/**
 * @file
 * netstof_featured_municipality_features.features.taxonomy.inc
 */

/**
 * Implements hook_taxonomy_default_vocabularies().
 */
function netstof_featured_municipality_features_taxonomy_default_vocabularies() {
  return array(
    'municipalities' => array(
      'name' => 'Kommuner',
      'machine_name' => 'municipalities',
      'description' => 'Kommuner i Danmark',
      'hierarchy' => '0',
      'module' => 'taxonomy',
      'weight' => '0',
    ),
  );
}
