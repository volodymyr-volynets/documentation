<?php

namespace Numbers\Documentation\Documentator\Data;
class System extends \Object\Import {
	public $data = [
		'controllers' => [
			'options' => [
				'pk' => ['sm_resource_id'],
				'model' => '\Numbers\Backend\System\Modules\Model\Collection\Resources',
				'method' => 'save'
			],
			'data' => [
				[
					'sm_resource_id' => '::id::\Numbers\Documentation\Documentator\Controller\ImportSchema',
					'sm_resource_code' => '\Numbers\Documentation\Documentator\Controller\ImportSchema',
					'sm_resource_type' => 100,
					'sm_resource_classification' => 'Global',
					'sm_resource_name' => 'D/N Import Schema',
					'sm_resource_description' => null,
					'sm_resource_icon' => 'fas fa-database',
					'sm_resource_module_code' => 'DN',
					'sm_resource_group1_name' => 'Operations',
					'sm_resource_group2_name' => 'Documentation',
					'sm_resource_group3_name' => 'Imports',
					'sm_resource_group4_name' => null,
					'sm_resource_group5_name' => null,
					'sm_resource_group6_name' => null,
					'sm_resource_group7_name' => null,
					'sm_resource_group8_name' => null,
					'sm_resource_group9_name' => null,
					'sm_resource_acl_public' => 0,
					'sm_resource_acl_authorized' => 1,
					'sm_resource_acl_permission' => 0,
					'sm_resource_menu_acl_resource_id' => null,
					'sm_resource_menu_acl_method_code' => null,
					'sm_resource_menu_acl_action_id' => null,
					'sm_resource_menu_url' => null,
					'sm_resource_menu_options_generator' => null,
					'sm_resource_inactive' => 0,
					'\Numbers\Backend\System\Modules\Model\Resource\Features' => [
						[
							'sm_rsrcftr_feature_code' => 'DN::DOCUMENTATION',
							'sm_rsrcftr_inactive' => 0
						]
					],
					'\Numbers\Backend\System\Modules\Model\Resource\Map' => [	]
				],
			]
		],
	];
}