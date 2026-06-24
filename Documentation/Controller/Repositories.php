<?php

/*
 * This file is part of Numbers Framework.
 *
 * (c) Volodymyr Volynets <volodymyr.volynets@gmail.com>
 *
 * This source file is subject to the Apache 2.0 license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Numbers\Documentation\Documentation\Controller;

use Numbers\Documentation\Documentation\Form\Repository\NewVersion;
use Object\Controller\Permission;
use Object\Form\Wrapper\Import;

class Repositories extends Permission
{
    public function actionIndex()
    {
        $form = new \Numbers\Documentation\Documentation\Form\List2\Repositories([
            'input' => \Request::input()
        ]);
        echo $form->render();
    }
    public function actionEdit()
    {
        $form = new \Numbers\Documentation\Documentation\Form\Repositories([
            'input' => \Request::input()
        ]);
        echo $form->render();
    }
    public function actionImport()
    {
        $form = new Import([
            'model' => '\Numbers\Documentation\Documentation\Form\Repositories',
            'input' => \Request::input()
        ]);
        echo $form->render();
    }
    public function actionActivate()
    {
        $form = new NewVersion([
            'input' => \Request::input()
        ]);
        echo $form->render();
    }
}
