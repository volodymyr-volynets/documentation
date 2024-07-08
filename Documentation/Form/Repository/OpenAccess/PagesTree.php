<?php

namespace Numbers\Documentation\Documentation\Form\Repository\OpenAccess;
class PagesTree extends \Object\Form\Wrapper\Base {
	public $form_link = 'dn_page_repository_page_tree';
	public $module_code = 'DN';
	public $title = 'D/N Page Repository Pages Form';
	public $options = [
		'include_css' => '/numbers/media_submodules/Numbers_Documentation_Documentation_Media_CSS_CollectionPages.css',
		'skip_acl' => true
	];
	public $containers = [
		'top' => ['default_row_type' => 'grid', 'order' => 100],
		'actions' => ['default_row_type' => 'grid', 'order' => 200, 'custom_renderer' => 'self::renderActions'],
		'tree_container' => [
			'type' => 'trees',
			'details_rendering_type' => 'name_only',
			'details_new_rows' => 0,
			'details_key' => '\Numbers\Documentation\Documentation\Model\Repository\Version\Pages',
			'details_pk' => ['dn_repopage_id'],
			'details_tree_key' => 'dn_repopage_id',
			'details_tree_i18n' => 'skip_sorting',
			'details_tree_parent_key' => 'dn_repopage_parent_repopage_id',
			'details_tree_name_only_custom_renderer' => 'self::renderTreeDocumentField',
			'order' => 300
		],
	];
	public $rows = [];
	public $elements = [
		'top' => [
			'separator' => [
				self::SEPARATOR_HORIZONTAL => ['order' => 1, 'row_order' => 100, 'label_name' => 'Table of Contents', 'icon' => 'far fa-list-alt', 'percent' => 100],
			],
			self::HIDDEN => [
				'dn_repoversion_repository_id' => ['order' => 1, 'label_name' => 'Repository #', 'domain' => 'repository_id', 'null' => true, 'method' => 'hidden'],
				'dn_repoversion_version_id' => ['order' => 2, 'label_name' => 'Version #', 'domain' => 'version_id', 'null' => true, 'method' => 'hidden'],
				// old records
				'dn_repository_module_id' => ['label_name' => 'Repository Module #', 'domain' => 'module_id', 'null' => true, 'method' => 'hidden', 'preserved' => true],
				'dn_repository_id' => ['order' => 3, 'label_name' => 'Repository', 'domain' => 'repository_id', 'null' => true, 'method' => 'hidden', 'preserved' => true],
				'dn_repository_version_id' => ['order' => 4, 'label_name' => 'Version', 'domain' => 'version_id', 'null' => true, 'method' => 'hidden', 'preserved' => true],
				'dn_repository_language_code' => ['order' => 5, 'label_name' => 'Language', 'domain' => 'language_code', 'null' => true, 'method' => 'hidden', 'preserved' => true],
			]
		],
		'tree_container' => [
			self::HIDDEN => [
				//'dn_repopage_id' => ['order' => 1, 'label_name' => 'Page #', 'domain' => 'page_id', 'null' => true, 'method' => 'hidden'],
				//'dn_repopage_parent_repopage_id' => ['order' => 2, 'label_name' => 'Parent Folder', 'domain' => 'folder_id', 'null' => true, 'method' => 'hidden'],
				//'dn_repopage_name' => ['order' => 3, 'label_name' => 'Name', 'domain' => 'name', 'required' => true, 'method' => 'hidden'],
				//'dn_repopage_inactive' => ['order' => 4, 'label_name' => 'Inactive', 'type' => 'boolean', 'method' => 'hidden'],
				//'dn_repopage_optimistic_lock' => ['order' => 5, 'label_name' => 'Optimistic Lock', 'type' => 'text', 'default' => null, 'method' => 'hidden'],
			]
		],
	];
	public $collection = [
		'name' => 'Versions',
		'model' => '\Numbers\Documentation\Documentation\Model\Repository\Versions',
		'pk' => ['dn_repoversion_tenant_id', 'dn_repoversion_module_id', 'dn_repoversion_repository_id', 'dn_repoversion_version_id'],
		'readonly' => true,
		'details' => [
			'\Numbers\Documentation\Documentation\Model\Repository\Version\Pages' => [
				'name' => 'Pages',
				'pk' => ['dn_repopage_tenant_id', 'dn_repopage_module_id', 'dn_repopage_repository_id', 'dn_repopage_version_id', 'dn_repopage_id'],
				'type' => '1M',
				'map' => ['dn_repoversion_tenant_id' => 'dn_repopage_tenant_id', 'dn_repoversion_module_id' => 'dn_repopage_module_id', 'dn_repoversion_repository_id' => 'dn_repopage_repository_id', 'dn_repoversion_version_id' => 'dn_repopage_version_id'],
				'readonly' => true,
				'details' => [
					'\Numbers\Documentation\Documentation\Model\Repository\Version\Page\Translations' => [
						'name' => 'Page Translations',
						'pk' => ['dn_repopgtransl_tenant_id', 'dn_repopgtransl_module_id', 'dn_repopgtransl_repository_id', 'dn_repopgtransl_version_id', 'dn_repopgtransl_repopage_id', 'dn_repopgtransl_language_code'],
						'type' => '1M',
						'map' => ['dn_repopage_tenant_id' => 'dn_repopgtransl_tenant_id', 'dn_repopage_module_id' => 'dn_repopgtransl_module_id', 'dn_repopage_repository_id' => 'dn_repopgtransl_repository_id', 'dn_repopage_version_id' => 'dn_repopgtransl_version_id', 'dn_repopage_id' => 'dn_repopgtransl_repopage_id'],
						'readonly' => true,
						'where' => [
							'dn_repopgtransl_language_code' => 'parent::dn_repository_language_code',
						]
					],
				],
			],
		],
	];
	public $subforms = [];
	public $translations;

	public function overrides(& $form) {
		if (empty($form->values['dn_repoversion_version_id']) && !empty($form->values['dn_repository_version_id'])) {
			$form->values['dn_repoversion_module_id'] = $form->values['dn_repository_module_id'];
			$form->values['dn_repoversion_repository_id'] = $form->values['dn_repository_id'];
			$form->values['dn_repoversion_version_id'] = $form->values['dn_repository_version_id'];
		}
	}

	public function renderActions(& $form) {
		$buttons = [];
		$params = [];
		$params['dn_repository_module_id'] = $params['__module_id'] = $form->values['dn_repository_module_id'];
		$params['dn_repository_id'] = $form->values['dn_repository_id'];
		$params['dn_repository_version_id'] = $form->values['dn_repository_version_id'];
		$params['dn_repository_language_code'] = $form->values['dn_repository_language_code'];
		// process subforms
		foreach ($this->subforms as $k => $v) {
			if (!empty($v['actions']['button']['url_open'])) {
				$temp = $form->generateSubformLink($k, $v, $params);
				if (!empty($temp)) {
					$buttons[]= $temp;
				}
			}
		}
		return '<div>' . implode(' ', $buttons) . '</div><br />';
	}

	public function renderTreeDocumentField(& $form, & $rows, & $data) {
		$filename = ($data['dn_repopage_toc_name'] ?? $data['dn_repopage_name']) . '.html';
		$filename = str_replace('/', '', $filename);
		$filename = urlencode($filename);
		if (!empty($data['\Numbers\Documentation\Documentation\Model\Repository\Version\Page\Translations'])) {
			$temp = current($data['\Numbers\Documentation\Documentation\Model\Repository\Version\Page\Translations']);
			$name = ($temp['dn_repopgtransl_toc_name'] ?? $temp['dn_repopgtransl_name']) . ' ';
		} else {
			$name = ($data['dn_repopage_toc_name'] ?? $data['dn_repopage_name']) . ' ';
		}
		// inactive
		if (!empty($data['dn_repopage_inactive'])) {
			$name.= '(' . i18n(null, 'Inactive') . ')';
		}
		// icon
		if (!empty($data['dn_repopage_icon'])) {
			$name = \HTML::icon(['type' => $data['dn_repopage_icon']]) . ' ' . $name;
		}
		$hash = \Request::hash([
			$form->values['__module_id'],
			$form->values['dn_repository_id'],
			$form->values['dn_repository_version_id'],
			$form->values['dn_repository_language_code'],
			$data['dn_repopage_id'],
		]);
		$href = \Request::buildFromName('D/N Documentation (Open Access)', 'Index/' . $hash . '/' . $filename, [], \Request::host(), 'page_title');
		$result = \HTML::a(['value' => $name, 'href' => $href]);
		return [
			'name' => $result,
		];
	}
}