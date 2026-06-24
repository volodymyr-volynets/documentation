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

class OrganizationsAR extends ActiveRecord
{
    /**
     * @var string
     */
    public string $object_table_class = Organizations::class;

    /**
     * @var array
     */
    public array $object_table_pk = ['dn_repoorg_tenant_id','dn_repoorg_module_id','dn_repoorg_repository_id','dn_repoorg_organization_id'];

    /**
     * Tenant #
     *
     *
     *
     * {domain{tenant_id}}
     *
     * @var int|null Domain: tenant_id Type: integer
     */
    public int|null $dn_repoorg_tenant_id = null {
        get => $this->dn_repoorg_tenant_id;
        set {
            $this->setFullPkAndFilledColumn('dn_repoorg_tenant_id', $value);
            $this->dn_repoorg_tenant_id = $value;
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
    public int|null $dn_repoorg_module_id = null {
        get => $this->dn_repoorg_module_id;
        set {
            $this->setFullPkAndFilledColumn('dn_repoorg_module_id', $value);
            $this->dn_repoorg_module_id = $value;
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
    public string|null $dn_repoorg_timestamp = 'now()' {
        get => $this->dn_repoorg_timestamp;
        set {
            $this->setFullPkAndFilledColumn('dn_repoorg_timestamp', $value);
            $this->dn_repoorg_timestamp = $value;
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
    public int|null $dn_repoorg_repository_id = null {
        get => $this->dn_repoorg_repository_id;
        set {
            $this->setFullPkAndFilledColumn('dn_repoorg_repository_id', $value);
            $this->dn_repoorg_repository_id = $value;
        }
    }

    /**
     * Organization #
     *
     *
     *
     * {domain{organization_id}}
     *
     * @var int|null Domain: organization_id Type: integer
     */
    public int|null $dn_repoorg_organization_id = null {
        get => $this->dn_repoorg_organization_id;
        set {
            $this->setFullPkAndFilledColumn('dn_repoorg_organization_id', $value);
            $this->dn_repoorg_organization_id = $value;
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
    public int|null $dn_repoorg_inactive = 0 {
        get => $this->dn_repoorg_inactive;
        set {
            $this->setFullPkAndFilledColumn('dn_repoorg_inactive', $value);
            $this->dn_repoorg_inactive = $value;
        }
    }
}
