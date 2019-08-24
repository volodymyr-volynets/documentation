<?php

namespace Numbers\Documentation\Documentation\Form\Repository\Page;
class SubflowFragmentFileTranslate extends \Object\Form\Wrapper\Base {
	public $form_link = 'dn_page_repository_fragment_file_translate';
	public $module_code = 'DN';
	public $title = 'D/N Page Subflow Fragment File Translate Form';
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
				'dn_repofragtransl_name' => ['order' => 1, 'row_order' => 300, 'label_name' => 'Title', 'domain' => 'name', 'null' => true],
			],
			'dn_repofragtransl_file_1_new' => [
				'dn_repofragtransl_file_1_new' => ['order' => 1, 'row_order' => 400, 'label_name' => 'File(s)', 'type' => 'mixed', 'percent' => 100, 'method' => 'file', 'null' => true, 'required' => true, 'multiple' => true, 'validator_method' => '\Numbers\Users\Documents\Base\Validator\Files::validate', 'validator_params' => ['types' => ['images', 'audio', 'documents']]],
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
			]
		]
	];
	public $collection = [
		'name' => 'Fragment Translations',
		'model' => '\Numbers\Documentation\Documentation\Model\Repository\Version\Page\Fragment\Translations',
		'pk' => ['dn_repofragtransl_tenant_id', 'dn_repofragtransl_module_id', 'dn_repofragtransl_repopgfragm_id', 'dn_repofragtransl_language_code'],
	];

	public function refresh(& $form) {
		if ($form->values['dn_repofragtransl_type_code'] == 'IMAGE') {
			$form->element('top', 'dn_repofragtransl_file_1_new', 'dn_repofragtransl_file_1_new', [
				'validator_params' => ['types' => ['images']],
				'description' => implode(', ', \Numbers\Users\Documents\Base\Helper\Validate::$validation_extensions['images']),
			]);
		} else {
			$form->element('top', 'dn_repofragtransl_file_1_new', 'dn_repofragtransl_file_1_new', [
				'description' => implode(', ', array_merge(\Numbers\Users\Documents\Base\Helper\Validate::$validation_extensions['images'], \Numbers\Users\Documents\Base\Helper\Validate::$validation_extensions['audio'], \Numbers\Users\Documents\Base\Helper\Validate::$validation_extensions['documents'])),
			]);
		}
	}

	public function validate(& $form) {
		$form->values['dn_repofragtransl_repository_id'] = $form->values['dn_repository_id'];
		$form->values['dn_repofragtransl_version_id'] = $form->values['dn_repository_version_id'];
		$form->values['dn_repofragtransl_repopage_id'] = $form->values['dn_repopage_id'];
		// add files
		if (!empty($form->values['dn_repofragtransl_file_1_new'])) {
			$repository = \Numbers\Documentation\Documentation\Model\Repositories::getStatic([
				'where' => [
					'dn_repository_module_id' => $form->values['__module_id'],
					'dn_repository_id' => $form->values['dn_repository_id'],
				],
				'single_row' => true,
				'pk' => null,
			]);
			\Numbers\Users\Documents\Base\Helper\MassUpload::uploadFewFilesInForm(
				$form,
				10,
				$form->values['dn_repofragtransl_file_1_new'],
				'dn_repofragtransl_file_',
				$form->fields['dn_repofragtransl_file_1_new']['options']['validator_params'] ?? [],
				$repository['dn_repository_catalog_code']
			);
		}
	}
}