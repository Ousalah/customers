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
		// $args = array("table" => "client");
		Customers::get($args);
		$data = array();
		foreach (Customers::get($args) as $Customer) {
			$sub_array = array();
			$sub_array[] = $Customer["CLIENT"];
			$sub_array[] = $Customer["TEL"];
			$sub_array[] = $Customer["ADRESSE1LIV"];
			$data[] = $sub_array;
		}
		echo json_encode($data);

		// if (Utils::isAjax()) {
		// 	echo json_encode(Customers::get($args));
		// }
		break;


	default:
		header("location:../index.php");
		break;
}

?>
