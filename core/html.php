<?php
namespace Core;

class html
{
	public function __construct() {}

	public static function addInput(string $type, string $idInput, string $label = '', array $arrAttrInput = [], array $arrAttrDiv = [], mixed $inputVal = ''): string
	{
		$strAttrInput = self::adjustAttr($arrAttrInput);
		$strAttrDiv = self::adjustAttr($arrAttrDiv);

		$abreDiv = "<div id='div$idInput' $strAttrDiv>";
		$label = "<label for=".$idInput.">$label</label>";
		$input = "<input type=\"".$type."\" name=\"".$idInput."\" id=\"".$idInput."\" $strAttrInput value='$inputVal'></input>";
		$divInput = $abreDiv.$label.$input."</div>";
		return $divInput;
	}

	public static function addTable(string $id, array $arrAttrInput = []): string
	{
		$strAttrInput = self::adjustAttr($arrAttrInput);

		return $strAttrInput." id=\"".$id."\"";
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

	public static function addTableAction(string $type, string $id, string $label, array $arrAttrBtn = []): string
	{
		$strAttrBtn = self::adjustAttr($arrAttrBtn);
		$str = "<button $strAttrBtn type='$type' name='$id' id='$id'>$label</button>";
		return $str;
	}
}
