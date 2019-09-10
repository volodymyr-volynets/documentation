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
		print_r2($dep['data']['submodule_dirs']);
		// find all classes
		$classes = [];
		foreach ($dep['data']['submodule_dirs'] as $k => $v) {
			if (!file_exists($v . 'module.ini')) {
				continue;
			}
			$data = \System\Config::ini($v . 'module.ini', 'module', ['simple_keys' => true]);
			print_r2($data);
		}
	}
}