<?php

/**
 * Created by DrSwad
 * Date: 05-Jan-18
 * Time: 1:55 AM
 */

require_once 'DbConfig.php';

class Product {
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

	public function getProduct($code) {
		$ret = [
            'totalProducts' => 0,
            'categoryId' => 0,
            'categories' => [],
            'categoryCodes' => [],
            'titles' => [''],
            'dimensions' => []
        ];

        $categoryResults = $this->runQuery("SELECT * FROM ".$this->database->productCategories);
        if (!$categoryResults) return false;

        while($categoryRow = $categoryResults->fetch_assoc()) if ($categoryRow['code'] === substr($code, 0, 2)) {
            $ret['code'] = substr($code, 0, 2);
            $category = $categoryRow['name'];
            $productNo = substr($code, 2);
            $ret['at'] = $productNo;

            $productResults = $this->runQueryI("SELECT title, height, width FROM ".$this->database->products." WHERE category = ?", (int)$categoryRow["id"]);
	        if (!$productResults) return false;
	        while($productRow = $productResults->fetch_assoc()) {
	            array_push($ret['titles'], $productRow['title']);
	            array_push($ret['dimensions'], [
	                'height' => $productRow['height'],
	                'width' => $productRow['width']
	            ]);
	        }

	        if ($category !== "All") $ret['categoryId'] = $categoryRow["id"];
	        $ret['totalProducts'] += $categoryRow["total_items"];
	        array_push($ret['categories'], [
                'name' => $categoryRow['name'],
                'till' => $ret['totalProducts']
            ]);
            array_push($ret['categoryCodes'], $categoryRow['code']);

        }

        return $ret;

    }
}
