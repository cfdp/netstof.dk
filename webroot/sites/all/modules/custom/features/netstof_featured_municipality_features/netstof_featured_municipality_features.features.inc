<?php
/**
 * @file
 * netstof_featured_municipality_features.features.inc
 */

/**
 * Implements hook_image_default_styles().
 */
function netstof_featured_municipality_features_image_default_styles() {
  $styles = array();

  // Exported image style: municipality_logo.
  $styles['municipality_logo'] = array(
    'name' => 'municipality_logo',
    'label' => 'municipality_logo',
    'effects' => array(
      8 => array(
        'label' => 'Skalér',
        'help' => 'Skalering bevarer billedets højde-bredde-forhold. Hvis kun den ene dimension angives vil den anden blive beregnet.',
        'effect callback' => 'retina_images_image_scale_effect',
        'dimensions callback' => 'image_scale_dimensions',
        'form callback' => 'retina_images_image_scale_form',
        'summary theme' => 'retina_images_image_scale_summary',
        'module' => 'image',
        'name' => 'image_scale',
        'data' => array(
          'width' => '120',
          'height' => '',
          'upscale' => 0,
          'retinafy' => 0,
        ),
        'weight' => '1',
      ),
    ),
  );

  return $styles;
}
