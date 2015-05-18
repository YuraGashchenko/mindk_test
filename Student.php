<?php

/**
 * 
 * @author Yura
 *
 * This class is mapped on Student table in the database.
 *
 */
class Student {

	private $conn;
	private $error = '';
	const HOST = 'localhost';
	const USER = 'root';
	const PASSWORD = 'pa$$word';
	const DB_NAME = 'mindk';

	/**
	 * Constructor of the class. Creates connections to MySQL database.
	 */
	function __construct() {
		$this->conn = new mysqli(self::HOST, self::USER, self::PASSWORD, self::DB_NAME);
		if ($this->conn->errno) {
			$this->error = $this->conn->error;
		}
	}

	/**
	 * Destroctor close connections to the database.
	 */
	function __destruct() {
		$this->conn->close();
	}

	/**
	 * Return a Student table description.
	 *
	 * @return array - Table array wich represents a description of Student table
	 */
	function get_student_desc() {
		$query = 'DESCRIBE student';
		$result = $this->conn->query($query);
		return $result->fetch_all(MYSQLI_ASSOC);
	}

	/**
	 * Returns Student table data in next format: [[key => value],[key => value]]
	 * 
	 * @return array - Associative array of student table.
	 */
	function get_students_as_tbl_arr() {
		$query = 'SELECT * FROM student';
		//mysqli_result -- class returned
		$result = $this->conn->query($query);
		return $result->fetch_all(MYSQLI_ASSOC);
	}

	/**
	 * Return a description of last occured error
	 * 
	 * @return string - error description
	 */
	function get_error() {
		return $this->error;
	}

	/**
	 * Delete a student with specified id.
	 * 
	 * @param integer $student_id - id of student which must b edeleted.
	 * @return boolean - TRUE on success and FALSE otherway.
	 */
	function delete($student_id) {
		$query = 'DELETE FROM student WHERE id = ?';

		if (!($result_stmt = $this->conn->prepare($query))) {
			$this->error = $this->conn->error;
			return FALSE;
		};

		$result_stmt->bind_param('i', $student_id);
		$res = $result_stmt->execute();
		$result_stmt->close();
		return $res;
	}

	/**
	 *  Add new student to the database.
	 *  
	 *  @param array $params is an associative array of student table filds.
	 *  @return mixed - An identifier of nearly created student on success or FALSE otherwise.
	 */
	function add($params) {
		$query = 'INSERT INTO `student` (`first_name`, `last_name`, `sex`, `age`, `group`, `faculty`)
					VALUES (?, ?, ?, ?, ?, ?)';

		if (!($stmt = $this->conn->prepare($query))) {
			$this->error = $this->conn->error;
			return FALSE;
		}

		$stmt->bind_param('sssiis', $params['first_name'], $params['last_name'], $params['sex']
							, $params['age'], $params['group'], $params['faculty']);
		if (!$stmt->execute()) {
			$this->error = $stmt->error;
			return FALSE;
		};
		$stmt->close();

		$query = 'SELECT id FROM student
					WHERE first_name = ? AND last_name = ?';
		
		if (!($stmt = $this->conn->prepare($query))) {
			$this->error = $this->conn->error;
			return FALSE;
		}
		
		$stmt->bind_param('ss', $params['first_name'], $params['last_name']);
		$stmt->execute();

		$stmt->bind_result($id);
		$stmt->fetch();
		$stmt->close();
		return $id;
	}
	
	/**
	 * Edit appropriate Student table row in the database.
	 * 
	 * @param array $fields - new field values.
	 * 
	 * @return boolean - TRUE on success and false if some error detected.
	 */
	function edit_student($fields) {
		$query = 'UPDATE Student
					SET `first_name` = ?, `last_name` = ?, `sex` = ?, `age` = ?, `group` = ?, `faculty` = ?
					WHERE `id` = ?';

		if(!($stmt = $this->conn->prepare($query))) {
			$this->error = $this->conn->error;
			return FALSE;
		}

		$stmt->bind_param('sssiisi', $fields['first_name'], $fields['last_name'], $fields['sex']
							, $fields['age'], $fields['group'], $fields['faculty'], $fields['id']);
		if (!$stmt->execute()) {
			$this->error = $this->conn->error;
			return FALSE;
		}

		return TRUE;
	}
	
}

?>