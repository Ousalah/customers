<?php
/**
*
*/
// include_once '../modules/utils.class.php';
include dirname(__FILE__).'/../modules/utils.class.php';

class Customers extends Utils {

  public static function nextid($table, $primaryKey = 'id') {
    $cnx  = Utils::connect_db();
		$stmt = $cnx->prepare("SELECT TOP 1 $primaryKey FROM $table ORDER BY $primaryKey DESC");
		$stmt->execute();

    // check if table has data increment by 1, else start with 0
    $id = 0;
    if ($stmt->rowCount() == -1) {
      $id = $stmt->fetchColumn();
      $id = (isset($id) && is_numeric($id)) ? intval($id) : 0;
      $id += 1;
    }

    // format code with 7 digits
    $id = sprintf("%07s", $id);

    return $id;
  }

}
?>
