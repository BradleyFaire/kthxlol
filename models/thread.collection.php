<?php 

require_once '../libraries/config.lib.php';

class Threads{

	public $items = array(); //holds content in database
	private $db;

	#establish a connection to the db
	public function __construct($id = false){
		$this->db = new Database(
			Config::$hostname,
			Config::$username,
			Config::$password,
			Config::$database
			);

		#select all products if they haven't been "deleted"
		$this->db
			->select('*')
			->from('tb_threads')
			->where('deleted', '0'); //if they are not deleted. Deleted =0
		
		# if it exists already, make sure the category_id is consistent
		if($id){
			$this->db->where_and('id', $id);
		}

		# get dem items
		$this->items = $this->db->get();
	}

	# count how many products are in this list
	public function count_items(){
		return count($this->items);
	}

}
