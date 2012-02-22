<?php

return array(
    'module_id' => "M-UM",
    'required'=>true,
    'moduleID'=>"usermanager",
    'module_name' => 'usermanagerModulName',
    'defaultCntrl' => '/usermanager/',
    'modulDescription' => 'usermanagerDescription',
    'class' => 'usermanager',
    'modulePermission' => array(
        array('access' => 'manageUser', 'name' => 'usermanagermanageUser'),
        array('access' => 'manageGroupRole', 'name' => 'usermanagermanageGroupRole'),
    ),
        )
?>
