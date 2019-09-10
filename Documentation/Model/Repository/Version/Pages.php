<?php

namespace Numbers\Documentation\Documentation\Model\Repository\Version;
class Pages extends \Object\Table {
	public $db_link;
	public $db_link_flag;
	public $module_code = 'DN';
	public $title = 'D/N Repository Pages';
	public $name = 'dn_repository_pages';
	public $pk = ['dn_repopage_tenant_id', 'dn_repopage_module_id', 'dn_repopage_id'];
	public $tenant = true;
	public $module = true;
	public $orderby = [
		'dn_repopage_order' => SORT_ASC
	];
	public $limit;
	public $column_prefix = 'dn_repopage_';
	public $columns = [
		'dn_repopage_tenant_id' => ['name' => 'Tenant #', 'domain' => 'tenant_id'],
		'dn_repopage_module_id' => ['name' => 'Module #', 'domain' => 'module_id'],
		'dn_repopage_id' => ['name' => 'Page #', 'domain' => 'page_id_sequence'],
		'dn_repopage_repository_id' => ['name' => 'Repository #', 'domain' => 'repository_id'],
		'dn_repopage_version_id' => ['name' => 'Version #', 'domain' => 'version_id'],
		'dn_repopage_parent_repopage_id' => ['name' => 'Parent Page #', 'domain' => 'page_id', 'null' => true],
		'dn_repopage_order' => ['name' => 'Order', 'domain' => 'big_order'],
		'dn_repopage_title_number' => ['name' => 'Title Number', 'domain' => 'title_number', 'null' => true],
		'dn_repopage_name' => ['name' => 'Title', 'domain' => 'name'],
		'dn_repopage_toc_name' => ['name' => 'Title (Table of Contents)', 'domain' => 'name', 'null' => true],
		'dn_repopage_language_code' => ['name' => 'Language', 'domain' => 'language_code'],
		'dn_repopage_icon' => ['name' => 'Icon', 'domain' => 'icon', 'null' => true],
		'dn_repopage_inactive' => ['name' => 'Inactive', 'type' => 'boolean']
	];
	public $constraints = [
		'dn_repository_pages_pk' => ['type' => 'pk', 'columns' => ['dn_repopage_tenant_id', 'dn_repopage_module_id', 'dn_repopage_id']],
		'dn_repopage_version_id_fk' => [
			'type' => 'fk',
			'columns' => ['dn_repopage_tenant_id', 'dn_repopage_module_id', 'dn_repopage_repository_id', 'dn_repopage_version_id'],
			'foreign_model' => '\Numbers\Documentation\Documentation\Model\Repository\Versions',
			'foreign_columns' => ['dn_repoversion_tenant_id', 'dn_repoversion_module_id', 'dn_repoversion_repository_id', 'dn_repoversion_version_id']
		],
		'dn_repopage_parent_repopage_id_fk' => [
			'type' => 'fk',
			'columns' => ['dn_repopage_tenant_id', 'dn_repopage_module_id', 'dn_repopage_parent_repopage_id'],
			'foreign_model' => '\Numbers\Documentation\Documentation\Model\Repository\Version\Pages',
			'foreign_columns' => ['dn_repopage_tenant_id', 'dn_repopage_module_id', 'dn_repopage_id']
		],
		'dn_repopage_language_code_fk' => [
			'type' => 'fk',
			'columns' => ['dn_repopage_tenant_id', 'dn_repopage_module_id', 'dn_repopage_repository_id', 'dn_repopage_language_code'],
			'foreign_model' => '\Numbers\Documentation\Documentation\Model\Repositories',
			'foreign_columns' => ['dn_repository_tenant_id', 'dn_repository_module_id', 'dn_repository_id', 'dn_repository_default_language_code']
		]
	];
	public $indexes = [
		'dn_repository_pages_fulltext_idx' => ['type' => 'fulltext', 'columns' => ['dn_repopage_name', 'dn_repopage_toc_name']]
	];
	public $history = false;
	public $audit = [
		'map' => [
			'dn_repopage_tenant_id' => 'wg_audit_tenant_id',
			'dn_repopage_module_id' => 'wg_audit_module_id',
			'dn_repopage_id' => 'wg_audit_repopage_id'
		]
	];
	public $options_map = [
		'dn_repopage_title_number' => 'name',
		'dn_repopage_name' => 'name',
		'dn_repopage_parent_repopage_id' => 'parent',
		'dn_repopage_order' => 'order',
		'dn_repopage_inactive' => 'inactive'
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

	public $comments = [
		'map' => [
			'dn_repopage_tenant_id' => 'wg_comment_tenant_id',
			'dn_repopage_module_id' => 'wg_comment_module_id',
			'dn_repopage_id' => 'wg_comment_repopage_id'
		]
	];

	public $documents = [
		'map' => [
			'dn_repopage_tenant_id' => 'wg_document_tenant_id',
			'dn_repopage_module_id' => 'wg_document_module_id',
			'dn_repopage_id' => 'wg_document_repopage_id'
		]
	];

	public $tags = [
		'map' => [
			'dn_repopage_tenant_id' => 'wg_tag_tenant_id',
			'dn_repopage_module_id' => 'wg_tag_module_id',
			'dn_repopage_id' => 'wg_tag_repopage_id'
		]
	];

	public $data_asset = [
		'classification' => 'client_confidential',
		'protection' => 2,
		'scope' => 'enterprise'
	];

	/**
	 * @see $this->options()
	 */
	public function optionsGrouppedTree($options = []) {
		$options['orderby'] = ['dn_repopage_order' => SORT_ASC];
		$data = $this->options($options);
		$converted = \Helper\Tree::convertByParent($data, 'parent');
		$result = [];
		$options['name_field'] = 'name';
		\Helper\Tree::convertTreeToOptionsMulti($converted, 0, $options, $result);
		return $result;
	}
}