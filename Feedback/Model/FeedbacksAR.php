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

class FeedbacksAR extends ActiveRecord
{
    /**
     * @var string
     */
    public string $object_table_class = Feedbacks::class;

    /**
     * @var array
     */
    public array $object_table_pk = ['f8_feedback_tenant_id','f8_feedback_id'];

    /**
     * Tenant #
     *
     *
     *
     * {domain{tenant_id}}
     *
     * @var int|null Domain: tenant_id Type: integer
     */
    public int|null $f8_feedback_tenant_id = null {
        get => $this->f8_feedback_tenant_id;
        set {
            $this->setFullPkAndFilledColumn('f8_feedback_tenant_id', $value);
            $this->f8_feedback_tenant_id = $value;
        }
    }

    /**
     * Feedback #
     *
     *
     *
     * {domain{feedback_id_sequence}}
     *
     * @var int|null Domain: feedback_id_sequence Type: bigserial
     */
    public int|null $f8_feedback_id = null {
        get => $this->f8_feedback_id;
        set {
            $this->setFullPkAndFilledColumn('f8_feedback_id', $value);
            $this->f8_feedback_id = $value;
        }
    }

    /**
     * Type Code
     *
     *
     *
     * {domain{group_code}}
     *
     * @var string|null Domain: group_code Type: varchar
     */
    public string|null $f8_feedback_f8_type_code = null {
        get => $this->f8_feedback_f8_type_code;
        set {
            $this->setFullPkAndFilledColumn('f8_feedback_f8_type_code', $value);
            $this->f8_feedback_f8_type_code = $value;
        }
    }

    /**
     * Controller Name
     *
     *
     *
     * {domain{name}}
     *
     * @var string|null Domain: name Type: varchar
     */
    public string|null $f8_feedback_controller_name = null {
        get => $this->f8_feedback_controller_name;
        set {
            $this->setFullPkAndFilledColumn('f8_feedback_controller_name', $value);
            $this->f8_feedback_controller_name = $value;
        }
    }

    /**
     * Feedback Stars
     *
     *
     *
     * {domain{feedback_stars}}
     *
     * @var int|null Domain: feedback_stars Type: smallint
     */
    public int|null $f8_feedback_stars = null {
        get => $this->f8_feedback_stars;
        set {
            $this->setFullPkAndFilledColumn('f8_feedback_stars', $value);
            $this->f8_feedback_stars = $value;
        }
    }

    /**
     * Feedback Note
     *
     *
     *
     * {domain{feedback_note}}
     *
     * @var string|null Domain: feedback_note Type: varchar
     */
    public string|null $f8_feedback_note = null {
        get => $this->f8_feedback_note;
        set {
            $this->setFullPkAndFilledColumn('f8_feedback_note', $value);
            $this->f8_feedback_note = $value;
        }
    }

    /**
     * User #
     *
     *
     *
     * {domain{user_id}}
     *
     * @var int|null Domain: user_id Type: bigint
     */
    public int|null $f8_feedback_um_user_id = null {
        get => $this->f8_feedback_um_user_id;
        set {
            $this->setFullPkAndFilledColumn('f8_feedback_um_user_id', $value);
            $this->f8_feedback_um_user_id = $value;
        }
    }

    /**
     * User Name
     *
     *
     *
     * {domain{name}}
     *
     * @var string|null Domain: name Type: varchar
     */
    public string|null $f8_feedback_um_user_name = null {
        get => $this->f8_feedback_um_user_name;
        set {
            $this->setFullPkAndFilledColumn('f8_feedback_um_user_name', $value);
            $this->f8_feedback_um_user_name = $value;
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
    public int|null $f8_feedback_inactive = 0 {
        get => $this->f8_feedback_inactive;
        set {
            $this->setFullPkAndFilledColumn('f8_feedback_inactive', $value);
            $this->f8_feedback_inactive = $value;
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
    public string|null $f8_feedback_inserted_timestamp = null {
        get => $this->f8_feedback_inserted_timestamp;
        set {
            $this->setFullPkAndFilledColumn('f8_feedback_inserted_timestamp', $value);
            $this->f8_feedback_inserted_timestamp = $value;
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
    public int|null $f8_feedback_inserted_user_id = null {
        get => $this->f8_feedback_inserted_user_id;
        set {
            $this->setFullPkAndFilledColumn('f8_feedback_inserted_user_id', $value);
            $this->f8_feedback_inserted_user_id = $value;
        }
    }
}
