<?php
/**
 * General searches Module
 * @author BryZe NtZa
 * @date   April 26th 2017
 */

namespace OpenAdmin\Library;

class Search extends CI_Controller {
    
    /*All tables to search in, and fields we want to match when searching*/
    private $users = array("accountant", "admin", "doctor", "nurse", "laboratorist", "pharmacist");
    private $others = array("message", "note", "notice", "noticeboard", "prescription");
    
    private $array_match = array(
        "patient" => array("name","email","address","phone","sex","birth_date","age","blood_group"),
        "medicine" => array("name", "key_words"),
        "doctor" => array("name","email","address","phone"),
        "laboratorist" => array("name","email","address","phone"),
        "pharmacist" => array("name","email","address","phone"),
        "accountant" => array("name","email","address","phone"),
    );
    
    /*Inputs*/
    private $keyword = ""; //Keyword
    private $searchin = array(); //Tablenames we want to search in
   
    /*Outputs*/
    private $found = 0; //Number results found
    private $results = array();
    
    public function __construct() {
        parent::__construct();
        $this->load->model('crud_model');
        $this->load->database();
        $this->load->library('session');
    }

    function search() {
        if ($this->session->userdata('admin_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
        }
        
        $this->getSearchResults();
        $page_data['search'] = array("found"=>$this->found, "results"=>$this->results);
        
        $page_data['users'] = $this->users;
        $page_data['others'] = $this->others;
        $page_data['keyword'] = $this->keyword;
        
        $page_data['module'] = '';
        $page_data['page_name'] = 'search';
        $page_data['page_title'] = get_phrase('search_results');
        $this->load->view('backend/index', $page_data);
    }
    
    function setDatas() {
        
        $this->keyword = $_GET["keyword"];
        
        if( isset($_GET["searchin"]) ) {
            
            foreach($_GET["searchin"] as $column) {         
                
                array_push($this->searchin, $column);
                
                if( $column == "users" ) {
                    foreach($this->users as $tablename) array_push($this->searchin, $tablename);
                }
                elseif ( $column == "others" ) {
                    foreach($this->others as $tablename) array_push($this->searchin, $tablename);
                }
                
            }
            
        }
        else {
            $this->searchin = NULL;
        }

    }
    
    function getMatchQuery($matchArray) {
        $match_columns = '';
        foreach($matchArray as $index=>$colonne)
            $match_columns .= ($match_columns == '') 
                            ? '(MATCH('.$colonne.') AGAINST ("'.$this->keyword.'*" IN BOOLEAN MODE))'
                            : ' OR (MATCH('.$colonne.') AGAINST ("'.$this->keyword.'*" IN BOOLEAN MODE))';
    
        return $match_columns;
    }
    
    function getMatchResults($tablename, $matchArray) {
        
        $this->db->select("*");
        $this->db->from($tablename);
        $this->db->where($this->getMatchQuery($matchArray), NULL, FALSE);
        $this->db->limit(100); 
        $query = $this->db->get();
        $resultArray = $query->result_array();
        
        $this->found += count($resultArray);
        
        return $resultArray;
    }
    
    function getSearchResults() {
       
        $this->setDatas();
	
        if($this->searchin)
            foreach($this->array_match as $tablename=>$tablecolumns)
                if(in_array($tablename, $this->searchin))
                    $this->results[$tablename] = $this->getMatchResults($tablename, $tablecolumns);
    }
    
    function suggest() {
        $this->getSearchResults();
        echo json_encode(array("found"=>$this->found, "results"=>$this->results)); 
    }
    
    
}
