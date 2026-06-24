<?php

/*
 * This file is part of Numbers Framework.
 *
 * (c) Volodymyr Volynets <volodymyr.volynets@gmail.com>
 *
 * This source file is subject to the Apache 2.0 license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Numbers\Documentation\Feedback\AI\Tool;

use Numbers\AI\SDK\Classes\Tool\BaseTool;
use Numbers\Users\Users\Model\Users;

class F8FeedbackSubFormTool extends BaseTool
{
    public string $name = 'f8_feedback_subform_tool';
    public function description(): string
    {
        return <<<TEXT
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
TEXT;
    }
    public function run(array $input): array
    {
        return [
            'success' => true,
            'error' => [],
            'summary' => 'Not implemented yet!'
        ];
    }
    public function schema(): array
    {
        return [];
    }
}
