<?php

namespace Numbers\Documentation\Documentation\Form\Repository\Page;
class Repositories extends \Object\Form\Wrapper\Base {
	public $form_link = 'dn_page_repositories';
	public $module_code = 'DN';
	public $title = 'D/N Page Repositories Form';
	public $options = [
		'segment' => self::SEGMENT_FORM,
		'actions' => [
			'refresh' => true,
		],
		'no_ajax_form_reload' => true,
	];
	public $containers = [
		'top' => ['default_row_type' => 'grid', 'order' => 100],
	];
	public $rows = [];
	public $elements = [
		'top' => [
			'dn_repository_id' => [
				'__doc_repository_id' => ['order' => 1, 'row_order' => 100, 'label_name' => 'Repository', 'domain' => 'repository_id', 'null' => true, 'percent' => 40, 'method' => 'select', 'options_model' => '\Numbers\Documentation\Documentation\Model\Repositories::optionsActive', 'track_previous_values' => true, 'onchange' => 'this.form.submit();'],
				'__doc_version_id' => ['order' => 2, 'label_name' => 'Version', 'domain' => 'version_id', 'null' => true, 'percent' => 30, 'method' => 'select', 'options_model' => '\Numbers\Documentation\Documentation\Model\Repository\Versions::optionsActive', 'options_depends' => ['dn_repoversion_repository_id' => '__doc_repository_id'], 'onchange' => 'this.form.submit();'],
				'__doc_language_code' => ['order' => 3, 'label_name' => 'Language', 'domain' => 'language_code', 'null' => true, 'method' => 'select', 'options_model' => '\Numbers\Documentation\Documentation\DataSource\Repository\Languages::optionsActive', 'options_depends' => ['dn_repolang_repository_id' => '__doc_repository_id'], 'onchange' => 'this.form.submit();'],
			],
		],
	];

	public function refresh(& $form) {
		// when we change repository we need to reload version and language
		$prev__doc_repository_id = (int) $form->tracked_values['__doc_repository_id'] ?? 0;
		if ($prev__doc_repository_id != ($form->values['__doc_repository_id'] ?? 0)) {
			if (!empty($form->values['__doc_repository_id'])) {
				$temp = \Numbers\Documentation\Documentation\Model\Repositories::loadById($form->values['__doc_repository_id']);
				$form->values['__doc_version_id'] = $temp['dn_repository_latest_version_id'];
				$form->values['__doc_language_code'] = $temp['dn_repository_default_language_code'];
			} else {
				$form->values['__doc_version_id'] = null;
				$form->values['__doc_language_code'] = null;
			}
		}
	}
}