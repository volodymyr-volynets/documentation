<?php

/*
 * This file is part of Numbers Framework.
 *
 * (c) Volodymyr Volynets <volodymyr.volynets@gmail.com>
 *
 * This source file is subject to the Apache 2.0 license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Numbers\Documentation\Documentation\Controller\Repository;

use Numbers\Documentation\Documentation\Form\Repository\Page\Collection;
use Numbers\Documentation\Documentation\Helper\Renderer\PDF;
use Object\Controller\Permission;

class Pages extends Permission
{
    public function actionEdit()
    {
        $input = \Request::input();
        $hash = \Application::get('mvc.hash_parts');
        if (!empty($hash)) {
            $input['dn_repository_module_id'] = $input['__module_id'] = $hash[1];
            $input['dn_repository_id'] = $hash[2];
            $input['dn_repository_version_id'] = $hash[3];
            $input['dn_repository_language_code'] = $hash[4];
            $input['dn_repopage_id'] = $hash[5];
        }
        $form = new Collection([
            'input' => $input,
        ]);
        echo $form->render();
    }
    public function actionPDF()
    {
        $input = \Request::input();
        $crypt = new \Crypt();
        $token_data = $crypt->tokenVerify($input['token'] ?? '', ['print.pdf']);
        $hash = explode('::', $token_data['id']);
        $input['dn_repository_module_id'] = $input['__module_id'] = $hash[1];
        $input['dn_repository_id'] = $hash[2];
        $input['dn_repository_version_id'] = $hash[3];
        $input['dn_repository_language_code'] = $hash[4];
        $input['dn_repopage_id'] = $hash[5];
        PDF::render($input);
    }
}
