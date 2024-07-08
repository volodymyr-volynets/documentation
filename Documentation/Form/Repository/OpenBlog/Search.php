<?php

namespace Numbers\Documentation\Documentation\Form\Repository\OpenBlog;
class Search extends \Object\Form\Wrapper\List2 {
	public $form_link = 'dn_page_repository_search';
	public $module_code = 'DN';
	public $title = 'D/N Repository Search List';
	public $options = [
		'include_css' => '/numbers/media_submodules/Numbers_Documentation_Documentation_Media_CSS_CollectionPages.css',
		'skip_acl' => true
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
				'dn_repopage_id' => ['order' => 1, 'row_order' => 100, 'label_name' => 'Page #', 'domain' => 'page_id', 'null' => true, 'percent' => 15, 'skip_fts' => true, 'custom_renderer' => 'self::renderPageId'],
				'dn_repopage_name' => ['order' => 2, 'label_name' => 'Name', 'domain' => 'name', 'percent' => 85, 'custom_renderer' => '\Numbers\Documentation\Documentation\Form\Repository\Page\Search::renderTitle'],
			],
			'row2' => [
				'dn_repopage_rank' => ['order' => 1, 'row_order' => 200, 'label_name' => 'Rank', 'type' => 'numeric', 'null' => true, 'percent' => 15, 'format' => '\Format::number'],
				'dn_repopgfragm_keywords' => ['order' => 2, 'label_name' => 'Description', 'type' => 'text', 'percent' => 85, 'custom_renderer' => '\Numbers\Documentation\Documentation\Form\Repository\Page\Search::renderDescription'],
			]
		]
	];
	public $list_options = [
		'pagination_top' => '\Numbers\Frontend\HTML\Form\Renderers\HTML\Pagination\Base',
		'pagination_bottom' => '\Numbers\Frontend\HTML\Form\Renderers\HTML\Pagination\Base',
		'default_limit' => 30,
		'default_sort' => [
			'dn_repopage_rank' => SORT_DESC
		]
	];
	const LIST_SORT_OPTIONS = [
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
		$repository = \Numbers\Documentation\Documentation\Model\Repositories::getStatic([
			'where' => [
				'dn_repository_module_id' => $form->values['__module_id'],
				'dn_repository_id' => $form->values['dn_repository_id'],
			],
			'single_row' => true,
			'pk' => null,
		]);
		// primary model
		$form->query = \Numbers\Documentation\Documentation\Model\Repository\Version\Pages::queryBuilderStatic(['alias' => 'a']);
		// main language we query pages
		if ($repository['dn_repository_default_language_code'] == $form->values['dn_repository_language_code']) {
			// titles
			$fts_titles = $form->query->db_object->fullTextSearchQuery(['a.dn_repopage_title_number', 'a.dn_repopage_name', 'a.dn_repopage_toc_name'], $form->values['full_text_search']);
			$form->query->columns([
				'dn_repopage_module_id' => 'a.dn_repopage_module_id',
				'dn_repopage_id' => 'a.dn_repopage_id',
				'dn_repopage_rank' => 'b.fragments_ts_rank + ' . $fts_titles['rank_simple'],
				'dn_repopage_name' => "concat_ws(' ', a.dn_repopage_title_number, a.dn_repopage_name)",
				'dn_repopage_toc_name' => 'a.dn_repopage_toc_name',
				'dn_repopgfragm_name' => 'b.dn_repopgfragm_name',
				'dn_repopgfragm_keywords' => 'b.dn_repopgfragm_keywords',
			]);
			// fragments
			$form->query->join('LEFT', function (& $query) use ($form) {
				// fts
				$fts_fragments = $form->query->db_object->fullTextSearchQuery(['inner_a.dn_repopgfragm_name', 'inner_a.dn_repopgfragm_keywords'], $form->values['full_text_search']);
				// assemble query
				$query = \Numbers\Documentation\Documentation\Model\Repository\Version\Page\Fragments::queryBuilderStatic(['alias' => 'inner_a'])->select();
				$query->columns([
					'inner_a.dn_repopgfragm_repopage_id',
					'fragments_ts_rank' => "SUM({$fts_fragments['rank_simple']})",
					'dn_repopgfragm_name' => $query->db_object->sqlHelper('string_agg', ['expression' => "inner_a.dn_repopgfragm_name", 'delimiter' => ' ']),
					'dn_repopgfragm_keywords' => $query->db_object->sqlHelper('string_agg', ['expression' => "inner_a.dn_repopgfragm_keywords", 'delimiter' => ' ']),
				]);
				$query->groupby(['inner_a.dn_repopgfragm_repopage_id']);
				// where
				$query->where('AND', ['inner_a.dn_repopgfragm_module_id', '=', $form->values['__module_id']]);
				$query->where('AND', ['inner_a.dn_repopgfragm_repository_id', '=', $form->values['dn_repository_id']]);
				$query->where('AND', ['inner_a.dn_repopgfragm_version_id', '=', $form->values['dn_repository_version_id']]);
				$query->where('AND', ['inner_a.dn_repopgfragm_language_code', '=', $form->values['dn_repository_language_code']]);
				$query->where('AND', $fts_fragments['where']);
			}, 'b', 'ON', [
				['AND', ['a.dn_repopage_id', '=', 'b.dn_repopgfragm_repopage_id', true], false]
			]);
			// combined where
			$form->query->where('AND', function (& $query) use ($fts_titles) {
				$query->where('OR', $fts_titles['where']);
				$query->where('OR', ['b.fragments_ts_rank', 'IS NOT', null]);
			});
		} else { // we query translations
			// titles
			$fts_titles = $form->query->db_object->fullTextSearchQuery(['a.dn_repopage_title_number'], $form->values['full_text_search']);
			$fts_translation_titles = $form->query->db_object->fullTextSearchQuery(['e.dn_repopgtransl_name', 'e.dn_repopgtransl_toc_name'], $form->values['full_text_search']);
			$form->query->columns([
				'dn_repopage_module_id' => 'a.dn_repopage_module_id',
				'dn_repopage_id' => 'a.dn_repopage_id',
				'dn_repopage_rank' => '(b.fragments_ts_rank + ' . $fts_titles['rank_simple'] . ' + ' . $fts_translation_titles['rank_simple'] . ')',
				'dn_repopage_name' => "concat_ws(' ', a.dn_repopage_title_number, e.dn_repopgtransl_name)",
				'dn_repopage_toc_name' => 'e.dn_repopgtransl_toc_name',
				'dn_repopgfragm_name' => 'b.dn_repopgfragm_name',
				'dn_repopgfragm_keywords' => 'b.dn_repopgfragm_keywords',
			]);
			$form->query->join('INNER', new \Numbers\Documentation\Documentation\Model\Repository\Version\Page\Translations(), 'e', 'ON', [
				['AND', ['a.dn_repopage_module_id', '=', 'e.dn_repopgtransl_module_id', true], false],
				['AND', ['a.dn_repopage_id', '=', 'e.dn_repopgtransl_repopage_id', true], false],
				['AND', ['e.dn_repopgtransl_language_code', '=', $form->values['dn_repository_language_code'], false], false],
			]);
			// fragments
			$form->query->join('LEFT', function (& $query) use ($form) {
				// fts
				$fts_fragments = $form->query->db_object->fullTextSearchQuery(['inner_a.dn_repofragtransl_name', 'inner_a.dn_repofragtransl_keywords'], $form->values['full_text_search']);
				// assemble query
				$query = \Numbers\Documentation\Documentation\Model\Repository\Version\Page\Fragment\Translations::queryBuilderStatic(['alias' => 'inner_a'])->select();
				$query->columns([
					'inner_a.dn_repofragtransl_repopage_id',
					'fragments_ts_rank' => "SUM({$fts_fragments['rank_simple']})",
					'dn_repopgfragm_name' => $query->db_object->sqlHelper('string_agg', ['expression' => "inner_a.dn_repofragtransl_name", 'delimiter' => ' ']),
					'dn_repopgfragm_keywords' => $query->db_object->sqlHelper('string_agg', ['expression' => "inner_a.dn_repofragtransl_keywords", 'delimiter' => ' ']),
				]);
				$query->groupby(['inner_a.dn_repofragtransl_repopage_id']);
				// where
				$query->where('AND', ['inner_a.dn_repofragtransl_module_id', '=', $form->values['__module_id']]);
				$query->where('AND', ['inner_a.dn_repofragtransl_repository_id', '=', $form->values['dn_repository_id']]);
				$query->where('AND', ['inner_a.dn_repofragtransl_version_id', '=', $form->values['dn_repository_version_id']]);
				$query->where('AND', ['inner_a.dn_repofragtransl_language_code', '=', $form->values['dn_repository_language_code']]);
				$query->where('AND', $fts_fragments['where']);
			}, 'b', 'ON', [
				['AND', ['a.dn_repopage_id', '=', 'b.dn_repofragtransl_repopage_id', true], false]
			]);
			// combined where
			$form->query->where('AND', function (& $query) use ($fts_titles, $fts_translation_titles) {
				$query->where('OR', $fts_titles['where']);
				$query->where('OR', $fts_translation_titles['where']);
				$query->where('OR', ['b.fragments_ts_rank', 'IS NOT', null]);
			});
		}
		// where
		$form->query->where('AND', ['a.dn_repopage_module_id', '=', $form->values['__module_id']]);
		$form->query->where('AND', ['a.dn_repopage_repository_id', '=', $form->values['dn_repository_id']]);
		$form->query->where('AND', ['a.dn_repopage_version_id', '=', $form->values['dn_repository_version_id']]);
	}

	public function renderPageId(& $form, & $options, & $value, & $neighbouring_values) {
		$filename = ($neighbouring_values['dn_repopage_toc_name'] ?? $neighbouring_values['dn_repopage_name']) . '.html';
		$filename = str_replace('/', '', $filename);
		$filename = urlencode($filename);
		$hash = \Request::hash([
			$form->values['__module_id'],
			$form->values['dn_repository_id'],
			$form->values['dn_repository_version_id'],
			$form->values['dn_repository_language_code'],
			$value,
		]);
		$href = \Request::buildURL(\Application::get('mvc.full') . '/_Index/' . $hash . '/' . $filename, [], \Request::host(), 'page_title');
		return \HTML::a(['href' => $href, 'value' => $value]);
	}

	public function renderTitle(& $form, & $options, & $value, & $neighbouring_values) {
		return $value;
	}

	public function renderDescription(& $form, & $options, & $value, & $neighbouring_values) {
		if (isset($value)) {
			$temp = \Helper\Parser::extractSentances($form->values['full_text_search'], $value, 5, 100);
			return implode('<br/>', $temp);
		} else {
			return '';
		}
	}
}