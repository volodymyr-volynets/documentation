<?php

namespace Numbers\Documentation\Documentation\Form\Repository\Page;
class SubflowFragmentTranslate extends \Object\Form\Wrapper\Base {
	public $form_link = 'dn_page_repository_fragment_translate';
	public $module_code = 'DN';
	public $title = 'D/N Page Subflow Fragment Translate Form';
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
			'dn_repofragtransl_repopgfragm_id' => [
				'dn_repofragtransl_repopgfragm_id' => ['order' => 1, 'row_order' => 100, 'label_name' => 'Fragment #', 'domain' => 'fragment_id', 'null' => true, 'readonly' => true, 'percent' => 95],
				'dn_repofragtransl_inactive' => ['order' => 2, 'label_name' => 'Inactive', 'type' => 'boolean', 'percent' => 5]
			],
			'dn_repofragtransl_language_code' => [
				'dn_repofragtransl_language_code' => ['order' => 1, 'row_order' => 200, 'label_name' => 'Language', 'domain' => 'language_code', 'null' => true, 'required' => true, 'method' => 'select', 'options_model' => '\Numbers\Documentation\Documentation\DataSource\Repository\PageLanguages::optionsActive', 'options_depends' => ['dn_repopage_module_id' => '__module_id', 'dn_repopage_id' => 'dn_repopage_id'], 'onchange' => 'this.form.submit();'],
			],
			'dn_repofragtransl_name' => [
				'dn_repofragtransl_name' => ['order' => 1, 'row_order' => 300, 'label_name' => 'Title', 'domain' => 'name', 'null' => true, 'required' => 'c'],
			],
			'dn_repofragtransl_body' => [
				'dn_repofragtransl_body' => ['order' => 1, 'row_order' => 400, 'label_name' => 'Body', 'type' => 'text', 'null' => true, 'required' => 'c', 'percent' => 100, 'method' => 'wysiwyg'],
			],
			self::HIDDEN => [
				'dn_repopage_id' => ['order' => 1, 'label_name' => 'Page #', 'domain' => 'page_id', 'null' => true, 'method' => 'hidden', 'preserved' => true],
				'dn_repofragtransl_type_code' => ['order' => 2, 'label_name' => 'Type', 'domain' => 'type_code', 'null' => true, 'method' => 'hidden', 'preserved' => true],
				// other
				'dn_repository_id' => ['order' => 4, 'label_name' => 'Repository', 'domain' => 'repository_id', 'null' => true, 'method' => 'hidden', 'preserved' => true],
				'dn_repository_version_id' => ['order' => 5, 'label_name' => 'Version', 'domain' => 'version_id', 'null' => true, 'method' => 'hidden', 'preserved' => true],
				'dn_repository_language_code' => ['order' => 6, 'label_name' => 'Language (View)', 'domain' => 'language_code', 'null' => true, 'method' => 'hidden', 'preserved' => true],
			]
		],
		'buttons' => [
			self::BUTTONS => [
				self::BUTTON_SUBMIT_SAVE => self::BUTTON_SUBMIT_SAVE_DATA,
				'__load_original' => ['order' => 200, 'button_group' => 'left', 'value' => 'Load Original Language', 'type' => 'success', 'method' => 'button2', 'icon' => 'far fa-file', 'accesskey' => 'a', 'process_refresh' => true],
				self::BUTTON_SUBMIT_DELETE => self::BUTTON_SUBMIT_DELETE_DATA,
			]
		]
	];
	public $collection = [
		'name' => 'Fragment Translations',
		'model' => '\Numbers\Documentation\Documentation\Model\Repository\Version\Page\Fragment\Translations',
		'pk' => ['dn_repofragtransl_tenant_id', 'dn_repofragtransl_module_id', 'dn_repofragtransl_repopgfragm_id', 'dn_repofragtransl_language_code'],
	];

	public function overrides(& $form) {
		$form->values['dn_repofragtransl_body'] = \Request::input('dn_repofragtransl_body', false);
	}

	public function refresh(& $form) {
		// load original language
		if (!empty($form->values['__load_original'])) {
			$fragment = \Numbers\Documentation\Documentation\Model\Repository\Version\Page\Fragments::getStatic([
				'where' => [
					'dn_repopgfragm_module_id' => $form->values['dn_repofragtransl_module_id'],
					'dn_repopgfragm_id' => $form->values['dn_repofragtransl_repopgfragm_id'],
				],
				'single_row' => true,
				'pk' => null,
			]);
			if (!empty($fragment)) {
				$form->values['dn_repofragtransl_name'] = $fragment['dn_repopgfragm_name'];
				$form->values['dn_repofragtransl_body'] = $fragment['dn_repopgfragm_body'];
			}
		}
		// code type
		if (($form->values['dn_repofragtransl_type_code'] ?? '') == 'CODE') {
			$form->element('top', 'dn_repofragtransl_body', 'dn_repofragtransl_body', ['method' => 'textarea', 'rows' => 10]);
			if ($form->values['dn_repofragtransl_body'] == '<p>&nbsp;</p>') {
				$form->values['dn_repofragtransl_body'] = '';
			}
		}
		// if we changed parent
		if (!empty($form->misc_settings['__form_onchange_field_values_key'][0])) {
			if ($form->misc_settings['__form_onchange_field_values_key'][0] == 'dn_repofragtransl_language_code') {
				$translation = \Numbers\Documentation\Documentation\Model\Repository\Version\Page\Fragment\Translations::getStatic([
					'where' => [
						'dn_repofragtransl_module_id' => $form->values['dn_repofragtransl_module_id'],
						'dn_repofragtransl_repopgfragm_id' => $form->values['dn_repofragtransl_repopgfragm_id'],
						'dn_repofragtransl_language_code' => $form->values['dn_repofragtransl_language_code'],
					],
					'single_row' => true,
					'pk' => null,
				]);
				if (!empty($translation)) {
					$form->values['dn_repofragtransl_name'] = $translation['dn_repofragtransl_name'];
					$form->values['dn_repofragtransl_body'] = $translation['dn_repofragtransl_body'];
					$form->values['dn_repofragtransl_inactive'] = $translation['dn_repofragtransl_inactive'];
				} else {
					$form->values['dn_repofragtransl_name'] = null;
					$form->values['dn_repofragtransl_body'] = null;
					$form->values['dn_repofragtransl_inactive'] = 0;
				}
			}
		}
	}

	public function validate(& $form) {
		$form->values['dn_repofragtransl_repository_id'] = $form->values['dn_repository_id'];
		$form->values['dn_repofragtransl_version_id'] = $form->values['dn_repository_version_id'];
		$form->values['dn_repofragtransl_repopage_id'] = $form->values['dn_repopage_id'];
		// either title or body
		if (empty($form->values['dn_repofragtransl_name']) && empty($form->values['dn_repofragtransl_body'])) {
			$form->error(DANGER, \Object\Content\Messages::OPTIONALLY_REQUIRED_FIELD, 'dn_repofragtransl_name');
			$form->error(DANGER, \Object\Content\Messages::OPTIONALLY_REQUIRED_FIELD, 'dn_repofragtransl_body');
		}
		// keywords
		if (isset($form->values['dn_repofragtransl_body'])) {
			$form->values['dn_repofragtransl_keywords'] = sanitize_string_tags($form->values['dn_repofragtransl_body'], 'all', ['remove_white_spaces' => true]);
		} else {
			$form->values['dn_repofragtransl_keywords'] = null;
		}
	}
}