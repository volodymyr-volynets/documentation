<?php

namespace Numbers\Documentation\Documentation\DataSource\Repository;
class PageLanguages extends \Object\DataSource {
	public $db_link;
	public $db_link_flag;
	public $pk = ['code'];
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

	public $cache = true;
	public $cache_tags = [];
	public $cache_memory = false;

	public $primary_model = '\Numbers\Documentation\Documentation\Model\Repository\Languages';
	public $parameters = [
		'dn_repopage_module_id' => ['name' => 'Module #', 'domain' => 'module_id', 'required' => true],
		'dn_repopage_id' => ['name' => 'Page #', 'domain' => 'page_id', 'required' => true],
		'only_language_codes' => ['name' => 'Only Language Codes', 'type' => 'boolean'],
		'only_with_translations' => ['name' => 'Only With Translations', 'type' => 'boolean'],
	];

	public function query($parameters, $options = []) {
		// columns
		if (!empty($parameters['only_language_codes'])) {
			$this->query->columns([
				'code' => 'a.dn_repolang_language_code',
			]);
		} else {
			$this->query->columns([
				'code' => 'a.dn_repolang_language_code',
				'name' => 'b.in_language_name',
				'native_name' => 'b.in_language_native_name',
				'country_code' => 'b.in_language_country_code',
				'primary' => "(CASE WHEN a.dn_repolang_primary = 1 THEN '(Primary)' ELSE NULL END)",
				'inactive' => 'a.dn_repolang_inactive + b.in_language_inactive',
			]);
		}
		// joins
		$this->query->join('INNER', new \Numbers\Internalization\Internalization\Model\Language\Codes(), 'b', 'ON', [
			['AND', ['a.dn_repolang_language_code', '=', 'b.in_language_code', true], false]
		]);
		// where
		$this->query->where('AND', function (& $query) use ($parameters) {
			$query = \Numbers\Documentation\Documentation\Model\Repository\Version\Pages::queryBuilderStatic(['alias' => 'inner_a'])->select();
			$query->where('AND', ['inner_a.dn_repopage_module_id', '=', $parameters['dn_repopage_module_id']]);
			$query->where('AND', ['inner_a.dn_repopage_id', '=', $parameters['dn_repopage_id']]);
			$query->where('AND', ['inner_a.dn_repopage_repository_id', '=', 'a.dn_repolang_repository_id', true]);
			if (empty($parameters['only_with_translations'])) {
				$query->where('AND', ['inner_a.dn_repopage_language_code', '<>', 'a.dn_repolang_language_code', true]);
			} else {
				// translations
				$query->join('LEFT', new \Numbers\Documentation\Documentation\Model\Repository\Version\Page\Translations(), 'inner_b', 'ON', [
					['AND', ['inner_b.dn_repopgtransl_module_id', '=', 'inner_a.dn_repopage_module_id', true], false],
					['AND', ['inner_b.dn_repopgtransl_repopage_id', '=', 'inner_a.dn_repopage_id', true], false],
					['AND', ['inner_b.dn_repopgtransl_language_code', '=', 'a.dn_repolang_language_code', true], false]
				]);
				$query->where('AND', function (& $query) use ($parameters) {
					$query->where('OR', ['inner_b.dn_repopgtransl_language_code', 'IS NOT', null]);
					$query->where('OR', ['inner_a.dn_repopage_language_code', '=', 'a.dn_repolang_language_code', true]);
				});
			}
		}, 'EXISTS');
	}
}