<?php

namespace Numbers\Documentation\Documentation\Model\Repository\Version\Page\Fragment;
class Types extends \Object\Data {
	public $column_key = 'code';
	public $column_prefix = 'dn_repopgfrgmtype_';
	public $orderby = ['dn_repopgfrgmtype_name' => SORT_ASC];
	public $options_map = [
		'dn_repopgfrgmtype_name' => 'name',
		'dn_repopgfrgmtype_icon' => 'icon_class',
	];
	public $columns = [
		'dn_repopgfrgmtype_code' => ['name' => 'Code', 'domain' => 'type_code'],
		'dn_repopgfrgmtype_name' => ['name' => 'Name', 'type' => 'text'],
		'dn_repopgfrgmtype_group' => ['name' => 'Group', 'domain' => 'type_code'],
		'dn_repopgfrgmtype_icon' => ['name' => 'Icon', 'domain' => 'icon'],
	];
	public $data = [
		'TEXT' => ['dn_repopgfrgmtype_name' => 'Text', 'dn_repopgfrgmtype_group' => 'TEXT', 'dn_repopgfrgmtype_icon' => 'far fa-file-alt'],
		'IMAGE' => ['dn_repopgfrgmtype_name' => 'Image', 'dn_repopgfrgmtype_group' => 'FILE', 'dn_repopgfrgmtype_icon' => 'far fa-file-image'],
		'FILE' => ['dn_repopgfrgmtype_name' => 'File', 'dn_repopgfrgmtype_group' => 'FILE', 'dn_repopgfrgmtype_icon' => 'far fa-file-excel'],
		'NOTE' => ['dn_repopgfrgmtype_name' => 'Note', 'dn_repopgfrgmtype_group' => 'TEXT', 'dn_repopgfrgmtype_icon' => 'far fa-sticky-note'],
		'CODE' => ['dn_repopgfrgmtype_name' => 'Code', 'dn_repopgfrgmtype_group' => 'TEXT', 'dn_repopgfrgmtype_icon' => 'far fa-file-code'],
		'QUOTE' => ['dn_repopgfrgmtype_name' => 'Quote', 'dn_repopgfrgmtype_group' => 'TEXT', 'dn_repopgfrgmtype_icon' => 'fas fa-quote-left'],
	];
}