<?php

namespace Numbers\Documentation\Documentation\Form\Repository\OpenAccess;
class Collection extends \Object\Form\Wrapper\Collection {
	public $collection_link = 'dn_repository_open_access_collection';
	const BYPASS = ['dn_repository_module_id', 'dn_repository_id', 'dn_repository_version_id', 'dn_repository_language_code', 'dn_repopage_module_id', 'dn_repopage_id', 'full_text_search'];
	public $data = [
		self::MAIN_SCREEN => [
			'order' => 1000,
			'options' => [
				'segment' => [
					'type' => 'secondary',
					'header' => [
						'icon' => ['type' => 'fas fa-pen-square'],
						'title' => 'View and Search Documentation:'
					]
				],
			],
			self::ROWS => [
				self::HEADER_ROW => [
					'order' => 100,
					self::FORMS => [
						'dn_page_repositories' => [
							'model' => \Numbers\Documentation\Documentation\Form\Repository\OpenAccess\Repositories::class,
							'flag_main_form' => true,
							'bypass_values' => self::BYPASS,
							'options' => [
								'percent' => 100
							],
							'order' => 1
						]
					]
				],
				self::MAIN_ROW => [
					'order' => 200,
					self::FORMS => [
						'dn_page_repository_page_tree' => [
							'model' => \Numbers\Documentation\Documentation\Form\Repository\OpenAccess\PagesTree::class,
							'bypass_input' => self::BYPASS,
							'options' => [
								'bypass_hidden_from_input' => self::BYPASS,
								'percent' => 30
							],
							'order' => 1
						],
						'dn_page_repository_page_view' => [
							'model' => \Numbers\Documentation\Documentation\Form\Repository\OpenAccess\PagesView::class,
							'bypass_input' => self::BYPASS,
							'options' => [
								'bypass_hidden_from_input' => self::BYPASS,
								'percent' => 70
							],
							'order' => 2
						]
					]
				],
				self::SEARCH_ROW => [
					'order' => 200,
					self::FORMS => [
						'dn_page_repository_search' => [
							'model' => \Numbers\Documentation\Documentation\Form\Repository\OpenAccess\Search::class,
							'bypass_input' => self::BYPASS,
							'options' => [
								'bypass_hidden_from_input' => self::BYPASS,
								'percent' => 100
							],
							'order' => 1
						],
					]
				]
			]
		],
	];

	public function distribute() {
		if (!empty($this->values['full_text_search']) && !empty($this->values['dn_repository_id'])) {
			unset($this->data[self::MAIN_SCREEN][self::ROWS][self::MAIN_ROW]);
			unset($this->data[self::MAIN_SCREEN][self::ROWS][self::WIDGETS_ROW]);
		} else if (empty($this->values['dn_repository_id'])) {
			unset($this->data[self::MAIN_SCREEN][self::ROWS][self::MAIN_ROW]);
			unset($this->data[self::MAIN_SCREEN][self::ROWS][self::SEARCH_ROW]);
			unset($this->data[self::MAIN_SCREEN][self::ROWS][self::WIDGETS_ROW]);
		} else if (empty($this->values['dn_repopage_id'])) {
			unset($this->data[self::MAIN_SCREEN][self::ROWS][self::MAIN_ROW][self::FORMS]['dn_page_repository_page_view']);
			unset($this->data[self::MAIN_SCREEN][self::ROWS][self::SEARCH_ROW]);
			unset($this->data[self::MAIN_SCREEN][self::ROWS][self::WIDGETS_ROW]);
		} else {
			unset($this->data[self::MAIN_SCREEN][self::ROWS][self::SEARCH_ROW]);
		}
	}
}