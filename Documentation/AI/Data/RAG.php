<?php

/*
 * This file is part of Numbers Framework.
 *
 * (c) Volodymyr Volynets <volodymyr.volynets@gmail.com>
 *
 * This source file is subject to the Apache 2.0 license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Numbers\Documentation\Documentation\AI\Data;

use Object\Import;

class RAG extends Import
{
    public $data = [
        'types' => [
            'options' => [
                'pk' => ['ai_ragtype_tenant_id', 'ai_ragtype_code'],
                'model' => '\Numbers\AI\SDK\Model\RAG\Types',
                'method' => 'save_insert_new',
                'submodule_exists' => ['Numbers.AI.SDK']
            ],
            'data' => [
                [
                    'ai_ragtype_tenant_id' => null,
                    'ai_ragtype_code' => 'DN::REPOSITORIES',
                    'ai_ragtype_name' => 'D/N Repositories',
                    'ai_ragtype_description' => 'Documentation repositories is used in this RAG.',
                    'ai_ragtype_model' => '\Numbers\Documentation\Documentation\Model\Embeddings',
                    'ai_ragtype_id_field_code' => 'dn_embedding_code',
                    'ai_ragtype_key_field_code' => 'dn_embedding_ai_ragtype_code',
                    'ai_ragtype_content_field_code' => 'dn_embedding_content',
                    'ai_ragtype_embeddings_field_code' => 'dn_embedding_embeddings',
                    'ai_ragtype_is_rag' => 1,
                    'ai_ragtype_fetch_counter' => 5,
                    'ai_ragtype_fetch_definition' => 1,
                    'ai_ragtype_inactive' => 0,
                ],
                [
                    'ai_ragtype_tenant_id' => null,
                    'ai_ragtype_code' => 'DN::PAGES',
                    'ai_ragtype_name' => 'D/N Pages',
                    'ai_ragtype_description' => 'Documentation pages is used in this RAG.',
                    'ai_ragtype_model' => '\Numbers\Documentation\Documentation\Model\Embeddings',
                    'ai_ragtype_id_field_code' => 'dn_embedding_code',
                    'ai_ragtype_key_field_code' => 'dn_embedding_ai_ragtype_code',
                    'ai_ragtype_content_field_code' => 'dn_embedding_content',
                    'ai_ragtype_embeddings_field_code' => 'dn_embedding_embeddings',
                    'ai_ragtype_is_rag' => 1,
                    'ai_ragtype_fetch_counter' => 5,
                    'ai_ragtype_fetch_definition' => 1,
                    'ai_ragtype_inactive' => 0,
                ],
                [
                    'ai_ragtype_tenant_id' => null,
                    'ai_ragtype_code' => 'DN::FRAGMENTS',
                    'ai_ragtype_name' => 'D/N Fragments',
                    'ai_ragtype_description' => 'Documentation fragments is used in this RAG.',
                    'ai_ragtype_model' => '\Numbers\Documentation\Documentation\Model\Embeddings',
                    'ai_ragtype_id_field_code' => 'dn_embedding_code',
                    'ai_ragtype_key_field_code' => 'dn_embedding_ai_ragtype_code',
                    'ai_ragtype_content_field_code' => 'dn_embedding_content',
                    'ai_ragtype_embeddings_field_code' => 'dn_embedding_embeddings',
                    'ai_ragtype_is_rag' => 1,
                    'ai_ragtype_fetch_counter' => 5,
                    'ai_ragtype_fetch_definition' => 1,
                    'ai_ragtype_inactive' => 0,
                ],
            ]
        ],
    ];
}
