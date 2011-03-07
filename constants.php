<?

if(!isset($attachment_settings))
{
  $attachment_settings = array(
    'fpath'=>DATA_FPATH ."/$this_module_name",
    'vpath'=>DATA_VPATH ."/$this_module_name",
  );
}

define('ATTACHMENT_UPLOAD_FPATH', $attachment_settings['fpath']);
define('ATTACHMENT_UPLOAD_VPATH', $attachment_settings['vpath']);

ensure_writable_folder(ATTACHMENT_UPLOAD_FPATH);