<?
/*
 * @file
 * Image Poll Field Devel Generator
 * 
 * Adds funcitonality for Devel Generator module to create appropriate content 
 * for the Image Poll Field compound field values.
 * 
 */
 
// called by Devel Generator when an Image Poll node is generated
function image_poll_field_devel_generate($object, $field, $instance, $bundle) {
  if (field_behaviors_widget('multiple values', $instance) == FIELD_BEHAVIOR_CUSTOM) {
    return devel_generate_multiple('_image_poll_field_devel_generate', $object, $field, $instance, $bundle);
  }
  else {
    return _image_poll_field_devel_generate($object, $field, $instance, $bundle);
  }
}

// fills compound fields with appropriate values.
function _image_poll_field_devel_generate($object, $field, $instance, $bundle) {
  $object_field = array();

  if ($instance['widget']['type'] == 'image_poll_write_in') {
    $object_field['choice_id'] = dechex(time() * rand(5, 50));
    $object_field['choice'] = devel_create_greeking(4);
    $object_field['write_in'] = 0;        
  }
  return $object_field;
}
