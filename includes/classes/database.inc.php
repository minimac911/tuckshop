<?php
//class for accesing database
class db {
	private $dbhost = '127.0.0.1:3306';
	private $dbuser = 'root';
	private $dbpass = 'admin';
	private $dbname = 'dbtuckshop';
	private $charset = 'utf8';
    //connection to the database
    protected $connection;
    //stores query
	protected $query;
	//stores the ammount of querys called
	public $query_count = 0;
	
	/** 
	 * setting up the connection to the database
	*/
	public function __construct() {
		//creating connection
		$this->connection = new mysqli($this->dbhost, $this->dbuser, $this->dbpass, $this->dbname);
		if ($this->connection->connect_error) {
			die('Failed to connect to MySQL - ' . $this->connection->connect_error);
		}
		$this->connection->set_charset($this->charset);
	}
	
	/**
	 * creating the query
	 * @param sql the sql query that needs to be executed
	 * one can then add extram parameters for binding
	 * e.g. query("SELECT * FROM tbl WHERE id = ? or id = ?", 1, 1)
	 * 	OR 
	 * query("SELECT * FROM tbl WHERE id = ? or id = ?", array(1,1))
	 */
    public function query($sql) {
		//checking that there are no errors when preparing
		if ($this->query = $this->connection->prepare($sql)) {
			//if it is a paramater query
            if (func_num_args() > 1) {
				//get the rest of the arguments
				$x = func_get_args();
				//get rid of the first param 
                $args = array_slice($x, 1);
				$types = '';
				//array for arguments
				$args_ref = array();
				//loop through all arguments
                foreach ($args as $k => &$arg) {
					if (is_array($args[$k])) {
						foreach ($args[$k] as $j => &$a) {
							//get the data type
							$types .= $this->_gettype($args[$k][$j]);
							//get the value
							$args_ref[] = &$a;
						}
					} else {
						//get the data type
						$types .= $this->_gettype($args[$k]);
						//get the value
	                    $args_ref[] = &$arg;
					}
				}
				//prepend elemnts to array
				array_unshift($args_ref, $types);
				//generate the stmt by binding the param
                call_user_func_array(array($this->query, 'bind_param'), $args_ref);
			}
			//execute query
			$this->query->execute();
			//if there is an error
           	if ($this->query->errno) {
				die('Unable to process MySQL query (check your params) - ' . $this->query->error);
			}   
			$this->query_count++;
        } else {
            die('Unable to prepare statement (check your syntax) - ' . $this->query->error);
		}
		//return query 
		return $this;
    }

	//Fetch multiple records from a database
	public function fetchAll() {
	    $params = array();
	    $meta = $this->query->result_metadata();
	    while ($field = $meta->fetch_field()) {
	        $params[] = &$row[$field->name];
	    }
	    call_user_func_array(array($this->query, 'bind_result'), $params);
        $result = array();
        while ($this->query->fetch()) {
            $r = array();
            foreach ($row as $key => $val) {
                $r[$key] = $val;
            }
            $result[] = $r;
        }
        $this->query->close();
		return $result;
	}

	//Fetch a record from a database
	public function fetchArray() {
	    $params = array();
	    $meta = $this->query->result_metadata();
	    while ($field = $meta->fetch_field()) {
	        $params[] = &$row[$field->name];
	    }
	    call_user_func_array(array($this->query, 'bind_result'), $params);
        $result = array();
		while ($this->query->fetch()) {
			foreach ($row as $key => $val) {
				$result[$key] = $val;
			}
		}
        $this->query->close();
		return $result;
	}
	
	//Checking the number of rows
	public function numRows() {
		$this->query->store_result();
		return $this->query->num_rows;
	}

	// Close the database
	public function close() {
		return $this->connection->close();
	}

	//Checking the affected number of rows
	public function affectedRows() {
		return $this->query->affected_rows;
	}


	//get the data type of the variable
	/**
	 * @param var var to be checked
	 * @return var of the datatype for a mysqli param
	 */
	private function _gettype($var) {
	    if(is_string($var)) return 's';
	    if(is_float($var)) return 'd';
	    if(is_int($var)) return 'i';
	    return 'b';
	}

}
?>
