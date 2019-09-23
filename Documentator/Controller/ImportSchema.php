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

	public function actionIndex2() {
		if (!\Application::get('debug.toolbar')) {
			Throw new \Exception('You must enabled toolbar to view Dev. Portal.');
		}
		// add your code here
		$model = new \Numbers\Documentation\Documentator\Helper\Classes();
		$model->loadAllDependencies();
		print_r2($model->generateDocumentationArray());
	}
}