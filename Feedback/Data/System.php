<?php

/*
 * This file is part of Numbers Framework.
 *
 * (c) Volodymyr Volynets <volodymyr.volynets@gmail.com>
 *
 * This source file is subject to the Apache 2.0 license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Numbers\Documentation\Feedback\Data;

use Object\Import;

class System extends Import
{
    public $data = [
        'controllers' => [
            'options' => [
                'pk' => ['sm_resource_id'],
                'model' => '\Numbers\Backend\System\Modules\Model\Collection\Resources',
                'method' => 'save'
            ],
            'data' => [
                [
                    'sm_resource_id' => '::id::\Numbers\Documentation\Feedback\Controller\Feedback',
                    'sm_resource_code' => '\Numbers\Documentation\Feedback\Controller\Feedback',
                    'sm_resource_type' => 100,
                    'sm_resource_classification' => 'Miscellaneous',
                    'sm_resource_name' => 'F/8 Feedback',
                    'sm_resource_description' => null,
                    'sm_resource_icon' => 'fa-solid fa-person-chalkboard',
                    'sm_resource_module_code' => 'F8',
                    'sm_resource_group1_name' => 'Feedback',
                    'sm_resource_group2_name' => null,
                    'sm_resource_group3_name' => null,
                    'sm_resource_group4_name' => null,
                    'sm_resource_group5_name' => null,
                    'sm_resource_group6_name' => null,
                    'sm_resource_group7_name' => null,
                    'sm_resource_group8_name' => null,
                    'sm_resource_group9_name' => null,
                    'sm_resource_acl_public' => 1,
                    'sm_resource_acl_authorized' => 1,
                    'sm_resource_acl_permission' => 0,
                    'sm_resource_menu_acl_resource_id' => null,
                    'sm_resource_menu_acl_method_code' => null,
                    'sm_resource_menu_acl_action_id' => null,
                    'sm_resource_menu_url' => null,
                    'sm_resource_menu_options_generator' => null,
                    'sm_resource_inactive' => 0,
                    '\Numbers\Backend\System\Modules\Model\Resource\Features' => [
                        [
                            'sm_rsrcftr_feature_code' => 'F8::FEEDBACK',
                            'sm_rsrcftr_inactive' => 0
                        ]
                    ],
                    '\Numbers\Backend\System\Modules\Model\Resource\Map' => [
                        [
                            'sm_rsrcmp_method_code' => 'AllActions',
                            'sm_rsrcmp_action_id' => '::id::All_Actions',
                            'sm_rsrcmp_inactive' => 0
                        ],
                        [
                            'sm_rsrcmp_method_code' => 'Edit',
                            'sm_rsrcmp_action_id' => '::id::Record_View',
                            'sm_rsrcmp_inactive' => 0
                        ],
                        [
                            'sm_rsrcmp_method_code' => 'Edit',
                            'sm_rsrcmp_action_id' => '::id::Record_New',
                            'sm_rsrcmp_inactive' => 0
                        ],
                        [
                            'sm_rsrcmp_method_code' => 'Edit',
                            'sm_rsrcmp_action_id' => '::id::Record_Edit',
                            'sm_rsrcmp_inactive' => 0
                        ],
                        [
                            'sm_rsrcmp_method_code' => 'Edit',
                            'sm_rsrcmp_action_id' => '::id::Record_Inactivate',
                            'sm_rsrcmp_inactive' => 0
                        ]
                    ]
                ],
            ]
        ],
        'menu' => [
            'options' => [
                'pk' => ['sm_resource_id'],
                'model' => '\Numbers\Backend\System\Modules\Model\Collection\Resources',
                'method' => 'save'
            ],
            'data' => [
                /*
                [
                    'sm_resource_id' => '::id::\Menu\Discussions',
                    'sm_resource_code' => '\Menu\Discussions',
                    'sm_resource_type' => 295,
                    'sm_resource_name' => 'Discussions & Engagements',
                    'sm_resource_description' => null,
                    'sm_resource_icon' => 'fa-solid fa-rectangle-list',
                    'sm_resource_module_code' => 'C5',
                    'sm_resource_group1_name' => null,
                    'sm_resource_group2_name' => null,
                    'sm_resource_group3_name' => null,
                    'sm_resource_group4_name' => null,
                    'sm_resource_group5_name' => null,
                    'sm_resource_group6_name' => null,
                    'sm_resource_group7_name' => null,
                    'sm_resource_group8_name' => null,
                    'sm_resource_group9_name' => null,
                    'sm_resource_acl_public' => 1,
                    'sm_resource_acl_authorized' => 1,
                    'sm_resource_acl_permission' => 0,
                    'sm_resource_menu_acl_resource_id' => null,
                    'sm_resource_menu_acl_method_code' => null,
                    'sm_resource_menu_acl_action_id' => null,
                    'sm_resource_menu_url' => null,
                    'sm_resource_menu_options_generator' => null,
                    'sm_resource_menu_name_generator' => null,
                    'sm_resource_menu_child_ordered' => 1,
                    'sm_resource_menu_group_name' => null,
                    'sm_resource_root_node' => 0,
                    'sm_resource_inactive' => 0
                ],
                [
                    'sm_resource_id' => '::id::\Menu\Chat',
                    'sm_resource_code' => '\Menu\Chat',
                    'sm_resource_type' => 299,
                    'sm_resource_name' => 'Chats',
                    'sm_resource_description' => null,
                    'sm_resource_icon' => 'fa-regular fa-message',
                    'sm_resource_module_code' => 'C5',
                    'sm_resource_group1_name' => null,
                    'sm_resource_group2_name' => null,
                    'sm_resource_group3_name' => null,
                    'sm_resource_group4_name' => null,
                    'sm_resource_group5_name' => null,
                    'sm_resource_group6_name' => null,
                    'sm_resource_group7_name' => null,
                    'sm_resource_group8_name' => null,
                    'sm_resource_group9_name' => null,
                    'sm_resource_acl_public' => 1,
                    'sm_resource_acl_authorized' => 1,
                    'sm_resource_acl_permission' => 0,
                    'sm_resource_menu_acl_resource_id' => null,
                    'sm_resource_menu_acl_method_code' => null,
                    'sm_resource_menu_acl_action_id' => null,
                    'sm_resource_menu_url' => null,
                    'sm_resource_menu_options_generator' => null,
                    'sm_resource_menu_name_generator' => null,
                    'sm_resource_menu_child_ordered' => 1,
                    'sm_resource_menu_group_name' => 'Discussions & Engagements',
                    'sm_resource_root_node' => 1,
                    'sm_resource_inactive' => 0
                ],
                [
                    'sm_resource_id' => '::id::\Menu\Chat\Settings',
                    'sm_resource_code' => '\Menu\Chat\Settings',
                    'sm_resource_type' => 299,
                    'sm_resource_name' => 'Settings',
                    'sm_resource_description' => null,
                    'sm_resource_icon' => 'fa-solid fa-cogs',
                    'sm_resource_module_code' => 'C5',
                    'sm_resource_group1_name' => 'Chats',
                    'sm_resource_group2_name' => null,
                    'sm_resource_group3_name' => null,
                    'sm_resource_group4_name' => null,
                    'sm_resource_group5_name' => null,
                    'sm_resource_group6_name' => null,
                    'sm_resource_group7_name' => null,
                    'sm_resource_group8_name' => null,
                    'sm_resource_group9_name' => null,
                    'sm_resource_acl_public' => 1,
                    'sm_resource_acl_authorized' => 1,
                    'sm_resource_acl_permission' => 0,
                    'sm_resource_menu_acl_resource_id' => null,
                    'sm_resource_menu_acl_method_code' => null,
                    'sm_resource_menu_acl_action_id' => null,
                    'sm_resource_menu_url' => null,
                    'sm_resource_menu_options_generator' => null,
                    'sm_resource_menu_name_generator' => null,
                    'sm_resource_menu_child_ordered' => 1,
                    'sm_resource_menu_group_name' => null,
                    'sm_resource_root_node' => 0,
                    'sm_resource_inactive' => 0
                ],
                [
                    'sm_resource_id' => '::id::\Menu\Numbers\Users\Chats\Controller\ChatPageStandalone',
                    'sm_resource_code' => '\Menu\Numbers\Users\Chats\Controller\ChatPageStandalone',
                    'sm_resource_type' => 200,
                    'sm_resource_name' => 'Chats & Channels',
                    'sm_resource_description' => null,
                    'sm_resource_icon' => 'fa-solid fa-message',
                    'sm_resource_module_code' => 'C5',
                    'sm_resource_group1_name' => 'Chats',
                    'sm_resource_group2_name' => null,
                    'sm_resource_group3_name' => null,
                    'sm_resource_group4_name' => null,
                    'sm_resource_group5_name' => null,
                    'sm_resource_group6_name' => null,
                    'sm_resource_group7_name' => null,
                    'sm_resource_group8_name' => null,
                    'sm_resource_group9_name' => null,
                    'sm_resource_acl_public' => 1,
                    'sm_resource_acl_authorized' => 1,
                    'sm_resource_acl_permission' => 0,
                    'sm_resource_menu_acl_resource_id' => null,
                    'sm_resource_menu_acl_method_code' => null,
                    'sm_resource_menu_acl_action_id' => null,
                    'sm_resource_menu_url' => '/Numbers/Users/Chats/Controller/ChatPageStandalone/_Chat',
                    'sm_resource_menu_options_generator' => null,
                    'sm_resource_menu_order' => -32000,
                    'sm_resource_inactive' => 0
                ],
                [
                    'sm_resource_id' => '::id::\Menu\Numbers\Users\Chats\Controller\Personalization',
                    'sm_resource_code' => '\Menu\Numbers\Users\Chats\Controller\Personalization',
                    'sm_resource_type' => 200,
                    'sm_resource_name' => 'Personalization',
                    'sm_resource_description' => null,
                    'sm_resource_icon' => 'fa-regular fa-user',
                    'sm_resource_module_code' => 'C5',
                    'sm_resource_group1_name' => 'Chats',
                    'sm_resource_group2_name' => 'Settings',
                    'sm_resource_group3_name' => null,
                    'sm_resource_group4_name' => null,
                    'sm_resource_group5_name' => null,
                    'sm_resource_group6_name' => null,
                    'sm_resource_group7_name' => null,
                    'sm_resource_group8_name' => null,
                    'sm_resource_group9_name' => null,
                    'sm_resource_acl_public' => 0,
                    'sm_resource_acl_authorized' => 1,
                    'sm_resource_acl_permission' => 0,
                    'sm_resource_menu_acl_resource_id' => null,
                    'sm_resource_menu_acl_method_code' => null,
                    'sm_resource_menu_acl_action_id' => null,
                    'sm_resource_menu_url' => '/Numbers/Users/Users/Controller/Account/Profile/_EditPersonalization',
                    'sm_resource_menu_options_generator' => null,
                    'sm_resource_menu_order' => -32000,
                    'sm_resource_inactive' => 0
                ],
                */
            ]
        ]
    ];
}
