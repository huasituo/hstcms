<?php

return [
    'hookList'=>[
        's_sms'=>[
            'name'=>'s_sms', 
            'description'=>'短信服务平台', 
            'document'=>'@param array
@return array', 
            'module'=>'hstcms'
        ],
    ],
    'hookInject'=>[
        's_sms'=>[
            [
                'hook_name' => 's_sms',
                'alias' => 'hstcms',
                'files' => 'Huasituo\Hstcms\Hook',
                'class' => 'HstcmsConfigHook',
                'fun' => 'getManageSmsPlatform',
                'description' => ''
            ]
        ],
        's_manage_menu'=>[
            [
                'hook_name' => 's_manage_menu',
                'alias' => 'hstcms',
                'files' => 'Huasituo\Hstcms\Hook',
                'class' => 'HstcmsConfigHook',
                'fun' => 'getManageMenu',
                'description' => ''
            ]
        ],
        's_common_role_uri'=>[
            [
                'hook_name' => 's_common_role_uri',
                'alias' => 'hstcms',
                'files' => 'Huasituo\Hstcms\Hook',
                'class' => 'HstcmsConfigHook',
                'fun' => 'getCommonRoleUri',
                'description' => ''
            ]
        ]
    ]
];