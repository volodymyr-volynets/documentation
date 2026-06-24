<?php

/*
 * This file is part of Numbers Framework.
 *
 * (c) Volodymyr Volynets <volodymyr.volynets@gmail.com>
 *
 * This source file is subject to the Apache 2.0 license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Numbers\Documentation\Feedback\Controller;

use Object\Controller;

class Feedback extends Controller
{
    public function actionEdit()
    {
        $form = new \Numbers\Documentation\Feedback\Form\Feedback([
            'input' => \Request::input()
        ]);
        echo $form->render();
    }
}
