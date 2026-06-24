<?php

/*
 * This file is part of Numbers Framework.
 *
 * (c) Volodymyr Volynets <volodymyr.volynets@gmail.com>
 *
 * This source file is subject to the Apache 2.0 license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Numbers\Documentation\Documentation\Command;

use Numbers\Backend\System\ShellCommand\Class2\ShellCommands;
use Numbers\Documentation\Documentation\Model\Repositories;
use Numbers\Documentation\Documentation\Model\Repository\Version\Page\FragmentsAR;
use Numbers\Documentation\Documentation\Model\Repository\Version\Pages;
use Numbers\Documentation\Documentation\Model\Repository\Version\PagesAR;
use Numbers\Documentation\Documentation\Model\Repository\Versions;
use System\Config;

class LoadRepository extends ShellCommands
{
    public $code = 'DN::LOAD_REPOSITORY';
    public $name = 'D/N Load Repository (Command)';
    public $command = 'dn_load_repository';
    public $columns = [
        'tenant_id' => ['required' => true, 'name' => 'Tenant #', 'domain' => 'tenant_id'],
        'load_key' => ['required' => true, 'name' => 'Load Key', 'type' => 'text'],
    ];

    public function execute(array $parameters, array $options = []): array
    {
        // load key
        $load_key_settings = \Application::get('dnrl.load.' . $parameters['load_key']);
        if (empty($load_key_settings['path'])) {
            throw new \Exception('Load key is not defined!');
        }
        // parse ini file with settings
        $ini_settings = Config::ini($load_key_settings['path'] . 'module.ini', 'production');
        if (empty($ini_settings['dnr'])) {
            throw new \Exception('Doc repository missing settings!');
        }
        // load repository
        $repository = Repositories::getSingleStatic([
            'where' => [
                'dn_repository_tenant_id' => $parameters['tenant_id'],
                'dn_repository_name' => $load_key_settings['repository_name'],
            ]
        ]);
        if (empty($repository)) {
            throw new \Exception('Repository name not found!');
        }
        // load version
        $version = Versions::getSingleStatic([
            'where' => [
                'dn_repoversion_tenant_id' => $repository['dn_repository_tenant_id'],
                'dn_repoversion_module_id' => $repository['dn_repository_module_id'],
                'dn_repoversion_repository_id' => $repository['dn_repository_id'],
                'dn_repoversion_version_name' => $ini_settings['dnr']['version'],
            ]
        ]);
        if (empty($version)) {
            throw new \Exception('Version not found!');
        }
        // delete old pages
        $pages_delete_result = Pages::queryBuilderStatic()
            ->delete()
            ->whereMultiple('AND', [
                'dn_repopage_tenant_id' => $repository['dn_repository_tenant_id'],
                'dn_repopage_module_id' => $repository['dn_repository_module_id'],
                'dn_repopage_repository_id' => $repository['dn_repository_id'],
                'dn_repopage_version_id' => $version['dn_repoversion_version_id'],
            ])
            ->query();
        // todo: delete comments, documents, tags and audit
        if (!$pages_delete_result['success']) {
            return $pages_delete_result;
        }
        //print_r2m($ini_settings['dnr']);
        $order = 1;
        $fragments = [];
        $urls = [];
        foreach ($ini_settings['dnr']['content'] as $k => $v) {
            // generate title number
            $title_number = '';
            foreach (explode('_', $k) as $v2) {
                $title_number .= ltrim($v2, '0') . '.';
            }
            // save
            $pages_ar = new PagesAR();
            $pages_result = $pages_ar->fill([
                'dn_repopage_tenant_id' => $repository['dn_repository_tenant_id'],
                'dn_repopage_module_id' => $repository['dn_repository_module_id'],
                'dn_repopage_id' => null,
                'dn_repopage_repository_id' => $repository['dn_repository_id'],
                'dn_repopage_version_id' => $version['dn_repoversion_version_id'],
                'dn_repopage_parent_repopage_id' => isset($v['parent']) ? ($ini_settings['dnr']['content'][$v['parent']]['dn_repopage_id'] ?? null) : null,
                'dn_repopage_order' => $order,
                'dn_repopage_title_number' => $title_number,
                'dn_repopage_name' => $v['title'],
                'dn_repopage_toc_name' => $v['title'],
                'dn_repopage_language_code' => $repository['dn_repository_default_language_code'],
                'dn_repopage_icon' => null,
                'dn_repopage_inactive' => 0
            ])->merge();
            // paragraphs
            if (!empty($v['paragraph'])) {
                $fragment_order = 1;
                foreach ($v['paragraph'] as $k2 => $v2) {
                    $html_file = rtrim($load_key_settings['path'], '/') . DIRECTORY_SEPARATOR . trim($v['folder'], '/') . DIRECTORY_SEPARATOR . $v2;
                    $html_content = file_get_contents($html_file);
                    if ($html_content === false) {
                        throw new \Exception('Could not load HTML content: ' . $html_file . '!');
                    }
                    $filename = DIRECTORY_SEPARATOR . trim($v['folder'], '/') . DIRECTORY_SEPARATOR . $v2;
                    $hash = \Request::hash([
                        $repository['dn_repository_module_id'],
                        $repository['dn_repository_id'],
                        $version['dn_repoversion_version_id'],
                        $repository['dn_repository_default_language_code'],
                        $pages_result['new_serials']['dn_repopage_id'],
                    ]);
                    $urls[$filename] = \Request::host() . 'Numbers/Documentation/Documentation/Controller/Repository/Pages/_Edit/' . $hash . '/' . $v2 . '?#page_title';
                    // add fragment
                    $fragments[$filename] = [
                        'dn_repopgfragm_tenant_id' => $repository['dn_repository_tenant_id'],
                        'dn_repopgfragm_module_id' => $repository['dn_repository_module_id'],
                        'dn_repopgfragm_repopage_id' => $pages_result['new_serials']['dn_repopage_id'],
                        'dn_repopgfragm_id' => null,
                        'dn_repopgfragm_repository_id' => $repository['dn_repository_id'],
                        'dn_repopgfragm_version_id' => $version['dn_repoversion_version_id'],
                        'dn_repopgfragm_language_code' => $repository['dn_repository_default_language_code'],
                        'dn_repopgfragm_type_code' => 'TEXT',
                        'dn_repopgfragm_name' => '',
                        'dn_repopgfragm_body' => $html_content,
                        'dn_repopgfragm_keywords' => strip_tags2($html_content),
                        'dn_repopgfragm_order' => $fragment_order,
                        /*
                        'dn_repopgfragm_file_1' => ['name' => 'File 1', 'domain' => 'file_id', 'null' => true],
                        'dn_repopgfragm_file_2' => ['name' => 'File 2', 'domain' => 'file_id', 'null' => true],
                        'dn_repopgfragm_file_3' => ['name' => 'File 3', 'domain' => 'file_id', 'null' => true],
                        'dn_repopgfragm_file_4' => ['name' => 'File 4', 'domain' => 'file_id', 'null' => true],
                        'dn_repopgfragm_file_5' => ['name' => 'File 5', 'domain' => 'file_id', 'null' => true],
                        'dn_repopgfragm_file_6' => ['name' => 'File 6', 'domain' => 'file_id', 'null' => true],
                        'dn_repopgfragm_file_7' => ['name' => 'File 7', 'domain' => 'file_id', 'null' => true],
                        'dn_repopgfragm_file_8' => ['name' => 'File 8', 'domain' => 'file_id', 'null' => true],
                        'dn_repopgfragm_file_9' => ['name' => 'File 9', 'domain' => 'file_id', 'null' => true],
                        'dn_repopgfragm_file_10' => ['name' => 'File 10', 'domain' => 'file_id', 'null' => true],
                        */
                        'dn_repopgfragm_inactive' => 0
                    ];
                    $fragment_order++;
                }
            }
            $order++;
            // put page # back for parent extraction
            $ini_settings['dnr']['content'][$k]['dn_repopage_id'] = $pages_result['new_serials']['dn_repopage_id'];
        }
        // insert fragments after processing
        if (!empty($fragments)) {
            foreach ($fragments as $k => $v) {
                // match urls
                $matches = [];
                if (preg_match_all('/<a data-repository="this" href="(.*)">(.*)<\/a>/U', $v['dn_repopgfragm_body'], $matches)) {
                    foreach ($matches[1] as $v2) {
                        $hash = '';
                        $v2_original = $v2;
                        if (strpos($v2, '#') !== false) {
                            $temp2 = explode('#', $v2);
                            $hash = $temp2[1];
                            $v2 = $temp2[0];
                        }
                        $link = false;
                        foreach ($urls as $k3 => $v3) {
                            if (str_ends_with($v2, $k3)) {
                                $link = $v3;
                                if (!empty($hash)) {
                                    $link = explode('#', $link)[0] . '#' . $hash;
                                }
                                break;
                            }
                        }
                        if (!empty($link)) {
                            $v['dn_repopgfragm_body'] = str_replace($v2_original, $link, $v['dn_repopgfragm_body']);
                        }
                    }
                }
                //
                $fragment_ar = new FragmentsAR();
                $fragment_result = $fragment_ar->fill($v)->merge();
                if (!$fragment_result['success']) {
                    return $fragment_result;
                }
            }
        }

        return [
            'success' => true,
            'error' => [],
        ];
    }
}
