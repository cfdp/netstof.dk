<?php
/**
 * @file
 * netstof_featured_municipality_features.features.field.inc
 */

/**
 * Implements hook_field_default_fields().
 */
function netstof_featured_municipality_features_field_default_fields() {
  $fields = array();

  // Exported field: 'taxonomy_term-municipalities-field_desc_block_heading'.
  $fields['taxonomy_term-municipalities-field_desc_block_heading'] = array(
    'field_config' => array(
      'active' => '1',
      'cardinality' => '1',
      'deleted' => '0',
      'entity_types' => array(),
      'field_name' => 'field_desc_block_heading',
      'field_permissions' => array(
        'type' => '0',
      ),
      'foreign keys' => array(
        'format' => array(
          'columns' => array(
            'format' => 'format',
          ),
          'table' => 'filter_format',
        ),
      ),
      'indexes' => array(
        'format' => array(
          0 => 'format',
        ),
      ),
      'locked' => '0',
      'module' => 'text',
      'settings' => array(
        'max_length' => '100',
      ),
      'translatable' => '0',
      'type' => 'text',
    ),
    'field_instance' => array(
      'bundle' => 'municipalities',
      'default_value' => NULL,
      'deleted' => '0',
      'description' => 'Denne tekst vises som overskrft til beskrivelsen af tilbuddet',
      'display' => array(
        'default' => array(
          'label' => 'above',
          'settings' => array(),
          'type' => 'hidden',
          'weight' => '2',
        ),
      ),
      'entity_type' => 'taxonomy_term',
      'field_name' => 'field_desc_block_heading',
      'label' => 'Beskrivelse, overskrift',
      'required' => 0,
      'settings' => array(
        'linkit' => array(
          'enable' => 0,
          'insert_plugin' => '',
        ),
        'text_processing' => '0',
        'user_register_form' => FALSE,
      ),
      'widget' => array(
        'active' => 1,
        'module' => 'text',
        'settings' => array(
          'size' => '60',
        ),
        'type' => 'text_textfield',
        'weight' => '1',
      ),
    ),
  );

  // Exported field: 'taxonomy_term-municipalities-field_municipality_chat'.
  $fields['taxonomy_term-municipalities-field_municipality_chat'] = array(
    'field_config' => array(
      'active' => '1',
      'cardinality' => '1',
      'deleted' => '0',
      'entity_types' => array(),
      'field_name' => 'field_municipality_chat',
      'field_permissions' => array(
        'type' => '0',
      ),
      'foreign keys' => array(
        'format' => array(
          'columns' => array(
            'format' => 'format',
          ),
          'table' => 'filter_format',
        ),
      ),
      'indexes' => array(
        'format' => array(
          0 => 'format',
        ),
      ),
      'locked' => '0',
      'module' => 'text',
      'settings' => array(
        'max_length' => '300',
      ),
      'translatable' => '0',
      'type' => 'text',
    ),
    'field_instance' => array(
      'bundle' => 'municipalities',
      'default_value' => NULL,
      'deleted' => '0',
      'description' => '',
      'display' => array(
        'default' => array(
          'label' => 'hidden',
          'module' => 'text',
          'settings' => array(),
          'type' => 'text_default',
          'weight' => '0',
        ),
      ),
      'entity_type' => 'taxonomy_term',
      'field_name' => 'field_municipality_chat',
      'label' => 'Kommunechat',
      'required' => 0,
      'settings' => array(
        'linkit' => array(
          'enable' => 0,
          'insert_plugin' => '',
        ),
        'text_processing' => '1',
        'user_register_form' => FALSE,
      ),
      'widget' => array(
        'active' => 1,
        'module' => 'text',
        'settings' => array(
          'size' => '100',
        ),
        'type' => 'text_textfield',
        'weight' => '4',
      ),
    ),
  );

  // Exported field: 'taxonomy_term-municipalities-field_municipality_logo'.
  $fields['taxonomy_term-municipalities-field_municipality_logo'] = array(
    'field_config' => array(
      'active' => '1',
      'cardinality' => '5',
      'deleted' => '0',
      'entity_types' => array(),
      'field_name' => 'field_municipality_logo',
      'field_permissions' => array(
        'type' => '0',
      ),
      'foreign keys' => array(
        'fid' => array(
          'columns' => array(
            'fid' => 'fid',
          ),
          'table' => 'file_managed',
        ),
      ),
      'indexes' => array(
        'fid' => array(
          0 => 'fid',
        ),
      ),
      'locked' => '0',
      'module' => 'image',
      'settings' => array(
        'default_image' => 0,
        'uri_scheme' => 'public',
      ),
      'translatable' => '0',
      'type' => 'image',
    ),
    'field_instance' => array(
      'bundle' => 'municipalities',
      'deleted' => '0',
      'description' => 'Upload et eller flere logoer, der vil blive vist i højre sidebjælke.',
      'display' => array(
        'default' => array(
          'label' => 'above',
          'settings' => array(),
          'type' => 'hidden',
          'weight' => '3',
        ),
      ),
      'entity_type' => 'taxonomy_term',
      'field_name' => 'field_municipality_logo',
      'label' => 'Kommunelogo',
      'required' => 0,
      'settings' => array(
        'alt_field' => 1,
        'default_image' => 0,
        'file_directory' => 'municipalities',
        'file_extensions' => 'png gif jpg jpeg',
        'max_filesize' => '2 MB',
        'max_resolution' => '2000x2000',
        'min_resolution' => '120x50',
        'title_field' => 1,
        'user_register_form' => FALSE,
      ),
      'widget' => array(
        'active' => 1,
        'module' => 'image',
        'settings' => array(
          'preview_image_style' => 'thumbnail',
          'progress_indicator' => 'throbber',
        ),
        'type' => 'image_image',
        'weight' => '3',
      ),
    ),
  );

  // Exported field: 'taxonomy_term-municipalities-field_oversigt'.
  $fields['taxonomy_term-municipalities-field_oversigt'] = array(
    'field_config' => array(
      'active' => '1',
      'cardinality' => '-1',
      'deleted' => '0',
      'entity_types' => array(),
      'field_name' => 'field_oversigt',
      'field_permissions' => array(
        'type' => '0',
      ),
      'foreign keys' => array(),
      'indexes' => array(),
      'locked' => '0',
      'module' => 'viewfield',
      'settings' => array(),
      'translatable' => '0',
      'type' => 'viewfield',
    ),
    'field_instance' => array(
      'bundle' => 'municipalities',
      'default_value' => array(
        0 => array(
          'vname' => 'kort_enkelt_kommune|default',
          'vargs' => '',
        ),
      ),
      'deleted' => '0',
      'description' => '',
      'display' => array(
        'default' => array(
          'label' => 'hidden',
          'module' => 'viewfield',
          'settings' => array(),
          'type' => 'viewfield_default',
          'weight' => '1',
        ),
      ),
      'entity_type' => 'taxonomy_term',
      'field_name' => 'field_oversigt',
      'label' => 'Danmarkskort',
      'required' => 0,
      'settings' => array(
        'allowed_views' => array(
          'Brevkasse' => 0,
          'advanced_forum_active_topics' => 0,
          'advanced_forum_new_topics' => 0,
          'advanced_forum_search' => 0,
          'advanced_forum_topic_list' => 0,
          'advanced_forum_unanswered_topics' => 0,
          'alle_tags' => 0,
          'artikler' => 0,
          'autocomplete_brevkasse' => 0,
          'autocomplete_debatforum' => 0,
          'autocomplete_nodes' => 0,
          'brevkasseredaktoerer' => 0,
          'erfaringer' => 0,
          'faq' => 0,
          'front_page_grid' => 0,
          'image_polls' => 0,
          'kommentarer' => 0,
          'kort' => 0,
          'kort_enkelt_kommune' => 'kort_enkelt_kommune',
          'leksikon' => 0,
          'leksikon_ikoner' => 0,
          'letterbox_count' => 0,
          'mediekit' => 0,
          'municipality_blocks' => 0,
          'nodes_autocomplete' => 0,
          'places' => 0,
          'related_content' => 0,
          'slideshow' => 0,
          'test' => 0,
          'user_displays' => 0,
          'usergenerated_content' => 0,
          'users_autocomplete' => 0,
          'words_autocomplete' => 0,
        ),
        'force_default' => 0,
        'user_register_form' => FALSE,
      ),
      'widget' => array(
        'active' => 0,
        'module' => 'viewfield',
        'settings' => array(),
        'type' => 'viewfield_select',
        'weight' => '5',
      ),
    ),
  );

  // Translatables
  // Included for use with string extractors like potx.
  t('Beskrivelse, overskrift');
  t('Danmarkskort');
  t('Denne tekst vises som overskrft til beskrivelsen af tilbuddet');
  t('Kommunechat');
  t('Kommunelogo');
  t('Upload et eller flere logoer, der vil blive vist i højre sidebjælke.');

  return $fields;
}
