<?php

require_once '../libraries/model.lib.php';

# a new model called "Category_model"
class Threads extends Model{

	public $table = 'tb_threads';

	# this will construct the model and let its functions be called
	public function __construct(){
		parent::__construct($this->table);
	}

	# this will select a 
	public function thread_name($thread){
		$test = $this->db
			->select('name')
			->from($this->table)
			->where('id', $thread)
			->get_one();
			return $test;
	}

	public function list_threads(){
		$this->data = $this->db
		->select('*')
		->from($this->table)
		->where('deleted', '0') //if they are not deleted. Deleted =0
		->where_and('main_thread', '0')
		->get();
		return $this->data;
	}

	public function list_main_threads(){
		$this->data = $this->db
		->select('*')
		->from($this->table)
		->where('deleted', '0') //if they are not deleted. Deleted =0
		->where_and('main_thread', '1')
		->get();
		return $this->data;
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