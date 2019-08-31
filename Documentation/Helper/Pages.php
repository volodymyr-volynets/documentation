<?php

namespace Numbers\Documentation\Documentation\Helper;
class Pages {

	/**
	 * Fetch one page
	 *
	 * @param int $module_id
	 * @param int $repository_id
	 * @param int $version_id
	 * @param string $language_code
	 * @param string $page_title
	 * @param int $parent_id
	 * @return array
	 */
	public static function fetchOnePage(int $module_id, int $repository_id, int $version_id, string $language_code, string $page_title, int $parent_id = 0) {
		if (empty($parent_id)) {
			return \Numbers\Documentation\Documentation\Model\Repository\Version\Pages::getStatic([
				'where' => [
					'dn_repopage_module_id' => $module_id,
					'dn_repopage_repository_id' => $repository_id,
					'dn_repopage_version_id' => $version_id,
					'dn_repopage_name' => $page_title,
				],
				'pk' => null,
				'single_row' => true,
			]);
		} else {
			return \Numbers\Documentation\Documentation\DataSource\Repository\PageChildPages::getStatic([
				'where' => [
					'dn_repopage_module_id' => $module_id,
					'dn_repopage_id' => $parent_id,
					'dn_repopage_language_code' => 'eng',
					'only_one_title' => $page_title,
				],
				'pk' => null,
				'single_row' => true,
			]);
		}
	}

	/**
	 * Check if fragment exists
	 *
	 * @param int $module_id
	 * @param int $page_id
	 * @param int $order
	 * @return array
	 */
	public static function fragmentExistsByOrder(int $module_id, int $page_id, int $order) {
		return \Numbers\Documentation\Documentation\Model\Repository\Version\Page\Fragments::getStatic([
			'where' => [
				'dn_repopgfragm_module_id' => $module_id,
				'dn_repopgfragm_repopage_id' => $page_id,
				'dn_repopgfragm_order' => $order,
			],
			'pk' => null,
			'single_row' => true,
		]);
	}
}
