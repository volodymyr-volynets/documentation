<?php

namespace Numbers\Documentation\Documentation\Model\Repository\Version\Page;
class Fragments extends \Object\Table {
	public $db_link;
	public $db_link_flag;
	public $module_code = 'DN';
	public $title = 'D/N Repository Page Fragments';
	public $name = 'dn_repository_page_fragments';
	public $pk = ['dn_repopgfragm_tenant_id', 'dn_repopgfragm_module_id', 'dn_repopgfragm_id'];
	public $tenant = true;
	public $module = true;
	public $orderby = [
		'dn_repopgfragm_order' => SORT_ASC
	];
	public $limit;
	public $column_prefix = 'dn_repopgfragm_';
	public $columns = [
		'dn_repopgfragm_tenant_id' => ['name' => 'Tenant #', 'domain' => 'tenant_id'],
		'dn_repopgfragm_module_id' => ['name' => 'Module #', 'domain' => 'module_id'],
		'dn_repopgfragm_repopage_id' => ['name' => 'Page #', 'domain' => 'page_id'],
		'dn_repopgfragm_id' => ['name' => 'Fragment #', 'domain' => 'fragment_id_sequence'],
		'dn_repopgfragm_repository_id' => ['name' => 'Repository #', 'domain' => 'repository_id'],
		'dn_repopgfragm_version_id' => ['name' => 'Version #', 'domain' => 'version_id'],
		'dn_repopgfragm_language_code' => ['name' => 'Language', 'domain' => 'language_code'],
		'dn_repopgfragm_type_code' => ['name' => 'Type', 'domain' => 'type_code', 'options_model' => '\Numbers\Documentation\Documentation\Model\Repository\Version\Page\Fragment\Types'],
		'dn_repopgfragm_name' => ['name' => 'Title', 'domain' => 'name', 'null' => true],
		'dn_repopgfragm_body' => ['name' => 'Body', 'type' => 'text', 'null' => true],
		'dn_repopgfragm_keywords' => ['name' => 'Keywords', 'type' => 'text', 'null' => true],
		'dn_repopgfragm_order' => ['name' => 'Order', 'domain' => 'big_order'],
		'dn_repopgfragm_file_1' => ['name' => 'File 1', 'domain' => 'file_id', 'null' => true],
		'dn_repopgfragm_file_2' => ['name' => 'File 2', 'domain' => 'file_id', 'null' => true],
		'dn_repopgfragm_file_3' => ['name' => 'File 3', 'domain' => 'file_id', 'null' => true],
		'dn_repopgfragm_file_4' => ['name' => 'File 4', 'domain' => 'file_id', 'null' => true],
		'dn_repopgfragm_file_5' => ['name' => 'File 5', 'domain' => 'file_id', 'null' => true],
		'dn_repopgfragm_file_6' => ['name' => 'File 6', 'domain' => 'file_id', 'null' => true],
		'dn_repopgfragm_file_7' => ['name' => 'File 7', 'domain' => 'file_id', 'null' => true],
		'dn_repopgfragm_file_8' => ['name' => 'File 8', 'domain' => 'file_id', 'null' => true],
		'dn_repopgfragm_file_9' => ['name' => 'File 9', 'domain' => 'file_id', 'null' => true],
		'dn_repopgfragm_file_10' => ['name' => 'File 10', 'domain' => 'file_id', 'null' => true],
		'dn_repopgfragm_face_picture' => ['name' => 'Face Picture', 'type' => 'boolean'],
		'dn_repopgfragm_inactive' => ['name' => 'Inactive', 'type' => 'boolean']
	];
	public $constraints = [
		'dn_repository_page_fragments_pk' => ['type' => 'pk', 'columns' => ['dn_repopgfragm_tenant_id', 'dn_repopgfragm_module_id', 'dn_repopgfragm_id']],
		'dn_repopgfragm_order_un' => ['type' => 'unique', 'columns' => ['dn_repopgfragm_tenant_id', 'dn_repopgfragm_module_id', 'dn_repopgfragm_repopage_id', 'dn_repopgfragm_order']],
		'dn_repopgfragm_language_code_fk' => [
			'type' => 'fk',
			'columns' => ['dn_repopgfragm_tenant_id', 'dn_repopgfragm_module_id', 'dn_repopgfragm_repopage_id'],
			'foreign_model' => '\Numbers\Documentation\Documentation\Model\Repository\Version\Pages',
			'foreign_columns' => ['dn_repopage_tenant_id', 'dn_repopage_module_id', 'dn_repopage_id']
		],
		'dn_repopgfragm_language_code_fk' => [
			'type' => 'fk',
			'columns' => ['dn_repopgfragm_tenant_id', 'dn_repopgfragm_language_code'],
			'foreign_model' => '\Numbers\Internalization\Internalization\Model\Language\Codes',
			'foreign_columns' => ['in_language_tenant_id', 'in_language_code']
		],
	];
	public $indexes = [
		'dn_repository_page_fragments_fulltext_idx' => ['type' => 'fulltext', 'columns' => ['dn_repopgfragm_name', 'dn_repopgfragm_keywords']]
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