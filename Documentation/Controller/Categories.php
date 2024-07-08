<?php

namespace Numbers\Documentation\Documentation\Controller;
class Categories extends \Object\Controller\Permission {
	public function actionIndex() {
		$form = new \Numbers\Documentation\Documentation\Form\List2\Categories([
			'input' => \Request::input()
		]);
		echo $form->render();
	}
	public function actionEdit() {
		$form = new \Numbers\Documentation\Documentation\Form\Categories([
			'input' => \Request::input()
		]);
		echo $form->render();
	}
	public function actionImport() {
		$form = new \Object\Form\Wrapper\Import([
			'model' => \Numbers\Documentation\Documentation\Form\Categories::class,
			'input' => \Request::input()
		]);
		echo $form->render();
	}
}