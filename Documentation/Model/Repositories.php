<?php

namespace Numbers\Documentation\Documentation\Model;
class Repositories extends \Object\Table {
	public $db_link;
	public $db_link_flag;
	public $module_code = 'DN';
	public $title = 'D/N Repositories';
	public $schema;
	public $name = 'dn_repositories';
	public $pk = ['dn_repository_tenant_id', 'dn_repository_id'];
	public $tenant = true;
	public $orderby;
	public $limit;
	public $column_prefix = 'dn_repository_';
	public $columns = [
		'dn_repository_tenant_id' => ['name' => 'Tenant #', 'domain' => 'tenant_id'],
		'dn_repository_id' => ['name' => 'Role #', 'domain' => 'repository_id_sequence'],
		'dn_repository_code' => ['name' => 'Code', 'domain' => 'group_code'],
		'dn_repository_type_id' => ['name' => 'Type', 'domain' => 'type_id', 'options_model' => '\Numbers\Documentation\Documentation\Model\Repository\Types'],
		'dn_repository_name' => ['name' => 'Name', 'domain' => 'name'],
		'dn_repository_icon' => ['name' => 'Icon', 'domain' => 'icon', 'null' => true],
		'dn_repository_public' => ['name' => 'Public', 'type' => 'boolean'],
		'dn_repository_default_language_code' => ['name' => 'Default Language', 'domain' => 'language_code', 'null' => true],
		'dn_repository_latest_version_id' => ['name' => 'Latest Version #', 'domain' => 'version_id', 'null' => true],
		'dn_repository_inactive' => ['name' => 'Inactive', 'type' => 'boolean']
	];
	public $constraints = [
		'dn_repositories_pk' => ['type' => 'pk', 'columns' => ['dn_repository_tenant_id', 'dn_repository_id']],
		'dn_repository_code_un' => ['type' => 'unique', 'columns' => ['dn_repository_tenant_id', 'dn_repository_code']],
	];
	public $indexes = [
		'dn_repositories_fulltext_idx' => ['type' => 'fulltext', 'columns' => ['dn_repository_code', 'dn_repository_name']]
	];
	public $history = false;
	public $audit = [
		'map' => [
			'dn_repository_tenant_id' => 'wg_audit_tenant_id',
			'dn_repository_id' => 'wg_audit_repository_id'
		]
	];
	public $optimistic_lock = true;
	public $options_map = [
		'dn_repository_name' => 'name',
		'dn_repository_icon' => 'icon_class'
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

	public $data_asset = [
		'classification' => 'client_confidential',
		'protection' => 2,
		'scope' => 'enterprise'
	];
}