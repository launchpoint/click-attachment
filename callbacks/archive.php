<?

$atts = Attachment::find_all();

$files = array();

foreach($atts as $att)
{
  $files[] = $att->fpath;
}