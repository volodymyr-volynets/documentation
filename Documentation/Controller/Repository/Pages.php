<?php

namespace Numbers\Documentation\Documentation\Controller\Repository;
class Pages extends \Object\Controller\Permission {
	/*
	public function actionIndex() {
		$form = new \Numbers\Documentation\Documentation\Form\List2\Repositories([
			'input' => \Request::input()
		]);
		echo $form->render();
	}
	*/
	public function actionEdit() {
		$input = \Request::input();
		$hash = \Application::get('mvc.hash_parts');
		if (!empty($hash)) {
			$input['dn_repository_module_id'] = $input['__module_id'] = $hash[1];
			$input['dn_repository_id'] = $hash[2];
			$input['dn_repository_version_id'] = $hash[3];
			$input['dn_repository_language_code'] = $hash[4];
			$input['dn_repopage_id'] = $hash[5];
		}
		$form = new \Numbers\Documentation\Documentation\Form\Repository\Page\Collection([
			'input' => $input,
		]);
		echo $form->render();
	}
	/*
	public function actionImport() {
		$form = new \Object\Form\Wrapper\Import([
			'model' => '\Numbers\Documentation\Documentation\Form\Repositories',
			'input' => \Request::input()
		]);
		echo $form->render();
	}
	*/
}