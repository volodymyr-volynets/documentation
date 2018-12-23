<?php

namespace Numbers\Documentation\Documentation\Model\Repository;
class Versions extends \Object\Table {
	public $db_link;
	public $db_link_flag;
	public $module_code = 'DN';
	public $title = 'D/N Repository Versions';
	public $name = 'dn_repository_versions';
	public $pk = ['dn_repoversion_tenant_id', 'dn_repoversion_repository_id', 'dn_repoversion_version_id'];
	public $tenant = true;
	public $orderby = [
		'dn_repoversion_timestamp' => SORT_ASC
	];
	public $limit;
	public $column_prefix = 'dn_repoversion_';
	public $columns = [
		'dn_repoversion_tenant_id' => ['name' => 'Tenant #', 'domain' => 'tenant_id'],
		'dn_repoversion_timestamp' => ['name' => 'Timestamp', 'domain' => 'timestamp_now'],
		'dn_repoversion_repository_id' => ['name' => 'Repository #', 'domain' => 'repository_id'],
		'dn_repoversion_version_id' => ['name' => 'Version #', 'domain' => 'version_id'],
		'dn_repoversion_version_name' => ['name' => 'Name', 'domain' => 'name'],
		'dn_repoversion_latest' => ['name' => 'Latest', 'type' => 'boolean'],
		'dn_repoversion_inactive' => ['name' => 'Inactive', 'type' => 'boolean']
	];
	public $constraints = [
		'dn_repository_versions_pk' => ['type' => 'pk', 'columns' => ['dn_repoversion_tenant_id', 'dn_repoversion_repository_id', 'dn_repoversion_version_id']],
		'dn_repoversion_repository_id_fk' => [
			'type' => 'fk',
			'columns' => ['dn_repoversion_tenant_id', 'dn_repoversion_repository_id'],
			'foreign_model' => '\Numbers\Documentation\Documentation\Model\Repositories',
			'foreign_columns' => ['dn_repository_tenant_id', 'dn_repository_id']
		],
	];
	public $indexes = [];
	public $history = false;
	public $audit = false;
	public $options_map = [
		'dn_repoversion_version_name' => 'name',
		'dn_repoversion_inactive' => 'inactive'
	];
	public $options_active = [
		'dn_repoversion_inactive' => 0
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