
<?php
class Utils
{
	private static $cnx = null;

	public static function connect_db() {

		try {
			if(!self::$cnx) {
				$options = array(
					PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
					PDO::ATTR_ERRMODE 					 => PDO::ERRMODE_EXCEPTION,
					PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"
				);
				// start sql server
				// local
				// $cnx = new PDO("sqlsrv:Server=.,1433;Database=DONNEESLPSIEGE", "sa", "2013@2013", $options);
				// Remote
				$cnx = new PDO("sqlsrv:Server=105.159.255.86;Database=DONNEES", "attijari2013", "VOIE_2013", $options);
				// end sql server

				// start mysql
				// $cnx = new PDO('mysql:host=localhost;dbname=DONNEESLPSIEGE', "root", "", $options);
				// end mysql
			}
		} catch (Exception $e) {
			die(print_r($e->getMessage()));
		}

		return  $cnx;
	}

	// check if table exist
	public static function tableExists($table) {
		// Try a select statement against the table
		// Run it in try/catch in case PDO is in ERRMODE_EXCEPTION.
		try {
			$cnx=Utils::connect_db();
			$pr = $cnx->query("select 1 from $table LIMIT 1");
		} catch (Exception $e) {
			// We got an exception == table not found
			return FALSE;
		}
		// Result is either boolean FALSE (no table found) or PDOStatement Object (table found)
		return $result !== FALSE;
	}

	public static function delete($table, $id, $idKey = "id"){
		$cnx = Utils::connect_db();
		$pr  = $cnx->prepare("delete from $table where $idKey = ?");
		$pr->execute(array($id));
	}

	public static function upload($data) {
		# default filename
		$filename = "default_image.png";

		#dossier de destination
		$dossier = $data["dossier"];

		#récupération du nom réel de l'image + son extension
		$name = basename($data["name"]);

		#récupération de l'extension uniquement
		#strtolower changera l'extension en minuscule
		$extension = strtolower(pathinfo($data["name"], PATHINFO_EXTENSION));

		#allowed extentions
		$allowedExtention = array('png', 'jpg', 'jpeg');
		# vérification si le type de fichier est une image
		if(!in_array($extension, $allowedExtention)){
			return $filename;
		}

		$size = $data["size"];
		if($size > 8000000){
			die ("le fichier ne doit pas dépasser 8Mo");
		}

		#Nouveau Nom (crypter et unique)
		$newName = md5(date('ymdHsiu')."ousalah");

		#chemin d'upload
		$imagePath = $dossier."".$newName.".".$extension;

		#déplacement du fichier chargé en mémoire vers le dossier de destination
		#move_uploaded_file(fichier temporaire,la source)
		move_uploaded_file($data["tmp_name"], $imagePath);

		$filename = $newName.".".$extension;
		return $filename;

	}

	/**
	* @param $table (require) : table's name
	* @param $data (require) : data to insert : $_POST
	* @param $image (optional) : image info(dossier,name,tmp_name,size) : $_FILES
	**/
	public static function insert($table, $data = array(), $image = array()) {
		$names  = array();
		$values = array();
		$trous  = array();
		foreach ($data as $key => $value) {

			// if there is Multi values for one field, like checkboks
			if(is_array($value)){ $value = implode(', ', $value); }

			$names[]  = $key;
			$values[] = $value;
			$trous[]  = '?';
		}
		# -- test if Isset image.
		if (($image != array())) {
			$imagePath = Utils::upload($image);

			$names[]  = "image";
			$values[] = $imagePath;
			$trous[]  = '?';
		}

		$trousdb = implode(',', $trous);
		$namesdb = implode(',', $names);
		$cnx = Utils::connect_db();
		$pr = $cnx->prepare("insert into $table ($namesdb) values($trousdb)");
		// var_dump($pr);
		$pr->execute($values);
	}

	public static function update($table,	$data = array(), $idValue, $idKey = "id", $image = array()) {
		$names  = array();
		$values = array();
		$trous  = array();
		foreach ($data as $key => $value) {
			$names[]  = "$key=?";
			$values[] = $value;
		}

		# -- test if Isset image.
		if ($image != array() && !empty($image["name"])) {
			$imagePath = Utils::upload($image);
			$names[]   = "image = ?";
			$values[]  = $imagePath;
		}

		$namesdb  = implode(',', $names);
		$cnx      = Utils::connect_db();
		$pr       = $cnx->prepare("update $table set $namesdb where $idKey = ?");
		$values[] = $idValue;
		$pr->execute($values);
	}


	/*
	** Get all fuction v2.2
	** Function to get records from any table
	** @param $params["fields"]     = array of fields to be selected - (optional) (default = "*")
	** @param $params["table"]      = table name to select from it - (required)
	** @param $params["joins"]      = array of joins, has 4 params, if you will use multi join put each one in array
																		the table and primary and foreign params are (required)
																		the type param is (optional) and (default = "INNER") {options = "INNER", "RIGHT", "LEFT", "FULL"}
																		[ex single: array("table" => "tablename", "primary" => "ID", "foreign" => "ID")]
																		[ex multi: array(array("table" => "tablename", "primary" => "ID", "foreign" => "ID"))]
																		- (optional) (default = "")
	** @param $params["conditions"] = array of conditions, you have tow format of condition to pass it:
																		if you will only use equal sign (eq: =) pass the condition like that [ex 1: array("key" => "value")]
																		else if you will use different operators (=, <, >, ...) pass the condition like that
																		[ex 2: array(array('key' => "", "operator" => "=", "value" => "",  "andOrOperator" => "")]
																		in this case the key and value params are (required)
																		and the operator param is (optional) and (default = "="),
																		in the ex: 2 you can also choose andOrOperator (AND, OR, "") it is (optional) and (default = "")
																		you can also use a mixe of 'ex 1' and 'ex 2'
																		[ex 3: array("key" => "value"), array('key' => "", "operator" => "=", "value" => "")] - (optional) (default = "")
	** @param $params["orderBy"]    = field to use it in the ordering - (optional) (default = "")
	** @param $params["orderType"]  = type of ordering - (optional) (default = "DESC") {options = "DESC", "ASC", "RAND()"}
	** @param $params["limit"]      = number of records to get - (optional) (default = "")
	** @param $params["checkExist"] = false to retrieve data, and true to check only extension - (optional) (default = false)
	** @param $fetch                = type of fetch (optional) (default = "fetchAll") {options = "fetchAll", "fetch"}
	** @return records
	*/
	public static function get($params = array(
		"fields"      => array(),
		"table"       => '',
		"joins"       => array(array("type" => "INNER", "table" => "", "primary" => "", "foreign" => "")),
		"conditions"  => array(array('key' => "", "operator" => "=", "value" => "", "andOrOperator" => "")),
		"orderBy"     => "",
		"orderType"   => 'DESC',
		"limit"       => null,
		"checkExist"	=> false,
	), $fetch = "fetchAll") {

		$cnx = Utils::connect_db();
		// check if isset table name, else return empty array
		if (isset($params["table"]) && !empty($params["table"])) {
			$params['fields']      = (isset($params['fields'])) ? $params['fields']: array('*');
			$params['conditions']  = (isset($params['conditions'])) ? $params['conditions']: array();
			$params['joins']       = (isset($params['joins'])) ? $params['joins']: "";
			$params['orderBy']     = (isset($params['orderBy'])) ? $params['orderBy']: "";
			$params['orderType']   = (isset($params['orderType'])) ? strtoupper($params['orderType']): 'DESC';
			$params['limit']       = (isset($params['limit'])) ? 'LIMIT ' . $params['limit']: null;
			$params['checkExist']  = (isset($params['checkExist'])) ? $params['checkExist'] : false;

			// Start fields part
			$params['fields'] = (!empty($params['fields']) && is_array($params['fields'])) ? implode(", ", $params['fields']) : '*';
			// End fields part

			// Start joins part
			$joins = "";
			if (!empty($params['joins']) && is_array($params['joins'])) :
				$joinsOptions = array("INNER", "RIGHT", "LEFT", "FULL");
				// check if has only one join
				if (isset($params["joins"]["table"]) && !empty($params["joins"]["table"]) && isset($params["joins"]["primary"]) && !empty($params["joins"]["primary"]) && isset($params["joins"]["foreign"]) && !empty($params["joins"]["foreign"])) {
					$params["joins"]["type"] = (isset($params["joins"]["type"]) && in_array(strtoupper($params["joins"]["type"]), $joinsOptions)) ? strtoupper($params["joins"]["type"]) : "INNER";

					$joins .= $params["joins"]["type"] . " JOIN " . $params["joins"]["table"]
									. " ON " . $params["joins"]["table"] . "." . $params["joins"]["primary"] . " = "
									. $params["table"] . "." . $params["joins"]["foreign"];
				} else {
					// check if has more than one join
					foreach ($params['joins'] as $key => $value) :
						if (isset($params["joins"][$key]["table"]) && !empty($params["joins"][$key]["table"]) && isset($params["joins"][$key]["primary"]) && !empty($params["joins"][$key]["primary"]) && isset($params["joins"][$key]["foreign"]) && !empty($params["joins"][$key]["foreign"])) {
							$params["joins"][$key]["type"] = (isset($params["joins"][$key]["type"]) && in_array(strtoupper($params["joins"][$key]["type"]), $joinsOptions)) ? strtoupper($params["joins"][$key]["type"]) : "INNER";

							$joins .= $params["joins"][$key]["type"] . " JOIN " . $params["joins"][$key]["table"]
											. " ON " . $params["joins"][$key]["table"] . "." . $params["joins"][$key]["primary"] . " = "
											. $params["table"] . "." . $params["joins"][$key]["foreign"] . " ";
						}
					endforeach;
				}
			endif;
			// End joins part

			// Start where part
			$where  = "";
			$keys   = array();
			$values = array();
			if (!empty($params['conditions']) && is_array($params['conditions'])) {
				$where = "WHERE";
				// if single condition [ex 2]
				if (isset($params['conditions']["key"]) && isset($params['conditions']["value"])) {
					$params['conditions']["operator"] = (isset($params['conditions']["operator"]) && !empty($params['conditions']["operator"])) ? $params['conditions']["operator"] : "=";
					$keys[] = "{$params['conditions']["key"]} {$params['conditions']["operator"]} ?";
					$values[] = $params['conditions']["value"];
				} else {
					// if single condition [ex 1] or multi condition [ex 3]
					foreach ($params['conditions'] as $key => $value) {
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
			// End where part

			// Start order by part
			// if orderBy = null
			if ($params['orderBy'] === "") {
				// if orderType = RAND() => "...", else if = DESC or ASC or "" => ""
				$params['orderType'] = ($params['orderType'] === "RAND()") ? "ORDER BY RAND()" : "";
			} else {
				if ($params['orderType'] === "" || $params['orderType'] == "DESC") :
					$params['orderBy']   = "ORDER BY " . $params['orderBy'];
					$params['orderType'] = "DESC";
				elseif ($params['orderType'] == "ASC") :
					$params['orderBy']   = "ORDER BY " . $params['orderBy'];
					$params['orderType'] = "ASC";
				elseif ($params['orderType'] == "RAND()") :
					$params['orderBy']   = "ORDER BY ";
					$params['orderType'] = "RAND()";
				else :
					$params['orderBy']   = "";
					$params['orderType'] = "";
				endif;
			}
			// End order by part

			$stmt = $cnx->prepare("SELECT {$params['fields']} FROM {$params['table']} {$joins} {$where} {$params['orderBy']} {$params['orderType']} {$params['limit']}");
			$stmt->execute($values);

			// if checkExist == true, then chekc only existence, else retrieve data
			if ($params['checkExist']) :
				return ($stmt->rowCount()) ? true : false;
			else :
				if ($fetch === "fetch") { return $stmt->fetch(); }
				elseif ($fetch === "fetchColumn") { return $stmt->fetchColumn(); }
				else { return $stmt->fetchAll(); }
			endif;

		} else {
			return array();
		}
	}

	public static function set_value($name) {
		session_regenerate_id();
		if(!empty($_POST[$name]))
		{
			//setcookie($name, $_POST[$name], time()+60);
			if(isset($_SESSION)){
				$_SESSION[$name] = $_POST[$name];
			}
		}

		if(!empty($_SESSION[$name])){
			echo $_SESSION[$name];
		}
	}

	public static function creer_session() {
		if(!isset($_SESSION))
		session_start();
		session_regenerate_id(TRUE);

	}

	public static function set_val_session($notice_name, $notice_value) {
		self::creer_session();
	 	$_SESSION[$notice_name] = $notice_value;

	}

	public static  function get_notice($notice_name) {

		//self::creer_session();
		if(isset($_SESSION[$notice_name])){
			$x = $_SESSION[$notice_name];
			unset($_SESSION[$notice_name]);
			return $x;
		}else{
			return "";
		}
	}


	/**
	 * @param $input : the value to show with break line
	 * @param $die : if this variable is true then die
	 */
	public static function echo_inline($input = '', $die = false) {
		echo "<br>" . $input . "<br>";
		($die) ? die() : '' ;
	}


	/**
	 * @param $input : first value to compare with $inpute2
	 * @param $input2 : the value to compare withe $inpute and show both of them with break line
	 * @param $heading : the title of each comparison
	 * @param $die : if this variable is true then die
	 */
	public static function echo_inline_comparaison($input = '', $input2 = '', $heading = '', $die = false) {
		echo $title = ($heading) ? "<br>" . $heading : "" ;
		echo "<br>" . $input . " -- " . $input2 ."<br>";
		($die) ? die() : '' ;
	}


	/**
	 * @param $input : the value to show with <pre> HTML tag
	 * @param $die : if this variable is true then die
	 */
	public static function var_dump_pre($input = '', $die = false) {
		echo "<pre>";
		var_dump($input);
		echo "</pre>";

		($die) ? die() : '' ;
	}


	/**
	 * @return True if ajax used
	 */
	public static function isAjax() {
		return (isset($_SERVER["HTTP_X_REQUESTED_WITH"])) && ($_SERVER["HTTP_X_REQUESTED_WITH"] == 'XMLHttpRequest');
	}

	/**
	* function to get columns of table
	* @return columnNames
	*/
	public static function getColumns($table, $db = "sqlsrv") {
		$cnx = Utils::connect_db();

		$sql = "";
		if ($db == "sqlsrv") {
			$sql = "SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = '" . $table . "'";
		} else if ($db == "mysql") {
			$sql = "SHOW COLUMNS FROM $table";
		} else {
			return array();
		}

		$pr = $cnx->prepare($sql);
		$pr->execute();
		return $pr->fetchAll(PDO::FETCH_OBJ);
	}

}
 ?>
