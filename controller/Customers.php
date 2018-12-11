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

		// get customers count
		$count = Customers::get($countArgs, "fetchColumn");
		// get last page value
		$lastPage = ceil($count / $page["perPage"]) > 0 ? ceil($count / $page["perPage"]) : 1;

		// start set pagination info (next, prev, current)
		// validation of currentPage value
		$currentPage = (isset($page["currentPage"]) && is_numeric($page["currentPage"])) ? intval($page["currentPage"]) : 1;
		$currentPage = ($currentPage >= 1) ? ($currentPage <= $lastPage ? $currentPage : $lastPage) : 1;
		// validation prevPage value
		$prevPage = $currentPage - 1;
		$prevPage = ($prevPage >= 1) ? $prevPage : 1;
		// validation nextPage value
		$nextPage = $currentPage + 1;
		$nextPage = ($nextPage <= $lastPage) ? $nextPage : $lastPage;
		// end set pagination info (next, prev, current)

		// get only column name
		foreach (Customers::getColumns($getColumnsArgs["table"]) as $field) {
			$columns[] = $field->COLUMN_NAME;
		}

		// assign columnNames and customer data to $data
		$data["column"] = $columns;
		// get customers with pagination
		$data["customer"] = Customers::getPaginatedCustomers($currentPage, $page["perPage"], $search);
		// get columns count
		$min = ($page["perPage"] * ($currentPage-1)) + 1;
		$min = $count > 0 ? $min : 0;
		$max = $page["perPage"] * $currentPage;
		$max = $max > $count ? $count : $max;

		$data["pagination"] = array(
			'count' 	=> $count,
			'min'   	=> $min,
			'max'   	=> $max,
			'current' => $currentPage,
			'prev'		=> $prevPage,
			'next'		=> $nextPage,
			'first'		=> 1,
			'last'		=> $lastPage,
		);

		echo json_encode($data);
		break;

	case 'nextid':
		echo json_encode(Customers::nextid($args["table"], $args["primaryKey"]));
		break;

	case 'check':
		echo json_encode(Customers::get($args));
		break;

	case 'edit':
		echo json_encode(Customers::get($args));
		break;

	case 'update':
		$customerInfo = array();
		parse_str($_POST['customerInfo'], $customerInfo);
		Customers::update($t, $customerInfo, $codeClt, "code_clt");
		break;

	case 'delete':
		Customers::delete($t, $args["idValue"], $args["idKey"]);
		break;

	default:
		header("location:../index.php");
		break;
}

?>
