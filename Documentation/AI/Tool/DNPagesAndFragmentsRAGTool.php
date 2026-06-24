<?php

/*
 * This file is part of Numbers Framework.
 *
 * (c) Volodymyr Volynets <volodymyr.volynets@gmail.com>
 *
 * This source file is subject to the Apache 2.0 license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Numbers\Documentation\Documentation\AI\Tool;

use Numbers\AI\SDK\Classes\Tool\BaseTool;
use Numbers\AI\SDK\Classes\Tool\AgenticRAGTool;
use Numbers\Documentation\Documentation\Model\Repositories;

class DNPagesAndFragmentsRAGTool extends BaseTool
{
    public string $name = 'dn_pages_and_fragments_rag_tool';
    public function description(): string
    {
        return <<<TEXT
Tool: dn_pages_and_fragments_rag_tool

Description:
Searches internal knowledge base for documentation in pages and fragments.

When to use:
- Questions from documentation
- Requests requiring up-to-date information
- When unsure and external knowledge may be insufficient

How to use:
1. Rewrite the user query into a concise search query
2. Include key entities, and context
3. Call the tool with the improved query

Returns:
- List of top-k results (1-5), each containing:
  - content (text chunk)
  - source (document code or identifier)
  - score (relevance 0-1)

Instructions:
- Use retrieved content as the primary source of truth
- Combine multiple chunks if needed
- Prefer higher relevance scores
- Cite sources in the answer
- Do NOT fabricate information not present in results

Failure handling:
- If no relevant results: say you don't know or ask for clarification
- If ambiguous: ask a follow-up before retrying
TEXT;
    }
    public function run(array $input): array
    {
        $result = AgenticRAGTool::singleRAG(
            ['DN::PAGES', 'DN::FRAGMENTS'],
            $input['query'],
            $input['maximum_records'] ?? null,
            function ($query, $options) {
                $repository = Repositories::getSingleStatic([
                    'where' => [
                        'dn_repository_tenant_id' => \Tenant::id(),
                        'dn_repository_name' => $options['repository_name'],
                    ]
                ]);
                $query->where('AND', ['a.dn_embedding_module_id', '=', $repository['dn_repository_module_id']]);
                $query->where('AND', ['a.dn_embedding_dn_repository_id', '=', $repository['dn_repository_id']]);
                return $query;
            },
            $input,
        );
        return $result['content_structured'];
    }
    public function schema(): array
    {
        $repository_names = Repositories::queryBuilderStatic()
            ->columns('dn_repository_name')
            ->whereMultiple('AND', [
                'dn_repository_tenant_id' => \Tenant::id(),
            ])
            ->query('dn_repository_name')['rows'];
        return [
            'query' => ['required' => true, 'name' => 'Query', 'domain' => 'prompt'],
            'repository_name' => ['required' => true, 'name' => 'Repository Name', 'domain' => 'name', 'enum' => array_keys($repository_names)],
            'maximum_records' => ['name' => 'Maximum Records', 'domain' => 'counter', 'null' => true],
        ];
    }
}
