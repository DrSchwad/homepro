<?php

/**
 * Created by DrSwad
 * Date: 02-Dec-17
 * Time: 12:09 AM
 */

class Database {
	private $host = "localhost";
	private $db_name = "homepro";
	private $username = "root";
	private $password = "";
	public $conn;
	public $productCategories = 'product_categories';
    public $products = 'products';

	public function dbConnection() {
		$this->conn = null;
		$this->conn = new mysqli($this->host, $this->username, $this->password, $this->db_name);
		if ($this->conn->connect_error) echo "Connection error occurred!";

		return $this->conn;
	}
}