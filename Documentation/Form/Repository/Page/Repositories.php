<?php

/*
 * This file is part of Numbers Framework.
 *
 * (c) Volodymyr Volynets <volodymyr.volynets@gmail.com>
 *
 * This source file is subject to the Apache 2.0 license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Numbers\Documentation\Documentation\Form\Repository\Page;

use Numbers\Documentation\Documentation\Model\Repository\Version\Pages;
use Object\Content\Messages;
use Object\Form\Wrapper\Base;

class Repositories extends Base
{
    public $form_link = 'dn_page_repositories';
    public $module_code = 'DN';
    public $title = 'D/N Page Repositories Form';
    public $options = [
        'actions' => [
            'refresh' => [
                'preserve_values' => ['dn_repository_version_id', 'dn_repository_language_code', 'dn_repopage_id']
            ],
        ],
        'no_ajax_form_reload' => true,
        'skip_optimistic_lock' => true,
        'skip_web_sockets' => true,
    ];
    public $containers = [
        'top' => ['default_row_type' => 'grid', 'order' => 100],
    ];
    public $rows = [];
    public $elements = [
        'top' => [
            'dn_repository_id' => [
                'dn_repository_id' => ['order' => 1, 'row_order' => 100, 'label_name' => 'Repository', 'domain' => 'repository_id', 'null' => true, 'percent' => 30, 'method' => 'select', 'options_model' => '\Numbers\Documentation\Documentation\Model\Repositories::optionsActive', 'options_depends' => ['dn_repository_module_id' => 'dn_repository_module_id'], 'track_previous_values' => true, 'onchange' => 'this.form.submit();', 'preserved' => true],
                'dn_repository_version_id' => ['order' => 2, 'label_name' => 'Version', 'domain' => 'version_id', 'null' => true, 'percent' => 15, 'method' => 'select', 'options_model' => '\Numbers\Documentation\Documentation\Model\Repository\Versions::optionsLatestActive', 'no_choose' => true, 'options_depends' => ['dn_repoversion_module_id' => 'dn_repository_module_id', 'dn_repoversion_repository_id' => 'dn_repository_id'], 'options_options' => ['i18n' => 'skip_sorting'], 'onchange' => 'this.form.submit();', 'preserved' => true],
                'dn_repository_language_code' => ['order' => 3, 'label_name' => 'Language', 'domain' => 'language_code', 'null' => true, 'percent' => 15, 'method' => 'select', 'options_model' => '\Numbers\Documentation\Documentation\DataSource\Repository\Languages::optionsActive', 'no_choose' => true, 'options_depends' => ['dn_repolang_module_id' => 'dn_repository_module_id', 'dn_repolang_repository_id' => 'dn_repository_id'], 'onchange' => 'this.form.submit();', 'preserved' => true],
                'full_text_search' => ['order' => 4, 'label_name' => 'Search', 'type' => 'text', 'null' => true, 'percent' => 30, 'placeholder' => 'Search', 'preserved' => true],
                self::BUTTON_SUBMIT_OTHER => ['order' => 5, 'label_name' => ' ', 'icon' => ''] + self::BUTTON_SUBMIT_OTHER_DATA + ['percent' => 10],
            ],
            self::HIDDEN => [
                'dn_repopage_id' => ['order' => 1, 'label_name' => 'Page #', 'domain' => 'page_id', 'null' => true, 'method' => 'hidden', 'preserved' => true],
                '__page_deleted' => ['order' => 2, 'label_name' => 'Page Deleted Flag', 'type' => 'boolean', 'null' => true, 'method' => 'hidden', 'preserved' => true],
            ]
        ],
    ];
    public $collection = [
        'readonly' => true,
        'model' => '\Numbers\Documentation\Documentation\Model\Repositories'
    ];

    public function overrides(& $form)
    {
        if (empty($form->values['dn_repository_id'])) {
            $form->values['dn_repository_version_id'] = null;
            $form->values['dn_repository_language_code'] = null;
        }
        // onchange fields
        if (!empty($form->__options['input']['__form_onchange_field_values_key'])) {
            $__form_onchange_field_values_key = explode('[::]', $form->__options['input']['__form_onchange_field_values_key']);
        }
        // changes in fields
        if (($__form_onchange_field_values_key[0] ?? '') == 'dn_repository_id') {
            $temp = \Numbers\Documentation\Documentation\Model\Repositories::getStatic([
                'where' => [
                    'dn_repository_module_id' => (int) $form->values['__module_id'],
                    'dn_repository_id' => (int) $form->values['dn_repository_id']
                ],
                'pk' => null,
                'single_row' => true,
            ]);
            if (!empty($temp)) {
                $form->values['dn_repository_version_id'] = $temp['dn_repository_latest_version_id'];
                $form->values['dn_repository_language_code'] = $temp['dn_repository_default_language_code'];
            }
            $form->values['full_text_search'] = null;
        }
        // if any fields changed
        if (!empty($__form_onchange_field_values_key[0])) {
            // fetch first page
            $first_page = Pages::getStatic([
                'where' => [
                    'dn_repopage_module_id' => (int) $form->values['__module_id'],
                    'dn_repopage_repository_id' => (int) $form->values['dn_repository_id'],
                    'dn_repopage_version_id' => $form->values['dn_repository_version_id'],
                    'dn_repopage_parent_repopage_id' => null,
                ],
                'columns' => ['dn_repopage_id'],
                'limit' => 1,
                'orderby' => ['dn_repopage_order' => SORT_ASC],
                'pk' => null,
                'single_row' => true,
            ]);
            if (!empty($first_page['dn_repopage_id'])) {
                $form->values['dn_repopage_id'] = $first_page['dn_repopage_id'];
            } else {
                $form->values['dn_repopage_id'] = null;
            }
        }
    }

    public function refresh(& $form)
    {
        if (!empty($form->values['__page_deleted'])) {
            $form->error(SUCCESS, Messages::RECORD_DELETED);
        }
        if (!empty($form->values['full_text_search']) && empty($form->values['dn_repository_id'])) {
            $form->error(DANGER, Messages::REQUIRED_FIELD, 'dn_repository_id');
        }
    }
}
