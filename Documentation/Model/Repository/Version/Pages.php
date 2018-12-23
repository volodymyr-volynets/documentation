<?php

namespace Numbers\Documentation\Documentation\Model\Repository\Version;
class Pages extends \Object\Table {
	public $db_link;
	public $db_link_flag;
	public $module_code = 'DN';
	public $title = 'D/N Repository Pages';
	public $name = 'dn_repository_pages';
	public $pk = ['dn_repopage_tenant_id', 'dn_repopage_repository_id', 'dn_repopage_version_id', 'dn_repopage_id'];
	public $tenant = true;
	public $orderby = [
		'dn_repopage_timestamp' => SORT_ASC
	];
	public $limit;
	public $column_prefix = 'dn_repopage_';
	public $columns = [
		'dn_repopage_tenant_id' => ['name' => 'Tenant #', 'domain' => 'tenant_id'],
		'dn_repopage_repository_id' => ['name' => 'Repository #', 'domain' => 'repository_id'],
		'dn_repopage_version_id' => ['name' => 'Version #', 'domain' => 'version_id'],
		'dn_repopage_id' => ['name' => 'Page #', 'domain' => 'page_id_sequence'],
		'dn_repopage_parent_repopage_id' => ['name' => 'Page #', 'domain' => 'page_id', 'null' => true],
		'dn_repopage_name' => ['name' => 'Name', 'domain' => 'name'],
		'dn_repopage_toc_name' => ['name' => 'Name (Table of Contents)', 'domain' => 'name', 'null' => true],
		'dn_repopage_inactive' => ['name' => 'Inactive', 'type' => 'boolean']
	];
	public $constraints = [
		'dn_repository_pages_pk' => ['type' => 'pk', 'columns' => ['dn_repopage_tenant_id', 'dn_repopage_repository_id', 'dn_repopage_version_id', 'dn_repopage_id']],
		'dn_repopage_version_id_fk' => [
			'type' => 'fk',
			'columns' => ['dn_repopage_tenant_id', 'dn_repopage_repository_id', 'dn_repopage_version_id'],
			'foreign_model' => '\Numbers\Documentation\Documentation\Model\Repository\Versions',
			'foreign_columns' => ['dn_repoversion_tenant_id', 'dn_repoversion_repository_id', 'dn_repoversion_version_id']
		],
		'dn_repopage_parent_repopage_id_fk' => [
			'type' => 'fk',
			'columns' => ['dn_repopage_tenant_id', 'dn_repopage_repository_id', 'dn_repopage_version_id', 'dn_repopage_parent_repopage_id'],
			'foreign_model' => '\Numbers\Documentation\Documentation\Model\Repository\Version\Pages',
			'foreign_columns' => ['dn_repopage_tenant_id', 'dn_repopage_repository_id', 'dn_repopage_version_id', 'dn_repopage_id']
		],
	];
	public $indexes = [];
	public $history = false;
	public $audit = false;
	public $options_map = [
		'dn_repopage_version_name' => 'name'
	];
	public $options_active = [
		'dn_repopage_inactive' => 0
	];
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