<?php

/*
 * This file is part of Numbers Framework.
 *
 * (c) Volodymyr Volynets <volodymyr.volynets@gmail.com>
 *
 * This source file is subject to the Apache 2.0 license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Numbers\Documentation\Documentation\Model;

use Object\Table;

class Embeddings extends Table
{
    public $db_link;
    public $db_link_flag;
    public $module_code = 'DN';
    public $title = 'D/N Embeddings';
    public $name = 'dn_embeddings';
    public $pk = ['dn_embedding_tenant_id', 'dn_embedding_module_id', 'dn_embedding_code'];
    public $tenant = true;
    public $module = true;
    public $orderby = [
        'dn_embedding_inserted_timestamp' => SORT_DESC,
    ];
    public $limit;
    public $column_prefix = 'dn_embedding_';
    public $columns = [
        'dn_embedding_tenant_id' => ['name' => 'Tenant #', 'domain' => 'tenant_id'],
        'dn_embedding_module_id' => ['name' => 'Module #', 'domain' => 'module_id'],
        'dn_embedding_dn_repository_id' => ['name' => 'Repository #', 'domain' => 'repository_id'],
        'dn_embedding_code' => ['name' => 'Code', 'domain' => 'code'],
        'dn_embedding_hash_sha1' => ['name' => 'Hash (Sha1)', 'domain' => 'hash'], // used to verify if content exists
        'dn_embedding_content' => ['name' => 'Content', 'domain' => 'content'], // as markdown
        'dn_embedding_embeddings' => ['name' => 'Embeddings', 'type' => 'vector'],
        'dn_embedding_total_token_counter' => ['name' => 'Total Token Counter', 'domain' => 'bigcounter', 'default' => 0],
        // AI model
        'dn_embedding_ai_model_code' => ['name' => 'A/I Model Code', 'domain' => 'code255', 'null' => true],
        'dn_embedding_ai_ragtype_code' => ['name' => 'A/I RAG Type Code', 'domain' => 'code255', 'null' => true],
        // other
        'dn_embedding_inactive' => ['name' => 'Inactive', 'type' => 'boolean']
    ];
    public $constraints = [
        'dn_embeddings_pk' => ['type' => 'pk', 'columns' => ['dn_embedding_tenant_id', 'dn_embedding_module_id', 'dn_embedding_code']],
        'dn_embedding_ai_ragtype_code_fk' => [
            'type' => 'fk',
            'columns' => ['dn_embedding_tenant_id', 'dn_embedding_ai_ragtype_code'],
            'foreign_model' => '\Numbers\AI\SDK\Model\RAG\Types',
            'foreign_columns' => ['ai_ragtype_tenant_id', 'ai_ragtype_code']
        ],
        'dn_embedding_ai_model_code_fk' => [
            'type' => 'fk',
            'columns' => ['dn_embedding_tenant_id', 'dn_embedding_ai_model_code'],
            'foreign_model' => '\Numbers\AI\SDK\Model\Models',
            'foreign_columns' => ['ai_model_tenant_id', 'ai_model_code']
        ]
    ];
    public $indexes = [];
    public $history = false;
    public $audit = [];
    public $options_map = [];
    public $options_active = [];
    public $engine = [
        'MySQLi' => 'InnoDB'
    ];

    public $who = [
        'inserted' => true,
    ];

    public $cache = false;
    public $cache_tags = [];
    public $cache_memory = false;

    public $batches = [
        'map' => [
            'dn_embedding_tenant_id' => 'tm_batchrecord_tenant_id',
            'dn_embedding_code' => 'tm_batchrecord_field_value_code'
        ],
        'where' => [
            'tm_batchrecord_sm_model_code' => '\Numbers\Documentation\Documentation\Model\Embeddings',
            'tm_batchrecord_field_code' => 'dn_embedding_code',
        ],
        'edit' => [
            'batch_value' => 'tm_batchrecord_field_value_code',
            'batch_name' => 'D/N Embedding Code',
            //'edit_endpoint' => '/Numbers/Users/Chats/Controller/ChatPageStandalone/_Chat',
            'edit_key' => 'dn_embedding_code',
            //'list_endpoint' => '/Numbers/Users/Chats/Controller/ChatPageStandalone/_Chat',
            'list_key' => ['dn_embedding_code'],
        ],
    ];

    public $data_asset = [
        'classification' => 'client_confidential',
        'protection' => 2,
        'scope' => 'enterprise'
    ];
}
