<?php

require_once '../libraries/model.lib.php';

# a new model called "Category_model"
class Pages extends Model{

	public $table = 'tb_pages';

	# this will construct the model and let its functions be called
	public function __construct(){
		parent::__construct($this->table);
	}

	# this will select a 
	public function page_name($page){
		$test = $this->db
			->select('name')
			->from($this->table)
			->where('id', $page)
			->get_one();
			return $test;
	}

	public function list_names(){

		$result = $this->db
			->select('name')
			->from($this->table)
			->where('deleted', '0')
			->get();
			$this->data = $result;

	}

}