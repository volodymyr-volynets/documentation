<?php

namespace Numbers\Documentation\Documentation\Helper\Renderer;
class PDF {

	/**
	 * Render
	 *
	 * @param array $data
	 */
	public static function render($values = []) {
		// fetch entire tree
		$data = \Numbers\Documentation\Documentation\DataSource\Repository\PageChildPages::getStatic([
			'where' => [
				'dn_repopage_module_id' => $values['__module_id'],
				'dn_repopage_id' => $values['dn_repopage_id'],
				'dn_repository_id' => $values['dn_repository_id'],
				'dn_repopage_language_code' => $values['dn_repository_language_code'],
			]
		]);
		// convert data
		$result = $temp = [];
		$converted = \Helper\Tree::convertByParent($data, 'parent_id');
		\Helper\Tree::convertTreeToOptionsMulti($converted, 0, ['name_field' => 'name', 'i18n' => 'skip_sorting'], $temp);
		$data_max_level = 0;
		$counter = 0;
		foreach ($temp as $k => $v) {
			if ($v['level'] > $data_max_level) {
				$data_max_level = $v['level'];
			}
			$v['__key'] = $k;
			unset($v['options']);
			$result[$counter] = $v;
			$counter++;
		}
		unset($temp, $data);
		// fetch repository
		$repository = \Numbers\Documentation\Documentation\Model\Repositories::getStatic([
			'where' => [
				'dn_repository_module_id' => $values['__module_id'],
				'dn_repository_id' => $values['dn_repository_id'],
			],
			'single_row' => true,
			'pk' => null,
		]);
		// create PDF
		$pdf = new \Numbers\Backend\IO\PDF\Wrapper([
			'skip_header' => true,
			'skip_footer' => true,
			'font' => 'freeserif',
		]);
		$pdf->AddPage();
		// title
		$pdf->SetFont($pdf->__options['font']['family'], 'B', 24);
		$_y = (int) ($pdf->getPageHeight() / 2);
		$pdf->SetXY(15, $_y);
		$pdf->Cell($pdf->getPageWidth() - 30, 24, i18n(null, $repository['dn_repository_name'], ['language_code' => $values['dn_repository_language_code']]), 0, false, 'C', 0, '', 0, false, 'T', 'M');
		// render pages
		$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
		$pdf->AddPage();
		$_y = 15;
		$levels = [
			0 => 24,
			1 => 22,
			2 => 20,
			3 => 18,
			4 => 16,
			5 => 14,
			6 => 12,
			7 => 11,
			8 => 10,
			9 => 9,
			10 => 8,
		];
		// load fragments
		$all_page_ids = [];
		foreach ($result as $k => $v) {
			$all_page_ids[$v['id']] = $v['id'];
		}
		$fragments = \Numbers\Documentation\Documentation\Model\Repository\Version\Page\Fragments::getStatic([
			'where' => [
				'dn_repopgfragm_repopage_id' => $all_page_ids
			],
			'pk' => ['dn_repopgfragm_repopage_id', 'dn_repopgfragm_id'],
			'orderby' => ['dn_repopgfragm_order' => SORT_ASC],
		]);
		$fragment_translations = \Numbers\Documentation\Documentation\Model\Repository\Version\Page\Fragment\Translations::getStatic([
			'where' => [
				'dn_repofragtransl_repopage_id' => $all_page_ids,
				'dn_repofragtransl_language_code' => $values['dn_repository_language_code'],
			],
			'pk' => ['dn_repofragtransl_repopage_id', 'dn_repofragtransl_repopgfragm_id'],
		]);
		foreach ($result as $k => $v) {
			$pdf->SetXY(15, $_y);
			$pdf->Bookmark($v['name'], $v['level'], -1, '', 'B', [0, 64, 128]);
			$pdf->SetFont($pdf->__options['font']['family'], 'B', $levels[$v['level']]);
			$pdf->Cell(0, 24, $v['name'], 0, 1, 'L');
			$_y+= $levels[$v['level']] / 2;
			// add content
			if (!empty($fragments[$v['id']])) {
				$pdf->SetFont($pdf->__options['font']['family'], '', 8);
				foreach ($fragments[$v['id']] as $k2 => $v2) {
					$header = $v2['dn_repopgfragm_name'];
					$body = $v2['dn_repopgfragm_body'];
					if (!empty($fragment_translations[$v['id']][$k2])) {
						$body = $fragment_translations[$v['id']][$k2]['dn_repofragtransl_body'];
						$header = $fragment_translations[$v['id']][$k2]['dn_repofragtransl_name'];
					}
					// remove links
					$body = preg_replace('#<a.*?>(.*?)</a>#i', '$1', $body);
					// main switch
					switch ($v2['dn_repopgfragm_type_code']) {
						case 'CODE':
							$pdf->writeHTML($body, true, false, true, false, '');
							$pdf->writeHTML('<b>' . $header . '</b>', true, false, true, false, 'C');
							break;
						case 'TEXT':
						default:
							$pdf->writeHTML('<b>' . $header . '</b>', true, false, true, false, '');
							$pdf->writeHTML($body, true, false, true, false, '');
							break;
					}
					$_y = $pdf->GetY();
					$_y+= $levels[$v['level']] / 2;
				}
			}
			// new page
			if ($_y > $pdf->getPageHeight() - 50) {
				$pdf->AddPage();
				$_y = 15;
			}
		}
		// toc
		$pdf->addTOCPage();
		// write the TOC title
		$pdf->SetFont($pdf->__options['font']['family'], 'B', 24);
		$pdf->MultiCell(0, 0, i18n(null, 'Table Of Content', ['language_code' => $values['dn_repository_language_code']]), 0, 'C', 0, 1, '', '', true, 0);
		$pdf->Ln();
		$pdf->SetFont($pdf->__options['font']['family'], '', 12);
		$pdf->addTOC(2, $pdf->__options['font']['family'], '.', 'INDEX', 'B', array(0, 0, 0));
		$pdf->endTOCPage();
		// output
		$pdf->Output(str_replace(' ', '_', $repository['dn_repository_name']) . '.pdf', 'I');
		exit;
		return '';
	}
}