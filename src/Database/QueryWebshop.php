<?php

namespace Vinter\Database;

/**
 * Class for handling queries for the webshop
 */
class QueryWebshop
{
    private $db;

    /**
     * Set which database object to send queries to
     * @param $db obj The database object
     * @return void
     */
    public function setDatabaseObj($db)
    {
        $this->db = $db;
    }

    /**
     * Get all products and inventory information
     * @return obj
     */
    public function getProductInventory()
    {
        $sql = "SELECT * FROM VInventory";
        $res = $this->db->executeFetchAll($sql);
        return $res;
    }

    /**
     * Get row from Product table
     * @param $id int Id of the product
     * @return obj
     */
    public function getProduct($id)
    {
        $sql = "SELECT * FROM VProduct WHERE prodId = ?";
        $params = [$id];
        $res = $this->db->executeFetch($sql, $params);
        return $res;
    }

    /**
     * Get all the rows from Category table
     * @return obj
     */
    public function getCategories()
    {
        $sql = "SELECT * FROM ProdCategory";
        $res = $this->db->executeFetchAll($sql);
        return $res;
    }

    /**
     * Get all rows from InvenShelf table
     * @return obj
     */
    public function getShelves()
    {
        $sql = "SELECT * FROM InvenShelf";
        $res = $this->db->executeFetchAll($sql);
        return $res;
    }

    /**
     * Update row in Product table
     * @param $params array Data for all the columns in a row
     * @return void
     */
    public function updateProduct($params)
    {
        $sql = "CALL updateProduct(?, ?, ?, ?, ?, ?, ?, ?)";
        $params = [
            $params["id"],
            $params["name"],
            $params["category"],
            $params["shelf"],
            $params["description"],
            $params["image"],
            $params["price"],
            $params["amount"]
        ];
        $this->db->execute($sql, $params);
    }

    /**
     * Insert new row into Product table
     * @param $name str Name of the prodcut
     * @param $amount int How many of this product
     * @param $shelf str Which shelf to but new product in
     * @return int The id of the new product
     */
    public function createProduct($name, $amount, $shelf)
    {
        $sql = "CALL createProduct(?, ?, ?)";
        $params = [$name, $amount, $shelf];
        $res = $this->db->executeFetch($sql, $params);
        return $res->id;
    }

    /**
     * Remove product from database
     * @param $id int The id of the product
     * @return void
     */
    public function removeProduct($id)
    {
        $params = [$id];
        $sql = "DELETE FROM Inventory WHERE prod_id = ?";
        $this->db->execute($sql, $params);
        $sql = "DELETE FROM Product WHERE id = ?";
        $this->db->execute($sql, $params);
    }
}
