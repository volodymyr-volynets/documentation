<?php

namespace Numbers\Documentation\Documentation\Model\Repository;
class Organizations extends \Object\Table {
	public $db_link;
	public $db_link_flag;
	public $module_code = 'DN';
	public $title = 'D/N Repository Organizations';
	public $name = 'dn_repository_organizations';
	public $pk = ['dn_repoorg_tenant_id', 'dn_repoorg_repository_id', 'dn_repoorg_organization_id'];
	public $tenant = true;
	public $orderby = [
		'dn_repoorg_timestamp' => SORT_ASC
	];
	public $limit;
	public $column_prefix = 'dn_repoorg_';
	public $columns = [
		'dn_repoorg_tenant_id' => ['name' => 'Tenant #', 'domain' => 'tenant_id'],
		'dn_repoorg_timestamp' => ['name' => 'Timestamp', 'domain' => 'timestamp_now'],
		'dn_repoorg_repository_id' => ['name' => 'Repository #', 'domain' => 'repository_id'],
		'dn_repoorg_organization_id' => ['name' => 'Organization #', 'domain' => 'organization_id'],
		'dn_repoorg_inactive' => ['name' => 'Inactive', 'type' => 'boolean']
	];
	public $constraints = [
		'dn_repository_organizations_pk' => ['type' => 'pk', 'columns' => ['dn_repoorg_tenant_id', 'dn_repoorg_repository_id', 'dn_repoorg_organization_id']],
		'dn_repoorg_repository_id_fk' => [
			'type' => 'fk',
			'columns' => ['dn_repoorg_tenant_id', 'dn_repoorg_repository_id'],
			'foreign_model' => '\Numbers\Documentation\Documentation\Model\Repositories',
			'foreign_columns' => ['dn_repository_tenant_id', 'dn_repository_id']
		],
		'dn_repoorg_organization_id_fk' => [
			'type' => 'fk',
			'columns' => ['dn_repoorg_tenant_id', 'dn_repoorg_organization_id'],
			'foreign_model' => '\Numbers\Users\Organizations\Model\Organizations',
			'foreign_columns' => ['on_organization_tenant_id', 'on_organization_id']
		]
	];
	public $indexes = [];
	public $history = false;
	public $audit = false;
	public $options_map = [];
	public $options_active = [];
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