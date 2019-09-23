<?php

namespace Numbers\Documentation\Documentator\Helper;
class Classes extends \Numbers\Documentation\Documentator\Abstract2\Objects {

	/**
	 * Generate documentation
	 *
	 * @return array
	 */
	public function generateDocumentationArray() : array {
		return [];
	}

	/**
	 * Load all dependencies
	 */
	public function loadAllDependencies() {
		$dep = \System\Dependencies::processDepsAll(['mode' => 'test']);
		// find all classes
		unset($dep['data']['submodule_dirs']['Config/']);
		$classes = [];
		foreach ($dep['data']['submodule_dirs'] as $k => $v) {
			if (!file_exists($v . 'module.ini')) {
				continue;
			}
			$data = \System\Config::ini($v . 'module.ini', 'module', ['simple_keys' => true]);
			$classes[$k] = [
				'module' => $data,
				'classes' => [],
			];
			// get all classes recursivelly
			if (empty($data['module.repository']) || strpos($k, '/Numbers/Framework/') !== false) {
				$classes[$k]['classes'] = \Helper\File::iterate($v, ['recursive' => true, 'only_extensions' => ['php']]);
			}
		}
		print_r2($classes);
	}
}