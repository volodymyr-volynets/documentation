<?php

/*
 * This file is part of Numbers Framework.
 *
 * (c) Volodymyr Volynets <volodymyr.volynets@gmail.com>
 *
 * This source file is subject to the Apache 2.0 license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Numbers\Documentation\Documentator\Controller;

use Numbers\Documentation\Documentator\Helper\Classes;
use Object\Controller\Authorized;

class ImportSchema extends Authorized
{
    public function actionIndex()
    {
        if (!\Application::get('debug.toolbar')) {
            throw new \Exception('You must enabled toolbar to view Dev. Portal.');
        }
        $form = new \Numbers\Documentation\Documentator\Form\ImportSchema([
            'input' => \Request::input()
        ]);
        echo $form->render();
    }

    public function actionIndex2()
    {
        if (!\Application::get('debug.toolbar')) {
            throw new \Exception('You must enabled toolbar to view Dev. Portal.');
        }
        // add your code here
        $model = new Classes();
        $model->loadAllDependencies();
        print_r2($model->generateDocumentationArray());
    }
}
