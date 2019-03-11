<?php

/**
 * Created by DrSwad
 * Date: 05-Jan-18
 * Time: 1:55 AM
 */

require_once 'DbConfig.php';

class Catalogue {
	private $conn;
	private $database;

	public function __construct() {
		$this->database = new Database();
		$this->conn = $this->database->dbConnection();
	}

	public function runQuery($sql) {
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->get_result();
    }
	public function runQueryS($sql, $s) {
		$stmt = $this->conn->prepare($sql);
		$stmt->bind_param('s', $s);
		$stmt->execute();
		return $stmt->get_result();
	}
	public function runQueryI($sql, $i) {
		$stmt = $this->conn->prepare($sql);
		$stmt->bind_param('i', $i);
		$stmt->execute();
		return $stmt->get_result();
	}

	private function getCategoryId($category) {
    	if ($category === "All") return 0;
    	$categoryResults = $this->runQueryS("SELECT id FROM ".$this->database->productCategories." WHERE name = ?", $category);
    	if (!$categoryResults) return false;
    	$categoryId = ($categoryResults->fetch_assoc())['id'];
    	return $categoryId;
    }

	public function getProducts($category) {
		$ret = ['category' => $this->getCategoryId($category)];
		$categories = [];
		$categoryCodes = [];

		$categoryResults = $this->runQuery("SELECT id, name, code FROM ".$this->database->productCategories);
        if (!$categoryResults) return false;

        while($categoryRow = $categoryResults->fetch_assoc()) {
            $ret[$categoryRow['id']] = [];
            $categories[$categoryRow['id']] = $categoryRow['name'];
            $categoryCodes[$categoryRow['id']] = $categoryRow['code'];
        }

        $productResults = $this->runQuery("SELECT * FROM ".$this->database->products);
	    if (!$productResults) return false;
	    while($productRow = $productResults->fetch_assoc()) {
	        $ret[$productRow['category']][$productRow['serial']] = $productRow;
	        $ret[$productRow['category']][$productRow['serial']]['category'] = $categories[$productRow['category']];
	        $ret[$productRow['category']][$productRow['serial']]['code'] = $categoryCodes[$productRow['category']].$productRow['serial'];
	    }

	    return $ret;
	}
}
