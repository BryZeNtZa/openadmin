<?php
/**
 * Project : OPEN ADMIN
 * File Author : BryZe NtZa
 * File Description : App DAO Configs
 * Date : June 2018
 * Copyright XDEV WORKGROUP
 * */

namespace XdevWorkgroup\Architecture;

class Table {
	
    protected $database = array('id' => 0);
    protected $model = array('id' => 0);
    protected $attributes = array('id' => []);
    protected $unitTables = array();
    protected $bigTableClass;
    protected \PDO $pdo;

    public function __construct($dbID, $modelID, $bigTbClass) {
        $this->bigTableClass = $bigTbClass;
        $this->database['id'] = $dbID;
        $this->model['id'] = $modelID;
    }

    public function getBigTableClass() {
        return $this->bigTableClass;
    }

    public function getBDParam($param) {
        return $this->database[$param];
    }

    public function getModelParam($param) {
        return $this->model[$param];
    }

    public function setDatabase($database) {
        $this->database = $database;
    }

    public function setModel($model) {
        $this->model = $model;
    }

    /* Get and Set attributes*/
    public function getAttributes() {
        return $this->attributes;
    }
    public function setAttributes($attributes) {
        $this->attributes = $attributes;
    }

    public function setDataAccessObject(\PDO $pdo) {
        $this->pdo = $pdo;
    }

    public function select() {
        // $unitTables
    }
}
