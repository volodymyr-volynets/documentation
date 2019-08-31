<?php

namespace Numbers\Documentation\Documentation\Helper\Renderer;
class Titles {

	/**
	 * Render
	 *
	 * @param object $form
	 */
	public static function renderForm(& $form, & $options, & $value, & $neighbouring_values) {
		$result = '';
		$result.= '<h1>';
		if (!empty($form->values['dn_repopage_title_number'])) {
			$result.= \Format::id($form->values['dn_repopage_title_number']) . ' ';
		}
		if (!empty($form->values['\Numbers\Documentation\Documentation\Model\Repository\Version\Page\Translations'])) {
			$temp = current($form->values['\Numbers\Documentation\Documentation\Model\Repository\Version\Page\Translations']);
			$result.= $temp['dn_repopgtransl_name'];
			$language = \Numbers\Internalization\Internalization\Helper\Languages::renderOneLanguage($temp['dn_repopgtransl_language_code']);
		} else {
			$result.= $form->values['dn_repopage_name'];
			$language = \Numbers\Internalization\Internalization\Helper\Languages::renderOneLanguage($form->values['dn_repopage_language_code']);
		}
		$result.= '</h1>';
		// other info
		$result.= '<div class="form_dn_page_repository_page_view_form_language">';
			$result.= i18n(null, 'Language') . ': ' . $language . ' ';
			$languages = \Numbers\Documentation\Documentation\DataSource\Repository\PageLanguages::getStatic([
				'where' => [
					'dn_repopage_module_id' => $form->values['dn_repopage_module_id'],
					'dn_repopage_id' => $form->values['dn_repopage_id'],
					'only_language_codes' => true,
					'only_with_translations' => true,
				]
			]);
			$temp = [];
			foreach ($languages as $k => $v) {
				$temp[] = \Numbers\Internalization\Internalization\Helper\Languages::renderOneLanguage($k);
			}
			$result.= i18n(null, 'Available') . ': ' . implode(' ', $temp);
		$result.= '</div>';
		// who
		$result.= '<div class="form_dn_page_repository_page_view_form_who">' . i18n(null, 'Created by [username] on [timestamp].', [
			'replace' => [
				'[username]' => \Numbers\Users\Users\Model\Users::getUsername($form->values['dn_repopage_inserted_user_id']),
				'[timestamp]' => \Format::datetime($form->values['dn_repopage_inserted_timestamp']),
			]
		]) . '</div>';
		if (!empty($form->values['dn_repopage_updated_user_id'])) {
			$result.= '<div class="form_dn_page_repository_page_view_form_who">' . i18n(null, 'Updated by [username] on [timestamp].', [
				'replace' => [
					'[username]' => \Numbers\Users\Users\Model\Users::getUsername($form->values['dn_repopage_updated_user_id']),
					'[timestamp]' => \Format::datetime($form->values['dn_repopage_updated_timestamp']),
				]
			]) . '</div>';
		}
		return $result;
	}
}
