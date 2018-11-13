<?php
include_once '../model/CustomersModel.php';
extract($_GET);
extract($_POST);

switch ($a) {

	case 'add':
		echo "insert begin";
		Customers::insert($t, $_POST);
		Customers::set_val_session("notice", "The addition was <strong>successfully</strong> completed.");
		break;


	default:
		header("location:../index.php");
		break;
}

?>
