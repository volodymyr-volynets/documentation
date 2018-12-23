<?php

namespace Numbers\Documentation\Documentation\DataSource\Repository;
class Languages extends \Object\DataSource {
	public $db_link;
	public $db_link_flag;
	public $pk = ['code'];
	public $columns;
	public $orderby;
	public $limit;
	public $single_row;
	public $single_value;
	public $options_map =[
		'name' => 'name',
		'primary' => 'name',
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
		'dn_repolang_repository_id' => ['name' => 'Repository #', 'domain' => 'repository_id', 'required' => true],
	];

	public function query($parameters, $options = []) {
		// columns
		$this->query->columns([
			'code' => 'a.dn_repolang_language_code',
			'name' => 'b.in_language_name',
			'primary' => "(CASE WHEN a.dn_repolang_primary = 1 THEN '(Primary)' ELSE NULL END)",
			'inactive' => 'a.dn_repolang_inactive + b.in_language_inactive'
		]);
		// joins
		$this->query->join('INNER', new \Numbers\Internalization\Internalization\Model\Language\Codes(), 'b', 'ON', [
			['AND', ['a.dn_repolang_language_code', '=', 'b.in_language_code', true], false]
		]);
		// where
		$this->query->where('AND', ['a.dn_repolang_repository_id', '=', $parameters['dn_repolang_repository_id']]);
	}
}