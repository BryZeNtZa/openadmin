<?php
/**
 * Project : OPEN ADMIN
 * File Author : BryZe NtZa
 * File Description : SQL Queries Builder
 * Date : Mai 2018
 * Copyright XDEV WORKGROUP
 * */

namespace OpenAdmin\Dao;
 
class Find extends Query {
	
    protected $fields = null;
    protected $where = null;
    protected $groupby = null;
    protected $orderby = null;
    protected $updateset = null;

    protected $limit = null;

    public function __construct(string $tablename, string $fields='*') {

        parent::__construct($tablename);
		$this->type ??= $type;
    }

    public function select($fields=null) {

            if( !empty($fields) ) {

                    if( is_string($fields) ) {
                            $this->fields = $fields;
                    }
                    elseif( is_array($fields) ) {
                            $this->fields = implode(',', $fields);
                    }
                    else {
                            $this->fields = '*';
                    }
            }
            else {
                    $this->fields = '*';
            }
    }

    public function select2($fields=null) {

            if( !empty($fields) ) {

                    if( is_string($fields) ) {
                            $this->fields = $fields;
                    }
                    elseif( is_array($fields) ) {
                            $this->fields = implode(',', $fields);
                    }
            }
    }

    public function set($fields) {

            foreach($fields as $field=>$value) {
                    $v = is_string($value) ? $this->protectStr($value) : $value;

                    if($this->updateset == null) {
                            $this->updateset = $field . '=' . $v;
                    }
                    else {
                            $this->where .= ',' . $field . '=' . $v ;
                    }

            }
    }

    public function ID($id) {
            $this->equal(['ID'=>intval($id)]);
    }

    public function equal($fields) {

            foreach($fields as $field=>$value) {
                    $v = is_string($value) ? $this->protectStr($value) : $value;

                    if($this->where == '') {
                            $this->where = $field . '=' . $v;
                    }
                    else {
                            $this->and();
                            $this->where .= $field . '=' . $v ;
                    }

            }
    }

    public function between($da) {

    }

    /*public function and(){
            $this->where .= ' AND ';
    }

    public function or() {
            $this->where .= ' OR ';
    }*/

    public function groupby ($groupby) {
            $this->groupby = $groupby;
    }

    public function orderby ($orderby) {
            $this->orderby = $orderby;
    }

    public function protectStr($str) {
		$search = ['"','\'', '\\'];
		$replace = ['&quot;','&quot;', '&slash'];

		return '"' . str_replace($search, $replace, $str) . '"';
    }

    public function build () {

		switch($this->qtype) {

			case 'SELECT' :

				$req = $this->qtype . $this->fields . ' FROM ' . $this->tablename;

				if( $this->where != null ) {
					$req .= ' WHERE '. $where;
				}

				if( $this->groupby != null ) {
					$req .= ' GROUP BY ' . $this->groupby;
				}

				if( $this->orderby != null ) {
					$req .= ' ORDER BY ' . $this->orderby;
				}

				if( $this->limit != null ) {
					$req .= ' LIMIT ' . $this->limit;
				}

			break;

			case 'UPDATE' :
				$req =  $this->qtype . ' ' . $this->tablename . ' SET ' . $this->updateset . ' WHERE ' . $this->where;
			break;
		}

        return $req;
    }

}
