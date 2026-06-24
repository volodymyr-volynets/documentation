<?php

/*
 * This file is part of Numbers Framework.
 *
 * (c) Volodymyr Volynets <volodymyr.volynets@gmail.com>
 *
 * This source file is subject to the Apache 2.0 license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Numbers\Documentation\Documentation\Model\Repository\Version;

use Object\ActiveRecord;

class PagesAR extends ActiveRecord
{
    /**
     * @var string
     */
    public string $object_table_class = Pages::class;

    /**
     * @var array
     */
    public array $object_table_pk = ['dn_repopage_tenant_id','dn_repopage_module_id','dn_repopage_id'];

    /**
     * Tenant #
     *
     *
     *
     * {domain{tenant_id}}
     *
     * @var int|null Domain: tenant_id Type: integer
     */
    public int|null $dn_repopage_tenant_id = null {
        get => $this->dn_repopage_tenant_id;
        set {
            $this->setFullPkAndFilledColumn('dn_repopage_tenant_id', $value);
            $this->dn_repopage_tenant_id = $value;
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
    public int|null $dn_repopage_module_id = null {
        get => $this->dn_repopage_module_id;
        set {
            $this->setFullPkAndFilledColumn('dn_repopage_module_id', $value);
            $this->dn_repopage_module_id = $value;
        }
    }

    /**
     * Page #
     *
     *
     *
     * {domain{page_id_sequence}}
     *
     * @var int|null Domain: page_id_sequence Type: bigserial
     */
    public int|null $dn_repopage_id = null {
        get => $this->dn_repopage_id;
        set {
            $this->setFullPkAndFilledColumn('dn_repopage_id', $value);
            $this->dn_repopage_id = $value;
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
    public int|null $dn_repopage_repository_id = null {
        get => $this->dn_repopage_repository_id;
        set {
            $this->setFullPkAndFilledColumn('dn_repopage_repository_id', $value);
            $this->dn_repopage_repository_id = $value;
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
    public int|null $dn_repopage_version_id = null {
        get => $this->dn_repopage_version_id;
        set {
            $this->setFullPkAndFilledColumn('dn_repopage_version_id', $value);
            $this->dn_repopage_version_id = $value;
        }
    }

    /**
     * Parent Page #
     *
     *
     *
     * {domain{page_id}}
     *
     * @var int|null Domain: page_id Type: bigint
     */
    public int|null $dn_repopage_parent_repopage_id = null {
        get => $this->dn_repopage_parent_repopage_id;
        set {
            $this->setFullPkAndFilledColumn('dn_repopage_parent_repopage_id', $value);
            $this->dn_repopage_parent_repopage_id = $value;
        }
    }

    /**
     * Order
     *
     *
     *
     * {domain{big_order}}
     *
     * @var int|null Domain: big_order Type: bigint
     */
    public int|null $dn_repopage_order = 0 {
        get => $this->dn_repopage_order;
        set {
            $this->setFullPkAndFilledColumn('dn_repopage_order', $value);
            $this->dn_repopage_order = $value;
        }
    }

    /**
     * Title Number
     *
     *
     *
     * {domain{title_number}}
     *
     * @var string|null Domain: title_number Type: varchar
     */
    public string|null $dn_repopage_title_number = null {
        get => $this->dn_repopage_title_number;
        set {
            $this->setFullPkAndFilledColumn('dn_repopage_title_number', $value);
            $this->dn_repopage_title_number = $value;
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
    public string|null $dn_repopage_name = null {
        get => $this->dn_repopage_name;
        set {
            $this->setFullPkAndFilledColumn('dn_repopage_name', $value);
            $this->dn_repopage_name = $value;
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
    public string|null $dn_repopage_toc_name = null {
        get => $this->dn_repopage_toc_name;
        set {
            $this->setFullPkAndFilledColumn('dn_repopage_toc_name', $value);
            $this->dn_repopage_toc_name = $value;
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
    public string|null $dn_repopage_language_code = null {
        get => $this->dn_repopage_language_code;
        set {
            $this->setFullPkAndFilledColumn('dn_repopage_language_code', $value);
            $this->dn_repopage_language_code = $value;
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
    public string|null $dn_repopage_icon = null {
        get => $this->dn_repopage_icon;
        set {
            $this->setFullPkAndFilledColumn('dn_repopage_icon', $value);
            $this->dn_repopage_icon = $value;
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
    public int|null $dn_repopage_inactive = 0 {
        get => $this->dn_repopage_inactive;
        set {
            $this->setFullPkAndFilledColumn('dn_repopage_inactive', $value);
            $this->dn_repopage_inactive = $value;
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
    public string|null $dn_repopage_inserted_timestamp = null {
        get => $this->dn_repopage_inserted_timestamp;
        set {
            $this->setFullPkAndFilledColumn('dn_repopage_inserted_timestamp', $value);
            $this->dn_repopage_inserted_timestamp = $value;
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
    public int|null $dn_repopage_inserted_user_id = null {
        get => $this->dn_repopage_inserted_user_id;
        set {
            $this->setFullPkAndFilledColumn('dn_repopage_inserted_user_id', $value);
            $this->dn_repopage_inserted_user_id = $value;
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
    public string|null $dn_repopage_updated_timestamp = null {
        get => $this->dn_repopage_updated_timestamp;
        set {
            $this->setFullPkAndFilledColumn('dn_repopage_updated_timestamp', $value);
            $this->dn_repopage_updated_timestamp = $value;
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
    public int|null $dn_repopage_updated_user_id = null {
        get => $this->dn_repopage_updated_user_id;
        set {
            $this->setFullPkAndFilledColumn('dn_repopage_updated_user_id', $value);
            $this->dn_repopage_updated_user_id = $value;
        }
    }
}
