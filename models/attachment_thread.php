<?

function attachment_thread_add($at, $params)
{
 	$att = Attachment::new_model_instance( array(
 	  'attributes'=>array(
 	    'attachment_thread_id'=>$at->id,
 	  ),
 	));
	$att->save_file($params);
	$at->purge('attachments');
	return $att;
}

function attachment_thread_duplicate_for($at, $obj)
{
  $new_at = $obj->attachment_threads($at->name);
  foreach($at->attachments as $att)
  {
    $new_att = $att->copy();
    $new_att->attachment_thread_id = $new_at->id;
    $new_att->save();
  }
}