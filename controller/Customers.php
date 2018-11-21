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

	case 'get':
		$data = array();
		$columns = array();

		// get only column name
		foreach (Customers::getColumns($args["table"]) as $field) {
			$columns[] = $field->Field;
		}

		// assign columnNames and customer data to $data
		$data["column"] = $columns;
		$data["customer"] = Customers::get($args);
		echo json_encode($data);
		break;

	default:
		header("location:../index.php");
		break;
}

?>
