<?php

namespace Numbers\Documentation\Documentation\Form\Repository;
class NewVersion extends \Object\Form\Wrapper\Base {
	public $form_link = 'dn_repository_new_version_form';
	public $module_code = 'DN';
	public $title = 'D/N Repository New Version Form';
	public $options = [
		'segment' => [
			'type' => 'primary',
			'header' => [
				'icon' => ['type' => 'cubes'],
				'title' => 'Create new version:'
			]
		],
		'actions' => [
			'refresh' => true,
			'back' => true,
		],
		'no_ajax_form_reload' => true
	];
	public $containers = [
		'default' => ['default_row_type' => 'grid', 'order' => 1]
	];
	public $rows = [];
	public $elements = [
		'default' => [
			'dn_repoversion_repository_id' => [
				'dn_repoversion_repository_id' => ['order' => 1, 'row_order' => 100, 'label_name' => 'Repository', 'domain' => 'repository_id', 'null' => true, 'percent' => 100, 'required' => true, 'method' => 'select', 'options_model' => '\Numbers\Documentation\Documentation\Model\Repositories::optionsActive', 'onchange' => 'this.form.submit();'],
			],
			'dn_repoversion_version_id' => [
				'dn_repoversion_version_id' => ['order' => 1, 'row_order' => 200, 'label_name' => 'Existing Version', 'domain' => 'version_id', 'null' => true, 'percent' => 100, 'required' => 'c', 'method' => 'select', 'options_model' => '\Numbers\Documentation\Documentation\Model\Repository\Versions::optionsActive', 'options_depends' => ['dn_repoversion_repository_id' => 'dn_repoversion_repository_id']],
			],
			'dn_repoversion_version_name' => [
				'dn_repoversion_version_name' => ['order' => 1, 'row_order' => 300, 'label_name' => 'Version Name', 'domain' => 'name', 'null' => true, 'percent' => 100, 'required' => true],
			],
			self::BUTTONS => [
				self::BUTTON_SUBMIT => self::BUTTON_SUBMIT_DATA
			]
		]
	];

	public function save(& $form) {
		$model = new \Numbers\Documentation\Documentation\Model\Repository\Versions();
		// unset latest
		$model->queryBuilder()->update()
			->set(['dn_repoversion_latest' => 0])
			->where('AND', ['dn_repoversion_repository_id', '=', $form->values['dn_repoversion_repository_id']])
			->query();
		// generate new version
		$sequence = $model->softSequence('dn_repoversion_version_id', ['dn_repoversion_repository_id' => $form->values['dn_repoversion_repository_id']], ['dn_repoversion_repository_id']);
		$result = $model->collection()->merge([
			'dn_repoversion_repository_id' => $form->values['dn_repoversion_repository_id'],
			'dn_repoversion_version_id' => $sequence['next'],
			'dn_repoversion_version_name' => $form->values['dn_repoversion_version_name'],
			'dn_repoversion_latest' => 1,
			'dn_repoversion_inactive' => 0
		]);
		if ($result['success']) {
			$repositories_model = new \Numbers\Documentation\Documentation\Model\Repositories();
			$result = $repositories_model->collection()->merge([
				'dn_repository_id' => $form->values['dn_repoversion_repository_id'],
				'dn_repository_latest_version_id' => $sequence['next'],
			], [
				'skip_optimistic_lock' => true
			]);
		}
		// todo copy pages
		if ($result['success']) {
			$form->error('success', \Object\Content\Messages::OPERATION_EXECUTED);
			return true;
		} else {
			$form->error('danger', $result['error']);
			return false;
		}
	}
}