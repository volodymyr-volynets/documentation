<?php

namespace Numbers\Documentation\Documentation\Form;
class Repositories extends \Object\Form\Wrapper\Base {
	public $form_link = 'dn_repositories';
	public $module_code = 'DN';
	public $title = 'D/N Repositories Form';
	public $options = [
		'segment' => self::SEGMENT_FORM,
		'actions' => [
			'refresh' => true,
			'new' => true,
			'back' => true,
			'import' => true,
			'activate' => ['value' => 'New Version']
		]
	];
	public $containers = [
		'top' => ['default_row_type' => 'grid', 'order' => 100],
		'tabs' => ['default_row_type' => 'grid', 'order' => 500, 'type' => 'tabs'],
		'buttons' => ['default_row_type' => 'grid', 'order' => 900],
		// child containers
		'general_container' => ['default_row_type' => 'grid', 'order' => 32000],
		'organizations_container' => [
			'type' => 'details',
			'details_rendering_type' => 'table',
			'details_new_rows' => 1,
			'details_key' => '\Numbers\Documentation\Documentation\Model\Repository\Organizations',
			'details_pk' => ['dn_repoorg_organization_id'],
			'required' => true,
			'order' => 35001
		],
		'languages_container' => [
			'type' => 'details',
			'details_rendering_type' => 'table',
			'details_new_rows' => 1,
			'details_key' => '\Numbers\Documentation\Documentation\Model\Repository\Languages',
			'details_pk' => ['dn_repolang_language_code'],
			'required' => true,
			'order' => 35002
		],
		'versions_container' => [
			'type' => 'details',
			'details_rendering_type' => 'table',
			'details_new_rows' => 0,
			'details_key' => '\Numbers\Documentation\Documentation\Model\Repository\Versions',
			'details_pk' => ['dn_repolang_language_code'],
			'details_empty_warning_message' => true,
			'details_cannot_delete' => true,
			'order' => 35003
		],
	];
	public $rows = [
		'top' => [
			'dn_repository_id' => ['order' => 100],
			'dn_repository_name' => ['order' => 200],
		],
		'tabs' => [
			'general' => ['order' => 100, 'label_name' => 'General'],
			'organizations' => ['order' => 200, 'label_name' => 'Organizations'],
			'languages' => ['order' => 300, 'label_name' => 'Languages'],
			'versions' => ['order' => 400, 'label_name' => 'Versions'],
		]
	];
	public $elements = [
		'top' => [
			'dn_repository_id' => [
				'dn_repository_id' => ['order' => 1, 'row_order' => 100, 'label_name' => 'Repository #', 'domain' => 'repository_id_sequence', 'percent' => 50, 'navigation' => true],
				'dn_repository_code' => ['order' => 2, 'label_name' => 'Code', 'domain' => 'group_code', 'null' => true, 'percent' => 45, 'required' => true, 'navigation' => true],
				'dn_repository_inactive' => ['order' => 3, 'label_name' => 'Inactive', 'type' => 'boolean', 'percent' => 5]
			],
			'dn_repository_name' => [
				'dn_repository_name' => ['order' => 1, 'row_order' => 200, 'label_name' => 'Name', 'domain' => 'name', 'percent' => 100, 'required' => true],
			]
		],
		'tabs' => [
			'general' => [
				'general' => ['container' => 'general_container', 'order' => 100],
			],
			'organizations' => [
				'organizations' => ['container' => 'organizations_container', 'order' => 100],
			],
			'languages' => [
				'languages' => ['container' => 'languages_container', 'order' => 100],
			],
			'versions' => [
				'versions' => ['container' => 'versions_container', 'order' => 200],
			]
		],
		'general_container' => [
			'dn_repository_type_id' => [
				'dn_repository_type_id' => ['order' => 1, 'row_order' => 100, 'label_name' => 'Type', 'domain' => 'type_id', 'null' => true, 'percent' => 50, 'required' => true, 'method' => 'select', 'options_model' => '\Numbers\Documentation\Documentation\Model\Repository\Types'],
				'dn_repository_icon' => ['order' => 2, 'label_name' => 'Icon', 'domain' => 'icon', 'null' => true, 'percent' => 50, 'method' => 'select', 'options_model' => '\Numbers\Frontend\HTML\FontAwesome\Model\Icons::options', 'searchable' => true],
			],
		],
		'organizations_container' => [
			'row1' => [
				'dn_repoorg_organization_id' => ['order' => 1, 'row_order' => 100, 'label_name' => 'Organization', 'domain' => 'organization_id', 'required' => true, 'null' => true, 'details_unique_select' => true, 'percent' => 95, 'method' => 'select', 'options_model' => '\Numbers\Users\Organizations\Model\Organizations::optionsActive', 'onchange' => 'this.form.submit();'],
				'dn_repoorg_inactive' => ['order' => 3, 'label_name' => 'Inactive', 'type' => 'boolean', 'percent' => 5]
			]
		],
		'languages_container' => [
			'row1' => [
				'dn_repolang_language_code' => ['order' => 1, 'row_order' => 100, 'label_name' => 'Language', 'domain' => 'language_code', 'required' => true, 'null' => true, 'details_unique_select' => true, 'percent' => 80, 'method' => 'select', 'options_model' => '\Numbers\Internalization\Internalization\Model\Language\Codes', 'onchange' => 'this.form.submit();'],
				'dn_repolang_primary' => ['order' => 2, 'label_name' => 'Primary', 'type' => 'boolean', 'percent' => 15],
				'dn_repolang_inactive' => ['order' => 2, 'label_name' => 'Inactive', 'type' => 'boolean', 'percent' => 5]
			]
		],
		'versions_container' => [
			'row1' => [
				'dn_repoversion_version_id' => ['order' => 1, 'row_order' => 100, 'label_name' => 'Version #', 'domain' => 'version_id', 'percent' => 15, 'readonly' => true],
				'dn_repoversion_version_name' => ['order' => 2, 'label_name' => 'Version Name', 'domain' => 'name', 'percent' => 65],
				'dn_repoversion_latest' => ['order' => 3, 'label_name' => 'Latest', 'type' => 'boolean', 'percent' => 15],
				'dn_repoversion_inactive' => ['order' => 4, 'label_name' => 'Inactive', 'type' => 'boolean', 'percent' => 5]
			]
		],
		'buttons' => [
			self::BUTTONS => self::BUTTONS_DATA_GROUP
		]
	];
	public $collection = [
		'name' => 'Repositories',
		'model' => '\Numbers\Documentation\Documentation\Model\Repositories',
		'details' => [
			'\Numbers\Documentation\Documentation\Model\Repository\Organizations' => [
				'name' => 'Organizations',
				'pk' => ['dn_repoorg_tenant_id', 'dn_repoorg_repository_id', 'dn_repoorg_organization_id'],
				'type' => '1M',
				'map' => ['dn_repository_tenant_id' => 'dn_repoorg_tenant_id', 'dn_repository_id' => 'dn_repoorg_repository_id']
			],
			'\Numbers\Documentation\Documentation\Model\Repository\Languages' => [
				'name' => 'Languages',
				'pk' => ['dn_repolang_tenant_id', 'dn_repolang_repository_id', 'dn_repolang_language_code'],
				'type' => '1M',
				'map' => ['dn_repository_tenant_id' => 'dn_repolang_tenant_id', 'dn_repository_id' => 'dn_repolang_repository_id']
			],
			'\Numbers\Documentation\Documentation\Model\Repository\Versions' => [
				'name' => 'Versions',
				'pk' => ['dn_repoversion_tenant_id', 'dn_repoversion_repository_id', 'dn_repoversion_version_id'],
				'type' => '1M',
				'map' => ['dn_repository_tenant_id' => 'dn_repoversion_tenant_id', 'dn_repository_id' => 'dn_repoversion_repository_id']
			]
		]
	];

	public function refresh(& $form) {

	}

	public function validate(& $form) {
		// default language code
		$default_language_code = $form->validateDetailsPrimaryColumn(
			'\Numbers\Documentation\Documentation\Model\Repository\Languages',
			'dn_repolang_primary',
			'dn_repolang_inactive',
			'dn_repolang_language_code'
		);
		$form->values['dn_repository_default_language_code'] = $default_language_code;
		// default language code
		$latest_version_id = $form->validateDetailsPrimaryColumn(
			'\Numbers\Documentation\Documentation\Model\Repository\Versions',
			'dn_repoversion_latest',
			'dn_repoversion_inactive',
			'dn_repoversion_version_id'
		);
		$form->values['dn_repository_latest_version_id'] = $latest_version_id;
		// prepopulate sequence number
		if (empty($form->values['dn_repository_code'])) {
			$sequence = new \Numbers\Documentation\Documentation\Model\Repository\CodeSequence();
			$form->values['dn_repository_code'] = $sequence->nextval('advanced');
		}
	}
}