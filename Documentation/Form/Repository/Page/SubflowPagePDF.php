<?php

namespace Numbers\Documentation\Documentation\Form\Repository\Page;
class SubflowPagePDF extends \Object\Form\Wrapper\Base {
	public $form_link = 'dn_page_repository_page_pdf';
	public $module_code = 'DN';
	public $title = 'D/N Page Subflow PDF Page Form';
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
			'dn_repopage_parent_repopage_id' => [
				'dn_repopage_parent_repopage_id' => ['order' => 1, 'row_order' => 200, 'label_name' => 'Start From Page', 'domain' => 'page_id', 'null' => true, 'method' => 'select', 'tree' => true, 'searchable' => true, 'options_model' => '\Numbers\Documentation\Documentation\Model\Repository\Version\Pages::optionsGrouppedTree', 'options_depends' => ['dn_repopage_module_id' => '__module_id', 'dn_repopage_repository_id' => 'dn_repository_id', 'dn_repopage_version_id' => 'dn_repository_version_id'], 'options_options' => ['i18n' => 'skip_sorting'], 'onchange' => 'this.form.submit();'],
			],
			self::HIDDEN => [
				'dn_repository_id' => ['order' => 4, 'label_name' => 'Repository', 'domain' => 'repository_id', 'null' => true, 'method' => 'hidden', 'preserved' => true],
				'dn_repository_version_id' => ['order' => 5, 'label_name' => 'Version', 'domain' => 'version_id', 'null' => true, 'method' => 'hidden', 'preserved' => true],
				'dn_repository_language_code' => ['order' => 6, 'label_name' => 'Language (View)', 'domain' => 'language_code', 'null' => true, 'method' => 'hidden', 'preserved' => true],
			]
		],
		'buttons' => [
			self::BUTTONS => [
				self::BUTTON_SUBMIT => self::BUTTON_PRINT_DATA,
			]
		]
	];
	public $collection = [
		'name' => 'Pages',
		'model' => '\Numbers\Documentation\Documentation\Model\Repository\Version\Pages',
		'pk' => ['dn_repopage_tenant_id', 'dn_repopage_module_id', 'dn_repopage_id'],
		'readonly' => true,
	];

	public function validate(& $form) {
		$repository = \Numbers\Documentation\Documentation\Model\Repositories::getStatic([
			'where' => [
				'dn_repository_module_id' => $form->values['__module_id'],
				'dn_repository_id' => $form->values['dn_repository_id'],
			],
			'single_row' => true,
			'pk' => null,
		]);
		$hash = \Request::hash([
			$form->values['__module_id'],
			$form->values['dn_repository_id'],
			$form->values['dn_repository_version_id'],
			$form->values['dn_repository_language_code'],
			$form->values['dn_repopage_parent_repopage_id'],
		]);
		$filename = urldecode($repository['dn_repository_name']) . '.pdf';
		$crypt = new \Crypt();
		$href = \Request::buildURL(\Application::get('mvc.controller') . '/_PDF/' . $filename, ['token' => urldecode($crypt->tokenCreate($hash, 'print.pdf'))], \Request::host(), 'page_title');
		$form->redirect($href);
	}
}