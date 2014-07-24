<?php 

require_once '../libraries/config.lib.php';

class Comments{

	public $items = array(); //holds content in database
	public $per_page = 5;
	private $db;

	#establish a connection to the db
	public function __construct($id = false, $page = null){
		$this->db = new Database(
			Config::$hostname,
			Config::$username,
			Config::$password,
			Config::$database
			);

		#select all comments if they haven't been "deleted"
		$this->db
			->select('*')
			->from('tb_comments')
			->where('deleted', '0') //if they are not deleted. Deleted =0
			->where_and('thread_id', $id)
			->order_by('date_posted', 'ASC');

		if($page !== null){
			$this->db->limit(($page-1)*$this->per_page, $this->per_page);
		}


		# get dem items
		$this->items = $this->db->get();

		// echo $this->db->last_query;
	}

	# count how many products are in this list
	public function count_comments(){
		$items = $this->db->select('id')->from('tb_comments')->where('deleted', '0')->get();
		return count($items);
	}

	public function count_items(){
		return count($this->items);
	}


}

