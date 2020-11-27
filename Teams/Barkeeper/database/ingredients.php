<?php

require_once($_SERVER["DOCUMENT_ROOT"]."/database/db.php");
require_once($_SERVER["DOCUMENT_ROOT"]."/database/models/ingredient.php");

class Ingredients {

    private $db;

    function __construct()
    {
        global $dbConnection;
        $this->db = $dbConnection;
    }

    public function findById($id) {
        $ingredient = new Ingredient();
        $stmt = $this->db->prepare("SELECT * FROM ingredients WHERE id=?");
        if($stmt == false) {
            print_r($this->db->error_list);
        }
        $stmt->bind_param('i', $id);
        $succ = $stmt->execute();
        if($succ) {
            $res = $stmt->get_result()->fetch_assoc();
            $ingredient->setId($res["id"]);
            $ingredient->setTitle($res["title"]);
        }
        return $ingredient;
    }

    public function findAll() {
        $ingredients = [];
        $stmt = $this->db->prepare("SELECT * FROM `ingredients`");
        $succ = $stmt->execute();
        if($succ) {
            $res = $stmt->get_result();
            while ($ingredientRow = $res->fetch_array())
            {
                $i = new Ingredient();
                $i->setId($ingredientRow["id"]);
                $i->setTitle($ingredientRow["title"]);
                array_push($ingredients, $i);
            }
        }
        return $ingredients;
    }

}