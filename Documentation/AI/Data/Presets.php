<?php

/*
 * This file is part of Numbers Framework.
 *
 * (c) Volodymyr Volynets <volodymyr.volynets@gmail.com>
 *
 * This source file is subject to the Apache 2.0 license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Numbers\Documentation\Documentation\AI\Data;

use Object\Import;

class Presets extends Import
{
    public $data = [
        'presets' => [
            'options' => [
                'pk' => ['um_imppreset_id'],
                'model' => '\Numbers\Users\Users\Model\Import\Presets',
                'method' => 'save',
                'submodule_exists' => ['Numbers.Users.Users']
            ],
            'data' => [
                [
                    'um_imppreset_id' => '::id::DN_RepositoryPagesETL',
                    'um_imppreset_code' => 'DN_RepositoryPagesETL',
                    'um_imppreset_name' => 'D/N Repository Pages ETL',
                    'um_imppreset_module_code' => 'DN',
                    'um_imppreset_sm_model_id' => '::id::\Numbers\Documentation\Documentation\Model\Repository\Version\Pages',
                    'um_imppreset_sm_model_code' => '\Numbers\Documentation\Documentation\Model\Repository\Version\Pages',
                    'um_imppreset_activation_method' => '\Numbers\Documentation\Documentation\AI\ETL\RepositoryPagesETL',
                    'um_imppreset_um_imppretype_code' => 'ETL',
                    'um_imppreset_inactive' => 0,
                ],
                [
                    'um_imppreset_id' => '::id::DN_RepositoryFragmentsETL',
                    'um_imppreset_code' => 'DN_RepositoryFragmentsETL',
                    'um_imppreset_name' => 'D/N Repository Fragments ETL',
                    'um_imppreset_module_code' => 'DN',
                    'um_imppreset_sm_model_id' => '::id::\Numbers\Documentation\Documentation\Model\Repository\Version\Page\Fragments',
                    'um_imppreset_sm_model_code' => '\Numbers\Documentation\Documentation\Model\Repository\Version\Page\Fragments',
                    'um_imppreset_activation_method' => '\Numbers\Documentation\Documentation\AI\ETL\RepositoryFragmentsETL',
                    'um_imppreset_um_imppretype_code' => 'ETL',
                    'um_imppreset_inactive' => 0,
                ],
            ]
        ],
    ];
}
