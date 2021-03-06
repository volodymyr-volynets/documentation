<?php

namespace Numbers\Documentation\Documentation\DataSource\Repository;
class PageBreadcrumbs extends \Object\DataSource {
	public $db_link;
	public $db_link_flag;
	public $pk = ['id'];
	public $columns;
	public $orderby;
	public $limit;
	public $single_row;
	public $single_value;
	public $options_map = [
		'name' => 'name',
		'native_name' => 'name',
		'primary' => 'name',
		'country_code' => 'flag_country_code',
		'inactive' => 'inactive'
	];
	public $options_active = [
		'inactive' => 0
	];
	public $column_prefix;

	public $cache = false;
	public $cache_tags = [];
	public $cache_memory = false;

	public $primary_model;
	public $parameters = [
		'dn_repopage_module_id' => ['name' => 'Module #', 'domain' => 'module_id', 'required' => true],
		'dn_repopage_id' => ['name' => 'Page #', 'domain' => 'page_id', 'required' => true],
		'dn_repopage_language_code' => ['name' => 'Language', 'domain' => 'language_code', 'required' => true],
	];

	public function query($parameters, $options = []) {
		$this->query->columns([
			'a.id',
			'a.parent_id',
			'a.order2',
			'name' => 'COALESCE(c.dn_repopgtransl_toc_name, c.dn_repopgtransl_name, b.dn_repopage_toc_name, b.dn_repopage_name)'
		]);
		$query = \Object\Query\Builder::quick()->withRecursive('temp_page_1000', ['module_id', 'id', 'parent_id', 'order2'], function(& $query) use ($parameters) {
			$query = \Numbers\Documentation\Documentation\Model\Repository\Version\Pages::queryBuilderStatic(['skip_acl' => true, 'alias' => 'inner_a'])->select();
			$query->columns([
				'module_id' => 'inner_a.dn_repopage_module_id',
				'id' => 'inner_a.dn_repopage_id',
				'parent_id' => 'inner_a.dn_repopage_parent_repopage_id',
				'order2' => 'inner_a.dn_repopage_order',
			]);
			$query->where('AND', ['inner_a.dn_repopage_module_id', '=', $parameters['dn_repopage_module_id']]);
			$query->where('AND', ['inner_a.dn_repopage_id', '=', $parameters['dn_repopage_id']]);
			$query->union('UNION ALL', function(& $query2) {
				$query2 = \Numbers\Documentation\Documentation\Model\Repository\Version\Pages::queryBuilderStatic(['skip_acl' => true, 'alias' => 'inner_b'])->select();
				$query2->columns([
					'module_id' => 'inner_b.dn_repopage_module_id',
					'id' => 'inner_b.dn_repopage_id',
					'parent_id' => 'inner_b.dn_repopage_parent_repopage_id',
					'order2' => 'inner_b.dn_repopage_order',
				]);
				$query2->from('temp_page_1000', 'inner_b2');
				$query2->where('AND', ['inner_b.dn_repopage_module_id', '=', 'inner_b2.module_id', true]);
				$query2->where('AND', ['inner_b.dn_repopage_id', '=', 'inner_b2.parent_id', true]);
			});
		});
		$this->query->from($query, 'a');
		$this->query->join('INNER', new \Numbers\Documentation\Documentation\Model\Repository\Version\Pages(), 'b', 'ON', [
			['AND', ['a.module_id', '=', 'b.dn_repopage_module_id', true], false],
			['AND', ['a.id', '=', 'b.dn_repopage_id', true], false]
		]);
		$this->query->join('LEFT', new \Numbers\Documentation\Documentation\Model\Repository\Version\Page\Translations(), 'c', 'ON', [
			['AND', ['a.module_id', '=', 'c.dn_repopgtransl_module_id', true], false],
			['AND', ['a.id', '=', 'c.dn_repopgtransl_repopage_id', true], false],
			['AND', ['c.dn_repopgtransl_language_code', '=', $parameters['dn_repopage_language_code']], false],
		]);
		$this->query->orderby(['order2' => SORT_ASC]);
	}
}