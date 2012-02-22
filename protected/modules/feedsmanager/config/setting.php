<?php
return array(
        'module_id'=>"M-FM",
        'required'=>false,
        'moduleID'=>"feedsmanager",
        'module_name'=>'feedsmanagerModulName',
        'defaultCntrl'=>'/feedsmanager/',
        'modulDescription'=>'feedsmanagerDescription',
        'class'=>'feedsmanager',
        'modulePermission'=>array(array('access'=>'manageFeeds', 'name'=>'feedsmanagermanageFeeds'),
                                  array('access'=>'manageFeedsObject', 'name'=>'feedsmanagermanageFeedsObject'),
                                  array('access'=>'manageFeedsRss', 'name'=>'feedsmanagermanageFeedsRss'),
                                  ),
        )

?>
