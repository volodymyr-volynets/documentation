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

use League\HTMLToMarkdown\HtmlConverter;

class RepositoryFragments2Embedding
{
    /**
     * Transform
     *
     * @param array $row
     * @param array $options
     * @return array{content: string, error: array, success: bool}
     */
    public static function transform(array $row, array $options = []): array
    {
        $content = [];
        $content[] = 'Type: D/N Repository Fragment';
        $content[] = 'Module ID: ' . $row['dn_repopgfragm_module_id'];
        $content[] = 'Page ID: ' . $row['dn_repopage_id'];
        $content[] = 'Page Name: ' . trim($row['dn_repopage_title_number'] . ' ' . $row['dn_repopage_name']);
        $content[] = 'Module: D/N';
        $content[] = 'Module Name: ' . $row['tm_module_name'];
        $content[] = 'Repository Name: ' . $row['dn_repository_name'];
        $content[] = 'Repository ID: ' . $row['dn_repository_id'];
        $content[] = 'Name: ' . $row['dn_repopgfragm_name'];
        // html -> markdown
        $converter = new HtmlConverter();
        $content[] = 'Content:' . "\n\n" . $converter->convert($row['dn_repopgfragm_body']);
        $content = implode("\n", $content);
        return [
            'success' => true,
            'error' => [],
            'content' => $content,
        ];
    }
}
