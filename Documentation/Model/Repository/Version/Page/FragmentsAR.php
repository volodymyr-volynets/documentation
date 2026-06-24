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

class FragmentsAR extends ActiveRecord
{
    /**
     * @var string
     */
    public string $object_table_class = Fragments::class;

    /**
     * @var array
     */
    public array $object_table_pk = ['dn_repopgfragm_tenant_id','dn_repopgfragm_module_id','dn_repopgfragm_id'];

    /**
     * Tenant #
     *
     *
     *
     * {domain{tenant_id}}
     *
     * @var int|null Domain: tenant_id Type: integer
     */
    public int|null $dn_repopgfragm_tenant_id = null {
        get => $this->dn_repopgfragm_tenant_id;
        set {
            $this->setFullPkAndFilledColumn('dn_repopgfragm_tenant_id', $value);
            $this->dn_repopgfragm_tenant_id = $value;
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
    public int|null $dn_repopgfragm_module_id = null {
        get => $this->dn_repopgfragm_module_id;
        set {
            $this->setFullPkAndFilledColumn('dn_repopgfragm_module_id', $value);
            $this->dn_repopgfragm_module_id = $value;
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
    public int|null $dn_repopgfragm_repopage_id = null {
        get => $this->dn_repopgfragm_repopage_id;
        set {
            $this->setFullPkAndFilledColumn('dn_repopgfragm_repopage_id', $value);
            $this->dn_repopgfragm_repopage_id = $value;
        }
    }

    /**
     * Fragment #
     *
     *
     *
     * {domain{fragment_id_sequence}}
     *
     * @var int|null Domain: fragment_id_sequence Type: bigserial
     */
    public int|null $dn_repopgfragm_id = null {
        get => $this->dn_repopgfragm_id;
        set {
            $this->setFullPkAndFilledColumn('dn_repopgfragm_id', $value);
            $this->dn_repopgfragm_id = $value;
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
    public int|null $dn_repopgfragm_repository_id = null {
        get => $this->dn_repopgfragm_repository_id;
        set {
            $this->setFullPkAndFilledColumn('dn_repopgfragm_repository_id', $value);
            $this->dn_repopgfragm_repository_id = $value;
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
    public int|null $dn_repopgfragm_version_id = null {
        get => $this->dn_repopgfragm_version_id;
        set {
            $this->setFullPkAndFilledColumn('dn_repopgfragm_version_id', $value);
            $this->dn_repopgfragm_version_id = $value;
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
    public string|null $dn_repopgfragm_language_code = null {
        get => $this->dn_repopgfragm_language_code;
        set {
            $this->setFullPkAndFilledColumn('dn_repopgfragm_language_code', $value);
            $this->dn_repopgfragm_language_code = $value;
        }
    }

    /**
     * Type
     *
     *
     * {options_model{\Numbers\Documentation\Documentation\Model\Repository\Version\Page\Fragment\Types}}
     * {domain{type_code}}
     *
     * @var string|null Domain: type_code Type: varchar
     */
    public string|null $dn_repopgfragm_type_code = null {
        get => $this->dn_repopgfragm_type_code;
        set {
            $this->setFullPkAndFilledColumn('dn_repopgfragm_type_code', $value);
            $this->dn_repopgfragm_type_code = $value;
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
    public string|null $dn_repopgfragm_name = null {
        get => $this->dn_repopgfragm_name;
        set {
            $this->setFullPkAndFilledColumn('dn_repopgfragm_name', $value);
            $this->dn_repopgfragm_name = $value;
        }
    }

    /**
     * Body
     *
     *
     *
     *
     *
     * @var string|null Type: text
     */
    public string|null $dn_repopgfragm_body = null {
        get => $this->dn_repopgfragm_body;
        set {
            $this->setFullPkAndFilledColumn('dn_repopgfragm_body', $value);
            $this->dn_repopgfragm_body = $value;
        }
    }

    /**
     * Keywords
     *
     *
     *
     *
     *
     * @var string|null Type: text
     */
    public string|null $dn_repopgfragm_keywords = null {
        get => $this->dn_repopgfragm_keywords;
        set {
            $this->setFullPkAndFilledColumn('dn_repopgfragm_keywords', $value);
            $this->dn_repopgfragm_keywords = $value;
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
    public int|null $dn_repopgfragm_order = 0 {
        get => $this->dn_repopgfragm_order;
        set {
            $this->setFullPkAndFilledColumn('dn_repopgfragm_order', $value);
            $this->dn_repopgfragm_order = $value;
        }
    }

    /**
     * File 1
     *
     *
     *
     * {domain{file_id}}
     *
     * @var int|null Domain: file_id Type: bigint
     */
    public int|null $dn_repopgfragm_file_1 = null {
        get => $this->dn_repopgfragm_file_1;
        set {
            $this->setFullPkAndFilledColumn('dn_repopgfragm_file_1', $value);
            $this->dn_repopgfragm_file_1 = $value;
        }
    }

    /**
     * File 2
     *
     *
     *
     * {domain{file_id}}
     *
     * @var int|null Domain: file_id Type: bigint
     */
    public int|null $dn_repopgfragm_file_2 = null {
        get => $this->dn_repopgfragm_file_2;
        set {
            $this->setFullPkAndFilledColumn('dn_repopgfragm_file_2', $value);
            $this->dn_repopgfragm_file_2 = $value;
        }
    }

    /**
     * File 3
     *
     *
     *
     * {domain{file_id}}
     *
     * @var int|null Domain: file_id Type: bigint
     */
    public int|null $dn_repopgfragm_file_3 = null {
        get => $this->dn_repopgfragm_file_3;
        set {
            $this->setFullPkAndFilledColumn('dn_repopgfragm_file_3', $value);
            $this->dn_repopgfragm_file_3 = $value;
        }
    }

    /**
     * File 4
     *
     *
     *
     * {domain{file_id}}
     *
     * @var int|null Domain: file_id Type: bigint
     */
    public int|null $dn_repopgfragm_file_4 = null {
        get => $this->dn_repopgfragm_file_4;
        set {
            $this->setFullPkAndFilledColumn('dn_repopgfragm_file_4', $value);
            $this->dn_repopgfragm_file_4 = $value;
        }
    }

    /**
     * File 5
     *
     *
     *
     * {domain{file_id}}
     *
     * @var int|null Domain: file_id Type: bigint
     */
    public int|null $dn_repopgfragm_file_5 = null {
        get => $this->dn_repopgfragm_file_5;
        set {
            $this->setFullPkAndFilledColumn('dn_repopgfragm_file_5', $value);
            $this->dn_repopgfragm_file_5 = $value;
        }
    }

    /**
     * File 6
     *
     *
     *
     * {domain{file_id}}
     *
     * @var int|null Domain: file_id Type: bigint
     */
    public int|null $dn_repopgfragm_file_6 = null {
        get => $this->dn_repopgfragm_file_6;
        set {
            $this->setFullPkAndFilledColumn('dn_repopgfragm_file_6', $value);
            $this->dn_repopgfragm_file_6 = $value;
        }
    }

    /**
     * File 7
     *
     *
     *
     * {domain{file_id}}
     *
     * @var int|null Domain: file_id Type: bigint
     */
    public int|null $dn_repopgfragm_file_7 = null {
        get => $this->dn_repopgfragm_file_7;
        set {
            $this->setFullPkAndFilledColumn('dn_repopgfragm_file_7', $value);
            $this->dn_repopgfragm_file_7 = $value;
        }
    }

    /**
     * File 8
     *
     *
     *
     * {domain{file_id}}
     *
     * @var int|null Domain: file_id Type: bigint
     */
    public int|null $dn_repopgfragm_file_8 = null {
        get => $this->dn_repopgfragm_file_8;
        set {
            $this->setFullPkAndFilledColumn('dn_repopgfragm_file_8', $value);
            $this->dn_repopgfragm_file_8 = $value;
        }
    }

    /**
     * File 9
     *
     *
     *
     * {domain{file_id}}
     *
     * @var int|null Domain: file_id Type: bigint
     */
    public int|null $dn_repopgfragm_file_9 = null {
        get => $this->dn_repopgfragm_file_9;
        set {
            $this->setFullPkAndFilledColumn('dn_repopgfragm_file_9', $value);
            $this->dn_repopgfragm_file_9 = $value;
        }
    }

    /**
     * File 10
     *
     *
     *
     * {domain{file_id}}
     *
     * @var int|null Domain: file_id Type: bigint
     */
    public int|null $dn_repopgfragm_file_10 = null {
        get => $this->dn_repopgfragm_file_10;
        set {
            $this->setFullPkAndFilledColumn('dn_repopgfragm_file_10', $value);
            $this->dn_repopgfragm_file_10 = $value;
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
    public int|null $dn_repopgfragm_inactive = 0 {
        get => $this->dn_repopgfragm_inactive;
        set {
            $this->setFullPkAndFilledColumn('dn_repopgfragm_inactive', $value);
            $this->dn_repopgfragm_inactive = $value;
        }
    }
}
