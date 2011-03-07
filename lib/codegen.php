<?

function codegen_attachment_before_validate($event_args, $event_data, $bt_names, $model_name)
{
  foreach($bt_names as $bt_name)
  {
    $o = $event_args[$model_name];
    $data = "{$bt_name}_data";
    if (is_file_upload($o->$data))
    {
      associate_attachment($o, $bt_name);
    }
  }
}


function codegen_attachment_after_new($event_args, $event_data, $bt_names, $model_name)
{
  foreach($bt_names as $bt_name)
  {
    $data = "{$bt_name}_data";
    $event_args[$model_name]->$data = null;
  }
}

function codegen_get_attachment_thread($obj,$name)
{
  $at = AttachmentThread::find_or_new_by( array(
    'conditions'=>array('object_type = ? and object_id = ? and name = ?', $obj->klass, $obj->id, $name),
    'attributes'=>array(
      'object_type'=>$obj->klass,
      'object_id'=>$obj->id,
      'name'=>$name,
    ),
  ));
  $at->validate();
  if($at->is_valid) $at->save();
  return $at;
}