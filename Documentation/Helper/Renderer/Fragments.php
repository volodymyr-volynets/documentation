<?php

namespace Numbers\Documentation\Documentation\Helper\Renderer;
class Fragments {

	/**
	 * Render
	 *
	 * @param object $form
	 */
	public static function renderForm(& $form, & $options, & $value, & $neighbouring_values) {
		$params = [];
		$params['dn_repository_module_id'] = $params['__module_id'] = $form->values['__module_id'];
		$params['dn_repository_id'] = $form->values['dn_repository_id'];
		$params['dn_repository_version_id'] = $form->values['dn_repository_version_id'];
		$params['dn_repository_language_code'] = $form->values['dn_repository_language_code'];
		$params['dn_repopage_id'] = $form->values['dn_repopage_id'];
		$result = '';
		foreach ($form->values['\Numbers\Documentation\Documentation\Model\Repository\Version\Page\Fragments'] as $k0 => $v0) {
			$v0['dn_repository_language_code'] = $form->values['dn_repository_language_code'];
			// menu
			$menu = [
				'id' => 'form_repository_pages_menu_' . $v0['dn_repopgfragm_id'],
				'align' => 'right',
				'options' => [
					'edit' => ['href' => 'javascript:void(0)', 'value' => i18n(null, 'Edit'), 'options' => []],
				],
			];
			// special fragments
			if (in_array($v0['dn_repopgfragm_type_code'], ['TEXT', 'NOTE', 'CODE', 'QUOTE'])) {
				$menu['options']['edit']['options'] = [
					'dn_page_repository_fragment_edit' => null,
					'dn_page_repository_fragment_translate' => null,
					'dn_page_repository_fragment_delete' => null,
				];
			} else if (in_array($v0['dn_repopgfragm_type_code'], ['FILE', 'IMAGE'])) {
				$menu['options']['edit']['options'] = [
					'dn_page_repository_fragment_file_edit' => null,
					'dn_page_repository_fragment_file_translate' => null,
					'dn_page_repository_fragment_delete' => null,
				];
			}
			foreach ($menu['options'] as $k => $v) {
				foreach ($v['options'] as $k2 => $v2) {
					if ($v2 === null) {
						$params['dn_repopgfragm_id'] = $params['dn_repofragtransl_repopgfragm_id'] = $v0['dn_repopgfragm_id'];
						$params['dn_repofragtransl_type_code'] = $v0['dn_repopgfragm_type_code'];
						$temp = $form->generateSubformLink($k2, $form->form_parent->subforms[$k2], $params, ['for_menu' => true]);
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
			// languages
			if (!empty($v0['\Numbers\Documentation\Documentation\Model\Repository\Version\Page\Fragment\Translations'])) {
				$temp = current($v0['\Numbers\Documentation\Documentation\Model\Repository\Version\Page\Fragment\Translations']);
				$language = \Numbers\Internalization\Internalization\Helper\Languages::renderOneLanguage($temp['dn_repofragtransl_language_code']);
			} else {
				$language = \Numbers\Internalization\Internalization\Helper\Languages::renderOneLanguage($v0['dn_repopgfragm_language_code']);
			}
			$languages2 = '<div class="form_dn_page_repository_page_view_form_language">';
				$languages2.= i18n(null, 'Language') . ': ' . $language . ' ';
				$languages = \Numbers\Documentation\Documentation\DataSource\Repository\FragmentLanguages::getStatic([
					'where' => [
						'dn_repopgfragm_module_id' => $v0['dn_repopgfragm_module_id'],
						'dn_repopgfragm_id' => $v0['dn_repopgfragm_id'],
						'only_language_codes' => true,
						'only_with_translations' => true,
					]
				]);
				$temp = [];
				foreach ($languages as $k => $v) {
					$temp[] = \Numbers\Internalization\Internalization\Helper\Languages::renderOneLanguage($k);
				}
				$languages2.= i18n(null, 'Available') . ': ' . implode(' ', $temp);
			$languages2.= '</div>';
			// render
			$result.= '<div class="form_dn_page_repository_page_view_form_fragment_holder">';
				$result.= '<table width="100%"><tr><td width="50%">' . $languages2 . '</td><td width="50%" align="right">' . \HTML::menuMini($menu) . '</td></tr></table>';
				$result.= self::{'renderForm' . $v0['dn_repopgfragm_type_code']}($v0);
			$result.= '</div>';
		}
		return $result;
	}

	/**
	 * Code fragment
	 *
	 * @param array $value
	 * @return string
	 */
	public static function renderFormCODE($value) {
		$translation = current($value['\Numbers\Documentation\Documentation\Model\Repository\Version\Page\Fragment\Translations']);
		if (!empty($translation)) {
			$name = $translation['dn_repofragtransl_name'] ?? $value['dn_repopgfragm_name'];
			$body = $translation['dn_repofragtransl_body'] ?? $value['dn_repopgfragm_body'];
		} else {
			$name = $value['dn_repopgfragm_name'];
			$body = $value['dn_repopgfragm_body'];
		}
		$result = '';
		$result.= '<div class="form_dn_page_repository_page_view_form_fragment_code_pre">' . \HTML::highlight(['value' => $body]) . '</div>';
		if (!empty($name)) {
			$result.= \HTML::div(['class' => 'form_dn_page_repository_page_view_form_fragment_code_title', 'value' => $name]);
		}
		return $result;
	}

	/**
	 * Text fragment
	 *
	 * @param array $value
	 * @return string
	 */
	public static function renderFormTEXT($value) {
		$translation = current($value['\Numbers\Documentation\Documentation\Model\Repository\Version\Page\Fragment\Translations']);
		if (!empty($translation)) {
			$name = $translation['dn_repofragtransl_name'] ?? $value['dn_repopgfragm_name'];
			$body = $translation['dn_repofragtransl_body'] ?? $value['dn_repopgfragm_body'];
		} else {
			$name = $value['dn_repopgfragm_name'];
			$body = $value['dn_repopgfragm_body'];
		}
		$result = '';
		if (!empty($name)) {
			$result.= \HTML::tag(['tag' => 'h4', 'value' => $name]);
		}
		$body = self::processLinks($value, $body);
		$result.= \HTML::div(['value' => $body]);
		return $result;
	}

	/**
	 * Note fragment
	 *
	 * @param array $value
	 * @return string
	 */
	public static function renderFormNOTE($value) {
		$translation = current($value['\Numbers\Documentation\Documentation\Model\Repository\Version\Page\Fragment\Translations']);
		if (!empty($translation)) {
			$name = $translation['dn_repofragtransl_name'] ?? $value['dn_repopgfragm_name'];
			$body = $translation['dn_repofragtransl_body'] ?? $value['dn_repopgfragm_body'];
		} else {
			$name = $value['dn_repopgfragm_name'];
			$body = $value['dn_repopgfragm_body'];
		}
		$result = '<div class="form_dn_page_repository_page_view_form_fragment_note">';
			if (!empty($name)) {
				$result.= \HTML::tag(['tag' => 'h4', 'value' => $name]);
			}
			$body = self::processLinks($value, $body);
			$result.= \HTML::div(['value' => $body]);
		$result.= '</div>';
		return $result;
	}

	/**
	 * Quote fragment
	 *
	 * @param array $value
	 * @return string
	 */
	public static function renderFormQUOTE($value) {
		$translation = current($value['\Numbers\Documentation\Documentation\Model\Repository\Version\Page\Fragment\Translations']);
		if (!empty($translation)) {
			$name = $translation['dn_repofragtransl_name'] ?? $value['dn_repopgfragm_name'];
			$body = $translation['dn_repofragtransl_body'] ?? $value['dn_repopgfragm_body'];
		} else {
			$name = $value['dn_repopgfragm_name'];
			$body = $value['dn_repopgfragm_body'];
		}
		$result = '<div class="form_dn_page_repository_page_view_form_fragment_quote">';
			if (!empty($name)) {
				$name = \HTML::tag(['tag' => 'h4', 'value' => $name]);
			}
			$body = self::processLinks($value, $body);
			$result.= \HTML::callout(['type' => 'default', 'value' => $name . $body]);
		$result.= '</div>';
		return $result;
	}

	/**
	 * File fragment
	 *
	 * @param array $value
	 * @return string
	 */
	public static function renderFormFILE($value) {
		$translation = current($value['\Numbers\Documentation\Documentation\Model\Repository\Version\Page\Fragment\Translations']);
		if (!empty($translation)) {
			$name = $translation['dn_repofragtransl_name'] ?? $value['dn_repopgfragm_name'];
			$body = \Numbers\Users\Widgets\Comments\Helper\Files::generateURLS($translation, 'dn_repofragtransl_file_', 10);
		} else {
			$name = $value['dn_repopgfragm_name'];
			$body = \Numbers\Users\Widgets\Comments\Helper\Files::generateURLS($value, 'dn_repopgfragm_file_', 10);
		}
		$result = '<div class="form_dn_page_repository_page_view_form_fragment_file">';
			$result.= \HTML::div(['value' => $body]);
			if (!empty($name)) {
				$result.= \HTML::div(['class' => 'form_dn_page_repository_page_view_form_fragment_code_title', 'value' => $name]);
			}
		$result.= '</div>';
		return $result;
	}

	/**
	 * Image fragment
	 *
	 * @param array $value
	 * @return string
	 */
	public static function renderFormIMAGE($value) {
		$translation = current($value['\Numbers\Documentation\Documentation\Model\Repository\Version\Page\Fragment\Translations']);
		$body = '';
		if (!empty($translation)) {
			$name = $translation['dn_repofragtransl_name'] ?? $value['dn_repopgfragm_name'];
			$temp_body = \Numbers\Users\Widgets\Comments\Helper\Files::generateOnlyURLS($translation, 'dn_repofragtransl_file_', 10);
		} else {
			$name = $value['dn_repopgfragm_name'];
			$temp_body = \Numbers\Users\Widgets\Comments\Helper\Files::generateOnlyURLS($value, 'dn_repopgfragm_file_', 10);
		}
		foreach ($temp_body as $v) {
			$body.= \HTML::img(['src' => $v['href'], 'alt' => $v['name'], 'width' => '100%']) . '<br/>';
		}
		$result = '<div class="form_dn_page_repository_page_view_form_fragment_file">';
			$result.= \HTML::div(['value' => $body]);
			if (!empty($name)) {
				$result.= \HTML::div(['class' => 'form_dn_page_repository_page_view_form_fragment_code_title', 'value' => $name]);
			}
		$result.= '</div>';
		return $result;
	}

	/**
	 * Process links
	 *
	 * @param array $value
	 * @param string $body
	 * @return string
	 */
	public static function processLinks(array $value, string $body) : string {
		$matches = \Helper\Parser::match($body, '[href[', ']]', ['all' => true]);
		$translation = current($value['\Numbers\Documentation\Documentation\Model\Repository\Version\Page\Fragment\Translations']);
		if (!empty($matches)) {
			foreach ($matches as $k => $v) {
				$page = \Numbers\Documentation\Documentation\Helper\Pages::fetchOnePage($value['dn_repopgfragm_module_id'], $value['dn_repopgfragm_repository_id'], $value['dn_repopgfragm_version_id'], $value['dn_repopgfragm_language_code'], $v);
				$hash = \Request::hash([
					$value['dn_repopgfragm_module_id'],
					$value['dn_repopgfragm_repository_id'],
					$value['dn_repopgfragm_version_id'],
					$value['dn_repository_language_code'],
					$page['dn_repopage_id'],
				]);
				$filename = $v . '.html';
				$filename = str_replace('/', '', $filename);
				$filename = urlencode($filename);
				$href = \Request::buildURL(\Application::get('mvc.controller') . '/_Edit/' . $hash . '/' . $filename, [], '', 'page_title');
				$body = str_replace('[href[' . $v . ']]', $href, $body);
			}
		}
		return $body;
	}
}