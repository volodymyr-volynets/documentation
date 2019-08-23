<?php

namespace Numbers\Documentation\Documentation\Form\Repository\Page;
class Collection extends \Object\Form\Wrapper\Collection {
	public $collection_link = 'dn_repository_page_collection';
	const BYPASS = ['dn_repository_id', 'dn_repository_version_id', 'dn_repository_language_code', 'dn_repopage_id'];
	public $data = [
		self::MAIN_SCREEN => [
			'order' => 1000,
			'options' => [
				'segment' => \Object\Form\Parent2::SEGMENT_FORM,
			],
			self::ROWS => [
				self::HEADER_ROW => [
					'order' => 100,
					self::FORMS => [
						'dn_page_repositories' => [
							'model' => '\Numbers\Documentation\Documentation\Form\Repository\Page\Repositories',
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
							'model' => '\Numbers\Documentation\Documentation\Form\Repository\Page\PagesTree',
							'bypass_input' => self::BYPASS,
							'options' => [
								'bypass_hidden_from_input' => self::BYPASS,
								'percent' => 30
							],
							'order' => 1
						],
						'dn_page_repository_page_view' => [
							'model' => '\Numbers\Documentation\Documentation\Form\Repository\Page\PagesView',
							'bypass_input' => self::BYPASS,
							'options' => [
								'bypass_hidden_from_input' => self::BYPASS,
								'percent' => 70
							],
							'order' => 2
						]
					]
				],
			]
		],
	];

	public function distribute() {
		if (empty($this->values['dn_repository_id'])) {
			unset($this->data[self::MAIN_SCREEN][self::ROWS][self::MAIN_ROW]);
		}
		if (empty($this->values['dn_repopage_id'])) {
			unset($this->data[self::MAIN_SCREEN][self::ROWS][self::MAIN_ROW][self::FORMS]['dn_page_repository_page_view']);
		}
	}
}