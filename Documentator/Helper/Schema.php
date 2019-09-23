<?php

namespace Numbers\Documentation\Documentator\Helper;
class Schema extends \Numbers\Documentation\Documentator\Abstract2\Objects {

	/**
	 * Data
	 *
	 * @var array
	 */
	private $data = [];

	/**
	 * Cached modules
	 *
	 * @var array
	 */
	private $cached_modules;

	/**
	 * Cached constraint types
	 *
	 * @var array
	 */
	private $cached_constraint_types;

	/**
	 * Cached index types
	 *
	 * @var array
	 */
	private $cached_index_type;

	/**
	 * Load all dependencies
	 */
	public function loadAllDependencies() {
		$dep = \System\Dependencies::processDepsAll(['mode' => 'test']);
		if (!empty($dep['data']['model_processed'])) {
			// run 1 to deterine virtual tables
			$first = true;
			$virtual_models = $dep['data']['model_processed'];
			$widgets = new \Object\Table\Widgets();
run_again:
			foreach ($virtual_models as $k => $v) {
				$k2 = str_replace('.', '_', $k);
				if ($v == '\Object\Table') {
					// widgets
					$model = \Factory::model($k2, true);
					foreach (array_keys($widgets->data) as $v0) {
						if (!empty($model->{$v0})) {
							$v01 = $v0 . '_model';
							$virtual_models[str_replace('_', '.', $model->{$v01})] = [
								'type' => '\Object\Table',
								'parent' => $k2,
								'parent_title' => $model->title,
							];
						}
					}
					// data objects
					foreach ($model->columns as $k0 => $v0) {
						if (!empty($v0['options_model'])) {
							$virtual_models[$v0['options_model']] = '\Object\Data';
						}
					}
				}
			}
			if ($first) {
				$first = false;
				goto run_again; // some widgets have attributes
			}
			$dep['data']['model_processed'] = array_merge_hard($dep['data']['model_processed'], $virtual_models);
			// generate skeleton
			$modules = \Numbers\Backend\System\Modules\Model\Modules::getStatic();
			$modules['NO'] = ['sm_module_name' => 'N/O Numbers Objects', 'sm_module_icon' => 'fab fa-periscope'];
			$this->cached_modules = $modules;
			$this->cached_constraint_types = \Object\Table\Constraints::getStatic();
			$this->cached_index_type = \Object\Table\Indexes::getStatic();
			foreach ($dep['data']['model_processed'] as $k => $v) {
				$type = $v['type'] ?? $v;
				if (in_array($type, ['\Object\Import'])) {
					continue;
				}
				// preset main holder
				$model = \Factory::model($k, true);
				if (empty($model->module_code)) {
					Throw new \Exception('Module code missing for: ' . $k);
				}
				if (empty($model->title)) {
					Throw new \Exception('Title missing for: ' . $k);
				}
				// preset module
				if (!isset($this->data[$model->module_code])) {
					$this->data[$model->module_code] = [
						'dn_repopage_order' => null,
						'dn_repopage_name' => $modules[$model->module_code]['sm_module_name'],
						'dn_repopage_toc_name' => $modules[$model->module_code]['sm_module_name'],
						'dn_repopage_icon' => $modules[$model->module_code]['sm_module_icon'],
						'options' => []
					];
				}
				switch ($type) {
					case '\Object\Table':
						if (!isset($this->data[$model->module_code]['options']['Tables'])) {
							$this->data[$model->module_code]['options']['Tables'] = [
								'dn_repopage_order' => null,
								'dn_repopage_name' => $modules[$model->module_code]['sm_module_name'] . ' Tables',
								'dn_repopage_toc_name' => 'Tables',
								'dn_repopage_icon' => 'fas fa-table',
								'options' => []
							];
						}
						if (empty($v['parent_title'])) {
							$this->data[$model->module_code]['options']['Tables']['options'][$model->title] = [
								'dn_repopage_order' => null,
								'dn_repopage_name' => $model->title,
								'dn_repopage_toc_name' => null,
								'dn_repopage_icon' => 'fas fa-table',
								'options' => [],
								'fragments' => [],
							];
							$this->renderObjectTable($model, $this->data[$model->module_code]['options']['Tables']['options'][$model->title]['fragments']);
						} else {
							$this->data[$model->module_code]['options']['Tables']['options'][$v['parent_title']]['options'][$model->title] = [
								'dn_repopage_order' => null,
								'dn_repopage_name' => $model->title,
								'dn_repopage_toc_name' => null,
								'dn_repopage_icon' => 'fas fa-table',
								'options' => [],
								'fragments' => [],
							];
							$this->renderObjectTable($model, $this->data[$model->module_code]['options']['Tables']['options'][$v['parent_title']]['options'][$model->title]['fragments']);
						}
						break;
					case '\Object\Data':
						if (!isset($this->data[$model->module_code]['options']['Data Models'])) {
							$this->data[$model->module_code]['options']['Data Models'] = [
								'dn_repopage_order' => null,
								'dn_repopage_name' => $modules[$model->module_code]['sm_module_name'] . ' Data Models',
								'dn_repopage_toc_name' => 'Data Models',
								'dn_repopage_icon' => 'fas fa-database',
								'options' => [],
								'fragments' => [],
							];
						}
						$this->data[$model->module_code]['options']['Data Models']['options'][$model->title] = [
							'dn_repopage_order' => null,
							'dn_repopage_name' => $model->title,
							'dn_repopage_toc_name' => null,
							'dn_repopage_icon' => 'fas fa-database',
							'options' => [],
							'fragments' => [],
						];
						$this->renderObjectData($model, $this->data[$model->module_code]['options']['Data Models']['options'][$model->title]['fragments']);
						break;
					case '\Object\Extension':
						if (!isset($this->data[$model->module_code]['options']['Extensions'])) {
							$this->data[$model->module_code]['options']['Extensions'] = [
								'dn_repopage_order' => null,
								'dn_repopage_name' => $modules[$model->module_code]['sm_module_name'] . ' Extensions',
								'dn_repopage_toc_name' => 'Extensions',
								'dn_repopage_icon' => 'fas fa-tablets',
								'options' => [],
							];
						}
						$this->data[$model->module_code]['options']['Extensions']['options'][$model->title] = [
							'dn_repopage_order' => null,
							'dn_repopage_name' => $model->title,
							'dn_repopage_toc_name' => null,
							'dn_repopage_icon' => 'fas fa-tablets',
							'options' => [],
							'fragments' => [],
						];
						$this->renderObjectExtension($model, $this->data[$model->module_code]['options']['Extensions']['options'][$model->title]['fragments']);
						break;
					case '\Object\Function2':
						if (!isset($this->data[$model->module_code]['options']['Functions'])) {
							$this->data[$model->module_code]['options']['Functions'] = [
								'dn_repopage_order' => null,
								'dn_repopage_name' => $modules[$model->module_code]['sm_module_name'] . ' Functions',
								'dn_repopage_toc_name' => 'Functions',
								'dn_repopage_icon' => 'fas fa-tasks',
								'options' => [],
							];
						}
						$this->data[$model->module_code]['options']['Functions']['options'][$model->title] = [
							'dn_repopage_order' => null,
							'dn_repopage_name' => $model->title,
							'dn_repopage_toc_name' => null,
							'dn_repopage_icon' => 'fas fa-tasks',
							'options' => [],
							'fragments' => [],
						];
						$this->renderObjectFunction($model, $this->data[$model->module_code]['options']['Functions']['options'][$model->title]['fragments']);
						break;
					case '\Object\Sequence':
						if (!isset($this->data[$model->module_code]['options']['Sequences'])) {
							$this->data[$model->module_code]['options']['Sequences'] = [
								'dn_repopage_order' => null,
								'dn_repopage_name' => $modules[$model->module_code]['sm_module_name'] . ' Sequences',
								'dn_repopage_toc_name' => 'Sequences',
								'dn_repopage_icon' => 'fas fa-terminal',
								'options' => [],
							];
						}
						$this->data[$model->module_code]['options']['Sequences']['options'][$model->title] = [
							'dn_repopage_order' => null,
							'dn_repopage_name' => $model->title,
							'dn_repopage_toc_name' => null,
							'dn_repopage_icon' => 'fas fa-terminal',
							'options' => [],
							'fragments' => [],
						];
						$this->renderObjectSequence($model, $this->data[$model->module_code]['options']['Sequences']['options'][$model->title]['fragments']);
						break;
					case '\Object\View':
						if (!isset($this->data[$model->module_code]['options']['Views'])) {
							$this->data[$model->module_code]['options']['Views'] = [
								'dn_repopage_order' => null,
								'dn_repopage_name' => $modules[$model->module_code]['sm_module_name'] . ' Views',
								'dn_repopage_toc_name' => 'Views',
								'dn_repopage_icon' => 'fas fa-street-view',
								'options' => [],
							];
						}
						$this->data[$model->module_code]['options']['Views']['options'][$model->title] = [
							'dn_repopage_order' => null,
							'dn_repopage_name' => $model->title,
							'dn_repopage_toc_name' => null,
							'dn_repopage_icon' => 'fas fa-street-view',
							'options' => [],
							'fragments' => [],
						];
						$this->renderObjectView($model, $this->data[$model->module_code]['options']['Views']['options'][$model->title]['fragments']);
						break;
					default:
						Throw new \Exception($type);
				}
			}
			// sort
			array_key_sort($this->data, ['dn_repopage_name' => SORT_ASC]);
			$order = 1000;
			foreach ($this->data as $k => $v) {
				$this->data[$k]['dn_repopage_order'] = $order;
				if (!empty($this->data[$k]['options'])) {
					$order2 = 1000;
					array_key_sort($this->data[$k]['options'], ['dn_repopage_name' => SORT_ASC]);
					foreach ($this->data[$k]['options'] as $k2 => $v2) {
						$this->data[$k]['options'][$k2]['dn_repopage_order'] = $order2;
						if (!empty($this->data[$k]['options'][$k2]['options'])) {
							$order3 = 1000;
							array_key_sort($this->data[$k]['options'][$k2]['options'], ['dn_repopage_name' => SORT_ASC]);
							foreach ($this->data[$k]['options'][$k2]['options'] as $k3 => $v3) {
								$this->data[$k]['options'][$k2]['options'][$k3]['dn_repopage_order'] = $order3;
								if (!empty($this->data[$k]['options'][$k2]['options'][$k3]['options'])) {
									$order4 = 1000;
									array_key_sort($this->data[$k]['options'][$k2]['options'][$k3]['options'], ['dn_repopage_name' => SORT_ASC]);
									foreach ($this->data[$k]['options'][$k2]['options'][$k3]['options'] as $k4 => $v4) {
										$this->data[$k]['options'][$k2]['options'][$k3]['options'][$k4]['dn_repopage_order'] = $order4;
										$order4+= 1000;
									}
								}
								$order3+= 1000;
							}
						}
						$order2+= 1000;
					}
				}
				$order+= 1000;
			}
		}
	}

	/**
	 * Render view
	 *
	 * @param \Object\View $model
	 * @param array $fragments
	 */
	public function renderObjectView(\Object\View & $model, array & $fragments) {
		// header
		$result = '<table class="table table-striped form_dn_page_repository_page_view_form_schema_import">';
			$result.= '<tr><td>Model:</td><td>' . '\\' . get_class($model) . '</td></tr>';
			$result.= '<tr><td>Module Name:</td><td>' . $this->cached_modules[$model->module_code]['sm_module_name'] . '</td></tr>';
			$result.= '<tr><td>Module Code:</td><td>' . $model->module_code . '</td></tr>';
			$result.= '<tr><td>Title:</td><td>' . $model->title . '</td></tr>';
			$result.= '<tr><td>Schema:</td><td>' . $model->schema . '</td></tr>';
			$result.= '<tr><td>Name:</td><td>' . $model->name . '</td></tr>';
			$result.= '<tr><td>Backend:</td><td>' . implode(', ', $model->backend) . '</td></tr>';
			$result.= '<tr><td>Primary Key:</td><td>' . implode(', ', $model->pk) . '</td></tr>';
			$result.= '<tr><td>SQL Version:</td><td>' . $model->sql_version . '</td></tr>';
		$result.= '</table>';
		$fragments[1000] = [
			'dn_repopgfragm_type_code' => 'TEXT',
			'dn_repopgfragm_name' => 'Header:',
			'dn_repopgfragm_body' => $result,
			'dn_repopgfragm_order' => 1000,
		];
	}

	/**
	 * Render extension
	 *
	 * @param \Object\Extension $model
	 * @param array $fragments
	 */
	public function renderObjectExtension(\Object\Extension & $model, array & $fragments) {
		// header
		$result = '<table class="table table-striped form_dn_page_repository_page_view_form_schema_import">';
			$result.= '<tr><td>Model:</td><td>' . '\\' . get_class($model) . '</td></tr>';
			$result.= '<tr><td>Module Name:</td><td>' . $this->cached_modules[$model->module_code]['sm_module_name'] . '</td></tr>';
			$result.= '<tr><td>Module Code:</td><td>' . $model->module_code . '</td></tr>';
			$result.= '<tr><td>Title:</td><td>' . $model->title . '</td></tr>';
			$result.= '<tr><td>Schema:</td><td>' . $model->schema . '</td></tr>';
			$result.= '<tr><td>Name:</td><td>' . $model->name . '</td></tr>';
			$result.= '<tr><td>Backend:</td><td>' . $model->backend . '</td></tr>';
		$result.= '</table>';
		$fragments[1000] = [
			'dn_repopgfragm_type_code' => 'TEXT',
			'dn_repopgfragm_name' => 'Header:',
			'dn_repopgfragm_body' => $result,
			'dn_repopgfragm_order' => 1000,
		];
	}

	/**
	 * Render object data model
	 *
	 * @param \Object\Data $model
	 * @param array $fragments
	 */
	public function renderObjectData(\Object\Data & $model, array & $fragments) {
		// header
		$result = '<table class="table table-striped form_dn_page_repository_page_view_form_schema_import">';
			$result.= '<tr><td>Model:</td><td>' . '\\' . get_class($model) . '</td></tr>';
			$result.= '<tr><td>Module Name:</td><td>' . $this->cached_modules[$model->module_code]['sm_module_name'] . '</td></tr>';
			$result.= '<tr><td>Module Code:</td><td>' . $model->module_code . '</td></tr>';
			$result.= '<tr><td>Title:</td><td>' . $model->title . '</td></tr>';
			$result.= '<tr><td>Column Key:</td><td>' . $model->column_key . '</td></tr>';
			$result.= '<tr><td>Column Prefix:</td><td>' . $model->column_prefix . '</td></tr>';
			$result.= '<tr><td>Order:</td><td>' . $this->renderOrderby($model->orderby, $model->columns) . '</td></tr>';
		$result.= '</table>';
		$fragments[1000] = [
			'dn_repopgfragm_type_code' => 'TEXT',
			'dn_repopgfragm_name' => 'Header:',
			'dn_repopgfragm_body' => $result,
			'dn_repopgfragm_order' => 1000,
		];
		// columns
		$fragments[2000] = [
			'dn_repopgfragm_type_code' => 'TEXT',
			'dn_repopgfragm_name' => 'Columns:',
			'dn_repopgfragm_body' => $this->renderColumns($model),
			'dn_repopgfragm_order' => 2000,
		];
		// data
		$fragments[3000] = [
			'dn_repopgfragm_type_code' => 'CODE',
			'dn_repopgfragm_name' => 'Snippet to get data',
			'dn_repopgfragm_body' => $this->renderCodeSnippet($model),
			'dn_repopgfragm_order' => 3000,
		];
	}

	/**
	 * Render function
	 *
	 * @param \Object\Function2 $model
	 * @param array $fragments
	 */
	public function renderObjectFunction(\Object\Function2 & $model, array & $fragments) {
		// header
		$result = '<table class="table table-striped form_dn_page_repository_page_view_form_schema_import">';
			$result.= '<tr><td>Model:</td><td>' . '\\' . get_class($model) . '</td></tr>';
			$result.= '<tr><td>Module Name:</td><td>' . $this->cached_modules[$model->module_code]['sm_module_name'] . '</td></tr>';
			$result.= '<tr><td>Module Code:</td><td>' . $model->module_code . '</td></tr>';
			$result.= '<tr><td>Title:</td><td>' . $model->title . '</td></tr>';
			$result.= '<tr><td>Schema:</td><td>' . $model->schema . '</td></tr>';
			$result.= '<tr><td>Name:</td><td>' . $model->name . '</td></tr>';
			$result.= '<tr><td>Backend:</td><td>' . $model->backend . '</td></tr>';
		$result.= '</table>';
		$fragments[1000] = [
			'dn_repopgfragm_type_code' => 'TEXT',
			'dn_repopgfragm_name' => 'Header:',
			'dn_repopgfragm_body' => $result,
			'dn_repopgfragm_order' => 1000,
		];
	}

	/**
	 * Render sequence
	 *
	 * @param \Object\Sequence $model
	 * @param array $fragments
	 */
	public function renderObjectSequence(\Object\Sequence & $model, array & $fragments) {
		// header
		$result = '<table class="table table-striped form_dn_page_repository_page_view_form_schema_import">';
			$result.= '<tr><td>Model:</td><td>' . '\\' . get_class($model) . '</td></tr>';
			$result.= '<tr><td>Module Name:</td><td>' . $this->cached_modules[$model->module_code]['sm_module_name'] . '</td></tr>';
			$result.= '<tr><td>Module Code:</td><td>' . $model->module_code . '</td></tr>';
			$result.= '<tr><td>Title:</td><td>' . $model->title . '</td></tr>';
			$result.= '<tr><td>Schema:</td><td>' . $model->schema . '</td></tr>';
			$result.= '<tr><td>Name:</td><td>' . $model->name . '</td></tr>';
			$result.= '<tr><td>Type:</td><td>' . $model->type . '</td></tr>';
			$result.= '<tr><td>Prefix:</td><td>' . $model->prefix . '</td></tr>';
			$result.= '<tr><td>Length:</td><td>' . $model->length . '</td></tr>';
			$result.= '<tr><td>Suffix:</td><td>' . $model->suffix . '</td></tr>';
		$result.= '</table>';
		$fragments[1000] = [
			'dn_repopgfragm_type_code' => 'TEXT',
			'dn_repopgfragm_name' => 'Header:',
			'dn_repopgfragm_body' => $result,
			'dn_repopgfragm_order' => 1000,
		];
	}

	/**
	 * Render object table
	 *
	 * @param \Object\Table $model
	 * @param array $fragments
	 */
	public function renderObjectTable(\Object\Table & $model, array & $fragments) {
		// header
		$result = '<table class="table table-striped form_dn_page_repository_page_view_form_schema_import">';
			$result.= '<tr><td>Model:</td><td>' . '\\' . get_class($model) . '</td></tr>';
			$result.= '<tr><td>Module Name:</td><td>' . $this->cached_modules[$model->module_code]['sm_module_name'] . '</td></tr>';
			$result.= '<tr><td>Module Code:</td><td>' . $model->module_code . '</td></tr>';
			$result.= '<tr><td>Title:</td><td>' . $model->title . '</td></tr>';
			$result.= '<tr><td>Schema:</td><td>' . $model->schema . '</td></tr>';
			$result.= '<tr><td>Name:</td><td>' . $model->name . '</td></tr>';
			$result.= '<tr><td>Full Name:</td><td>' . $model->full_table_name . '</td></tr>';
			$result.= '<tr><td>Primary Key:</td><td>' . implode(', ', $model->pk) . '</td></tr>';
			$result.= '<tr><td>Tenanted:</td><td>' . ($model->tenant ? 'Yes' : 'No') . '</td></tr>';
			$result.= '<tr><td>Moduled:</td><td>' . ($model->module ? 'Yes' : 'No') . '</td></tr>';
			$result.= '<tr><td>Column Prefix:</td><td>' . $model->column_prefix . '</td></tr>';
			$result.= '<tr><td>Order:</td><td>' . $this->renderOrderby($model->orderby, $model->columns) . '</td></tr>';
		$result.= '</table>';
		$fragments[1000] = [
			'dn_repopgfragm_type_code' => 'TEXT',
			'dn_repopgfragm_name' => 'Header:',
			'dn_repopgfragm_body' => $result,
			'dn_repopgfragm_order' => 1000,
		];
		// columns
		$fragments[2000] = [
			'dn_repopgfragm_type_code' => 'TEXT',
			'dn_repopgfragm_name' => 'Columns:',
			'dn_repopgfragm_body' => $this->renderColumns($model),
			'dn_repopgfragm_order' => 2000,
		];
		// foreigh keys
		$constraints = $this->renderConstraints($model);
		if (!empty($constraints)) {
			$fragments[3000] = [
				'dn_repopgfragm_type_code' => 'TEXT',
				'dn_repopgfragm_name' => 'Constraints:',
				'dn_repopgfragm_body' => $constraints,
				'dn_repopgfragm_order' => 3000,
			];
		}
		// indexes
		$indexes = $this->renderIndexes($model);
		if (!empty($indexes)) {
			$fragments[4000] = [
				'dn_repopgfragm_type_code' => 'TEXT',
				'dn_repopgfragm_name' => 'Indexes:',
				'dn_repopgfragm_body' => $indexes,
				'dn_repopgfragm_order' => 4000,
			];
		}
		// data asset
		$result = '<table class="table table-striped form_dn_page_repository_page_view_form_schema_import">';
			$result.= '<tr><td>Classification:</td><td>' . $model->data_asset['classification'] . '</td></tr>';
			$result.= '<tr><td>Protection:</td><td>' . $model->data_asset['protection'] . '</td></tr>';
			$result.= '<tr><td>Scope:</td><td>' . $model->data_asset['scope'] . '</td></tr>';
		$result.= '</table>';
		$fragments[5000] = [
			'dn_repopgfragm_type_code' => 'TEXT',
			'dn_repopgfragm_name' => 'Data asset:',
			'dn_repopgfragm_body' => $result,
			'dn_repopgfragm_order' => 5000,
		];
	}

	/**
	 * Render indexes
	 *
	 * @param \Object\Table $model
	 * @return string
	 */
	public function renderIndexes(\Object\Table $model) : string {
		if (empty($model->indexes)) return false;
		$result = '<table class="table table-striped form_dn_page_repository_page_view_form_schema_import">';
			$result.= '<tr><th>Name</th><th>Type</th><th>Columns</th></tr>';
			foreach ($model->indexes as $k => $v) {
				$result.= '<tr>';
					$result.= '<td>' . $k . '</td>';
					$result.= '<td>' . $this->cached_index_type[$v['type']]['no_table_index_name'] . '</td>';
					$result.= '<td>' . implode(', ', $v['columns']) . '</td>';
				$result.= '</tr>';
			}
		$result.= '</table>';
		return $result;
	}

	/**
	 * Render constraints
	 *
	 * @param \Object\Table $model
	 * @return string
	 */
	public function renderConstraints(\Object\Table $model) : string {
		if (empty($model->constraints)) return false;
		$result = '<table class="table table-striped form_dn_page_repository_page_view_form_schema_import">';
			$result.= '<tr><th>Name</th><th>Type</th><th>Columns</th><th>Foreign Model</th><th>Foreign Columns</th></tr>';
			foreach ($model->constraints as $k => $v) {
				$result.= '<tr>';
					$result.= '<td>' . $k . '</td>';
					$result.= '<td>' . $this->cached_constraint_types[$v['type']]['no_table_constraint_name'] . '</td>';
					$result.= '<td>' . implode(', ', $v['columns']) . '</td>';
					if ($v['type'] == 'fk') {
						$result.= '<td>';
							if (!empty($v['foreign_model'])) {
								$foreign_model = \Factory::model($v['foreign_model'], true);
								$result.= '<a href="[href[' . $foreign_model->title . ']]">Yes</a>';
							} else {
								$result.= '&nbsp;';
							}
						$result.= '</td>';
						$result.= '<td>' . implode(', ', $v['foreign_columns']) . '</td>';
					} else {
						$result.= '<td>&nbsp;</td>';
						$result.= '<td>&nbsp;</td>';
					}
				$result.= '</tr>';
			}
		$result.= '</table>';
		return $result;
	}

	/**
	 * Render data
	 *
	 * @param object $model
	 * @return string
	 */
	public function renderData($model) : string {
		return \HTML::highlight(['value' => print_r($model->get(), true), 'class' => 'form_dn_page_repository_page_view_form_schema_import']);
	}

	/**
	 * Render data
	 *
	 * @param object $model
	 * @return string
	 */
	public function renderCodeSnippet($model) : string {
		$class = get_class($model);
		$value = <<<TTT
\$model = new \\$class();
print_r2(\$model->get());
TTT;
		return \HTML::highlight(['value' => $value]);
	}

	/**
	 * Render columns
	 *
	 * @param object $model
	 * @return string
	 */
	public function renderColumns($model) : string {
		$result = '<table class="table table-striped form_dn_page_repository_page_view_form_schema_import">';
			$result.= '<tr><th>Code</th><th>Name</th><th>Domain</th><th>Type</th><th>Default</th><th>Null</th><th>Model</th></tr>';
			foreach ($model->columns as $k => $v) {
				$result.= '<tr>';
					$result.= '<td>' . $k . '</td>';
					$result.= '<td>' . $v['name'] . '</td>';
					$result.= '<td>' . ($v['domain'] ?? '&nbsp;') . '</td>';
					$type = $v['type'] ?? '';
					if (!empty($v['length'])) {
						$type.= '(' . $v['length'] . ')';
					}
					$result.= '<td>' . ($type ?? '&nbsp;') . '</td>';
					$result.= '<td>' . ($v['default'] ?? '&nbsp;') . '</td>';
					$result.= '<td>' . (!empty($v['null']) ? 'Yes' : '&nbsp;') . '</td>';
					$result.= '<td>';
						if (!empty($v['options_model'])) {
							$options_model = \Factory::model($v['options_model'], true);
							$result.= '<a href="[href[' . $options_model->title . ']]">Yes</a>';
						} else {
							$result.= '&nbsp;';
						}
					$result.= '</td>';
				$result.= '</tr>';
			}
		$result.= '</table>';
		return $result;
	}

	/**
	 * Render order by
	 *
	 * @param array $order
	 * @return string
	 */
	public function renderOrderby($orderby, $columns = []) : string {
		if (!empty($orderby)) {
			$result = [];
			foreach ($orderby as $k => $v) {
				if (empty($columns)) {
					$result[] = $k . ' ' . ($v == SORT_ASC ? 'ASC' : 'DESC');
				} else {
					$result[] = $columns[$k]['name'] . ' ' . ($v == SORT_ASC ? 'ASC' : 'DESC');
				}
			}
			return implode(', ', $result);
		} else {
			return 'None';
		}
	}

	/**
	 * Generate documentation
	 *
	 * @return array
	 */
	public function generateDocumentationArray() : array {
		return $this->data;
	}
}