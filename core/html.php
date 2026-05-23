<?php
namespace Core;

class html
{
	public function __construct() {}

	public static function addInput(string $type, string $idInput, string $label = '', array $arrAttrInput = [], array $arrAttrDiv = [], mixed $inputVal = ''): string
	{
		if ($inputVal) {
			$arrAttrInput['value'] = $inputVal;
		}

		$strAttrInput = self::adjustAttr($arrAttrInput);
		$strAttrDiv = self::adjustAttr($arrAttrDiv);
		$label = self::handleRequiredLabel($label, $arrAttrInput);

		$abreDiv = "<div id='div$idInput' $strAttrDiv>";
		$label = "<label for=".$idInput.">$label</label>";
		$input = "<input type=\"".$type."\" name=\"".$idInput."\" id=\"".$idInput."\" $strAttrInput></input>";
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

	public static function addSelect(string $idInput, string $label = '', array $arrSelectOptions = [], array $arrAttrInput = [], array $arrAttrDiv = [], mixed $inputVal = ''):string
	{
		$strAttrInput = self::adjustAttr($arrAttrInput);
		$strAttrDiv = self::adjustAttr($arrAttrDiv);
		$strSelectOptions = self::handleSelectOptions($arrSelectOptions, $arrAttrInput, $inputVal);
		$label = self::handleRequiredLabel($label, $arrAttrInput);

		$abreDiv = "<div id='div$idInput' $strAttrDiv>";
		$label = "<label for=".$idInput.">$label</label>";
		$select = "<select name=\"".$idInput."\" id=\"".$idInput."\" $strAttrInput value='$inputVal'>$strSelectOptions</select>";
		$divSelect = $abreDiv.$label.$select."</div>";
		return $divSelect;
	}

	private static function handleSelectOptions(array $arrSelectOptions, array $arrAttrInput, mixed $inputVal): string
	{
		foreach($arrSelectOptions as $value => $label) {
			$selected = $value == $inputVal ? 'selected' : '';

			$strOptions[] = "<option $selected value=".$value.">".$label."</option>";
		}

		self::addSelectOption($strOptions, $arrAttrInput);
		return implode('', $strOptions);
	}

	private static function addSelectOption(array &$arrSelectOptions, array $arrAttrInput): void
	{
		if (key_exists('placeholder', $arrAttrInput) && $arrAttrInput['placeholder'] == 1) {
			$arrSelectOptions = array_merge(["<option value=''>Select:</option>"], $arrSelectOptions);
		}
	}

	private static function handleRequiredLabel(string $label, array $arAttr): string
	{
		if (key_exists('required', $arAttr)) {
			$label = $label . ' <span class="span-required">*</span>';
		}

		return $label;
	}
}
