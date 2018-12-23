<?php

namespace Numbers\Documentation\Documentation\Form\Repository\Page;
class Collection extends \Object\Form\Wrapper\Collection {
	public $collection_link = 'dn_repository_page_collection';
	public $data = [
		'step1' => [
			'order' => 1000,
			self::ROWS => [
				self::HEADER_ROW => [
					'order' => 100,
					self::FORMS => [
						'dn_page_repositories' => [
							'model' => '\Numbers\Documentation\Documentation\Form\Repository\Page\Repositories',
							'bypass_values' => ['dn_repository_id'],
							'options' => [
								'percent' => 100
							],
							'order' => 1
						]
					]
				],
				/*
				self::MAIN_ROW => [
					'order' => 200,
					self::FORMS => [
						'b4_register_step1' => [
							'model' => '\Form\Register\Step1',
							'bypass_values' => ['__wizard_step', 'b4_register_id'],
							'options' => [
								'segment' => null,
								'percent' => 100
							],
							'order' => 1
						]
					]
				]
				*/
			]
		],
	];

	public function distribute() {
		$this->values['__wizard_step'] = (int) ($this->values['__wizard_step'] ?? 1);
		if (empty($this->values['__wizard_step'])) $this->values['__wizard_step'] = 1;
		$this->collection_screen_link = 'step' . $this->values['__wizard_step'];
		// make everything look success
		if ($this->values['__wizard_step'] == 5) {
			$this->data['step5'][$this::ROWS][self::HEADER_ROW][$this::FORMS]['register_step5']['options']['wizard']['type'] = 'success';
			$this->data['step5']['options']['segment']['type'] = 'success';
		}
	}
}