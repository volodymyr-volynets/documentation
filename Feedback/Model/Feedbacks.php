<?php

/*
 * This file is part of Numbers Framework.
 *
 * (c) Volodymyr Volynets <volodymyr.volynets@gmail.com>
 *
 * This source file is subject to the Apache 2.0 license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Numbers\Documentation\Feedback\Model;

use Object\Table;

class Feedbacks extends Table
{
    public $db_link;
    public $db_link_flag;
    public $module_code = 'F8';
    public $title = 'F/8 Feedbacks';
    public $schema;
    public $name = 'f8_feedbacks';
    public $pk = ['f8_feedback_tenant_id', 'f8_feedback_id'];
    public $tenant = true;
    public $orderby;
    public $limit;
    public $column_prefix = 'f8_feedback_';
    public $columns = [
        'f8_feedback_tenant_id' => ['name' => 'Tenant #', 'domain' => 'tenant_id'],
        'f8_feedback_id' => ['name' => 'Feedback #', 'domain' => 'feedback_id_sequence'],
        'f8_feedback_f8_type_code' => ['name' => 'Type Code', 'domain' => 'group_code'],
        'f8_feedback_controller_name' => ['name' => 'Controller Name', 'domain' => 'name'],
        'f8_feedback_stars' => ['name' => 'Feedback Stars', 'domain' => 'feedback_stars', 'null' => true],
        'f8_feedback_note' => ['name' => 'Feedback Note', 'domain' => 'feedback_note', 'null' => true],
        'f8_feedback_um_user_id' => ['name' => 'User #', 'domain' => 'user_id', 'null' => true],
        'f8_feedback_um_user_name' => ['name' => 'User Name', 'domain' => 'name', 'null' => true],
        'f8_feedback_inactive' => ['name' => 'Inactive', 'type' => 'boolean']
    ];
    public $constraints = [
        'f8_feedbacks_pk' => ['type' => 'pk', 'columns' => ['f8_feedback_tenant_id', 'f8_feedback_id']],
        'f8_feedback_f8_type_code_fk' => [
            'type' => 'fk',
            'columns' => ['f8_feedback_tenant_id', 'f8_feedback_f8_type_code'],
            'foreign_model' => '\Numbers\Documentation\Feedback\Model\Types',
            'foreign_columns' => ['f8_type_tenant_id', 'f8_type_code']
        ]
    ];
    public $indexes = [];
    public $history = false;
    public $audit = [];
    public $optimistic_lock = false;
    public $options_map = [];
    public $options_active = [];
    public $engine = [
        'MySQLi' => 'InnoDB'
    ];

    public $cache = false;
    public $cache_tags = [];
    public $cache_memory = false;

    public $who = [
        'inserted' => true,
    ];

    public $data_asset = [
        'classification' => 'client_confidential',
        'protection' => 2,
        'scope' => 'enterprise'
    ];
}
