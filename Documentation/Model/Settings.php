<?php

/*
 * This file is part of Numbers Framework.
 *
 * (c) Volodymyr Volynets <volodymyr.volynets@gmail.com>
 *
 * This source file is subject to the Apache 2.0 license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Numbers\Documentation\Documentation\Model;

use Object\Table;

class Settings extends Table
{
    public $db_link;
    public $db_link_flag;
    public $module_code = 'DN';
    public $title = 'D/N Settings';
    public $name = 'dn_settings';
    public $pk = ['dn_setting_tenant_id', 'dn_setting_module_id'];
    public $tenant = true;
    public $module = true;
    public $orderby;
    public $limit;
    public $column_prefix = 'dn_setting_';
    public $columns = [
        'dn_setting_tenant_id' => ['name' => 'Tenant #', 'domain' => 'tenant_id'],
        'dn_setting_module_id' => ['name' => 'Module #', 'domain' => 'module_id'],
        // other
        'dn_setting_sequence' => ['name' => 'Sequence', 'type' => 'bigserial', 'null' => true],
        'dn_setting_inactive' => ['name' => 'Inactive', 'type' => 'boolean']
    ];
    public $constraints = [
        'dn_settings_pk' => ['type' => 'pk', 'columns' => ['dn_setting_tenant_id', 'dn_setting_module_id']],
        'dn_setting_module_id_fk' => [
            'type' => 'fk',
            'columns' => ['dn_setting_tenant_id', 'dn_setting_module_id'],
            'foreign_model' => '\Numbers\Tenants\Tenants\Model\Modules',
            'foreign_columns' => ['tm_module_tenant_id', 'tm_module_id']
        ],
    ];
    public $indexes = [];
    public $optimistic_lock = true;
    public $history = false;
    public $audit = [
        'map' => [
            'dn_setting_tenant_id' => 'wg_audit_tenant_id',
            'dn_setting_module_id' => 'wg_audit_module_id'
        ]
    ];
    public $options_map = [];
    public $options_active = [];
    public $engine = [
        'MySQLi' => 'InnoDB'
    ];

    public $cache = true;
    public $cache_tags = [];
    public $cache_memory = false;

    public $data_asset = [
        'classification' => 'client_confidential',
        'protection' => 2,
        'scope' => 'enterprise'
    ];
}
