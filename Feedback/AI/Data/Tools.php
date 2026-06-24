<?php

/*
 * This file is part of Numbers Framework.
 *
 * (c) Volodymyr Volynets <volodymyr.volynets@gmail.com>
 *
 * This source file is subject to the Apache 2.0 license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Numbers\Documentation\Feedback\AI\Data;

use Object\Import;

class Tools extends Import
{
    public $data = [
        'groups' => [
            'options' => [
                'pk' => ['ai_group_tenant_id', 'ai_group_code'],
                'model' => '\Numbers\AI\SDK\Model\Groups',
                'method' => 'save',
                'submodule_exists' => ['Numbers.AI.SDK']
            ],
            'data' => [
                [
                    'ai_group_tenant_id' => null,
                    'ai_group_code' => 'F8::DEFAULT_GROUP',
                    'ai_group_name' => 'F/8 Default Groups',
                    'ai_group_module_code' => 'F8',
                    'ai_group_inactive' => 0,
                ],
            ]
        ],
        'tools' => [
            'options' => [
                'pk' => ['ai_tool_tenant_id', 'ai_tool_code'],
                'model' => '\Numbers\AI\SDK\Model\Collection\Tools',
                'method' => 'save',
                'submodule_exists' => ['Numbers.AI.SDK']
            ],
            'data' => [
                [
                    'ai_tool_tenant_id' => null,
                    'ai_tool_code' => 'F8::FEEDBACK_SUBFORM_TOOL',
                    'ai_tool_name' => 'F/8 Feedback SubForm Tool',
                    'ai_tool_description' => <<<TEXT
Tool: f8_feedback_subform_tool

Description:
Opens a feed back form for users to submit their feedback.

When to use:
When you want to collect feedback from users about a specific topic, feature, or experience.

How to use:
1. Open the feedback sub form with a specific context.
2. Subform would collect user feedback and would return summary of the feedback.

Returns:
- Summary of the feedback provided by users.
TEXT,
                    'ai_tool_tool_model' => '\Numbers\Documentation\Feedback\AI\Tool\F8FeedbackSubFormTool',
                    'ai_tool_tool_name' => 'f8_feedback_subform_tool',
                    'ai_tool_is_rag' => 0,
                    'ai_tool_is_form' => 1,
                    'ai_tool_form_settings_json' => [
                        "link" => "f8_feedback_subform",
                        "form" => "\Numbers\Documentation\Feedback\AI\Form\FeedbackSubForm",
                        "label_name" => "Feedback",
                        "icon" => "fa-solid fa-person-chalkboard"
                    ],
                    'ai_tool_inactive' => 0,
                    '\Numbers\AI\SDK\Model\Tool\Groups' => [
                        [
                            'ai_tolgrp_ai_group_code' => 'F8::DEFAULT_GROUP',
                            'ai_tolgrp_inactive' => 0,
                        ]
                    ]
                ],
            ]
        ],
    ];
}
