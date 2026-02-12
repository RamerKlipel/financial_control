<?php
namespace Core;

class html
{
	public function __construct() {}

	public static function addInput(string $type, string $idInput, string $label = '', array $arrAttrInput = [])
	{
		$strAttrInput = '';
		if (!empty($arrAttrInput ?? [])) {
			foreach($arrAttrInput as $nmAttr => $valAttr) {
				$strAttrInput .= " $nmAttr = \"$valAttr\"";
			}
		}
		$abreDiv = '<div id="div'.$idInput.'" class="form-group">';
		$label = "<label for".$idInput.">$label</label>";
		$input = "<input type=\"".$type."\" name=\"".$idInput."\" id=\"".$idInput."\" $strAttrInput></input>";
		$divInput = $abreDiv.$label.$input."</div>";
		return $divInput;
	}
}
