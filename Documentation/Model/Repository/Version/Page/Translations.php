<?php

namespace Numbers\Documentation\Documentation\Model\Repository\Version\Page;
class Translations extends \Object\Table {
	public $db_link;
	public $db_link_flag;
	public $module_code = 'DN';
	public $title = 'D/N Repository Page Translations';
	public $name = 'dn_repository_page_translations';
	public $pk = ['dn_repopgtransl_tenant_id', 'dn_repopgtransl_module_id', 'dn_repopgtransl_repopage_id', 'dn_repopgtransl_language_code'];
	public $tenant = true;
	public $module = true;
	public $orderby = [
		'dn_repopgtransl_language_code' => SORT_ASC
	];
	public $limit;
	public $column_prefix = 'dn_repopgtransl_';
	public $columns = [
		'dn_repopgtransl_tenant_id' => ['name' => 'Tenant #', 'domain' => 'tenant_id'],
		'dn_repopgtransl_module_id' => ['name' => 'Module #', 'domain' => 'module_id'],
		'dn_repopgtransl_repopage_id' => ['name' => 'Page #', 'domain' => 'page_id'],
		'dn_repopgtransl_repository_id' => ['name' => 'Repository #', 'domain' => 'repository_id'],
		'dn_repopgtransl_version_id' => ['name' => 'Version #', 'domain' => 'version_id'],
		'dn_repopgtransl_language_code' => ['name' => 'Language', 'domain' => 'language_code'],
		'dn_repopgtransl_name' => ['name' => 'Title', 'domain' => 'name'],
		'dn_repopgtransl_toc_name' => ['name' => 'Title (Table of Contents)', 'domain' => 'name', 'null' => true],
		'dn_repopgtransl_inactive' => ['name' => 'Inactive', 'type' => 'boolean']
	];
	public $constraints = [
		'dn_repository_page_translations_pk' => ['type' => 'pk', 'columns' => ['dn_repopgtransl_tenant_id', 'dn_repopgtransl_module_id', 'dn_repopgtransl_repopage_id', 'dn_repopgtransl_language_code']],
		'dn_repopgtransl_repopage_id_fk' => [
			'type' => 'fk',
			'columns' => ['dn_repopgtransl_tenant_id', 'dn_repopgtransl_module_id', 'dn_repopgtransl_repopage_id'],
			'foreign_model' => '\Numbers\Documentation\Documentation\Model\Repository\Version\Pages',
			'foreign_columns' => ['dn_repopage_tenant_id', 'dn_repopage_module_id', 'dn_repopage_id']
		],
		'dn_repopgtransl_language_code_fk' => [
			'type' => 'fk',
			'columns' => ['dn_repopgtransl_tenant_id', 'dn_repopgtransl_language_code'],
			'foreign_model' => '\Numbers\Internalization\Internalization\Model\Language\Codes',
			'foreign_columns' => ['in_language_tenant_id', 'in_language_code']
		],
	];
	public $indexes = [
		'dn_repository_page_translations_fulltext_idx' => ['type' => 'fulltext', 'columns' => ['dn_repopgtransl_name', 'dn_repopgtransl_toc_name']]
	];
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

	public $who = [];

	public $data_asset = [
		'classification' => 'client_confidential',
		'protection' => 2,
		'scope' => 'enterprise'
	];
}