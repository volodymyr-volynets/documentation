<?php

/*
 * This file is part of Numbers Framework.
 *
 * (c) Volodymyr Volynets <volodymyr.volynets@gmail.com>
 *
 * This source file is subject to the Apache 2.0 license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Numbers\Documentation\Feedback\Model;

use Object\Table;

class Types extends Table
{
    public $db_link;
    public $db_link_flag;
    public $module_code = 'F8';
    public $title = 'F/8 Types';
    public $schema;
    public $name = 'f8_types';
    public $pk = ['f8_type_tenant_id', 'f8_type_code'];
    public $tenant = true;
    public $orderby;
    public $limit;
    public $column_prefix = 'f8_type_';
    public $columns = [
        'f8_type_tenant_id' => ['name' => 'Tenant #', 'domain' => 'tenant_id'],
        'f8_type_code' => ['name' => 'Code', 'domain' => 'group_code'],
        'f8_type_name' => ['name' => 'Name', 'domain' => 'name'],
        'f8_type_icon' => ['name' => 'Icon', 'domain' => 'icon', 'null' => true],
        'f8_type_description' => ['name' => 'Description', 'domain' => 'description', 'null' => true],
        'f8_type_primary' => ['name' => 'Primary', 'type' => 'boolean'],
        'f8_type_inactive' => ['name' => 'Inactive', 'type' => 'boolean']
    ];
    public $constraints = [
        'f8_types_pk' => ['type' => 'pk', 'columns' => ['f8_type_tenant_id', 'f8_type_code']],
    ];
    public $indexes = [
        'f8_types_fulltext_idx' => ['type' => 'fulltext', 'columns' => ['f8_type_code', 'f8_type_name', 'f8_type_description']]
    ];
    public $history = false;
    public $audit = [];
    public $optimistic_lock = true;
    public $options_map = [
        'f8_type_name' => 'name',
        'f8_type_icon' => 'icon_class',
        'f8_type_inactive' => 'inactive',
        'f8_type_primary' => 'primary',
    ];
    public $options_active = [
        'f8_type_inactive' => 0,
    ];
    public $engine = [
        'MySQLi' => 'InnoDB'
    ];

    public $cache = true;
    public $cache_tags = [];
    public $cache_memory = false;

    public $who = [
        'inserted' => true,
        'updated' => true
    ];

    public $data_asset = [
        'classification' => 'client_confidential',
        'protection' => 2,
        'scope' => 'enterprise'
    ];
}
