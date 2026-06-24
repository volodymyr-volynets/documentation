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

class Repositories extends Table
{
    public $db_link;
    public $db_link_flag;
    public $module_code = 'DN';
    public $title = 'D/N Repositories';
    public $schema;
    public $name = 'dn_repositories';
    public $pk = ['dn_repository_tenant_id', 'dn_repository_module_id', 'dn_repository_id'];
    public $tenant = true;
    public $module = true;
    public $orderby;
    public $limit;
    public $column_prefix = 'dn_repository_';
    public $columns = [
        'dn_repository_tenant_id' => ['name' => 'Tenant #', 'domain' => 'tenant_id'],
        'dn_repository_module_id' => ['name' => 'Module #', 'domain' => 'module_id'],
        'dn_repository_id' => ['name' => 'Repository #', 'domain' => 'repository_id_sequence'],
        'dn_repository_code' => ['name' => 'Code', 'domain' => 'group_code'],
        'dn_repository_type_id' => ['name' => 'Type', 'domain' => 'type_id', 'options_model' => '\Numbers\Documentation\Documentation\Model\Repository\Types'],
        'dn_repository_name' => ['name' => 'Name', 'domain' => 'name'],
        'dn_repository_icon' => ['name' => 'Icon', 'domain' => 'icon', 'null' => true],
        'dn_repository_public' => ['name' => 'Public', 'type' => 'boolean'],
        'dn_repository_title_numbering' => ['name' => 'Title Numbering', 'type' => 'boolean'],
        'dn_repository_default_language_code' => ['name' => 'Default Language', 'domain' => 'language_code', 'null' => true],
        'dn_repository_latest_version_id' => ['name' => 'Latest Version #', 'domain' => 'version_id', 'null' => true],
        'dn_repository_catalog_code' => ['name' => 'Catalog Code', 'domain' => 'group_code'],
        'dn_repository_description' => ['name' => 'Description', 'domain' => 'description', 'null' => true],
        'dn_repository_inactive' => ['name' => 'Inactive', 'type' => 'boolean']
    ];
    public $constraints = [
        'dn_repositories_pk' => ['type' => 'pk', 'columns' => ['dn_repository_tenant_id', 'dn_repository_module_id', 'dn_repository_id']],
        'dn_repository_code_un' => ['type' => 'unique', 'columns' => ['dn_repository_tenant_id', 'dn_repository_module_id', 'dn_repository_code']],
        'dn_repository_name_un' => ['type' => 'unique', 'columns' => ['dn_repository_tenant_id', 'dn_repository_name']], // name must be unique per tenant
        'dn_repository_default_language_code_un' => ['type' => 'unique', 'columns' => ['dn_repository_tenant_id', 'dn_repository_module_id', 'dn_repository_id', 'dn_repository_default_language_code']],
        'dn_repository_catalog_code_fk' => [
            'type' => 'fk',
            'columns' => ['dn_repository_tenant_id', 'dn_repository_catalog_code'],
            'foreign_model' => '\Numbers\Users\Documents\Base\Model\Catalogs',
            'foreign_columns' => ['dt_catalog_tenant_id', 'dt_catalog_code']
        ],
    ];
    public $indexes = [
        'dn_repositories_fulltext_idx' => ['type' => 'fulltext', 'columns' => ['dn_repository_code', 'dn_repository_name', 'dn_repository_description']]
    ];
    public $history = false;
    public $audit = [
        'map' => [
            'dn_repository_tenant_id' => 'wg_audit_tenant_id',
            'dn_repository_module_id' => 'wg_audit_module_id',
            'dn_repository_id' => 'wg_audit_repository_id'
        ]
    ];
    public $optimistic_lock = true;
    public $options_map = [
        'dn_repository_name' => 'name',
        'dn_repository_icon' => 'icon_class',
        'dn_repository_inactive' => 'inactive'
    ];
    public $options_active = [];
    public $engine = [
        'MySQLi' => 'InnoDB'
    ];

    public $cache = false;
    public $cache_tags = [];
    public $cache_memory = false;

    public $who = [
        'inserted' => true,
        'updated' => true
    ];

    public $batches = [
        'map' => [
            'dn_repository_tenant_id' => 'tm_batchrecord_tenant_id',
            'dn_repository_module_id' => 'tm_batchrecord_module_id',
            'dn_repository_id' => 'tm_batchrecord_field_value_id'
        ],
        'where' => [
            'tm_batchrecord_sm_model_code' => '\Numbers\Documentation\Documentation\Model\Repositories',
            'tm_batchrecord_field_code' => 'dn_repository_id',
        ],
        'edit' => [
            'batch_value' => 'tm_batchrecord_field_value_id',
            'batch_name' => 'D/N Repository #',
            //'edit_endpoint' => '/Numbers/Users/Chats/Controller/ChatPageStandalone/_Chat',
            'edit_key' => 'dn_repository_id',
            //'list_endpoint' => '/Numbers/Users/Chats/Controller/ChatPageStandalone/_Chat',
            'list_key' => ['dn_repository_id'],
        ],
    ];

    public $data_asset = [
        'classification' => 'client_confidential',
        'protection' => 2,
        'scope' => 'enterprise'
    ];
}
