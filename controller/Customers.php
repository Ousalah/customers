<?php
include_once '../model/CustomersModel.php';
extract($_GET);
extract($_POST);

switch ($a) {

	case 'add':
		$customerInfo = array();
		parse_str($_POST['customerInfo'], $customerInfo);
		Customers::insert($_POST["t"], $customerInfo);
		break;

	case 'get':
		$data = array();
		$columns = array();

		// get only column name
		foreach (Customers::getColumns($getColumnsArgs["table"]) as $field) {
			$columns[] = $field->COLUMN_NAME;
		}

		// assign columnNames and customer data to $data
		$data["column"] = $columns;
		// get customers with pagination
		$data["customer"] = Customers::getPaginatedCustomers(2, 25);
		// get columns count
		$data["countinfo"] = array(
			'count' => count(Customers::get($countArgs)),
			'min'   => $data["customer"][0]->RowNum,
			'max'   => end($data["customer"])->RowNum
		);

		echo json_encode($data);
		break;

	case 'nextid':
		echo json_encode(Customers::nextid($args["table"], $args["primaryKey"]));
		break;

	default:
		header("location:../index.php");
		break;
}

?>
