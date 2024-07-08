<?php

namespace Numbers\Documentation\Documentation\Form\Repository\OpenBlog;
class Repositories extends \Object\Form\Wrapper\Base {
	public $form_link = 'dn_page_repositories';
	public $module_code = 'DN';
	public $title = 'D/N Page Repositories Form';
	public $options = [
		'actions' => [
			'refresh' => [
				'preserve_values' => ['dn_repository_version_id', 'dn_repository_language_code', 'dn_repopage_module_id', 'dn_repopage_id']
			],
		],
		'no_ajax_form_reload' => true,
		'skip_optimistic_lock' => true,
		'skip_acl' => true,
		'hide_module_id' => true
	];
	public $containers = [
		'top' => ['default_row_type' => 'grid', 'order' => 100],
	];
	public $rows = [];
	public $elements = [
		'top' => [
			'dn_repository_id' => [
				'dn_repository_id' => ['order' => 1, 'row_order' => 100, 'label_name' => 'Repository', 'domain' => 'repository_id', 'null' => true, 'required' => true, 'percent' => 40, 'method' => 'select', 'options_model' => '\Numbers\Documentation\Documentation\Model\Repositories::optionsActive', 'options_depends' => ['dn_repository_module_id' => 'dn_repository_module_id'], 'options_params' => ['dn_repository_type_id' => 30], 'track_previous_values' => true, 'onchange' => 'this.form.submit();', 'preserved' => true],
				'dn_repository_version_id' => ['order' => 2, 'label_name' => 'Version', 'domain' => 'version_id', 'null' => true, 'percent' => 30, 'method' => 'select', 'options_model' => '\Numbers\Documentation\Documentation\Model\Repository\Versions::optionsLatestActive', 'no_choose' => true, 'options_depends' => ['dn_repoversion_module_id' => 'dn_repository_module_id', 'dn_repoversion_repository_id' => 'dn_repository_id'], 'options_options' => ['i18n' => 'skip_sorting'], 'onchange' => 'this.form.submit();', 'preserved' => true],
				'dn_repository_language_code' => ['order' => 3, 'label_name' => 'Language', 'domain' => 'language_code', 'null' => true, 'method' => 'select', 'options_model' => '\Numbers\Documentation\Documentation\DataSource\Repository\Languages::optionsActive', 'no_choose' => true, 'options_depends' => ['dn_repolang_module_id' => 'dn_repository_module_id', 'dn_repolang_repository_id' => 'dn_repository_id'], 'onchange' => 'this.form.submit();', 'preserved' => true],
			],
			'full_text_search' => [
				'full_text_search' => ['order' => -200, 'row_order' => 200, 'label_name' => '', 'type' => 'text', 'null' => true, 'percent' => 100, 'placeholder' => 'Search', 'preserved' => true],
			],
			'buttons' => [
				self::BUTTON_SUBMIT_OTHER => ['order' => 1, 'row_order' => 300, 'type' => 'secondary'] + self::BUTTON_SUBMIT_OTHER_DATA + ['style' => 'width: 100%;'],
			],
			self::HIDDEN => [
				'dn_repopage_id' => ['label_name' => 'Page #', 'domain' => 'page_id', 'null' => true, 'method' => 'hidden', 'preserved' => true],
				'dn_repopage_module_id' => ['label_name' => 'Page Module #', 'domain' => 'module_id', 'null' => true, 'method' => 'hidden', 'preserved' => true],
				'__page_deleted' => ['label_name' => 'Page Deleted Flag', 'type' => 'boolean', 'null' => true, 'method' => 'hidden', 'preserved' => true],
			]
		],
	];
	public $collection = [
		'readonly' => true,
		'model' => '\Numbers\Documentation\Documentation\Model\Repositories'
	];

	public function overrides(& $form) {
		\Application::set('old.controller.class', get_class(\Application::$controller));
		$temp_reflection_obj = new \ReflectionClass(\Application::$controller);
		\Application::set('old.controller.dir', pathinfo($temp_reflection_obj->getFileName(), PATHINFO_DIRNAME) . '/');
		\Application::$controller = new \Object\Controller('\Numbers\Documentation\Documentation\Controller\Repository\Pages');
		// other logic
		if (empty($form->values['dn_repository_id'])) {
			$form->values['dn_repository_version_id'] = null;
			$form->values['dn_repository_language_code'] = null;
		}
		// onchange fields
		if (!empty($form->__options['input']['__form_onchange_field_values_key'])) {
			$__form_onchange_field_values_key = explode('[::]', $form->__options['input']['__form_onchange_field_values_key']);
		}
		// if we submit though URL.
		if (empty($__form_onchange_field_values_key[0]) && !empty($form->values['dn_repository_id'])) {
			if (empty($form->values['dn_repository_language_code'])) {
				$__form_onchange_field_values_key[0] = 'dn_repository_id';
			}
		}
		// changes in fields
		if (($__form_onchange_field_values_key[0] ?? '') == 'dn_repository_id' && !empty($form->values['dn_repository_id'])) {
			$temp = \Numbers\Documentation\Documentation\Model\Repositories::getStatic([
				'where' => [
					'dn_repository_module_id' => (int) $form->values['__module_id'],
					'dn_repository_id' => (int) $form->values['dn_repository_id']
				],
				'pk' => null,
				'single_row' => true,
			]);
			$form->values['dn_repository_version_id'] = $temp['dn_repository_latest_version_id'];
			$form->values['dn_repository_language_code'] = $temp['dn_repository_default_language_code'];
			$form->values['full_text_search'] = null;
		}
		// if any fields changed
		if (!empty($__form_onchange_field_values_key[0])) {
			// fetch first page
			$first_page = \Numbers\Documentation\Documentation\Model\Repository\Version\Pages::getStatic([
				'where' => [
					'dn_repopage_module_id' => (int) $form->values['__module_id'],
					'dn_repopage_repository_id' => (int) $form->values['dn_repository_id'],
					'dn_repopage_version_id' => $form->values['dn_repository_version_id'],
					'dn_repopage_parent_repopage_id' => null,
				],
				'columns' => ['dn_repopage_id'],
				'limit' => 1,
				'orderby' => ['dn_repopage_order' => SORT_ASC],
				'pk' => null,
				'single_row' => true,
			]);
			if (!empty($first_page['dn_repopage_id'])) {
				$form->values['dn_repopage_id'] = $first_page['dn_repopage_id'];
			} else {
				$form->values['dn_repopage_id'] = null;
			}
		}
	}

	public function refresh(& $form) {
		if (!empty($form->values['__page_deleted'])) {
			$form->error(SUCCESS, \Object\Content\Messages::RECORD_DELETED);
		}
		if (!empty($form->values['full_text_search']) && empty($form->values['dn_repository_id'])) {
			$form->error(DANGER, \Object\Content\Messages::REQUIRED_FIELD, 'dn_repository_id');
		}
	}
}