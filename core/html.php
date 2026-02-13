<?php
namespace Core;

class html
{
	public function __construct() {}

	public static function addInput(string $type, string $idInput, string $label = '', array $arrAttrInput = [])
	{
		$strAttrInput = self::adjustAttr($arrAttrInput);

		$abreDiv = '<div id="div'.$idInput.'" class="form-group">';
		$label = "<label for".$idInput.">$label</label>";
		$input = "<input type=\"".$type."\" name=\"".$idInput."\" id=\"".$idInput."\" $strAttrInput></input>";
		$divInput = $abreDiv.$label.$input."</div>";
		return $divInput;
	}

	public static function addTable(string $name, string $label, array $arrAttrInput = []): string
	{
		$strAttrInput = self::adjustAttr($arrAttrInput);









		return '';


		/*
		<thead> utilizar $label
			<th>$label</th>
		</thead>
		<tbody>// utilizar o $name, $label, $arrAttrInput
			<tr>
				<li></li>
			</tr>
		</tbody>

		 */

	}

	private static function adjustAttr(array $arrAttr): string
	{
		$strAttrInput = '';
		if (!empty($arrAttr ?? [])) {
			foreach($arrAttr as $nmAttr => $valAttr) {
				$strAttrInput .= " $nmAttr = \"$valAttr\"";
			}
		}
		return $strAttrInput;
	}
}
