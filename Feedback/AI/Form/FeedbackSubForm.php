<?php

/*
 * This file is part of Numbers Framework.
 *
 * (c) Volodymyr Volynets <volodymyr.volynets@gmail.com>
 *
 * This source file is subject to the Apache 2.0 license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Numbers\Documentation\Feedback\AI\Form;

use Object\Form\Wrapper\Base;
use Numbers\Users\Chats\Helper\Chats as ChatsHelper;
use Numbers\AI\SDK\Helper\FieldsSummary as AIFieldsSummaryHelper;
use Numbers\Documentation\Feedback\Model\Types as FeedbackTypesModel;

class FeedbackSubForm extends Base
{
    public $form_link = 'f8_feedback_subform';
    public $module_code = 'F8';
    public $title = 'F/8 Feedback Sub Form';
    public $options = [
        'actions' => [
            'refresh' => true,
        ],
        'skip_web_sockets' => true,
        'skip_action_line' => true,
    ];
    public $containers = [
        'top' => ['default_row_type' => 'grid', 'order' => 100],
        'buttons' => ['default_row_type' => 'grid', 'order' => 300],
    ];
    public $rows = [];
    public $elements = [
        'top' => [
            'f8_feedback_f8_type_code' => [
                'f8_feedback_f8_type_code' => ['order' => 1, 'row_order' => 100, 'label_name' => 'Type', 'domain' => 'group_code', 'null' => true, 'required' => true, 'method' => 'select', 'options_model' => '\Numbers\Documentation\Feedback\Model\Types', 'options_options' => ['i18n' => 'skip_sorting'], 'set_primary' => true],
            ],
            'f8_feedback_stars' => [
                'f8_feedback_stars' => ['order' => 1, 'row_order' => 200, 'label_name' => 'Stars', 'domain' => 'feedback_stars', 'null' => true, 'required' => true, 'method' => 'stars'],
            ],
            'f8_feedback_note' => [
                'f8_feedback_note' => ['order' => 1, 'row_order' => 300, 'label_name' => 'Note', 'domain' => 'feedback_note', 'null' => true, 'required' => 'c', 'method' => 'textarea', 'rows' => 3],
            ],
            self::HIDDEN => [
                'f8_feedback_id' => ['label_name' => 'Feedback #', 'domain' => 'feedback_id_sequence', 'null' => true, 'method' => 'hidden'],
                'f8_feedback_controller_name' => ['label_name' => 'Controller Name', 'domain' => 'name', 'null' => true, 'method' => 'hidden'],
                // chat fields
                'c5_chat_id' => ['label_name' => 'Chat #', 'domain' => 'chat_id', 'null' => true, 'method' => 'hidden', 'preserved' => true],
                'c5_chatmessage_id' => ['label_name' => 'Message #', 'domain' => 'message_id', 'null' => true, 'method' => 'hidden', 'preserved' => true],
            ]
        ],
        'buttons' => [
            self::BUTTONS => [
                self::BUTTON_SUBMIT => self::BUTTON_SUBMIT_DATA,
            ]
        ]
    ];
    public $collection = [
        'name' => 'F8 Feedbacks',
        'model' => '\Numbers\Documentation\Feedback\Model\Feedbacks',
    ];

    public function validate(& $form)
    {
        if (empty($form->values['f8_feedback_controller_name'])) {
            $form->values['f8_feedback_controller_name'] = \Application::$controller->title;
        }
        $form->values['f8_feedback_um_user_id'] = \User::id();
        $form->values['f8_feedback_um_user_name'] = \User::get('name');
    }

    public function post(& $form)
    {
        $types = FeedbackTypesModel::optionsStatic();
        $summary = AIFieldsSummaryHelper::HTML([
            'F/8 Feedback ID' => $form->values['f8_feedback_id'],
            'Type' => $types[$form->values['f8_feedback_f8_type_code']]['name'],
            'Stars' => $form->values['f8_feedback_stars'] . ' Star(s)',
            'Note' => $form->values['f8_feedback_note'],
        ]);
        ChatsHelper::formToolCompleted($form->values['c5_chatmessage_id'], [
            'success' => true,
            'error' => [],
            'summary' => $summary
        ]);
        $form->hideSubform();
    }
}
