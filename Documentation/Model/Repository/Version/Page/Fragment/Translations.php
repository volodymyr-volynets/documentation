<?php

namespace Numbers\Documentation\Documentation\Model\Repository\Version\Page\Fragment;
class Translations extends \Object\Table {
	public $db_link;
	public $db_link_flag;
	public $module_code = 'DN';
	public $title = 'D/N Repository Page Fragment Translations';
	public $name = 'dn_repository_page_fragment_translations';
	public $pk = ['dn_repofragtransl_tenant_id', 'dn_repofragtransl_module_id', 'dn_repofragtransl_repopgfragm_id', 'dn_repofragtransl_language_code'];
	public $tenant = true;
	public $module = true;
	public $orderby = [
		'dn_repofragtransl_language_code' => SORT_ASC
	];
	public $limit;
	public $column_prefix = 'dn_repofragtransl_';
	public $columns = [
		'dn_repofragtransl_tenant_id' => ['name' => 'Tenant #', 'domain' => 'tenant_id'],
		'dn_repofragtransl_module_id' => ['name' => 'Module #', 'domain' => 'module_id'],
		'dn_repofragtransl_repopage_id' => ['name' => 'Page #', 'domain' => 'page_id'],
		'dn_repofragtransl_repopgfragm_id' => ['name' => 'Fragment #', 'domain' => 'fragment_id'],
		'dn_repofragtransl_repository_id' => ['name' => 'Repository #', 'domain' => 'repository_id'],
		'dn_repofragtransl_version_id' => ['name' => 'Version #', 'domain' => 'version_id'],
		'dn_repofragtransl_language_code' => ['name' => 'Language', 'domain' => 'language_code'],
		'dn_repofragtransl_type_code' => ['name' => 'Type', 'domain' => 'type_code', 'options_model' => '\Numbers\Documentation\Documentation\Model\Repository\Version\Page\Fragment\Types'],
		'dn_repofragtransl_name' => ['name' => 'Title', 'domain' => 'name', 'null' => true],
		'dn_repofragtransl_body' => ['name' => 'Body', 'type' => 'text', 'null' => true],
		'dn_repofragtransl_inactive' => ['name' => 'Inactive', 'type' => 'boolean']
	];
	public $constraints = [
		'dn_repository_page_fragment_translations_pk' => ['type' => 'pk', 'columns' => ['dn_repofragtransl_tenant_id', 'dn_repofragtransl_module_id', 'dn_repofragtransl_repopgfragm_id', 'dn_repofragtransl_language_code']],
		'dn_repofragtransl_repopage_id_fk' => [
			'type' => 'fk',
			'columns' => ['dn_repofragtransl_tenant_id', 'dn_repofragtransl_module_id', 'dn_repofragtransl_repopage_id'],
			'foreign_model' => '\Numbers\Documentation\Documentation\Model\Repository\Version\Pages',
			'foreign_columns' => ['dn_repopage_tenant_id', 'dn_repopage_module_id', 'dn_repopage_id']
		],
		'dn_repofragtransl_language_code_fk' => [
			'type' => 'fk',
			'columns' => ['dn_repofragtransl_tenant_id', 'dn_repofragtransl_language_code'],
			'foreign_model' => '\Numbers\Internalization\Internalization\Model\Language\Codes',
			'foreign_columns' => ['in_language_tenant_id', 'in_language_code']
		],
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

	public $who = [];

	public $data_asset = [
		'classification' => 'client_confidential',
		'protection' => 2,
		'scope' => 'enterprise'
	];
}