<?

function is_file_upload($arr)
{
	return ($arr['size']>0);
}
  
function associate_attachment($model, $key_name='attachment')
{
  $file_data = $key_name."_data";
  $fk_name = $key_name."_id";
  $params = $model->$file_data;
	if (!is_file_upload($params)) return;
	$att = Attachment::new_model_instance();
	$att->save_file($params);
	$model->$fk_name = $att->id;
	$model->purge($key_name);
	$model->a($key_name);
}

function create_attachment_from_file($fname)
{
  $info = pathinfo($fname);
  switch($info['extension'])
  {
    case 'jpg':
      $type = "image/jpg";
      break;
    default:
      click_error("unsuported type $fname");
  }
  
  $params = array(
    'name'=>basename($fname),
    'type'=>$type,
    'tmp_name'=>$fname
  );
  $att = Attachment::new_model_instance();
	$att->save_file($params);
	return $att;
}


function gc_attachments_folder()
{
  $sql = "select local_file_name from attachments";
  $recs = query_assoc($sql);
  $fnames = collect($recs, 'local_file_name');
  $fpaths = glob(ATTACHMENT_UPLOAD_FPATH.'/*');
  foreach($fpaths as $fpath)
  {
    $fname = basename($fpath);
    if(array_search($fname, $fnames)===false)
    {
      unlink($fpath);
    }
  }
}