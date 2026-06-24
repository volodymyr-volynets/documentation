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

class VersionsAR extends ActiveRecord
{
    /**
     * @var string
     */
    public string $object_table_class = Versions::class;

    /**
     * @var array
     */
    public array $object_table_pk = ['dn_repoversion_tenant_id','dn_repoversion_module_id','dn_repoversion_repository_id','dn_repoversion_version_id'];

    /**
     * Tenant #
     *
     *
     *
     * {domain{tenant_id}}
     *
     * @var int|null Domain: tenant_id Type: integer
     */
    public int|null $dn_repoversion_tenant_id = null {
        get => $this->dn_repoversion_tenant_id;
        set {
            $this->setFullPkAndFilledColumn('dn_repoversion_tenant_id', $value);
            $this->dn_repoversion_tenant_id = $value;
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
    public int|null $dn_repoversion_module_id = null {
        get => $this->dn_repoversion_module_id;
        set {
            $this->setFullPkAndFilledColumn('dn_repoversion_module_id', $value);
            $this->dn_repoversion_module_id = $value;
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
    public string|null $dn_repoversion_timestamp = 'now()' {
        get => $this->dn_repoversion_timestamp;
        set {
            $this->setFullPkAndFilledColumn('dn_repoversion_timestamp', $value);
            $this->dn_repoversion_timestamp = $value;
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
    public int|null $dn_repoversion_repository_id = null {
        get => $this->dn_repoversion_repository_id;
        set {
            $this->setFullPkAndFilledColumn('dn_repoversion_repository_id', $value);
            $this->dn_repoversion_repository_id = $value;
        }
    }

    /**
     * Version #
     *
     *
     *
     * {domain{version_id}}
     *
     * @var int|null Domain: version_id Type: integer
     */
    public int|null $dn_repoversion_version_id = null {
        get => $this->dn_repoversion_version_id;
        set {
            $this->setFullPkAndFilledColumn('dn_repoversion_version_id', $value);
            $this->dn_repoversion_version_id = $value;
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
    public string|null $dn_repoversion_version_name = null {
        get => $this->dn_repoversion_version_name;
        set {
            $this->setFullPkAndFilledColumn('dn_repoversion_version_name', $value);
            $this->dn_repoversion_version_name = $value;
        }
    }

    /**
     * Latest
     *
     *
     *
     *
     *
     * @var int|null Type: boolean
     */
    public int|null $dn_repoversion_latest = 0 {
        get => $this->dn_repoversion_latest;
        set {
            $this->setFullPkAndFilledColumn('dn_repoversion_latest', $value);
            $this->dn_repoversion_latest = $value;
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
    public int|null $dn_repoversion_inactive = 0 {
        get => $this->dn_repoversion_inactive;
        set {
            $this->setFullPkAndFilledColumn('dn_repoversion_inactive', $value);
            $this->dn_repoversion_inactive = $value;
        }
    }
}
