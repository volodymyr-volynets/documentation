<?php

namespace Numbers\Documentation\Documentation\Model\Repository;
class Languages extends \Object\Table {
	public $db_link;
	public $db_link_flag;
	public $module_code = 'DN';
	public $title = 'D/N Repository Languages';
	public $name = 'dn_repository_languages';
	public $pk = ['dn_repolang_tenant_id', 'dn_repolang_module_id', 'dn_repolang_repository_id', 'dn_repolang_language_code'];
	public $tenant = true;
	public $module = true;
	public $orderby = [
		'dn_repolang_timestamp' => SORT_ASC
	];
	public $limit;
	public $column_prefix = 'dn_repolang_';
	public $columns = [
		'dn_repolang_tenant_id' => ['name' => 'Tenant #', 'domain' => 'tenant_id'],
		'dn_repolang_module_id' => ['name' => 'Module #', 'domain' => 'module_id'],
		'dn_repolang_timestamp' => ['name' => 'Timestamp', 'domain' => 'timestamp_now'],
		'dn_repolang_repository_id' => ['name' => 'Repository #', 'domain' => 'repository_id'],
		'dn_repolang_language_code' => ['name' => 'Language', 'domain' => 'language_code'],
		'dn_repolang_primary' => ['name' => 'Primary', 'type' => 'boolean'],
		'dn_repolang_inactive' => ['name' => 'Inactive', 'type' => 'boolean']
	];
	public $constraints = [
		'dn_repository_languages_pk' => ['type' => 'pk', 'columns' => ['dn_repolang_tenant_id', 'dn_repolang_module_id', 'dn_repolang_repository_id', 'dn_repolang_language_code']],
		'dn_repolang_repository_id_fk' => [
			'type' => 'fk',
			'columns' => ['dn_repolang_tenant_id', 'dn_repolang_module_id', 'dn_repolang_repository_id'],
			'foreign_model' => '\Numbers\Documentation\Documentation\Model\Repositories',
			'foreign_columns' => ['dn_repository_tenant_id', 'dn_repository_module_id', 'dn_repository_id']
		],
		'dn_repolang_language_code_fk' => [
			'type' => 'fk',
			'columns' => ['dn_repolang_tenant_id', 'dn_repolang_language_code'],
			'foreign_model' => '\Numbers\Internalization\Internalization\Model\Language\Codes',
			'foreign_columns' => ['in_language_tenant_id', 'in_language_code']
		]
	];
	public $indexes = [];
	public $history = false;
	public $audit = false;
	public $options_map = [
		'dn_repolang_language_code' => 'name',
		'dn_repolang_inactive' => 'inactive'
	];
	public $options_active = [
		'dn_repolang_inactive' => 0
	];
	public $engine = [
		'MySQLi' => 'InnoDB'
	];

	public $cache = false;
	public $cache_tags = [];
	public $cache_memory = false;

	public $data_asset = [
		'classification' => 'client_confidential',
		'protection' => 2,
		'scope' => 'enterprise'
	];
}