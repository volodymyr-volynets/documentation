<?php

/*
 * This file is part of Numbers Framework.
 *
 * (c) Volodymyr Volynets <volodymyr.volynets@gmail.com>
 *
 * This source file is subject to the Apache 2.0 license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Numbers\Documentation\Documentation\Form;

use Numbers\Tenants\Tenants\Helper\Sequence;
use Object\Form\Wrapper\Base;

class Settings extends Base
{
    public $form_link = 'dn_settings';
    public $module_code = 'DN';
    public $title = 'D/N Settings Form';
    public $options = [
        'segment' => self::SEGMENT_FORM,
        'actions' => [
            'refresh' => true
        ],
        'flag_save_anyway' => true
    ];
    public $containers = [
        'tabs' => ['default_row_type' => 'grid', 'order' => 500, 'type' => 'tabs'],
        'buttons' => ['default_row_type' => 'grid', 'order' => 900],
        'sequences_container' => [
            'type' => 'details',
            'details_rendering_type' => 'table',
            'details_new_rows' => 0,
            'details_key' => '\Numbers\Tenants\Tenants\Model\Module\Sequences',
            'details_pk' => ['tm_mdlseq_type_code'],
            'details_cannot_delete' => true,
            'required' => true,
            'order' => 35002
        ],
    ];
    public $rows = [
        'tabs' => [
            'sequences' => ['order' => 200, 'label_name' => 'Sequences'],
        ],
    ];
    public $elements = [
        'tabs' => [
            'sequences' => [
                'sequences' => ['container' => 'sequences_container', 'order' => 100]
            ],
        ],
        'sequences_container' => [
            'row1' => [
                'tm_mdlseq_type_code' => ['order' => 1, 'row_order' => 100, 'label_name' => 'Type', 'domain' => 'type_code', 'null' => true, 'required' => true, 'percent' => 25, 'method' => 'select', 'options_model' => '\Numbers\Documentation\Documentation\Model\Transaction\EntryTypes', 'readonly' => true],
                'tm_mdlseq_prefix' => ['order' => 2, 'label_name' => 'Prefix', 'domain' => 'type_code', 'null' => true, 'percent' => 25, 'placeholder' => 'Prefix'],
                'tm_mdlseq_length' => ['order' => 3, 'label_name' => 'Length', 'domain' => 'counter', 'default' => 18, 'percent' => 10],
                'tm_mdlseq_suffix' => ['order' => 4, 'label_name' => 'Suffix', 'domain' => 'type_code', 'null' => true, 'percent' => 25, 'placeholder' => 'Suffix'],
                'tm_mdlseq_counter' => ['order' => 5, 'row_order' => 200, 'label_name' => 'Current Value', 'domain' => 'bigcounter', 'percent' => 15],
            ],
        ],
        'buttons' => [
            self::BUTTONS => [
                self::BUTTON_SUBMIT_SAVE => self::BUTTON_SUBMIT_SAVE_DATA
            ]
        ]
    ];
    public $collection = [
        'name' => 'DN Settings',
        'model' => '\Numbers\Documentation\Documentation\Model\Settings',
        'details' => [
            '\Numbers\Tenants\Tenants\Model\Module\Sequences' => [
                'name' => 'Sequences',
                'pk' => ['tm_mdlseq_tenant_id', 'tm_mdlseq_module_id', 'tm_mdlseq_type_code'],
                'type' => '1M',
                'map' => ['dn_setting_tenant_id' => 'tm_mdlseq_tenant_id', 'dn_setting_module_id' => 'tm_mdlseq_module_id'],
            ],
        ]
    ];

    public function refresh(& $form)
    {
        // preset sequences
        Sequence::presetIfNotSet($form, [
            [
                'tm_mdlseq_type_code' => 'DNR',
                'tm_mdlseq_prefix' => 'DNR',
                'tm_mdlseq_length' => 22,
                'tm_mdlseq_suffix' => null,
                'tm_mdlseq_counter' => 0,
            ],
            [
                'tm_mdlseq_type_code' => 'DNP',
                'tm_mdlseq_prefix' => 'DNP',
                'tm_mdlseq_length' => 22,
                'tm_mdlseq_suffix' => null,
                'tm_mdlseq_counter' => 0,
            ],
            [
                'tm_mdlseq_type_code' => 'DNF',
                'tm_mdlseq_prefix' => 'DNF',
                'tm_mdlseq_length' => 22,
                'tm_mdlseq_suffix' => null,
                'tm_mdlseq_counter' => 0,
            ],
            [
                'tm_mdlseq_type_code' => 'DNE',
                'tm_mdlseq_prefix' => 'DNE',
                'tm_mdlseq_length' => 22,
                'tm_mdlseq_suffix' => null,
                'tm_mdlseq_counter' => 0,
            ]
        ]);
    }

    public function validate(& $form)
    {
        Sequence::validateSequenceTypes($form);
        if ($form->hasErrors()) {
            return;
        }
        // update sequence
        $form->values['dn_setting_sequence'] = $form->collection_object->primary_model->sequence('dn_setting_sequence');
    }
}
