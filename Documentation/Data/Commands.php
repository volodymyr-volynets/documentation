<?php

/*
 * This file is part of Numbers Framework.
 *
 * (c) Volodymyr Volynets <volodymyr.volynets@gmail.com>
 *
 * This source file is subject to the Apache 2.0 license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Numbers\Documentation\Documentation\Data;

use Object\Import;

class Commands extends Import
{
    public $data = [
        'tasks' => [
            'options' => [
                'pk' => ['sm_shellcommand_code'],
                'model' => '\Numbers\Backend\System\ShellCommand\Model\ShellCommands',
                'method' => 'save'
            ],
            'data' => [
                [
                    'sm_shellcommand_code' => 'DN::LOAD_REPOSITORY',
                    'sm_shellcommand_name' => 'D/N Load Repository (Command)',
                    'sm_shellcommand_description' => 'Use this command to load repository.',
                    'sm_shellcommand_model' => '\Numbers\Documentation\Documentation\Command\LoadRepository',
                    'sm_shellcommand_command' => 'dn_load_repository',
                    'sm_shellcommand_module_code' => 'DN',
                    'sm_shellcommand_inactive' => 0,
                ],
            ],
        ],
    ];
}
