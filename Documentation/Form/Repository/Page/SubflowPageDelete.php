<?php

namespace Numbers\Documentation\Documentation\Form\Repository\Page;
class SubflowPageDelete extends \Object\Form\Wrapper\Base {
	public $form_link = 'dn_page_repository_page_delete';
	public $module_code = 'DN';
	public $title = 'D/N Page Subflow Delete Page Form';
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
				'dn_repopage_id' => ['order' => 1, 'row_order' => 100, 'label_name' => 'Page #', 'domain' => 'page_id_sequence', 'null' => true, 'readonly' => true, 'percent' => 100, 'preserved' => true],
			],
			self::HIDDEN => [
				'dn_repository_id' => ['order' => 4, 'label_name' => 'Repository', 'domain' => 'repository_id', 'null' => true, 'method' => 'hidden', 'preserved' => true],
				'dn_repository_version_id' => ['order' => 5, 'label_name' => 'Version', 'domain' => 'version_id', 'null' => true, 'method' => 'hidden', 'preserved' => true],
				'dn_repository_language_code' => ['order' => 6, 'label_name' => 'Language (View)', 'domain' => 'language_code', 'null' => true, 'method' => 'hidden', 'preserved' => true],
			]
		],
		'buttons' => [
			self::BUTTONS => [
				self::BUTTON_SUBMIT_SAVE => self::BUTTON_SUBMIT_DELETE_DATA,
			]
		]
	];
	public $collection = [
		'name' => 'Pages',
		'model' => '\Numbers\Documentation\Documentation\Model\Repository\Version\Pages',
		'pk' => ['dn_repopage_tenant_id', 'dn_repopage_module_id', 'dn_repopage_id'],
		'readonly' => true,
		'skip_transaction' => true,
	];

	public function validate(& $form) {
		$model = new \Numbers\Documentation\Documentation\Model\Repository\Version\Pages();
		$model->db_object->begin();
		$child_pages = \Numbers\Documentation\Documentation\DataSource\Repository\PageChildPages::getStatic([
			'where' => [
				'dn_repopage_module_id' => $form->values['__module_id'],
				'dn_repopage_id' => $form->values['dn_repopage_id'],
				'dn_repopage_language_code' => $form->values['dn_repository_language_code'],
				'skip_ordering' => true,
			]
		]);
		$child_pages = array_keys(array_reverse($child_pages, true));
		$result = \Numbers\Documentation\Documentation\Model\Repository\Version\Page\Translations::queryBuilderStatic()
			->delete()
			->where('AND', ['dn_repopgtransl_module_id', '=', $form->values['__module_id']])
			->where('AND', ['dn_repopgtransl_repopage_id', '=', $child_pages])
			->query();
		if (!$result['success']) {
			$form->error(DANGER, $result['error']);
			$model->db_object->rollback();
			return;
		}
		$result = \Numbers\Documentation\Documentation\Model\Repository\Version\Page\Fragment\Translations::queryBuilderStatic()
			->delete()
			->where('AND', ['dn_repofragtransl_module_id', '=', $form->values['__module_id']])
			->where('AND', ['dn_repofragtransl_repopage_id', '=', $child_pages])
			->query();
		if (!$result['success']) {
			$form->error(DANGER, $result['error']);
			$model->db_object->rollback();
			return;
		}
		$result = \Numbers\Documentation\Documentation\Model\Repository\Version\Page\Fragments::queryBuilderStatic()
			->delete()
			->where('AND', ['dn_repopgfragm_module_id', '=', $form->values['__module_id']])
			->where('AND', ['dn_repopgfragm_repopage_id', '=', $child_pages])
			->query();
		if (!$result['success']) {
			$form->error(DANGER, $result['error']);
			$model->db_object->rollback();
			return;
		}
		$result = \Numbers\Documentation\Documentation\Model\Repository\Version\Pages::queryBuilderStatic()
			->delete()
			->where('AND', ['dn_repopage_module_id', '=', $form->values['__module_id']])
			->where('AND', ['dn_repopage_id', '=', $child_pages])
			->query();
		if (!$result['success']) {
			$form->error(DANGER, $result['error']);
			$model->db_object->rollback();
			return;
		}
		$form->error(SUCCESS, \Object\Content\Messages::OPERATION_EXECUTED);
		$model->db_object->commit();
	}

	public function post(& $form) {
		$href = \Request::buildURL(\Application::get('mvc.controller') . '/_Edit', [
			'dn_repository_module_id' => $form->values['__module_id'],
			'__module_id' => $form->values['__module_id'],
			'dn_repository_id' => $form->values['dn_repository_id'],
			'dn_repository_version_id' => $form->values['dn_repository_version_id'],
			'dn_repository_language_code' => $form->values['dn_repository_language_code'],
			'__page_deleted' => true,
		]);
		$form->redirect($href);
	}
}