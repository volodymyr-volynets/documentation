<?php

/*
 * This file is part of Numbers Framework.
 *
 * (c) Volodymyr Volynets <volodymyr.volynets@gmail.com>
 *
 * This source file is subject to the Apache 2.0 license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Numbers\Documentation\Documentation\Model\Transaction;

use Object\Data;

class EntryTypes extends Data
{
    public $module_code = 'AI';
    public $title = 'A/I Entry Types';
    public $column_key = 'ai_enttype_code';
    public $column_prefix = 'ai_enttype_';
    public $orderby = ['ai_enttype_order' => SORT_ASC];
    public $columns = [
        'ai_enttype_code' => ['name' => 'Entry Type', 'domain' => 'type_code'],
        'ai_enttype_name' => ['name' => 'Name', 'type' => 'text'],
        'ai_enttype_order' => ['name' => 'Order', 'domain' => 'order']
    ];
    public $data = [
        'DNR' => ['ai_enttype_name' => 'Repositories', 'ai_enttype_order' => 1000],
        'DNP' => ['ai_enttype_name' => 'Pages', 'ai_enttype_order' => 2000],
        'DNF' => ['ai_enttype_name' => 'Fragments', 'ai_enttype_order' => 3000],
        'DNE' => ['ai_enttype_name' => 'Embeddings', 'ai_enttype_order' => 4000],
    ];
}
