<?php

$s = array(
    'backtrace_depth' => 1,
    'domain' => '',
    'users' => '[]',
    'project_key' => '',
);

$settings = array();

foreach ($s as $key => $value) {
    if (is_string($value) || is_int($value)) { $type = 'textfield'; }
    elseif (is_bool($value)) { $type = 'combo-boolean'; }
    else { $type = 'textfield'; }

    $parts = explode('.',$key);
    if (count($parts) == 1) { $area = 'Default'; }
    else { $area = $parts[0]; }
    
    $settings['phpconsole.'.$key] = $modx->newObject('modSystemSetting');
    $settings['phpconsole.'.$key]->set('key', 'phpconsole.'.$key);
    $settings['phpconsole.'.$key]->fromArray(array(
        'value' => $value,
        'xtype' => $type,
        'namespace' => 'phpconsole',
        'area' => $area
    ));
}

return $settings;


