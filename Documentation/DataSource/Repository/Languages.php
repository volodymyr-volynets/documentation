<?php

/*
 * This file is part of Numbers Framework.
 *
 * (c) Volodymyr Volynets <volodymyr.volynets@gmail.com>
 *
 * This source file is subject to the Apache 2.0 license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Numbers\Documentation\Documentation\DataSource\Repository;

use Numbers\Internalization\Internalization\Model\Language\Codes;
use Object\DataSource;

class Languages extends DataSource
{
    public $db_link;
    public $db_link_flag;
    public $pk = ['code'];
    public $columns;
    public $orderby;
    public $limit;
    public $single_row;
    public $single_value;
    public $options_map = [
        'name' => 'name',
        'native_name' => 'name',
        'primary' => 'name',
        'country_code' => 'flag_country_code',
        'inactive' => 'inactive'
    ];
    public $options_active = [
        'inactive' => 0
    ];
    public $column_prefix;

    public $cache = true;
    public $cache_tags = [];
    public $cache_memory = false;

    public $primary_model = '\Numbers\Documentation\Documentation\Model\Repository\Languages';
    public $parameters = [
        'dn_repolang_module_id' => ['name' => 'Module #', 'domain' => 'module_id', 'required' => true],
        'dn_repolang_repository_id' => ['name' => 'Repository #', 'domain' => 'repository_id', 'required' => true],
    ];

    public function query($parameters, $options = [])
    {
        // columns
        $this->query->columns([
            'code' => 'a.dn_repolang_language_code',
            'name' => 'b.in_language_name',
            'native_name' => 'b.in_language_native_name',
            'country_code' => 'b.in_language_country_code',
            'primary' => "(CASE WHEN a.dn_repolang_primary = 1 THEN '(Primary)' ELSE NULL END)",
            'inactive' => 'a.dn_repolang_inactive + b.in_language_inactive',
        ]);
        // joins
        $this->query->join('INNER', new Codes(), 'b', 'ON', [
            ['AND', ['a.dn_repolang_language_code', '=', 'b.in_language_code', true], false]
        ]);
        // where
        $this->query->where('AND', ['a.dn_repolang_module_id', '=', $parameters['dn_repolang_module_id']]);
        $this->query->where('AND', ['a.dn_repolang_repository_id', '=', $parameters['dn_repolang_repository_id']]);
    }
}
