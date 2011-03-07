<?

$a = Attachment::find_by_id($params['id']);

header("Content-Type: {$a->mime_type}");
header("Content-Disposition: attachment; filename={$a->original_file_name}");
echo file_get_contents($a->fpath);