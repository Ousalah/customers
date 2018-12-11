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


  /*
  ** @param $search = array of conditions, you have tow format of condition to pass it:
																		if you will only use equal sign (eq: =) pass the condition like that [ex 1: array("key" => "value")]
																		else if you will use different operators (=, <, >, ...) pass the condition like that
																		[ex 2: array(array('key' => "", "operator" => "=", "value" => "",  "andOrOperator" => "")]
																		in this case the key and value params are (required)
																		and the operator param is (optional) and (default = "="),
																		in the ex: 2 you can also choose andOrOperator (AND, OR, "") it is (optional) and (default = "")
																		you can also use a mixe of 'ex 1' and 'ex 2'
																		[ex 3: array("key" => "value"), array('key' => "", "operator" => "=", "value" => "")] - (optional) (default = "")
  */
  public static function getPaginatedCustomers($pageNumber = 1, $perPage =  50, $search = array(array('key' => "", "operator" => "=", "value" => "", "andOrOperator" => ""))) {
    $cnx  = Utils::connect_db();

    // Start where part (search)
    $search = (isset($search)) ? $search : array();
    // echo '$search';
    // var_dump($params);
    // echo "  end condition";

    $where  = "";
    $keys   = array();
    $values = array();
    if (!empty($search)) {
      $where = "AND";
      // if single condition [ex 2]
      if (isset($search["key"]) && isset($search["value"])) {
        $search["operator"] = (isset($search["operator"]) && !empty($search["operator"])) ? $search["operator"] : "=";
        $keys[] = "{$search["key"]} {$search["operator"]} ?";
        $values[] = $search["value"];
      } else {
        // if single condition [ex 1] or multi condition [ex 3]
        foreach ($search as $key => $value) {
          if (!empty($value) && is_array($value)) :
            $value["operator"] = (isset($value["operator"]) && !empty($value["operator"])) ? $value["operator"] : "=";
            $value["andOrOperator"] = (isset($value["andOrOperator"]) && !empty($value["andOrOperator"])) ? $value["andOrOperator"] : "";
            $keys[] = "{$value["key"]} {$value["operator"]} ? {$value["andOrOperator"]}";
            $values[] = $value["value"];
          else :
            $keys[] = "$key = ?";
            $values[] = $value;
          endif;
        }
      }
      $where = $where . " " . implode(" ", $keys);
    }
    // End where part (search)

    $stmt = $cnx->prepare("SELECT TOP $perPage * FROM (SELECT ROW_NUMBER() OVER (ORDER BY code_clt) AS RowNum, *
            FROM Z_TEST_CLIENT) AS RowConstrainedResult
            WHERE RowNum > ($perPage * ($pageNumber - 1)) {$where} ORDER BY code_clt ASC");
    $stmt->execute($values);
    return $stmt->fetchAll();
  }

}
?>
