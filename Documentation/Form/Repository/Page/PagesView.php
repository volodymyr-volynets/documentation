<?php

namespace Numbers\Documentation\Documentation\Form\Repository\Page;
class PagesView extends \Object\Form\Wrapper\Base {
	public $form_link = 'dn_page_repository_page_view';
	public $module_code = 'DN';
	public $title = 'D/N Page Repository Pages Form';
	public $options = [
		'include_css' => '/numbers/media_submodules/Numbers_Documentation_Documentation_Media_CSS_CollectionPages.css'
	];
	public $containers = [
		'separator' => ['default_row_type' => 'grid', 'order' => 50],
		'actions' => ['default_row_type' => 'grid', 'order' => 100, 'custom_renderer' => '\Numbers\Documentation\Documentation\Form\Repository\Page\PagesView::renderActions'],
		'top' => ['default_row_type' => 'grid', 'order' => 200],
		'bottom' => ['default_row_type' => 'grid', 'order' => 32000, 'custom_renderer' => '\Numbers\Documentation\Documentation\Form\Repository\Page\PagesView::renderChildPages'],
	];
	public $rows = [];
	public $elements = [
		'separator' => [
			'separator' => [
				self::SEPARATOR_HORIZONTAL => ['order' => 1, 'row_order' => 100, 'label_name' => 'Page Content', 'icon' => 'far fa-newspaper', 'percent' => 100],
			],
		],
		'top' => [
			'title' => [
				'title' => ['order' => 1, 'row_order' => 100, 'label_name' => '', 'percent' => 100, 'custom_renderer' => '\Numbers\Documentation\Documentation\Helper\Renderer\Titles::renderForm'],
			],
			'fragments' => [
				'fragments' => ['order' => 1, 'row_order' => 200, 'label_name' => '', 'percent' => 100, 'custom_renderer' => '\Numbers\Documentation\Documentation\Helper\Renderer\Fragments::renderForm'],
			],
			self::HIDDEN => [
				'dn_repopage_id' => ['order' => 1, 'label_name' => 'Page #', 'domain' => 'page_id', 'null' => true, 'method' => 'hidden'],
				// old records
				'dn_repository_id' => ['order' => 4, 'label_name' => 'Repository', 'domain' => 'repository_id', 'null' => true, 'method' => 'hidden', 'preserved' => true],
				'dn_repository_version_id' => ['order' => 5, 'label_name' => 'Version', 'domain' => 'version_id', 'null' => true, 'method' => 'hidden', 'preserved' => true],
				'dn_repository_language_code' => ['order' => 6, 'label_name' => 'Language', 'domain' => 'language_code', 'null' => true, 'method' => 'hidden', 'preserved' => true],
			],
		],
	];
	public $collection = [
		'name' => 'Pages',
		'model' => '\Numbers\Documentation\Documentation\Model\Repository\Version\Pages',
		'pk' => ['dn_repopage_tenant_id', 'dn_repopage_module_id', 'dn_repopage_id'],
		'readonly' => true,
		'details' => [
			'\Numbers\Documentation\Documentation\Model\Repository\Version\Page\Translations' => [
				'name' => 'Page Translations',
				'pk' => ['dn_repopgtransl_tenant_id', 'dn_repopgtransl_module_id', 'dn_repopgtransl_repopage_id', 'dn_repopgtransl_language_code'],
				'type' => '1M',
				'map' => ['dn_repopage_tenant_id' => 'dn_repopgtransl_tenant_id', 'dn_repopage_module_id' => 'dn_repopgtransl_module_id', 'dn_repopage_id' => 'dn_repopgtransl_repopage_id'],
				'readonly' => true,
				'where' => [
					'dn_repopgtransl_language_code' => 'parent::dn_repository_language_code',
				]
			],
			'\Numbers\Documentation\Documentation\Model\Repository\Version\Page\Fragments' => [
				'name' => 'Page Fragments',
				'pk' => ['dn_repopgfragm_tenant_id', 'dn_repopgfragm_module_id', 'dn_repopgfragm_repopage_id', 'dn_repopgfragm_id'],
				'type' => '1M',
				'map' => ['dn_repopage_tenant_id' => 'dn_repopgfragm_tenant_id', 'dn_repopage_module_id' => 'dn_repopgfragm_module_id', 'dn_repopage_id' => 'dn_repopgfragm_repopage_id'],
				'readonly' => true,
				'details' => [
					'\Numbers\Documentation\Documentation\Model\Repository\Version\Page\Fragment\Translations' => [
						'name' => 'Page Translations',
						'pk' => ['dn_repofragtransl_tenant_id', 'dn_repofragtransl_module_id', 'dn_repofragtransl_repopage_id', 'dn_repofragtransl_repopgfragm_id', 'dn_repofragtransl_language_code'],
						'type' => '1M',
						'map' => ['dn_repopgfragm_tenant_id' => 'dn_repofragtransl_tenant_id', 'dn_repopgfragm_module_id' => 'dn_repofragtransl_module_id', 'dn_repopgfragm_repopage_id' => 'dn_repofragtransl_repopage_id', 'dn_repopgfragm_id' => 'dn_repofragtransl_repopgfragm_id'],
						'readonly' => true,
						'where' => [
							'dn_repofragtransl_language_code' => 'parent::dn_repository_language_code',
						]
					],
				]
			],
		],
	];
	public $subforms = [
		'dn_page_repository_page_edit' => [
			'form' => '\Numbers\Documentation\Documentation\Form\Repository\Page\SubflowPageEdit',
			'label_name' => 'Edit Page',
			'actions' => [
				'button' => [
					'label_name' => 'Edit Title',
					'url_open' => true,
					'acl_controller_actions' => [['Edit', 'Record_New']],
					'icon' => 'fas fa-pen-square',
				],
			]
		],
		'dn_page_repository_page_translate' => [
			'form' => '\Numbers\Documentation\Documentation\Form\Repository\Page\SubflowPageTranslate',
			'label_name' => 'Translate Page',
			'actions' => [
				'button' => [
					'label_name' => 'Translate Title',
					'url_open' => true,
					'acl_controller_actions' => [['Edit', 'Record_Edit']],
					'icon' => 'far fa-flag',
				],
			]
		],
		'dn_page_repository_fragment_new' => [
			'form' => '\Numbers\Documentation\Documentation\Form\Repository\Page\SubflowFragmentNew',
			'label_name' => 'New Text Fragment',
			'actions' => [
				'button' => [
					'label_name' => 'New Text Paragraph',
					'url_open' => true,
					'acl_controller_actions' => [['Edit', 'Record_New']],
					'icon' => 'fas fa-pen-square',
				],
			]
		],
		'dn_page_repository_fragment_edit' => [
			'form' => '\Numbers\Documentation\Documentation\Form\Repository\Page\SubflowFragmentEdit',
			'label_name' => 'Edit Text Fragment',
			'actions' => [
				'button' => [
					'label_name' => 'Edit Paragraph',
					'url_open' => true,
					'acl_controller_actions' => [['Edit', 'Record_Edit']],
					'icon' => 'fas fa-pen-square',
				],
			]
		],
		'dn_page_repository_fragment_translate' => [
			'form' => '\Numbers\Documentation\Documentation\Form\Repository\Page\SubflowFragmentTranslate',
			'label_name' => 'Translate Fragment',
			'actions' => [
				'button' => [
					'label_name' => 'Translate Paragraph',
					'url_open' => true,
					'acl_controller_actions' => [['Edit', 'Record_Edit']],
					'icon' => 'far fa-flag',
				],
			]
		],
	];

	public function renderActions(& $form) {
		$params = [];
		$params['dn_repository_module_id'] = $params['__module_id'] = $form->values['__module_id'];
		$params['dn_repository_id'] = $form->values['dn_repository_id'];
		$params['dn_repository_version_id'] = $form->values['dn_repository_version_id'];
		$params['dn_repository_language_code'] = $form->values['dn_repository_language_code'];
		$params['dn_repopage_id'] = $form->values['dn_repopage_id'];
		// process subforms
		$menu = [
			'id' => 'form_repository_pages_menu',
			'align' => 'right',
			'options' => [
				'edit' => ['href' => 'javascript:void(0)', 'value' => i18n(null, 'Edit'), 'options' => [
					'dn_page_repository_page_edit' => null,
					'dn_page_repository_page_translate' => null,
				]],
				'new' => ['href' => 'javascript:void(0)', 'value' => i18n(null, 'New'), 'options' => [
					'dn_page_repository_fragment_new' => null,
				]],
			],
		];
		foreach ($menu['options'] as $k => $v) {
			foreach ($v['options'] as $k2 => $v2) {
				if ($v2 === null) {
					$temp = $form->generateSubformLink($k2, $this->subforms[$k2], $params, ['for_menu' => true]);
					if (!empty($temp)) {
						$menu['options'][$k]['options'][$k2] = $temp;
					} else {
						unset($menu['options'][$k]['options'][$k2]);
					}
				}
			}
			if (isset($menu['options'][$k]['options']) && empty($menu['options'][$k]['options'])) {
				unset($menu['options'][$k]);
			}
		}
		// breadcrumbs from parents
		$breadcrumbs = [];
		$temp = \Numbers\Documentation\Documentation\DataSource\Repository\PageBreadcrumbs::getStatic([
			'where' => [
				'dn_repopage_module_id' => $form->values['__module_id'],
				'dn_repopage_id' => $form->values['dn_repopage_id'],
				'dn_repopage_language_code' => $form->values['dn_repository_language_code'],
			]
		]);
		$current_parent_id = $temp[$form->values['dn_repopage_id']]['parent_id'];
		unset($temp[$form->values['dn_repopage_id']]);
		while (count($temp) > 0) {
			array_unshift($breadcrumbs, $temp[$current_parent_id]['name']);
			$current_parent_id2 = $current_parent_id;
			$current_parent_id = $temp[$current_parent_id]['parent_id'];
			unset($temp[$current_parent_id2]);
		}
		return '<table width="100%"><tr><td width="50%">' . implode(' / ', $breadcrumbs) . '</td><td width="50%" align="right">' . \HTML::menuMini($menu) . '</td></tr></table>';
	}

	public function renderChildPages(& $form) {
		$temp = \Numbers\Documentation\Documentation\DataSource\Repository\PageChildPages::getStatic([
			'where' => [
				'dn_repopage_module_id' => $form->values['__module_id'],
				'dn_repopage_id' => $form->values['dn_repopage_id'],
				'dn_repopage_language_code' => $form->values['dn_repository_language_code'],
				'only_one_parent' => true,
			]
		]);
		if (count($temp) > 0) {
			$result = '<br/><br/><hr/>';
			$result.= '<h5>' . i18n(null, 'Related pages') . ':' . '</h5>';
			foreach ($temp as $k => $v) {
				$name = $v['name'];
				// icon
				$v['icon'] = $v['icon'] ?? 'far fa-file-alt';
				if (!empty($v['icon'])) {
					$name = \HTML::icon(['type' => $v['icon']]) . ' ' . $name;
				}
				$href = \Request::buildURL(\Application::get('mvc.controller') . '/_Edit', [
					'dn_repository_module_id' => $form->values['__module_id'],
					'__module_id' => $form->values['__module_id'],
					'dn_repository_id' => $form->values['dn_repository_id'],
					'dn_repository_version_id' => $form->values['dn_repository_version_id'],
					'dn_repository_language_code' => $form->values['dn_repository_language_code'],
					'dn_repopage_id' => $v['id'],
				]);
				$result.= \HTML::a(['value' => $name, 'href' => $href]) . '<br/>';
			}
			return $result;
		}
	}
}