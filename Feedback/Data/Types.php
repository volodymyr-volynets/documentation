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

use Object\Import;

class Types extends Import
{
    public $data = [
        'types' => [
            'options' => [
                'pk' => ['f8_type_tenant_id', 'f8_type_code'],
                'model' => '\Numbers\Documentation\Feedback\Model\Types',
                'method' => 'save_insert_new'
            ],
            'data' => [
                [
                    'f8_type_tenant_id' => null,
                    'f8_type_code' => 'F8_GENERAL_FEEDBACK',
                    'f8_type_name' => 'General Feedback',
                    'f8_type_icon' => 'fa-solid fa-person-circle-check',
                    'f8_type_description' => null,
                    'f8_type_primary' => 1,
                    'f8_type_inactive' => 0,
                ],
                [
                    'f8_type_tenant_id' => null,
                    'f8_type_code' => 'F8_BUG_REPORT',
                    'f8_type_name' => 'Bug Report',
                    'f8_type_icon' => 'fa-solid fa-bug',
                    'f8_type_description' => null,
                    'f8_type_primary' => 0,
                    'f8_type_inactive' => 0,
                ],
            ]
        ],
    ];
}
