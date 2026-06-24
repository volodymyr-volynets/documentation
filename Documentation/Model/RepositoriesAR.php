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

class RepositoriesAR extends ActiveRecord
{
    /**
     * @var string
     */
    public string $object_table_class = Repositories::class;

    /**
     * @var array
     */
    public array $object_table_pk = ['dn_repository_tenant_id','dn_repository_module_id','dn_repository_id'];

    /**
     * Tenant #
     *
     *
     *
     * {domain{tenant_id}}
     *
     * @var int|null Domain: tenant_id Type: integer
     */
    public int|null $dn_repository_tenant_id = null {
        get => $this->dn_repository_tenant_id;
        set {
            $this->setFullPkAndFilledColumn('dn_repository_tenant_id', $value);
            $this->dn_repository_tenant_id = $value;
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
    public int|null $dn_repository_module_id = null {
        get => $this->dn_repository_module_id;
        set {
            $this->setFullPkAndFilledColumn('dn_repository_module_id', $value);
            $this->dn_repository_module_id = $value;
        }
    }

    /**
     * Repository #
     *
     *
     *
     * {domain{repository_id_sequence}}
     *
     * @var int|null Domain: repository_id_sequence Type: serial
     */
    public int|null $dn_repository_id = null {
        get => $this->dn_repository_id;
        set {
            $this->setFullPkAndFilledColumn('dn_repository_id', $value);
            $this->dn_repository_id = $value;
        }
    }

    /**
     * Code
     *
     *
     *
     * {domain{group_code}}
     *
     * @var string|null Domain: group_code Type: varchar
     */
    public string|null $dn_repository_code = null {
        get => $this->dn_repository_code;
        set {
            $this->setFullPkAndFilledColumn('dn_repository_code', $value);
            $this->dn_repository_code = $value;
        }
    }

    /**
     * Type
     *
     *
     * {options_model{\Numbers\Documentation\Documentation\Model\Repository\Types}}
     * {domain{type_id}}
     *
     * @var int|null Domain: type_id Type: smallint
     */
    public int|null $dn_repository_type_id = null {
        get => $this->dn_repository_type_id;
        set {
            $this->setFullPkAndFilledColumn('dn_repository_type_id', $value);
            $this->dn_repository_type_id = $value;
        }
    }

    /**
     * Name
     *
     *
     *
     * {domain{name}}
     *
     * @var string|null Domain: name Type: varchar
     */
    public string|null $dn_repository_name = null {
        get => $this->dn_repository_name;
        set {
            $this->setFullPkAndFilledColumn('dn_repository_name', $value);
            $this->dn_repository_name = $value;
        }
    }

    /**
     * Icon
     *
     *
     *
     * {domain{icon}}
     *
     * @var string|null Domain: icon Type: varchar
     */
    public string|null $dn_repository_icon = null {
        get => $this->dn_repository_icon;
        set {
            $this->setFullPkAndFilledColumn('dn_repository_icon', $value);
            $this->dn_repository_icon = $value;
        }
    }

    /**
     * Public
     *
     *
     *
     *
     *
     * @var int|null Type: boolean
     */
    public int|null $dn_repository_public = 0 {
        get => $this->dn_repository_public;
        set {
            $this->setFullPkAndFilledColumn('dn_repository_public', $value);
            $this->dn_repository_public = $value;
        }
    }

    /**
     * Title Numbering
     *
     *
     *
     *
     *
     * @var int|null Type: boolean
     */
    public int|null $dn_repository_title_numbering = 0 {
        get => $this->dn_repository_title_numbering;
        set {
            $this->setFullPkAndFilledColumn('dn_repository_title_numbering', $value);
            $this->dn_repository_title_numbering = $value;
        }
    }

    /**
     * Default Language
     *
     *
     *
     * {domain{language_code}}
     *
     * @var string|null Domain: language_code Type: char
     */
    public string|null $dn_repository_default_language_code = null {
        get => $this->dn_repository_default_language_code;
        set {
            $this->setFullPkAndFilledColumn('dn_repository_default_language_code', $value);
            $this->dn_repository_default_language_code = $value;
        }
    }

    /**
     * Latest Version #
     *
     *
     *
     * {domain{version_id}}
     *
     * @var int|null Domain: version_id Type: integer
     */
    public int|null $dn_repository_latest_version_id = null {
        get => $this->dn_repository_latest_version_id;
        set {
            $this->setFullPkAndFilledColumn('dn_repository_latest_version_id', $value);
            $this->dn_repository_latest_version_id = $value;
        }
    }

    /**
     * Catalog Code
     *
     *
     *
     * {domain{group_code}}
     *
     * @var string|null Domain: group_code Type: varchar
     */
    public string|null $dn_repository_catalog_code = null {
        get => $this->dn_repository_catalog_code;
        set {
            $this->setFullPkAndFilledColumn('dn_repository_catalog_code', $value);
            $this->dn_repository_catalog_code = $value;
        }
    }

    /**
     * Description
     *
     *
     *
     * {domain{description}}
     *
     * @var string|null Domain: description Type: varchar
     */
    public string|null $dn_repository_description = null {
        get => $this->dn_repository_description;
        set {
            $this->setFullPkAndFilledColumn('dn_repository_description', $value);
            $this->dn_repository_description = $value;
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
    public int|null $dn_repository_inactive = 0 {
        get => $this->dn_repository_inactive;
        set {
            $this->setFullPkAndFilledColumn('dn_repository_inactive', $value);
            $this->dn_repository_inactive = $value;
        }
    }

    /**
     * Optimistic Lock
     *
     *
     *
     * {domain{optimistic_lock}}
     *
     * @var string|null Domain: optimistic_lock Type: timestamp
     */
    public string|null $dn_repository_optimistic_lock = 'now()' {
        get => $this->dn_repository_optimistic_lock;
        set {
            $this->setFullPkAndFilledColumn('dn_repository_optimistic_lock', $value);
            $this->dn_repository_optimistic_lock = $value;
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
    public string|null $dn_repository_inserted_timestamp = null {
        get => $this->dn_repository_inserted_timestamp;
        set {
            $this->setFullPkAndFilledColumn('dn_repository_inserted_timestamp', $value);
            $this->dn_repository_inserted_timestamp = $value;
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
    public int|null $dn_repository_inserted_user_id = null {
        get => $this->dn_repository_inserted_user_id;
        set {
            $this->setFullPkAndFilledColumn('dn_repository_inserted_user_id', $value);
            $this->dn_repository_inserted_user_id = $value;
        }
    }

    /**
     * Updated Datetime
     *
     *
     *
     *
     *
     * @var string|null Type: timestamp
     */
    public string|null $dn_repository_updated_timestamp = null {
        get => $this->dn_repository_updated_timestamp;
        set {
            $this->setFullPkAndFilledColumn('dn_repository_updated_timestamp', $value);
            $this->dn_repository_updated_timestamp = $value;
        }
    }

    /**
     * Updated User #
     *
     *
     *
     * {domain{user_id}}
     *
     * @var int|null Domain: user_id Type: bigint
     */
    public int|null $dn_repository_updated_user_id = null {
        get => $this->dn_repository_updated_user_id;
        set {
            $this->setFullPkAndFilledColumn('dn_repository_updated_user_id', $value);
            $this->dn_repository_updated_user_id = $value;
        }
    }
}
