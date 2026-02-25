<?php
namespace Core;

class html
{
	public function __construct() {}

	public static function addInput(string $type, string $idInput, string $label = '', array $arrAttrInput = [])
	{
		$strAttrInput = self::adjustAttr($arrAttrInput);

		$abreDiv = '<div id="div'.$idInput.'" class="form-group">';
		$label = "<label for=".$idInput.">$label</label>";
		$input = "<input type=\"".$type."\" name=\"".$idInput."\" id=\"".$idInput."\" $strAttrInput></input>";
		$divInput = $abreDiv.$label.$input."</div>";
		return $divInput;
	}

	public static function addTable(string $id, array $arrAttrInput = []): string
	{
		$strAttrInput = self::adjustAttr($arrAttrInput);

		return '<td '.$strAttrInput.' id="'.$id.'"> </td>';


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

	public static function addButton(string $type, string $id, string $label, array $arrAttrBtn = []): string
	{
		$strAttrBtn = self::adjustAttr($arrAttrBtn);
		$str = "<button $strAttrBtn type='$type' name='$id' id='$id'>$label</button>";
		return $str;
	}
}
