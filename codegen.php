<?


foreach($model_settings as $model_name=>$data)
{
  $mn = strtolower(singularize(tableize($model_name)));
  $bt = eval("return $model_name::\$belongs_to;");
  $c=0;
  if($mn!='attachment_thread')
  {
    $code = <<<PHP
    
      function {$mn}_get_attachments__d(\$s)
      {
        if(!\$s->attachment_threads()) return array();
        return \$s->attachment_threads()->attachments;
      }
      
      function {$mn}_get_attachment_thread__d(\$s)
      {
        return \$s->attachment_threads();
      }
      
      function {$mn}_attachment_threads__d(\$s, \$name='default')
      {
        return codegen_get_attachment_thread(\$s,\$name);
      }
PHP;
    $codegen[] = $code;
  }

  $bt_names = array();
  foreach($bt as $bt_name=>$arr)
  {
    list($tn,$fn) = $arr;
    if ($tn!='attachments') continue;
    $bt_names[] = $bt_name;
  }
  $bt_names_str = s_var_export($bt_names);

  if(count($bt_names)>0)
  {
    $code = <<<PHP
  
      function attachment_{$mn}_after_new(\$event_args, &\$event_data)
      {
        codegen_attachment_after_new(\$event_args, \$event_data, $bt_names_str, '$mn');
      }

      function attachment_{$mn}_before_validate(\$event_args, &\$event_data)
      {
        codegen_attachment_before_validate(\$event_args, \$event_data, $bt_names_str, '$mn');
      }
PHP;
    foreach($bt_names as $name)
    {
      $codegen[] = "{$model_name}::\$attribute_types['$name']['type'] = 'image';";
      $codegen[] = "{$model_name}::\$eager_load[] = '$name';";
    }
    $codegen[] = $code;
  }
}

