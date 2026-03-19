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
        if (in_array($this->action, ['r', 'u']) && !empty($this->id)) {
            $this->setArrData();
        }

        $this->setArrInputs($this->getArrInput());

        ob_start();
            $this->callViewFrom($this->getViewForm());
        $this->setViewContent(ob_get_clean());

        $this->callViewFrom('index');
    }

    public function getArrInputs(): array
    {
        return $this->arrInputs;
    }

    public function Submit(): void
    {
        if ($this->post && (!$this->get['complete'] ?? false)) {
            switch ($this->action) {
                case 'c':
                    $arrPdo = $arrInsert = [];

                    foreach($this->post as $nmCampo => $value) {
                        $nmCampo = strtoupper($nmCampo);
                        $arrPdo[":$nmCampo"] = $value;
                        $arrInsert[$nmCampo] = ":$nmCampo";
                    }

                    Database::insert($this->getSqlTable(), $arrInsert, $arrPdo);
                    // TODO refatorar para utilizar o model
                case 'u':
                    $arrPdo = $arrUpdate = [];
                    $nmTable = $this->getSqlTable();
                    $strIdTable = "ID" .strtoupper($nmTable);

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
            'type' => $type,
            'idInput' => $idInput,
            'label' => $label,
            'arrAttrInput' => $arrAttrInput,
            'arrAttrDiv' => $arrAttrDiv,
        ];
    }

    public function getArrInput():array
    {
        return $this->arrInputs;
    }

    public function getWidth($nr): string
    {
        return "col-$nr";
    }
}
