<?php

namespace Numbers\Documentation\Documentator\Controller;
class ImportSchema extends \Object\Controller\Authorized {
	public function actionIndex() {
		if (!\Application::get('debug.toolbar')) {
			Throw new \Exception('You must enabled toolbar to view Dev. Portal.');
		}
		$form = new \Numbers\Documentation\Documentator\Form\ImportSchema([
			'input' => \Request::input()
		]);
		echo $form->render();
	}
}