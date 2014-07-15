<?php

require_once '../libraries/config.lib.php';
require_once '../libraries/database.lib.php';
require_once '../libraries/form.lib.php';
require_once '../libraries/hash.lib.php';
require_once '../libraries/login.lib.php';
require_once '../libraries/model.lib.php';
require_once '../models/comment.collection.php';
require_once '../models/thread.collection.php';
require_once '../models/page.collection.php';

#Protects the page so only admin can see
Login::kickout();

#Establishing tb_categories table
# This will allow tb_categories to use any function that we have set within the Model Library.
$page_stuff = new Model('tb_pages');

#If the string "id" is found in the url (which would happen if we clicked on a page that exists in the database.)
if($_GET['id']){
	//$pages then accesses the model library to perform the 'Load' function which will then find everything associated with that id.
	$page_stuff->load($_GET['id']);
	//title of the page becomes 'Edit pages'
	$title = 'Edit Page';
}
else{
	//If the id is not found in the url 'Create pages' 
	$title = 'Create Page';
}

#If the form was just posted
if($_POST){
	//
	$page_stuff->name = $_POST['name'];
	$page_stuff->content = $_POST['content'];
	//Saves the pages
	$page_stuff->save();
	//Redirects us to the page where we just added the new pages
	header("location: add_page.php?id=$page_stuff->id");
	exit;
}

include '../views/header.php';
include '../views/navigation.php';
include '../views/page_form.php';
include '../views/footer.php';