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

use Object\ActiveRecord;

class EmbeddingsAR extends ActiveRecord
{
    /**
     * @var string
     */
    public string $object_table_class = Embeddings::class;

    /**
     * @var array
     */
    public array $object_table_pk = ['dn_embedding_tenant_id','dn_embedding_module_id','dn_embedding_code'];

    /**
     * Tenant #
     *
     *
     *
     * {domain{tenant_id}}
     *
     * @var int|null Domain: tenant_id Type: integer
     */
    public int|null $dn_embedding_tenant_id = null {
        get => $this->dn_embedding_tenant_id;
        set {
            $this->setFullPkAndFilledColumn('dn_embedding_tenant_id', $value);
            $this->dn_embedding_tenant_id = $value;
        }
    }

    /**
     * Module #
     *
     *
     *
     * {domain{module_id}}
     *
     * @var int|null Domain: module_id Type: integer
     */
    public int|null $dn_embedding_module_id = null {
        get => $this->dn_embedding_module_id;
        set {
            $this->setFullPkAndFilledColumn('dn_embedding_module_id', $value);
            $this->dn_embedding_module_id = $value;
        }
    }

    /**
     * Repository #
     *
     *
     *
     * {domain{repository_id}}
     *
     * @var int|null Domain: repository_id Type: integer
     */
    public int|null $dn_embedding_dn_repository_id = null {
        get => $this->dn_embedding_dn_repository_id;
        set {
            $this->setFullPkAndFilledColumn('dn_embedding_dn_repository_id', $value);
            $this->dn_embedding_dn_repository_id = $value;
        }
    }

    /**
     * Code
     *
     *
     *
     * {domain{code}}
     *
     * @var string|null Domain: code Type: varchar
     */
    public string|null $dn_embedding_code = null {
        get => $this->dn_embedding_code;
        set {
            $this->setFullPkAndFilledColumn('dn_embedding_code', $value);
            $this->dn_embedding_code = $value;
        }
    }

    /**
     * Hash (Sha1)
     *
     *
     *
     * {domain{hash}}
     *
     * @var string|null Domain: hash Type: varchar
     */
    public string|null $dn_embedding_hash_sha1 = null {
        get => $this->dn_embedding_hash_sha1;
        set {
            $this->setFullPkAndFilledColumn('dn_embedding_hash_sha1', $value);
            $this->dn_embedding_hash_sha1 = $value;
        }
    }

    /**
     * Content
     *
     *
     *
     * {domain{content}}
     *
     * @var string|null Domain: content Type: text
     */
    public string|null $dn_embedding_content = null {
        get => $this->dn_embedding_content;
        set {
            $this->setFullPkAndFilledColumn('dn_embedding_content', $value);
            $this->dn_embedding_content = $value;
        }
    }

    /**
     * Embeddings
     *
     *
     *
     *
     *
     * @var mixed Type: vector
     */
    public mixed $dn_embedding_embeddings = null {
        get => $this->dn_embedding_embeddings;
        set {
            $this->setFullPkAndFilledColumn('dn_embedding_embeddings', $value);
            $this->dn_embedding_embeddings = $value;
        }
    }

    /**
     * Total Token Counter
     *
     *
     *
     * {domain{bigcounter}}
     *
     * @var int|null Domain: bigcounter Type: bigint
     */
    public int|null $dn_embedding_total_token_counter = 0 {
        get => $this->dn_embedding_total_token_counter;
        set {
            $this->setFullPkAndFilledColumn('dn_embedding_total_token_counter', $value);
            $this->dn_embedding_total_token_counter = $value;
        }
    }

    /**
     * A/I Model Code
     *
     *
     *
     * {domain{code255}}
     *
     * @var string|null Domain: code255 Type: varchar
     */
    public string|null $dn_embedding_ai_model_code = null {
        get => $this->dn_embedding_ai_model_code;
        set {
            $this->setFullPkAndFilledColumn('dn_embedding_ai_model_code', $value);
            $this->dn_embedding_ai_model_code = $value;
        }
    }

    /**
     * A/I RAG Type Code
     *
     *
     *
     * {domain{code255}}
     *
     * @var string|null Domain: code255 Type: varchar
     */
    public string|null $dn_embedding_ai_ragtype_code = null {
        get => $this->dn_embedding_ai_ragtype_code;
        set {
            $this->setFullPkAndFilledColumn('dn_embedding_ai_ragtype_code', $value);
            $this->dn_embedding_ai_ragtype_code = $value;
        }
    }

    /**
     * Inactive
     *
     *
     *
     *
     *
     * @var int|null Type: boolean
     */
    public int|null $dn_embedding_inactive = 0 {
        get => $this->dn_embedding_inactive;
        set {
            $this->setFullPkAndFilledColumn('dn_embedding_inactive', $value);
            $this->dn_embedding_inactive = $value;
        }
    }

    /**
     * Inserted Datetime
     *
     *
     *
     *
     *
     * @var string|null Type: timestamp
     */
    public string|null $dn_embedding_inserted_timestamp = null {
        get => $this->dn_embedding_inserted_timestamp;
        set {
            $this->setFullPkAndFilledColumn('dn_embedding_inserted_timestamp', $value);
            $this->dn_embedding_inserted_timestamp = $value;
        }
    }

    /**
     * Inserted User #
     *
     *
     *
     * {domain{user_id}}
     *
     * @var int|null Domain: user_id Type: bigint
     */
    public int|null $dn_embedding_inserted_user_id = null {
        get => $this->dn_embedding_inserted_user_id;
        set {
            $this->setFullPkAndFilledColumn('dn_embedding_inserted_user_id', $value);
            $this->dn_embedding_inserted_user_id = $value;
        }
    }
}
