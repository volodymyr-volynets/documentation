<?php

/*
 * This file is part of Numbers Framework.
 *
 * (c) Volodymyr Volynets <volodymyr.volynets@gmail.com>
 *
 * This source file is subject to the Apache 2.0 license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Numbers\Documentation\Documentation\AI\ETL;

use Numbers\AI\SDK\Classes\Agent\PreConfigured;
use Numbers\AI\SDK\Model\Settings;
use Numbers\Backend\Db\Common\Model\Models;
use Numbers\Backend\System\Modules\Model\Resources;
use Numbers\Tenants\Widgets\Batches\Helper\Save;
use Numbers\Tenants\Widgets\Batches\Model\Records;
use Numbers\Tenants\Tenants\Helper\Sequence;
use Numbers\Documentation\Documentation\Model\Embeddings;
use Numbers\Documentation\Documentation\Model\Repositories;
use Numbers\Documentation\Documentation\Model\Repository\Version\Pages;
use Numbers\Tenants\Tenants\Model\Modules;
use Object\Error\ResultException;
use Numbers\Documentation\Documentation\Model\Repository\Version\Page\Fragments;

class RepositoryFragmentsETL
{
    public static function process()
    {
        $result = [
            'success' => false,
            'error' => [],
            'count' => 0,
            'legend' => [],
        ];
        // load default embedding agent
        $ai_settings = Settings::getSingleStatic([
            'where' => [
                'ai_setting_tenant_id' => \Tenant::id(),
            ]
        ]);
        if (empty($ai_settings['ai_setting_embedding_ai_agent_code'])) {
            throw new \Exception('ETL: please set A/I Embedding Agent Code in A/I Settings');
        }
        // run ETL
        return \Db::etl(function ($options) {
            $query = Fragments::queryBuilderStatic(['alias' => 'a'])
                ->select()
                ->columns([
                    'a_id' => "concat_ws('::', a.dn_repopgfragm_tenant_id, a.dn_repopgfragm_module_id, a.dn_repopgfragm_id)",
                    'a.*',
                    'r.*',
                    'p.*',
                    'm.*',
                    'd.*'
                ])
                ->join('INNER', new Modules(), 'm', 'ON', [
                    ['AND', ['m.tm_module_id', '=', 'a.dn_repopgfragm_module_id', true], false],
                ])
                ->join('INNER', new Repositories(), 'r', 'ON', [
                    ['AND', ['r.dn_repository_module_id', '=', 'a.dn_repopgfragm_module_id', true], false],
                    ['AND', ['r.dn_repository_id', '=', 'a.dn_repopgfragm_repository_id', true], false],
                ])
                ->join('INNER', new Pages(), 'p', 'ON', [
                    ['AND', ['p.dn_repopage_module_id', '=', 'a.dn_repopgfragm_module_id', true], false],
                    ['AND', ['p.dn_repopage_id', '=', 'a.dn_repopgfragm_repopage_id', true], false],
                ])
                ->join('LEFT', new Records(), 'b', 'ON', [
                    ['AND', ['b.tm_batchrecord_tm_batchtype_code', '=', 'DN_EMBEDDINGS', false], false],
                    ['AND', ['b.tm_batchrecord_module_id', '=', 'a.dn_repopgfragm_module_id', true], false],
                    ['AND', ['b.tm_batchrecord_field_code', '=', 'dn_repopgfragm_id', false], false],
                    ['AND', ['b.tm_batchrecord_no_data_model_role_code', '=', 'primary', false], false],
                    ['AND', ['b.tm_batchrecord_field_value_id', '=', "a.dn_repopgfragm_id", true], false]
                ])
                ->join('LEFT', new Records(), 'c', 'ON', [
                    ['AND', ['c.tm_batchrecord_tm_batchtype_code', '=', 'DN_EMBEDDINGS', false], false],
                    ['AND', ['c.tm_batchrecord_module_id', '=', 'a.dn_repopgfragm_module_id', true], false],
                    ['AND', ['c.tm_batchrecord_field_code', '=', 'dn_embedding_code', false], false],
                    ['AND', ['c.tm_batchrecord_tm_batchentry_code', '=', 'b.tm_batchrecord_tm_batchentry_code', true], false]
                ])
                ->join('LEFT', new Embeddings(), 'd', 'ON', [
                    ['AND', ['d.dn_embedding_tenant_id', '=', \Tenant::id(), false], false],
                    ['AND', ['d.dn_embedding_module_id', '=', 'a.dn_repopgfragm_module_id', true], false],
                    ['AND', ['d.dn_embedding_code', '=', 'c.tm_batchrecord_field_value_code', true], false]
                ])
                ->limit(10_000)
                ->orderby(['a_id' => SORT_ASC]);
            return $query->query('a_id')['rows'];
        }, function ($row, $options) {
            $content = RepositoryFragments2Embedding::transform($row, $options)['content'];
            $transform = [
                'a_id' => $row['a_id'],
                // fragment
                'dn_repopgfragm_module_id' => $row['dn_repopgfragm_module_id'],
                'dn_repopgfragm_id' => $row['dn_repopgfragm_id'],
                'dn_repopgfragm_name' => $row['dn_repopgfragm_name'],
                // page
                'dn_repopage_module_id' => $row['dn_repopage_module_id'],
                'dn_repopage_repository_id' => $row['dn_repopage_repository_id'],
                'dn_repopage_id' => $row['dn_repopage_id'],
                'dn_repopage_name' => $row['dn_repopage_name'],
                // repository
                'dn_repository_name' => $row['dn_repository_name'],
                // module
                'tm_module_name' => $row['tm_module_name'],
                // embeddings
                'dn_embedding_code' => $row['dn_embedding_code'],
                'dn_embedding_content' => $content,
                'dn_embedding_hash_sha1' => sha1($content),
            ];
            // compare sha1s and return null
            if (!empty($row['dn_embedding_hash_sha1']) && $row['dn_embedding_hash_sha1'] == $transform['dn_embedding_hash_sha1']) {
                return false;
            }
            return $transform;
        }, function ($row, $options) {
            // call AI Embeddings API
            $agent = new PreConfigured($options['ai_agent_code']);
            $response1 = $agent->embeddings($row['dn_embedding_content'], [
                'ai_embedding_code' => $row['dn_embedding_code'] ?? null,
                'ai_embedding_ai_ragtype_code' => $options['dn_embedding_ai_ragtype_code'] ?? 'AI::OTHER',
                'skip_record_saving' => true, // embeddings are in different table
            ]);
            // save embeddings
            $dn_embedding_code = $row['dn_embedding_code'] ?? Sequence::nextval('DEFAULT', 'DNE', $row['dn_repopage_module_id'], \Tenant::id(), true);
            $embeddings_result = Embeddings::collectionStatic()->merge([
                'dn_embedding_tenant_id' => \Tenant::id(),
                'dn_embedding_module_id' => $row['dn_repopage_module_id'],
                'dn_embedding_dn_repository_id' => $row['dn_repopage_repository_id'],
                'dn_embedding_code' => $dn_embedding_code,
                'dn_embedding_hash_sha1' => $response1['records']['ai_embedding_hash_sha1'],
                'dn_embedding_content' => $response1['records']['ai_embedding_content'],
                'dn_embedding_embeddings' => $response1['records']['ai_embedding_embeddings'],
                'dn_embedding_total_token_counter' => $response1['records']['ai_embedding_total_token_counter'],
                'dn_embedding_ai_model_code' => $response1['records']['ai_embedding_ai_model_code'],
                'dn_embedding_ai_ragtype_code' => $response1['records']['ai_embedding_ai_ragtype_code'],
                'dn_embedding_inactive' => 0,
            ]);
            if (!$embeddings_result['success']) {
                throw new ResultException($embeddings_result);
            }
            // if its existing we do not create batch
            if (!empty($row['dn_embedding_code'])) {
                return false;
            }
            // create batches
            $raw_batch_records = [];
            $raw_batch_records[$dn_embedding_code . '::EMBEDDING_CODE'] = [
                'tm_batchrecord_sm_model_id' => Models::loadIDByCodeStatic('\Numbers\Documentation\Documentation\Model\Embeddings', null, null, ['first' => true]),
                'tm_batchrecord_sm_model_code' => '\Numbers\Documentation\Documentation\Model\Embeddings',
                'tm_batchrecord_no_data_model_role_code' => 'embedding',
                'tm_batchrecord_field_code' => 'dn_embedding_code',
                'tm_batchrecord_field_name' => 'D/N Embedding Code',
                'tm_batchrecord_field_value_id' => null,
                'tm_batchrecord_field_value_code' => $dn_embedding_code,
                'tm_batchrecord_field_value_name' => 'Embedding Content and Vectors',
                'tm_batchrecord_module_id' => $row['dn_repopage_module_id'],
                'tm_batchrecord_inactive' => 0,
            ];
            $raw_batch_records[$dn_embedding_code . '::REPOSITORY_ID'] = [
                'tm_batchrecord_sm_model_id' => Models::loadIDByCodeStatic('\Numbers\Documentation\Documentation\Model\Repositories', null, null, ['first' => true]),
                'tm_batchrecord_sm_model_code' => '\Numbers\Documentation\Documentation\Model\Repositories',
                'tm_batchrecord_no_data_model_role_code' => 'secondary',
                'tm_batchrecord_field_code' => 'dn_repository_id',
                'tm_batchrecord_field_name' => 'D/N Repository #',
                'tm_batchrecord_field_value_id' => $row['dn_repopage_repository_id'],
                'tm_batchrecord_field_value_code' => null,
                'tm_batchrecord_field_value_name' => $row['dn_repository_name'],
                'tm_batchrecord_module_id' => $row['dn_repopage_module_id'],
                'tm_batchrecord_inactive' => 0,
            ];
            $raw_batch_records[$dn_embedding_code . '::PAGE_ID'] = [
                'tm_batchrecord_sm_model_id' => Models::loadIDByCodeStatic('\Numbers\Documentation\Documentation\Model\Repository\Version\Pages', null, null, ['first' => true]),
                'tm_batchrecord_sm_model_code' => '\Numbers\Documentation\Documentation\Model\Repository\Version\Pages',
                'tm_batchrecord_no_data_model_role_code' => 'secondary',
                'tm_batchrecord_field_code' => 'dn_repopage_id',
                'tm_batchrecord_field_name' => 'D/N Page #',
                'tm_batchrecord_field_value_id' => $row['dn_repopage_id'],
                'tm_batchrecord_field_value_code' => null,
                'tm_batchrecord_field_value_name' => $row['dn_repopage_name'],
                'tm_batchrecord_module_id' => $row['dn_repopage_module_id'],
                'tm_batchrecord_inactive' => 0,
            ];
            $raw_batch_records[$dn_embedding_code . '::FRAGMENT_ID'] = [
                'tm_batchrecord_sm_model_id' => Models::loadIDByCodeStatic('\Numbers\Documentation\Documentation\Model\Repository\Version\Page\Fragments', null, null, ['first' => true]),
                'tm_batchrecord_sm_model_code' => '\Numbers\Documentation\Documentation\Model\Repository\Version\Page\Fragments',
                'tm_batchrecord_no_data_model_role_code' => 'primary',
                'tm_batchrecord_field_code' => 'dn_repopgfragm_id',
                'tm_batchrecord_field_name' => 'D/N Fragment #',
                'tm_batchrecord_field_value_id' => $row['dn_repopgfragm_id'],
                'tm_batchrecord_field_value_code' => null,
                'tm_batchrecord_field_value_name' => $row['dn_repopgfragm_name'] ?: 'Fragment',
                'tm_batchrecord_module_id' => $row['dn_repopage_module_id'],
                'tm_batchrecord_inactive' => 0,
            ];
            $batch_helper_save = Save::create(null, 'DN_EMBEDDINGS', $raw_batch_records);
            if (!$batch_helper_save['success']) {
                return false;
            }
        }, [
            'ai_agent_code' => $ai_settings['ai_setting_embedding_ai_agent_code'],
            'dn_embedding_ai_ragtype_code' => 'DN::FRAGMENTS',
        ]);
    }
}
