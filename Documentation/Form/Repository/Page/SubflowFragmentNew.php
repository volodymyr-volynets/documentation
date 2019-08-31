<?php

namespace Numbers\Documentation\Documentation\Form\Repository\Page;
class SubflowFragmentNew extends \Object\Form\Wrapper\Base {
	public $form_link = 'dn_page_repository_fragment_new';
	public $module_code = 'DN';
	public $title = 'D/N Page Subflow New Fragment Form';
	public $options = [
		'on_success_refresh_collection' => true
	];
	public $containers = [
		'top' => ['default_row_type' => 'grid', 'order' => 100],
		'buttons' => ['default_row_type' => 'grid', 'order' => 900]
	];
	public $rows = [];
	public $elements = [
		'top' => [
			'dn_repopgfragm_id' => [
				'dn_repopgfragm_id' => ['order' => 1, 'row_order' => 100, 'label_name' => 'Fragment #', 'domain' => 'fragment_id_sequence', 'null' => true, 'readonly' => true, 'percent' => 95],
				'dn_repopgfragm_inactive' => ['order' => 2, 'label_name' => 'Inactive', 'type' => 'boolean', 'percent' => 5]
			],
			'dn_repopgfragm_order' => [
				'dn_repopgfragm_order' => ['order' => 1, 'row_order' => 200, 'label_name' => 'Order', 'domain' => 'big_order', 'null' => true, 'required' => true],
				'dn_repopgfragm_type_code' => ['order' => 2, 'label_name' => 'Type', 'domain' => 'type_code', 'null' => true, 'required' => true, 'method' => 'select', 'options_model' => '\Numbers\Documentation\Documentation\Model\Repository\Version\Page\Fragment\Types', 'options_params' => ['dn_repopgfrgmtype_group' => 'TEXT'], 'onchange' => 'this.form.submit();'],
			],
			'dn_repopgfragm_name' => [
				'dn_repopgfragm_name' => ['order' => 1, 'row_order' => 300, 'label_name' => 'Title', 'domain' => 'name', 'null' => true],
			],
			'dn_repopgfragm_body' => [
				'dn_repopgfragm_body' => ['order' => 1, 'row_order' => 400, 'label_name' => 'Body', 'type' => 'text', 'null' => true, 'required' => true, 'percent' => 100, 'method' => 'wysiwyg'],
			],
			self::HIDDEN => [
				'dn_repopage_id' => ['order' => 3, 'label_name' => 'Page #', 'domain' => 'page_id', 'null' => true, 'method' => 'hidden', 'preserved' => true],
				'dn_repository_id' => ['order' => 4, 'label_name' => 'Repository', 'domain' => 'repository_id', 'null' => true, 'method' => 'hidden', 'preserved' => true],
				'dn_repository_version_id' => ['order' => 5, 'label_name' => 'Version', 'domain' => 'version_id', 'null' => true, 'method' => 'hidden', 'preserved' => true],
				'dn_repository_language_code' => ['order' => 6, 'label_name' => 'Language (View)', 'domain' => 'language_code', 'null' => true, 'method' => 'hidden', 'preserved' => true],
			]
		],
		'buttons' => [
			self::BUTTONS => [
				self::BUTTON_SUBMIT_SAVE => self::BUTTON_SUBMIT_SAVE_DATA,
			]
		]
	];
	public $collection = [
		'name' => 'Fragments',
		'model' => '\Numbers\Documentation\Documentation\Model\Repository\Version\Page\Fragments',
		'pk' => ['dn_repopgfragm_tenant_id', 'dn_repopgfragm_module_id', 'dn_repopgfragm_id'],
	];

	public function overrides(& $form) {
		$body = \Request::input('dn_repopgfragm_body', false);
		if (!empty($body)) {
			$form->values['dn_repopgfragm_body'] = $body;
		}
	}

	public function refresh(& $form) {
		if ($form->values['dn_repopgfragm_type_code'] == 'CODE') {
			$form->element('top', 'dn_repopgfragm_body', 'dn_repopgfragm_body', ['method' => 'textarea', 'rows' => 10]);
			if ($form->values['dn_repopgfragm_body'] == '<p>&nbsp;</p>') {
				$form->values['dn_repopgfragm_body'] = '';
			}
		}
		// preset order
		if (empty($form->values['dn_repopgfragm_id']) && empty($form->values['dn_repopgfragm_order'])) {
			$last_fragment = \Numbers\Documentation\Documentation\Model\Repository\Version\Page\Fragments::getStatic([
				'where' => [
					'dn_repopgfragm_module_id' => $form->values['__module_id'],
					'dn_repopgfragm_repopage_id' => $form->values['dn_repopage_id'],
				],
				'pk' => null,
				'single_row' => true,
				'limit' => 1,
				'columns' => ['dn_repopgfragm_order'],
				'orderby' => ['dn_repopgfragm_order' => SORT_DESC],
			]);
			if (!empty($last_fragment)) {
				$form->values['dn_repopgfragm_order'] = $last_fragment['dn_repopgfragm_order'] + 1000;
			} else {
				$form->values['dn_repopgfragm_order'] = 1000;
			}
		}
	}

	public function validate(& $form) {
		$repository = \Numbers\Documentation\Documentation\Model\Repositories::getStatic([
			'where' => [
				'dn_repository_module_id' => $form->values['__module_id'],
				'dn_repository_id' => $form->values['dn_repository_id'],
			],
			'single_row' => true,
			'pk' => null,
		]);
		// validate fields
		$form->values['dn_repopgfragm_language_code'] = $repository['dn_repository_default_language_code'];
		$form->values['dn_repopgfragm_repository_id'] = $form->values['dn_repository_id'];
		$form->values['dn_repopgfragm_version_id'] = $form->values['dn_repository_version_id'];
		$form->values['dn_repopgfragm_repopage_id'] = $form->values['dn_repopage_id'];
	}
}