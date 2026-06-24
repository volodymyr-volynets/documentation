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

use Object\ActiveRecord;

class TypesAR extends ActiveRecord
{
    /**
     * @var string
     */
    public string $object_table_class = Types::class;

    /**
     * @var array
     */
    public array $object_table_pk = ['f8_type_tenant_id','f8_type_code'];

    /**
     * Tenant #
     *
     *
     *
     * {domain{tenant_id}}
     *
     * @var int|null Domain: tenant_id Type: integer
     */
    public int|null $f8_type_tenant_id = null {
        get => $this->f8_type_tenant_id;
        set {
            $this->setFullPkAndFilledColumn('f8_type_tenant_id', $value);
            $this->f8_type_tenant_id = $value;
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
    public string|null $f8_type_code = null {
        get => $this->f8_type_code;
        set {
            $this->setFullPkAndFilledColumn('f8_type_code', $value);
            $this->f8_type_code = $value;
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
    public string|null $f8_type_name = null {
        get => $this->f8_type_name;
        set {
            $this->setFullPkAndFilledColumn('f8_type_name', $value);
            $this->f8_type_name = $value;
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
    public string|null $f8_type_icon = null {
        get => $this->f8_type_icon;
        set {
            $this->setFullPkAndFilledColumn('f8_type_icon', $value);
            $this->f8_type_icon = $value;
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
    public string|null $f8_type_description = null {
        get => $this->f8_type_description;
        set {
            $this->setFullPkAndFilledColumn('f8_type_description', $value);
            $this->f8_type_description = $value;
        }
    }

    /**
     * Primary
     *
     *
     *
     *
     *
     * @var int|null Type: boolean
     */
    public int|null $f8_type_primary = 0 {
        get => $this->f8_type_primary;
        set {
            $this->setFullPkAndFilledColumn('f8_type_primary', $value);
            $this->f8_type_primary = $value;
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
    public int|null $f8_type_inactive = 0 {
        get => $this->f8_type_inactive;
        set {
            $this->setFullPkAndFilledColumn('f8_type_inactive', $value);
            $this->f8_type_inactive = $value;
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
    public string|null $f8_type_optimistic_lock = 'now()' {
        get => $this->f8_type_optimistic_lock;
        set {
            $this->setFullPkAndFilledColumn('f8_type_optimistic_lock', $value);
            $this->f8_type_optimistic_lock = $value;
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
    public string|null $f8_type_inserted_timestamp = null {
        get => $this->f8_type_inserted_timestamp;
        set {
            $this->setFullPkAndFilledColumn('f8_type_inserted_timestamp', $value);
            $this->f8_type_inserted_timestamp = $value;
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
    public int|null $f8_type_inserted_user_id = null {
        get => $this->f8_type_inserted_user_id;
        set {
            $this->setFullPkAndFilledColumn('f8_type_inserted_user_id', $value);
            $this->f8_type_inserted_user_id = $value;
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
    public string|null $f8_type_updated_timestamp = null {
        get => $this->f8_type_updated_timestamp;
        set {
            $this->setFullPkAndFilledColumn('f8_type_updated_timestamp', $value);
            $this->f8_type_updated_timestamp = $value;
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
    public int|null $f8_type_updated_user_id = null {
        get => $this->f8_type_updated_user_id;
        set {
            $this->setFullPkAndFilledColumn('f8_type_updated_user_id', $value);
            $this->f8_type_updated_user_id = $value;
        }
    }
}
