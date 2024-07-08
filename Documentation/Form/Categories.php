<?php

namespace Numbers\Documentation\Documentation\Form;
class Categories extends \Object\Form\Wrapper\Base {
	public $form_link = 'dn_categories';
	public $module_code = 'DN';
	public $title = 'D/N Categories Form';
	public $options = [
		'segment' => self::SEGMENT_FORM,
		'actions' => [
			'refresh' => true,
			'new' => true,
			'back' => true,
			'import' => true,
		]
	];
	public $containers = [
		'top' => ['default_row_type' => 'grid', 'order' => 100],
		'buttons' => ['default_row_type' => 'grid', 'order' => 900],
	];
	public $rows = [];
	public $elements = [
		'top' => [
			'dn_category_id' => [
				'dn_category_code' => ['order' => 1, 'row_order' => 100, 'label_name' => 'Code', 'domain' => 'group_code', 'null' => true, 'percent' => 95, 'required' => true, 'navigation' => true],
				'dn_category_inactive' => ['order' => 2, 'label_name' => 'Inactive', 'type' => 'boolean', 'percent' => 5]
			],
			'dn_category_name' => [
				'dn_category_name' => ['order' => 1, 'row_order' => 200, 'label_name' => 'Name', 'domain' => 'name', 'percent' => 100, 'required' => true],
			],
			'dn_category_parent_dn_category_code' => [
				'dn_category_parent_dn_category_code' => ['order' => 1, 'row_order' => 300, 'label_name' => 'Parent', 'domain' => 'group_code', 'null' => true, 'percent' => 50, 'method' => 'select', 'tree' => true, 'options_model' => \Numbers\Documentation\Documentation\Model\Categories::selectOptionsGrouppedTree, 'options_depends' => ['dn_category_module_id' => 'dn_category_module_id']],
				'dn_category_order' => ['order' => 2, 'label_name' => 'Order', 'domain' => 'order', 'null' => true, 'required' => true, 'percent' => 50],
			]
		],
		'buttons' => [
			self::BUTTONS => self::BUTTONS_DATA_GROUP
		]
	];
	public $collection = [
		'name' => 'DN Categories',
		'model' => \Numbers\Documentation\Documentation\Model\Categories::class,
	];

	public function validate(& $form) {

	}
}