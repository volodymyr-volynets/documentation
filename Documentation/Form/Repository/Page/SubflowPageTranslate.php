<?php

namespace Numbers\Documentation\Documentation\Form\Repository\Page;
class SubflowPageTranslate extends \Object\Form\Wrapper\Base {
	public $form_link = 'dn_page_repository_page_translate';
	public $module_code = 'DN';
	public $title = 'D/N Page Subflow Page Translate Form';
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
			'dn_repopgtransl_repopage_id' => [
				'dn_repopgtransl_repopage_id' => ['order' => 1, 'row_order' => 100, 'label_name' => 'Page #', 'domain' => 'page_id', 'null' => true, 'readonly' => true, 'percent' => 95],
				'dn_repopgtransl_inactive' => ['order' => 2, 'label_name' => 'Inactive', 'type' => 'boolean', 'percent' => 5]
			],
			'dn_repopgtransl_language_code' => [
				'dn_repopgtransl_language_code' => ['order' => 1, 'row_order' => 200, 'label_name' => 'Language', 'domain' => 'language_code', 'null' => true, 'required' => true, 'method' => 'select', 'options_model' => '\Numbers\Documentation\Documentation\DataSource\Repository\PageLanguages::optionsActive', 'options_depends' => ['dn_repopage_module_id' => '__module_id', 'dn_repopage_id' => 'dn_repopgtransl_repopage_id'], 'onchange' => 'this.form.submit();'],
			],
			'dn_repopgtransl_name' => [
				'dn_repopgtransl_name' => ['order' => 1, 'row_order' => 300, 'label_name' => 'Name', 'domain' => 'name', 'null' => true, 'required' => true],
			],
			'dn_repopgtransl_toc_name' => [
				'dn_repopgtransl_toc_name' => ['order' => 1, 'row_order' => 400, 'label_name' => 'Name (Table of Contents)', 'domain' => 'name', 'null' => true],
			],
			self::HIDDEN => [
				'dn_repopage_id' => ['order' => 1, 'row_order' => 100, 'label_name' => 'Page #', 'domain' => 'page_id', 'null' => true, 'method' => 'hidden', 'preserved' => true],
				// other
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
		'name' => 'Page Translations',
		'model' => '\Numbers\Documentation\Documentation\Model\Repository\Version\Page\Translations',
		'pk' => ['dn_repopgtransl_tenant_id', 'dn_repopgtransl_module_id', 'dn_repopgtransl_repopage_id', 'dn_repopgtransl_language_code'],
	];

	public function overrides(& $form) {
		if (empty($form->values['dn_repopgtransl_repopage_id']) && !empty($form->values['dn_repopage_id'])) {
			$form->values['dn_repopgtransl_repopage_id'] = $form->values['dn_repopage_id'];
		}
	}

	public function refresh(& $form) {
		// if we changed parent
		if (!empty($form->misc_settings['__form_onchange_field_values_key'][0])) {
			if ($form->misc_settings['__form_onchange_field_values_key'][0] == 'dn_repopgtransl_language_code') {
				$translation = \Numbers\Documentation\Documentation\Model\Repository\Version\Page\Translations::getStatic([
					'where' => [
						'dn_repopgtransl_module_id' => $form->values['dn_repopgtransl_module_id'],
						'dn_repopgtransl_repopage_id' => $form->values['dn_repopgtransl_repopage_id'],
						'dn_repopgtransl_language_code' => $form->values['dn_repopgtransl_language_code'],
					],
					'single_row' => true,
					'pk' => null,
				]);
				if (!empty($translation)) {
					$form->values['dn_repopgtransl_name'] = $translation['dn_repopgtransl_name'];
					$form->values['dn_repopgtransl_toc_name'] = $translation['dn_repopgtransl_toc_name'];
					$form->values['dn_repopgtransl_inactive'] = $translation['dn_repopgtransl_inactive'];
				} else {
					$form->values['dn_repopgtransl_name'] = null;
					$form->values['dn_repopgtransl_toc_name'] = null;
					$form->values['dn_repopgtransl_inactive'] = 0;
				}
			}
		}
	}

	public function validate(& $form) {
		$form->values['dn_repopgtransl_repository_id'] = $form->values['dn_repository_id'];
		$form->values['dn_repopgtransl_version_id'] = $form->values['dn_repository_version_id'];
	}
}