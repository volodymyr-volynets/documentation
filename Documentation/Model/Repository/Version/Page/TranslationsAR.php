<?php

/*
 * This file is part of Numbers Framework.
 *
 * (c) Volodymyr Volynets <volodymyr.volynets@gmail.com>
 *
 * This source file is subject to the Apache 2.0 license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Numbers\Documentation\Documentation\Model\Repository\Version\Page;

use Object\ActiveRecord;

class TranslationsAR extends ActiveRecord
{
    /**
     * @var string
     */
    public string $object_table_class = Translations::class;

    /**
     * @var array
     */
    public array $object_table_pk = ['dn_repopgtransl_tenant_id','dn_repopgtransl_module_id','dn_repopgtransl_repopage_id','dn_repopgtransl_language_code'];

    /**
     * Tenant #
     *
     *
     *
     * {domain{tenant_id}}
     *
     * @var int|null Domain: tenant_id Type: integer
     */
    public int|null $dn_repopgtransl_tenant_id = null {
        get => $this->dn_repopgtransl_tenant_id;
        set {
            $this->setFullPkAndFilledColumn('dn_repopgtransl_tenant_id', $value);
            $this->dn_repopgtransl_tenant_id = $value;
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
    public int|null $dn_repopgtransl_module_id = null {
        get => $this->dn_repopgtransl_module_id;
        set {
            $this->setFullPkAndFilledColumn('dn_repopgtransl_module_id', $value);
            $this->dn_repopgtransl_module_id = $value;
        }
    }

    /**
     * Page #
     *
     *
     *
     * {domain{page_id}}
     *
     * @var int|null Domain: page_id Type: bigint
     */
    public int|null $dn_repopgtransl_repopage_id = null {
        get => $this->dn_repopgtransl_repopage_id;
        set {
            $this->setFullPkAndFilledColumn('dn_repopgtransl_repopage_id', $value);
            $this->dn_repopgtransl_repopage_id = $value;
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
    public int|null $dn_repopgtransl_repository_id = null {
        get => $this->dn_repopgtransl_repository_id;
        set {
            $this->setFullPkAndFilledColumn('dn_repopgtransl_repository_id', $value);
            $this->dn_repopgtransl_repository_id = $value;
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
    public int|null $dn_repopgtransl_version_id = null {
        get => $this->dn_repopgtransl_version_id;
        set {
            $this->setFullPkAndFilledColumn('dn_repopgtransl_version_id', $value);
            $this->dn_repopgtransl_version_id = $value;
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
    public string|null $dn_repopgtransl_language_code = null {
        get => $this->dn_repopgtransl_language_code;
        set {
            $this->setFullPkAndFilledColumn('dn_repopgtransl_language_code', $value);
            $this->dn_repopgtransl_language_code = $value;
        }
    }

    /**
     * Title
     *
     *
     *
     * {domain{name}}
     *
     * @var string|null Domain: name Type: varchar
     */
    public string|null $dn_repopgtransl_name = null {
        get => $this->dn_repopgtransl_name;
        set {
            $this->setFullPkAndFilledColumn('dn_repopgtransl_name', $value);
            $this->dn_repopgtransl_name = $value;
        }
    }

    /**
     * Title (Table of Contents)
     *
     *
     *
     * {domain{name}}
     *
     * @var string|null Domain: name Type: varchar
     */
    public string|null $dn_repopgtransl_toc_name = null {
        get => $this->dn_repopgtransl_toc_name;
        set {
            $this->setFullPkAndFilledColumn('dn_repopgtransl_toc_name', $value);
            $this->dn_repopgtransl_toc_name = $value;
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
    public int|null $dn_repopgtransl_inactive = 0 {
        get => $this->dn_repopgtransl_inactive;
        set {
            $this->setFullPkAndFilledColumn('dn_repopgtransl_inactive', $value);
            $this->dn_repopgtransl_inactive = $value;
        }
    }
}
