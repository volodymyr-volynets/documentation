<?php

namespace Numbers\Documentation\Documentation\Model;
class Categories extends \Object\Table {
	public $db_link;
	public $db_link_flag;
	public $module_code = 'DN';
	public $title = 'D/N Categories';
	public $name = 'dn_categories';
	public $pk = ['dn_category_tenant_id', 'dn_category_module_id', 'dn_category_code'];
	public $tenant = true;
	public $module = true;
	public $orderby = [
		'dn_category_order' => SORT_ASC
	];
	public $limit;
	public $column_prefix = 'dn_category_';
	public $columns = [
		'dn_category_tenant_id' => ['name' => 'Tenant #', 'domain' => 'tenant_id'],
		'dn_category_module_id' => ['name' => 'Module #', 'domain' => 'module_id'],
		'dn_category_code' => ['name' => 'Code', 'domain' => 'group_code'],
		'dn_category_name' => ['name' => 'Name', 'domain' => 'name'],
		'dn_category_parent_dn_category_code' => ['name' => 'Parent', 'domain' => 'group_code', 'null' => true],
		'dn_category_order' => ['name' => 'Order', 'domain' => 'order'],
		'dn_category_inactive' => ['name' => 'Inactive', 'type' => 'boolean'],
	];
	public $constraints = [
		'dn_categories_pk' => ['type' => 'pk', 'columns' => ['dn_category_tenant_id', 'dn_category_module_id', 'dn_category_code']],
		'dn_category_parent_dn_category_code_fk' => [
			'type' => 'fk',
			'columns' => ['dn_category_tenant_id', 'dn_category_module_id', 'dn_category_parent_dn_category_code'],
			'foreign_model' => \Numbers\Documentation\Documentation\Model\Categories::class,
			'foreign_columns' => ['dn_category_tenant_id', 'dn_category_module_id', 'dn_category_code']
		],
	];
	public $indexes = [
		'dn_categories_fulltext_idx' => ['type' => 'fulltext', 'columns' => ['dn_category_name', 'dn_category_code']],
	];
	public $history = false;
	public $audit = [
		'map' => [
			'dn_category_tenant_id' => 'wg_audit_tenant_id',
			'dn_category_module_id' => 'wg_audit_module_id',
			'dn_category_code' => 'wg_audit_category_code'
		]
	];
	public $optimistic_lock = true;
	public $options_map = [
		'dn_category_name' => 'name',
		'dn_category_parent_dn_category_code' => 'parent',
		'dn_category_inactive' => 'inactive'
	];
	public $options_active = [
		'dn_category_inactive' => 0
	];
	public const selectOptionsActive = '\Numbers\Documentation\Documentation\Model\Categories::optionsActive';
	public const selectOptionsGrouppedTree = '\Numbers\Documentation\Documentation\Model\Categories::optionsGrouppedTree';
	public $engine = [
		'MySQLi' => 'InnoDB'
	];

	public $cache = true;
	public $cache_tags = [];
	public $cache_memory = false;

	public $who = [
		'inserted' => true,
		'posted' => true
	];

	public $attributes = [];
	public $comments = [];
	public $documents = [];
	public $tags = [];

	public $data_asset = [
		'classification' => 'client_confidential',
		'protection' => 2,
		'scope' => 'enterprise'
	];

	/**
	 * @see $this->options()
	 */
	public function optionsGrouppedTree($options = []) {
		$data = $this->options($options);
		$result = [];
		if (!empty($data)) {
			$converted = \Helper\Tree::convertByParent($data, 'parent');
			\Helper\Tree::convertTreeToOptionsMulti($converted, 0, ['name_field' => 'name'], $result);
		}
		return $result;
	}
}