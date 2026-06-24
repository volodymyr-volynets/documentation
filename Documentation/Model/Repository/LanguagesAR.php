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

use Object\ActiveRecord;

class LanguagesAR extends ActiveRecord
{
    /**
     * @var string
     */
    public string $object_table_class = Languages::class;

    /**
     * @var array
     */
    public array $object_table_pk = ['dn_repolang_tenant_id','dn_repolang_module_id','dn_repolang_repository_id','dn_repolang_language_code'];

    /**
     * Tenant #
     *
     *
     *
     * {domain{tenant_id}}
     *
     * @var int|null Domain: tenant_id Type: integer
     */
    public int|null $dn_repolang_tenant_id = null {
        get => $this->dn_repolang_tenant_id;
        set {
            $this->setFullPkAndFilledColumn('dn_repolang_tenant_id', $value);
            $this->dn_repolang_tenant_id = $value;
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
    public int|null $dn_repolang_module_id = null {
        get => $this->dn_repolang_module_id;
        set {
            $this->setFullPkAndFilledColumn('dn_repolang_module_id', $value);
            $this->dn_repolang_module_id = $value;
        }
    }

    /**
     * Timestamp
     *
     *
     *
     * {domain{timestamp_now}}
     *
     * @var string|null Domain: timestamp_now Type: timestamp
     */
    public string|null $dn_repolang_timestamp = 'now()' {
        get => $this->dn_repolang_timestamp;
        set {
            $this->setFullPkAndFilledColumn('dn_repolang_timestamp', $value);
            $this->dn_repolang_timestamp = $value;
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
    public int|null $dn_repolang_repository_id = null {
        get => $this->dn_repolang_repository_id;
        set {
            $this->setFullPkAndFilledColumn('dn_repolang_repository_id', $value);
            $this->dn_repolang_repository_id = $value;
        }
    }

    /**
     * Language
     *
     *
     *
     * {domain{language_code}}
     *
     * @var string|null Domain: language_code Type: char
     */
    public string|null $dn_repolang_language_code = null {
        get => $this->dn_repolang_language_code;
        set {
            $this->setFullPkAndFilledColumn('dn_repolang_language_code', $value);
            $this->dn_repolang_language_code = $value;
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
    public int|null $dn_repolang_primary = 0 {
        get => $this->dn_repolang_primary;
        set {
            $this->setFullPkAndFilledColumn('dn_repolang_primary', $value);
            $this->dn_repolang_primary = $value;
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
    public int|null $dn_repolang_inactive = 0 {
        get => $this->dn_repolang_inactive;
        set {
            $this->setFullPkAndFilledColumn('dn_repolang_inactive', $value);
            $this->dn_repolang_inactive = $value;
        }
    }
}
