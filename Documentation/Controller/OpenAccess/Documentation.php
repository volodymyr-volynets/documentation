<?php

namespace Numbers\Documentation\Documentation\Controller\OpenAccess;
class Documentation extends \Object\Controller {
	public function actionIndex() {
		\Layout::$title_override = 'Documentation';
		\Layout::$icon_override = 'fas fa-font';
		// we need to set 100% width
		\Object\Controller::$main_content_class = 'container-fluid';
		// render pages
		$input = \Request::input();
		$hash = \Application::get('mvc.hash_parts');
		if (!empty($hash)) {
			$input['dn_repository_id'] = $hash[2];
			$input['dn_repository_version_id'] = $hash[3];
			$input['dn_repository_language_code'] = $hash[4];
			$input['dn_repopage_id'] = $hash[5];
		}
		$input['dn_repository_module_id'] = $input['__module_id'] = $input['dn_repopage_module_id'] = $input['dn_repoversion_module_id'] = \Registry::get('websites.OpenAccess.dn_repository_module_id');
		$form = new \Numbers\Documentation\Documentation\Form\Repository\OpenAccess\Collection([
			'input' => $input
		]);
		echo $form->render();
	}
}