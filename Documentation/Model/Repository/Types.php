<?php

/*
 * This file is part of Numbers Framework.
 *
 * (c) Volodymyr Volynets <volodymyr.volynets@gmail.com>
 *
 * This source file is subject to the Apache 2.0 license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Numbers\Documentation\Documentation\Model\Repository;

use Object\Data;

class Types extends Data
{
    public $module_code = 'DN';
    public $title = 'D/N Repository Types';
    public $column_key = 'dn_repotype_id';
    public $column_prefix = 'dn_repotype_';
    public $orderby;
    public $columns = [
        'dn_repotype_id' => ['name' => 'Type #', 'domain' => 'type_id'],
        'dn_repotype_name' => ['name' => 'Name', 'type' => 'text']
    ];
    public $data = [
        10 => ['dn_repotype_name' => 'Documentation'],
        20 => ['dn_repotype_name' => 'Template(s)'],
        30 => ['dn_repotype_name' => 'Blog'],
    ];
}
