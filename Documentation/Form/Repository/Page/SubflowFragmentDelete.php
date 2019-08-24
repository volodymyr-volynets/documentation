<?php

namespace Numbers\Documentation\Documentation\Form\Repository\Page;
class SubflowFragmentDelete extends \Object\Form\Wrapper\Base {
	public $form_link = 'dn_page_repository_fragment_delete';
	public $module_code = 'DN';
	public $title = 'D/N Page Subflow Delete Fragment Form';
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
			'dn_repopgfragm_id' => [
				'dn_repopgfragm_id' => ['order' => 1, 'row_order' => 100, 'label_name' => 'Fragment #', 'domain' => 'fragment_id_sequence', 'null' => true, 'readonly' => true, 'percent' => 100],
			],
			self::HIDDEN => [
				'dn_repopage_id' => ['order' => 3, 'label_name' => 'Page #', 'domain' => 'page_id', 'null' => true, 'method' => 'hidden', 'preserved' => true],
				'dn_repository_id' => ['order' => 4, 'label_name' => 'Repository', 'domain' => 'repository_id', 'null' => true, 'method' => 'hidden', 'preserved' => true],
				'dn_repository_version_id' => ['order' => 5, 'label_name' => 'Version', 'domain' => 'version_id', 'null' => true, 'method' => 'hidden', 'preserved' => true],
				'dn_repository_language_code' => ['order' => 6, 'label_name' => 'Language (View)', 'domain' => 'language_code', 'null' => true, 'method' => 'hidden', 'preserved' => true],
			]
		],
		'buttons' => [
			self::BUTTONS => [
				self::BUTTON_SUBMIT_DELETE => self::BUTTON_SUBMIT_DELETE_DATA,
			]
		]
	];
	public $collection = [
		'name' => 'Fragments',
		'model' => '\Numbers\Documentation\Documentation\Model\Repository\Version\Page\Fragments',
		'pk' => ['dn_repopgfragm_tenant_id', 'dn_repopgfragm_module_id', 'dn_repopgfragm_id'],
		'details' => [
			'\Numbers\Documentation\Documentation\Model\Repository\Version\Page\Fragment\Translations' => [
				'name' => 'Page Fragment Translations',
				'pk' => ['dn_repofragtransl_tenant_id', 'dn_repofragtransl_module_id', 'dn_repofragtransl_repopage_id', 'dn_repofragtransl_repopgfragm_id', 'dn_repofragtransl_language_code'],
				'type' => '1M',
				'map' => ['dn_repopgfragm_tenant_id' => 'dn_repofragtransl_tenant_id', 'dn_repopgfragm_module_id' => 'dn_repofragtransl_module_id', 'dn_repopgfragm_id' => 'dn_repofragtransl_repopgfragm_id'],
			],
		]
	];
}