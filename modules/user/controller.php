<?php
require_once ("../../../include/initialize.php");
	 }

$action = (isset($_GET['action']) && $_GET['action'] != '') ? $_GET['action'] : '';

switch ($action) {
	case 'add' :
	doInsert();
	break;
	
	case 'edit' :
	doEdit();
	break;
	
	case 'delete' :
	doDelete();
	break;

	case 'assign':
	doassignsubj();
	break;

	case 'delsubj':
	doDelsubj();
	break;
	case 'grade':
	savegrade();
	break;
	}
   
	function doInsert(){
		global $mydb;
		if(isset($_POST['save'])){


		if ($_POST['user_name'] == "" OR $_POST['user_email'] == "" OR $_POST['user_pass'] == "") {
			$messageStats = false;
			message("All field is required!","error");
			redirect('index.php?view=add');
		}else{	
			$user = New User();
			// $user->USERID 		= $_POST['user_id'];
			$user->NAME 		= $_POST['user_name'];
			$user->UEMAIL		= $_POST['user_email'];
			$user->PASS			=sha1($_POST['user_pass']);
			$user->TYPE			= "Administrator" ;// $_POST['user_type'];
			$user->create();
			$id =  $mydb->insert_id();
			$student = New Student();
		    $student->IDNO          = $id;
		    $student->FNAME         =  $_POST['user_name'];    
		    $student->USERNAME      = $_POST['user_email'];
		    $student->STUDPASS      = sha1($_POST['user_pass']);
		    $student->create(); 

					

			message("New [". $_POST['user_name'] ."] created successfully!", "success");
			redirect("index.php");
			
		}
		}

	}

	function doEdit(){
		global $mydb;
	if(isset($_POST['save'])){

			$user = New User(); 
			$user->NAME 		= $_POST['user_name'];
			$user->UEMAIL		= $_POST['user_email'];
			$user->PASS			=sha1($_POST['user_pass']);
			$user->TYPE			= "Administrator" ; //$_POST['user_type'];
			$user->update($_POST['user_id']);

			 $sql = "SELECT * FROM `tblstudent` WHERE `IDNO`='".$_POST['user_id']."'";
			 $mydb->setQuery($sql);
			 $mydb->executeQuery();


			  message("[". $_POST['user_name'] ."] has been updated!", "success");
			redirect("index.php");
		}
	}


	
		
		
		
?>