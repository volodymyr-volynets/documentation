<?php

namespace Numbers\Documentation\Documentator\Form;
class ImportSchema extends \Object\Form\Wrapper\Base {
	public $form_link = 'dn_import_schema';
	public $module_code = 'DN';
	public $title = 'D/N Import Schema Form';
	public $options = [
		'segment' => self::SEGMENT_FORM,
		'actions' => [
			'refresh' => true,
		],
		'no_ajax_form_reload' => true,
		'skip_optimistic_lock' => true,
	];
	public $containers = [
		'top' => ['default_row_type' => 'grid', 'order' => 100],
	];
	public $rows = [];
	public $elements = [
		'top' => [
			'dn_repository_id' => [
				'dn_repository_id' => ['order' => 1, 'row_order' => 100, 'label_name' => 'Repository', 'domain' => 'repository_id', 'null' => true, 'percent' => 40, 'method' => 'select', 'options_model' => '\Numbers\Documentation\Documentation\Model\Repositories::optionsActive', 'options_depends' => ['dn_repository_module_id' => 'dn_repository_module_id'], 'track_previous_values' => true, 'onchange' => 'this.form.submit();', 'preserved' => true],
				'dn_repository_version_id' => ['order' => 2, 'label_name' => 'Version', 'domain' => 'version_id', 'null' => true, 'percent' => 30, 'method' => 'select', 'options_model' => '\Numbers\Documentation\Documentation\Model\Repository\Versions::optionsLatestActive', 'no_choose' => true, 'options_depends' => ['dn_repoversion_module_id' => 'dn_repository_module_id', 'dn_repoversion_repository_id' => 'dn_repository_id'], 'options_options' => ['i18n' => 'skip_sorting'], 'onchange' => 'this.form.submit();', 'preserved' => true],
				'dn_repository_language_code' => ['order' => 3, 'label_name' => 'Language', 'domain' => 'language_code', 'null' => true, 'method' => 'select', 'options_model' => '\Numbers\Documentation\Documentation\DataSource\Repository\Languages::optionsActive', 'no_choose' => true, 'options_depends' => ['dn_repolang_module_id' => 'dn_repository_module_id', 'dn_repolang_repository_id' => 'dn_repository_id'], 'onchange' => 'this.form.submit();', 'preserved' => true],
			],
			self::BUTTONS => [
				self::BUTTON_SUBMIT => self::BUTTON_SUBMIT_DATA,
			]
		],
	];
	public $collection = [
		'readonly' => true,
		'model' => '\Numbers\Documentation\Documentation\Model\Repositories',
		'skip_transaction' => true,
	];

	public function overrides(& $form) {
		if (empty($form->values['dn_repository_id'])) {
			$form->values['dn_repository_version_id'] = null;
			$form->values['dn_repository_language_code'] = null;
		}
		// onchange fields
		if (!empty($form->__options['input']['__form_onchange_field_values_key'])) {
			$__form_onchange_field_values_key = explode('[::]', $form->__options['input']['__form_onchange_field_values_key']);
		}
		// changes in fields
		if (($__form_onchange_field_values_key[0] ?? '') == 'dn_repository_id') {
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
		}
	}

	public function validate(& $form) {
		$model = \Numbers\Documentation\Documentation\Form\Repository\Page\SubflowPageNew::API();
		$fragment_model = \Numbers\Documentation\Documentation\Form\Repository\Page\SubflowFragmentNew::API();
		// add your code here
		$schema_generator_object = new \Numbers\Documentation\Documentator\Helper\Schema();
		$schema_generator_object->loadAllDependencies();
		// main parent holder
		$page = \Numbers\Documentation\Documentation\Helper\Pages::fetchOnePage((int) $form->values['__module_id'], (int) $form->values['dn_repository_id'], (int) $form->values['dn_repository_version_id'], $form->values['dn_repository_language_code'], 'Database Schema');
		if (empty($page)) {
			$result = $model->save([
				'dn_repopage_module_id' => $form->values['__module_id'],
				'dn_repopage_id' => null,
				'dn_repopage_inactive' => 0,
				'dn_repopage_parent_repopage_id' => null,
				'dn_repopage_order' => 100000,
				'dn_repopage_title_number' => null,
				'dn_repopage_name' => 'Database Schema',
				'dn_repopage_toc_name' => null,
				'dn_repopage_icon' => 'fas fa-database',
				'dn_repository_id' => $form->values['dn_repository_id'],
				'dn_repository_version_id' => $form->values['dn_repository_version_id'],
				'dn_repository_language_code' => $form->values['dn_repository_language_code'],
			]);
			if (!$result['success']) {
				$form->error(DANGER, $result['error']);
				return;
			}
			$master_parent_id = $result['pk']['dn_repopage_id'];
		} else {
			$master_parent_id = $page['dn_repopage_id'];
		}
		// import all pages
		foreach ($schema_generator_object->generateDocumentationArray() as $k => $v) {
			$page = \Numbers\Documentation\Documentation\Helper\Pages::fetchOnePage((int) $form->values['__module_id'], (int) $form->values['dn_repository_id'], (int) $form->values['dn_repository_version_id'], $form->values['dn_repository_language_code'], $v['dn_repopage_name'], $master_parent_id);
			if (empty($page)) {
				$result = $model->save([
					'dn_repopage_module_id' => $form->values['__module_id'],
					'dn_repopage_id' => null,
					'dn_repopage_inactive' => 0,
					'dn_repopage_parent_repopage_id' => $master_parent_id,
					'dn_repopage_order' => $v['dn_repopage_order'],
					'dn_repopage_title_number' => null,
					'dn_repopage_name' => $v['dn_repopage_name'],
					'dn_repopage_toc_name' => $v['dn_repopage_toc_name'],
					'dn_repopage_icon' => $v['dn_repopage_icon'],
					'dn_repository_id' => $form->values['dn_repository_id'],
					'dn_repository_version_id' => $form->values['dn_repository_version_id'],
					'dn_repository_language_code' => $form->values['dn_repository_language_code'],
				]);
				if (!$result['success']) {
					$form->error(DANGER, $result['error']);
					return;
				}
				$parent_id = $result['pk']['dn_repopage_id'];
			} else {
				$parent_id = $page['dn_repopage_id'];
			}
			if (!empty($v['options'])) {
				foreach ($v['options'] as $k2 => $v2) {
					$page = \Numbers\Documentation\Documentation\Helper\Pages::fetchOnePage((int) $form->values['__module_id'], (int) $form->values['dn_repository_id'], (int) $form->values['dn_repository_version_id'], $form->values['dn_repository_language_code'], $v2['dn_repopage_name'], $master_parent_id);
					if (empty($page)) {
						$result = $model->save([
							'dn_repopage_module_id' => $form->values['__module_id'],
							'dn_repopage_id' => null,
							'dn_repopage_inactive' => 0,
							'dn_repopage_parent_repopage_id' => $parent_id,
							'dn_repopage_order' => $v2['dn_repopage_order'],
							'dn_repopage_title_number' => null,
							'dn_repopage_name' => $v2['dn_repopage_name'],
							'dn_repopage_toc_name' => $v2['dn_repopage_toc_name'],
							'dn_repopage_icon' => $v2['dn_repopage_icon'],
							'dn_repository_id' => $form->values['dn_repository_id'],
							'dn_repository_version_id' => $form->values['dn_repository_version_id'],
							'dn_repository_language_code' => $form->values['dn_repository_language_code'],
						]);
						if (!$result['success']) {
							$form->error(DANGER, $result['error']);
							return;
						}
						$parent_id2 = $result['pk']['dn_repopage_id'];
					} else {
						$parent_id2 = $page['dn_repopage_id'];
					}
					if (!empty($v2['options'])) {
						foreach ($v2['options'] as $k3 => $v3) {
							$page = \Numbers\Documentation\Documentation\Helper\Pages::fetchOnePage((int) $form->values['__module_id'], (int) $form->values['dn_repository_id'], (int) $form->values['dn_repository_version_id'], $form->values['dn_repository_language_code'], $v3['dn_repopage_name'], $master_parent_id);
							if (empty($page)) {
								$result = $model->save([
									'dn_repopage_module_id' => $form->values['__module_id'],
									'dn_repopage_id' => null,
									'dn_repopage_inactive' => 0,
									'dn_repopage_parent_repopage_id' => $parent_id2,
									'dn_repopage_order' => $v3['dn_repopage_order'],
									'dn_repopage_title_number' => null,
									'dn_repopage_name' => $v3['dn_repopage_name'],
									'dn_repopage_toc_name' => $v3['dn_repopage_toc_name'],
									'dn_repopage_icon' => $v3['dn_repopage_icon'],
									'dn_repository_id' => $form->values['dn_repository_id'],
									'dn_repository_version_id' => $form->values['dn_repository_version_id'],
									'dn_repository_language_code' => $form->values['dn_repository_language_code'],
								]);
								if (!$result['success']) {
									$form->error(DANGER, $result['error']);
									return;
								}
								$parent_id3 = $result['pk']['dn_repopage_id'];
							} else {
								$parent_id3 = $page['dn_repopage_id'];
							}
							// fragments
							if (!empty($v3['fragments'])) {
								foreach ($v3['fragments'] as $k4 => $v4) {
									$fragment = \Numbers\Documentation\Documentation\Helper\Pages::fragmentExistsByOrder((int) $form->values['__module_id'], $parent_id3, $v4['dn_repopgfragm_order']);
									$result = $fragment_model->save([
										'dn_repopgfragm_module_id' => $form->values['__module_id'],
										'dn_repopgfragm_id' => $fragment['dn_repopgfragm_id'] ?? null,
										'dn_repopgfragm_inactive' => 0,
										'dn_repopgfragm_order' => $v4['dn_repopgfragm_order'],
										'dn_repopgfragm_type_code' => $v4['dn_repopgfragm_type_code'],
										'dn_repopgfragm_name' => $v4['dn_repopgfragm_name'],
										'dn_repopgfragm_body' => $v4['dn_repopgfragm_body'],
										'dn_repopage_id' => $parent_id3,
										'dn_repository_id' => $form->values['dn_repository_id'],
										'dn_repository_version_id' => $form->values['dn_repository_version_id'],
										'dn_repository_language_code' => $form->values['dn_repository_language_code'],
									]);
									if (!$result['success']) {
										$form->error(DANGER, $result['error']);
										return;
									}
								}
							}
							// child pages
							if (!empty($v3['options'])) {
								foreach ($v3['options'] as $k4 => $v4) {
									$page = \Numbers\Documentation\Documentation\Helper\Pages::fetchOnePage((int) $form->values['__module_id'], (int) $form->values['dn_repository_id'], (int) $form->values['dn_repository_version_id'], $form->values['dn_repository_language_code'], $v4['dn_repopage_name'], $master_parent_id);
									if (empty($page)) {
										$result = $model->save([
											'dn_repopage_module_id' => $form->values['__module_id'],
											'dn_repopage_id' => null,
											'dn_repopage_inactive' => 0,
											'dn_repopage_parent_repopage_id' => $parent_id3,
											'dn_repopage_order' => $v4['dn_repopage_order'],
											'dn_repopage_title_number' => null,
											'dn_repopage_name' => $v4['dn_repopage_name'],
											'dn_repopage_toc_name' => $v4['dn_repopage_toc_name'],
											'dn_repopage_icon' => $v4['dn_repopage_icon'],
											'dn_repository_id' => $form->values['dn_repository_id'],
											'dn_repository_version_id' => $form->values['dn_repository_version_id'],
											'dn_repository_language_code' => $form->values['dn_repository_language_code'],
										]);
										if (!$result['success']) {
											$form->error(DANGER, $result['error']);
											return;
										}
										$parent_id4 = $result['pk']['dn_repopage_id'];
									} else {
										$parent_id4 = $page['dn_repopage_id'];
									}
									// fragments
									if (!empty($v4['fragments'])) {
										foreach ($v4['fragments'] as $k5 => $v5) {
											$fragment = \Numbers\Documentation\Documentation\Helper\Pages::fragmentExistsByOrder((int) $form->values['__module_id'], $parent_id4, $v5['dn_repopgfragm_order']);
											$result = $fragment_model->save([
												'dn_repopgfragm_module_id' => $form->values['__module_id'],
												'dn_repopgfragm_id' => $fragment['dn_repopgfragm_id'] ?? null,
												'dn_repopgfragm_inactive' => 0,
												'dn_repopgfragm_order' => $v5['dn_repopgfragm_order'],
												'dn_repopgfragm_type_code' => $v5['dn_repopgfragm_type_code'],
												'dn_repopgfragm_name' => $v5['dn_repopgfragm_name'],
												'dn_repopgfragm_body' => $v5['dn_repopgfragm_body'],
												'dn_repopage_id' => $parent_id4,
												'dn_repository_id' => $form->values['dn_repository_id'],
												'dn_repository_version_id' => $form->values['dn_repository_version_id'],
												'dn_repository_language_code' => $form->values['dn_repository_language_code'],
											]);
											if (!$result['success']) {
												$form->error(DANGER, $result['error']);
												return;
											}
										}
									}
								}
							}
						}
					}
				}
			}
		}
		// we commit
		$form->error(SUCCESS, \Object\Content\Messages::OPERATION_EXECUTED);
	}
}