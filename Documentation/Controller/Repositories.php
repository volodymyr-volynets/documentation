<?php

namespace Numbers\Documentation\Documentation\Controller;
class Repositories extends \Object\Controller\Permission {
	public function actionIndex() {
		$form = new \Numbers\Documentation\Documentation\Form\List2\Repositories([
			'input' => \Request::input()
		]);
		echo $form->render();
	}
	public function actionEdit() {
		$form = new \Numbers\Documentation\Documentation\Form\Repositories([
			'input' => \Request::input()
		]);
		echo $form->render();
	}
	public function actionImport() {
		$form = new \Object\Form\Wrapper\Import([
			'model' => '\Numbers\Documentation\Documentation\Form\Repositories',
			'input' => \Request::input()
		]);
		echo $form->render();
	}
	public function actionActivate() {
		$form = new \Numbers\Documentation\Documentation\Form\Repository\NewVersion([
			'input' => \Request::input()
		]);
		echo $form->render();
	}
}