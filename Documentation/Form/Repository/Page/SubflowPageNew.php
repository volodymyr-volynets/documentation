<?php

namespace Numbers\Documentation\Documentation\Form\Repository\Page;
class SubflowPageNew extends \Object\Form\Wrapper\Base {
	public $form_link = 'dn_page_repository_page_new';
	public $module_code = 'DN';
	public $title = 'D/N Page Subflow New Page Form';
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
			'dn_repopage_id' => [
				'dn_repopage_id' => ['order' => 1, 'row_order' => 100, 'label_name' => 'Page #', 'domain' => 'page_id_sequence', 'null' => true, 'readonly' => true, 'percent' => 95],
				'dn_repopage_inactive' => ['order' => 2, 'label_name' => 'Inactive', 'type' => 'boolean', 'percent' => 5]
			],
			'dn_repopage_parent_repopage_id' => [
				'dn_repopage_parent_repopage_id' => ['order' => 1, 'row_order' => 200, 'label_name' => 'Parent Page', 'domain' => 'page_id', 'null' => true, 'method' => 'select', 'tree' => true, 'searchable' => true, 'options_model' => '\Numbers\Documentation\Documentation\Model\Repository\Version\Pages::optionsGrouppedTree', 'options_depends' => ['dn_repopage_module_id' => '__module_id', 'dn_repopage_repository_id' => 'dn_repository_id', 'dn_repopage_version_id' => 'dn_repository_version_id'], 'options_options' => ['i18n' => 'skip_sorting'], 'onchange' => 'this.form.submit();'],
			],
			'dn_repopage_order' => [
				'dn_repopage_order' => ['order' => 1, 'row_order' => 300, 'label_name' => 'Order', 'domain' => 'big_order', 'null' => true, 'required' => true],
				'dn_repopage_title_number' => ['order' => 2, 'label_name' => 'Title Number', 'domain' => 'title_number', 'null' => true, 'required' => 'c'],
			],
			'dn_repopage_name' => [
				'dn_repopage_name' => ['order' => 1, 'row_order' => 400, 'label_name' => 'Title', 'domain' => 'name', 'null' => true, 'required' => true],
			],
			'dn_repopage_toc_name' => [
				'dn_repopage_toc_name' => ['order' => 1, 'row_order' => 500, 'label_name' => 'Title (Table of Contents)', 'domain' => 'name', 'null' => true, 'percent' => 50],
				'dn_repopage_icon' => ['order' => 2, 'label_name' => 'Icon', 'domain' => 'icon', 'null' => true, 'percent' => 50, 'method' => 'select', 'options_model' => '\Numbers\Frontend\HTML\FontAwesome\Model\Icons::options', 'searchable' => true],
			],
			self::HIDDEN => [
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
		'name' => 'Pages',
		'model' => '\Numbers\Documentation\Documentation\Model\Repository\Version\Pages',
		'pk' => ['dn_repopage_tenant_id', 'dn_repopage_module_id', 'dn_repopage_id'],
	];

	public function refresh(& $form) {
		// if we changed parent
		if (!empty($form->misc_settings['__form_onchange_field_values_key'][0])) {
			if ($form->misc_settings['__form_onchange_field_values_key'][0] == 'dn_repopage_parent_repopage_id') {
				$last_order = \Numbers\Documentation\Documentation\Model\Repository\Version\Pages::getStatic([
					'where' => [
						'dn_repopage_module_id' => $form->values['__module_id'],
						'dn_repopage_parent_repopage_id' => $form->values['dn_repopage_parent_repopage_id'],
					],
					'columns' => ['dn_repopage_order', 'dn_repopage_title_number'],
					'single_row' => true,
					'pk' => null,
					'limit' => 1,
					'orderby' => ['dn_repopage_order' => SORT_DESC]
				]);
				if (!empty($last_order['dn_repopage_order'])) {
					$form->values['dn_repopage_order'] = $last_order['dn_repopage_order'] + 1000;
				} else {
					$form->values['dn_repopage_order'] = 1000;
				}
				if (!empty($last_order['dn_repopage_title_number'])) {
					$form->error(SUCCESS, \Numbers\Documentation\Documentation\Helper\Messages::LAST_TITLE_NUMBER, 'dn_repopage_title_number', ['replace' => ['[number]' => \Format::id($last_order['dn_repopage_title_number'])]]);
				}
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
		$form->values['dn_repopage_language_code'] = $repository['dn_repository_default_language_code'];
		$form->values['dn_repopage_repository_id'] = $form->values['dn_repository_id'];
		$form->values['dn_repopage_version_id'] = $form->values['dn_repository_version_id'];
		// numbering required
		if (!empty($repository['dn_repository_title_numbering'])) {
			if (empty($form->values['dn_repopage_title_number'])) {
				$form->error(DANGER, \Object\Content\Messages::REQUIRED_FIELD, 'dn_repopage_title_number');
			}
		}
	}
}