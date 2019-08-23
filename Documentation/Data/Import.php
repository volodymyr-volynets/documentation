<?php

namespace Numbers\Documentation\Documentation\Data;
class Import extends \Object\Import {
	public $data = [
		'modules' => [
			'options' => [
				'pk' => ['sm_module_code'],
				'model' => '\Numbers\Backend\System\Modules\Model\Collection\Modules',
				'method' => 'save'
			],
			'data' => [
				[
					'sm_module_code' => 'DN',
					'sm_module_type' => 20,
					'sm_module_name' => 'D/N Documentation',
					'sm_module_abbreviation' => 'D/N',
					'sm_module_icon' => 'fas fa-font',
					'sm_module_transactions' => 0,
					'sm_module_multiple' => 1,
					'sm_module_activation_model' => null,
					'sm_module_custom_activation' => 0,
					'sm_module_inactive' => 0,
					'\Numbers\Backend\System\Modules\Model\Module\Dependencies' => [
						[
							'sm_mdldep_child_module_code' => 'UM',
							'sm_mdldep_child_feature_code' => 'UM::USERS'
						],
						[
							'sm_mdldep_child_module_code' => 'ON',
							'sm_mdldep_child_feature_code' => 'ON::ORGANIZATIONS'
						],
					]
				]
			]
		],
		'features' => [
			'options' => [
				'pk' => ['sm_feature_code'],
				'model' => '\Numbers\Backend\System\Modules\Model\Collection\Module\Features',
				'method' => 'save'
			],
			'data' => [
				[
					'sm_feature_module_code' => 'DN',
					'sm_feature_code' => 'DN::DOCUMENTATION',
					'sm_feature_type' => 10,
					'sm_feature_name' => 'D/N Documentation',
					'sm_feature_icon' => 'fas fa-font',
					'sm_feature_activation_model' => null,
					'sm_feature_activated_by_default' => 1,
					'sm_feature_inactive' => 0,
					'\Numbers\Backend\System\Modules\Model\Module\Dependencies' => [
						[
							'sm_mdldep_child_module_code' => 'UM',
							'sm_mdldep_child_feature_code' => 'UM::USERS'
						],
						[
							'sm_mdldep_child_module_code' => 'ON',
							'sm_mdldep_child_feature_code' => 'ON::ORGANIZATIONS'
						],
					]
				]
			]
		]
	];
}