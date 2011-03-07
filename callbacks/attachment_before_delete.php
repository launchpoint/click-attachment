<?

if(file_exists($attachment->fpath))
{
	unlink($attachment->fpath);
}
