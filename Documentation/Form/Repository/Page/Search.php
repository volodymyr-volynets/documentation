<?php

namespace Numbers\Documentation\Documentation\Form\Repository\Page;
class Search extends \Object\Form\Wrapper\List2 {
	public $form_link = 'dn_page_repository_search';
	public $module_code = 'DN';
	public $title = 'D/N Repository Search List';
	public $options = [
		'include_css' => '/numbers/media_submodules/Numbers_Documentation_Documentation_Media_CSS_CollectionPages.css'
	];
	public $containers = [
		'top' => ['default_row_type' => 'grid', 'order' => 100],
		'tabs' => ['default_row_type' => 'grid', 'order' => 1000, 'type' => 'tabs', 'class' => 'numbers_form_filter_sort_container'],
		'filter' => ['default_row_type' => 'grid', 'order' => 1500],
		'sort' => self::LIST_SORT_CONTAINER,
		self::LIST_CONTAINER => ['default_row_type' => 'grid', 'order' => PHP_INT_MAX],
	];
	public $rows = [
		'tabs' => [
			'filter' => ['order' => 100, 'label_name' => 'Filter'],
			'sort' => ['order' => 200, 'label_name' => 'Sort'],
		]
	];
	public $elements = [
		'top' => [
			self::HIDDEN => [
				'dn_repository_id' => ['order' => 4, 'label_name' => 'Repository', 'domain' => 'repository_id', 'null' => true, 'method' => 'hidden', 'preserved' => true],
				'dn_repository_version_id' => ['order' => 5, 'label_name' => 'Version', 'domain' => 'version_id', 'null' => true, 'method' => 'hidden', 'preserved' => true],
				'dn_repository_language_code' => ['order' => 6, 'label_name' => 'Language (View)', 'domain' => 'language_code', 'null' => true, 'method' => 'hidden', 'preserved' => true],
			]
		],
		'tabs' => [
			'filter' => [
				'filter' => ['container' => 'filter', 'order' => 100]
			],
			'sort' => [
				'sort' => ['container' => 'sort', 'order' => 100]
			]
		],
		'filter' => [
			'full_text_search' => [
				'full_text_search' => ['order' => 1, 'row_order' => 300, 'label_name' => 'Text Search', 'full_text_search_columns' => ['a.dn_repository_name', 'a.dn_repository_code'], 'placeholder' => true, 'domain' => 'name', 'percent' => 100, 'null' => true],
			]
		],
		'sort' => [
			'__sort' => [
				'__sort' => ['order' => 1, 'row_order' => 100, 'label_name' => 'Sort', 'domain' => 'code', 'details_unique_select' => true, 'percent' => 50, 'null' => true, 'method' => 'select', 'options' => self::LIST_SORT_OPTIONS, 'onchange' => 'this.form.submit();'],
				'__order' => ['order' => 2, 'label_name' => 'Order', 'type' => 'smallint', 'default' => SORT_ASC, 'percent' => 50, 'null' => true, 'method' => 'select', 'no_choose' => true, 'options_model' => '\Object\Data\Model\Order', 'onchange' => 'this.form.submit();'],
			]
		],
		self::LIST_BUTTONS => self::LIST_BUTTONS_DATA,
		self::LIST_CONTAINER => [
			'row1' => [
				'dn_repopage_id' => ['order' => 1, 'label_name' => 'Page #', 'domain' => 'page_id', 'null' => true, 'url_edit' => true, 'percent' => 15],
				'dn_repopage_name' => ['order' => 2, 'label_name' => 'Name', 'domain' => 'name', 'percent' => 85],
			]
		]
	];
	//public $query_primary_model = '\Numbers\Documentation\Documentation\Model\Repositories';
	public $list_options = [
		'pagination_top' => '\Numbers\Frontend\HTML\Form\Renderers\HTML\Pagination\Base',
		'pagination_bottom' => '\Numbers\Frontend\HTML\Form\Renderers\HTML\Pagination\Base',
		'default_limit' => 30,
		'default_sort' => [
			'dn_repopage_rank' => SORT_DESC
		]
	];
	const LIST_SORT_OPTIONS = [
		'dn_repopage_id' => ['name' => 'Page #'],
		'dn_repopage_name' => ['name' => 'Name'],
		'dn_repopage_rank' => ['name' => 'Rank']
	];
	public $collection = [
		'readonly' => true,
		'model' => '\Numbers\Documentation\Documentation\Model\Repository\Version\Pages'
	];

	public function overrides(& $form) {
		$form->values['dn_repopage_id'] = null;
	}

	public function listQuery(& $form) {
		//\Numbers\Documentation\Documentation\Model\Repository\Version\Pages
		print_r2($form->values);
//		$datasource = new \Mirabelli\JobManagement\DataSource\Jobs();
//		foreach ($form->values as $k => $v) {
//			if ($v == 0) {
//				unset($form->values[$k]);
//			}
//		}
//		$form->query = $datasource->queryBuilder([
//			'where' => $form->values
//		]);
//		// columns
//		$form->query->columns([
//			'a.*'
//		]);
	}
}