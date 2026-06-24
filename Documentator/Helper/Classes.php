<?php

/*
 * This file is part of Numbers Framework.
 *
 * (c) Volodymyr Volynets <volodymyr.volynets@gmail.com>
 *
 * This source file is subject to the Apache 2.0 license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Numbers\Documentation\Documentator\Helper;

use Helper\File;
use Numbers\Documentation\Documentator\Abstract2\Objects;
use System\Config;
use System\Dependencies;

class Classes extends Objects
{
    /**
     * Generate documentation
     *
     * @return array
     */
    public function generateDocumentationArray(): array
    {
        return [];
    }

    /**
     * Load all dependencies
     */
    public function loadAllDependencies()
    {
        $dep = Dependencies::processDepsAll(['mode' => 'test']);
        // find all classes
        unset($dep['data']['submodule_dirs']['Config/']);
        $classes = [];
        foreach ($dep['data']['submodule_dirs'] as $k => $v) {
            if (!file_exists($v . 'module.ini')) {
                continue;
            }
            $data = Config::ini($v . 'module.ini', 'module', ['simple_keys' => true]);
            $classes[$k] = [
                'module' => $data,
                'classes' => [],
            ];
            // get all classes recursivelly
            if (empty($data['module.repository']) || strpos($k, '/Numbers/Framework/') !== false) {
                $classes[$k]['classes'] = File::iterate($v, ['recursive' => true, 'only_extensions' => ['php']]);
            }
        }
        print_r2($classes);
    }
}
