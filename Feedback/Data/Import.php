<?php

/*
 * This file is part of Numbers Framework.
 *
 * (c) Volodymyr Volynets <volodymyr.volynets@gmail.com>
 *
 * This source file is subject to the Apache 2.0 license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Numbers\Documentation\Feedback\Data;

class Import extends \Object\Import
{
    public $data = [
        'modules' => [
            'options' => [
                'pk' => ['sm_module_code'],
                'model' => '\Numbers\Backend\System\Modules\Model\Collection\Modules',
                'method' => 'save'
            ],
            'data' => [
                [
                    'sm_module_code' => 'F8',
                    'sm_module_type' => 20,
                    'sm_module_name' => 'F/8 Feedback',
                    'sm_module_abbreviation' => 'F/8',
                    'sm_module_icon' => 'fa-solid fa-person-chalkboard',
                    'sm_module_transactions' => 0,
                    'sm_module_multiple' => 0,
                    'sm_module_activation_model' => null,
                    'sm_module_custom_activation' => 0,
                    'sm_module_inactive' => 0,
                    '\Numbers\Backend\System\Modules\Model\Module\Dependencies' => [
                        [
                            'sm_mdldep_child_module_code' => 'UM',
                            'sm_mdldep_child_feature_code' => 'UM::USERS'
                        ],
                        [
                            'sm_mdldep_child_module_code' => 'ON',
                            'sm_mdldep_child_feature_code' => 'ON::ORGANIZATIONS'
                        ],
                    ]
                ]
            ]
        ],
        'features' => [
            'options' => [
                'pk' => ['sm_feature_code'],
                'model' => '\Numbers\Backend\System\Modules\Model\Collection\Module\Features',
                'method' => 'save'
            ],
            'data' => [
                [
                    'sm_feature_module_code' => 'F8',
                    'sm_feature_code' => 'F8::FEEDBACK',
                    'sm_feature_type' => 10,
                    'sm_feature_name' => 'F/8 Feedback',
                    'sm_feature_icon' => 'fa-solid fa-person-chalkboard',
                    'sm_feature_activation_model' => null,
                    'sm_feature_activated_by_default' => 1,
                    'sm_feature_inactive' => 0,
                    '\Numbers\Backend\System\Modules\Model\Module\Dependencies' => [
                        [
                            'sm_mdldep_child_module_code' => 'UM',
                            'sm_mdldep_child_feature_code' => 'UM::USERS'
                        ],
                        [
                            'sm_mdldep_child_module_code' => 'ON',
                            'sm_mdldep_child_feature_code' => 'ON::ORGANIZATIONS'
                        ],
                    ]
                ]
            ]
        ],
        'batch_types' => [
            'options' => [
                'pk' => ['tm_batchtype_tenant_id', 'tm_batchtype_code'],
                'model' => '\Numbers\Tenants\Widgets\Batches\Model\Types',
                'method' => 'save_insert_new'
            ],
            'data' => [
                [
                    'tm_batchtype_tenant_id' => null,
                    'tm_batchtype_code' => 'F8_FEEDBACK',
                    'tm_batchtype_name' => 'F/8 Feedback',
                    'tm_batchtype_prefix' => 'F8FB',
                    'tm_batchtype_length' => 22,
                    'tm_batchtype_suffix' => '',
                    'tm_batchtype_counter' => 0,
                    'tm_batchtype_inactive' => 0
                ],
            ]
        ],
    ];
}
