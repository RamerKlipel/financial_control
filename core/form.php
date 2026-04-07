<?php
namespace Core;
use Core\database;

trait form {
    protected $viewFormContent;
    protected $arrInputs = [];
    public function setArrInputs(array $arrInputs): void
    {
        $this->arrInputs = $arrInputs;
    }

    public function renderForm(): void
    {
        if (empty($this->getArrInputs())) {
            http_response_code(500);
            throw new \Exception("It's necessary to have at least one field on the function Form");

        }
        if (in_array($this->action, ['r', 'u']) && !empty($this->id)) {
            $this->setArrData();
        }

        ob_start();
            $this->callViewFrom($this->getViewForm());
        $this->setViewContent(ob_get_clean());

        $this->callViewFrom('index');
    }

    public function getArrInputs(): array
    {
        return $this->arrInputs;
    }

    public function Submit()
    {
        if ($this->post && !($this->get['complete'] ?? false)) {
            $this->post = array_filter($this->post);
            switch ($this->action) {
                case 'c':
                    $arrPdo = $arrInsert = [];

                    $this->handleTypeData($this->post);
                    foreach($this->post as $nmCampo => $value) {
                        $nmCampo = strtoupper($nmCampo);
                        $arrPdo[":$nmCampo"] = $value;
                        $arrInsert[$nmCampo] = ":$nmCampo";
                    }

                    Database::insert($this->getSqlTable(), $arrInsert, $arrPdo);
                case 'u':
                    $arrPdo = $arrUpdate = [];
                    $nmTable = $this->getSqlTable();
                    $strIdTable = "ID" .strtoupper($nmTable);

                    $this->handleTypeData($this->post);
                    foreach($this->post as $nmCampo => $value) {
                        $nmCampo = strtoupper($nmCampo);
                        $arrPdo[":$nmCampo"] = $value;
                        $arrUpdate[] = "$nmCampo = :$nmCampo";
                    };

                    $arrPdo[":$strIdTable"] = $this->id;
                    $where = "$strIdTable = :$strIdTable";

                    Database::update($this->getSqlTable(), $arrUpdate, $where, $arrPdo);
            }
        }
    }

    protected function addInput(string $type, string $idInput, string $label = '', array $arrAttrInput = [], array $arrAttrDiv = []): void
    {
        if ($this->action == "r") {
            $arrAttrInput['disabled'] = true;
        }
        $this->arrInputs[] = [
            'typeInput' => 'input',
            'type' => $type,
            'idInput' => $idInput,
            'label' => $label,
            'arrAttrInput' => $arrAttrInput,
            'arrAttrDiv' => $arrAttrDiv,
        ];
    }

    protected function addSelect(string $idInput, string $label = '', array $arrSelectOptions = [], array $arrAttrInput = [], array $arrAttrDiv = []): void
    {
        if ($this->action == "r") {
            $arrAttrInput['disabled'] = true;
        }
        $this->arrInputs[] = [
            'typeInput' => 'select',
            'idInput' => $idInput,
            'label' => $label,
            'arrSelectOptions' => $arrSelectOptions,
            'arrAttrInput' => $arrAttrInput,
            'arrAttrDiv' => $arrAttrDiv,
        ];
    }

    public function getWidth($nr): string
    {
        return "col-$nr";
    }

    public function handleTypeData($post)
    {
        foreach($this->post as $nmCampo => $value) {
            $prefix = substr($nmCampo, 0, 2);
            switch ($prefix) {
                case 'DA':
                    if (preg_match("/[0-9]{2}\/[0-9]{2}\/[0-9]{4}/", $value)) {
                        $this->post[$nmCampo] = formatDateDB($value);
                    }
                    break;
            }
        }
    }
}
