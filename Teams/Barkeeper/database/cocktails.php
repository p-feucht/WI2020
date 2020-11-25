<?php

require_once($_SERVER["DOCUMENT_ROOT"]."/database/db.php");
require_once($_SERVER["DOCUMENT_ROOT"]."/database/models/cocktail.php");
require_once($_SERVER["DOCUMENT_ROOT"]."/database/models/cocktail-ingredient.php");

class Cocktails {

    private $db;

    function __construct()
    {
        global $dbConnection;
        $this->db = $dbConnection;
    }    

    private function _getIngredients($id) {
        $ingredients = [];
        $stmt = $this->db->prepare("SELECT * FROM `cocktail_ingredients` INNER JOIN ingredients ON cocktail_ingredients.ingredient_id = ingredients.id WHERE cocktail_ingredients.cocktail_id = ?");
        if($stmt == false) {
            print_r($this->db->error_list);
        }
        $stmt->bind_param('i', $id);
        $succ = $stmt->execute();
        
        if($succ) {
            $res = $stmt->get_result();
            while ($row = $res->fetch_array())
            {
                $i = new CocktailIngredient();
                $i->setId($row["id"]);
                $i->setIngredientId($row["ingredient_id"]);
                $i->setCocktailId($row["cocktail_id"]);
                $i->setAmount($row["amount"]);
                $i->setTitle($row["title"]);
                array_push($ingredients, $i);
            }
        }
        return $ingredients;
    }

    public function findById($id) {
        $cocktail = new Cocktail();
        $stmt = $this->db->prepare("SELECT * FROM `cocktails` WHERE id=?");
        if($stmt == false) {
            print_r($this->db->error_list);
        }
        $stmt->bind_param('i', $id);
        $succ = $stmt->execute();
        if($succ) {
            $res = $stmt->get_result()->fetch_assoc();
            $cocktail->setTitle($res["title"]);
            $cocktail->setDescription($res["description"]);
            $cocktail->setPreparation($res["preparation"]);
            $cocktail->setImage($res["image"]);
            $cocktail->setAlcoholic($res["alcoholic"]);
            $cocktail->setReleased($res["released"]);
            $cocktail->setIngredients($this->_getIngredients($id));
            return $cocktail;
        }
        return $cocktail;
    }

    public function findAll($onlyReleased = true) {
        $cocktails = [];
        if($onlyReleased) {
            $stmt = $this->db->prepare("SELECT * FROM `cocktails` WHERE released = 1");
        } else {
            $stmt = $this->db->prepare("SELECT * FROM `cocktails`");
        }
        $succ = $stmt->execute();
        if($succ) {
            $res = $stmt->get_result();
            while ($cocktail = $res->fetch_array())
            {
                $i = new Cocktail();
                $i->setId($cocktail["id"]);
                $i->setTitle($cocktail["title"]);
                $i->setDescription($cocktail["description"]);
                $i->setPreparation($cocktail["preparation"]);
                $i->setImage($cocktail["image"]);
                $i->setAlcoholic($cocktail["alcoholic"]);
                $i->setReleased($cocktail["released"]);
                $i->setIngredients($this->_getIngredients($cocktail["id"]));
                array_push($cocktails, $i);
            }
        }
        return $cocktails;
    }

    public function findAllWithIngredients($ingredients = [], $and = true) {
        $cocktails = [];
        $ingredientIds = [];
        $bindingTypes = "";
        $sql = "SELECT cocktails.* FROM `cocktail_ingredients` INNER JOIN `cocktails` ON cocktail_ingredients.cocktail_id = cocktails.id WHERE released = 1";
        $ingCount = count($ingredients);
        if($ingCount > 0) {
            $sql = $sql . " AND";
        }
        $c = 0;
        foreach($ingredients as $i) {
            if($c++ === 0) {
                $sql = $sql . " cocktail_ingredients.ingredient_id = ?";
            } else {
                if($and) {
                    $sql = $sql . " AND";
                } else {
                    $sql = $sql . " OR";
                }
                $sql = $sql . " cocktail_ingredients.ingredient_id = ?";
            }
            $bindingTypes = $bindingTypes . "i";
            array_push($ingredientIds, intval($i));
        }
        $sql = $sql . " GROUP BY cocktails.id";
        $stmt = $this->db->prepare($sql);
        if($stmt == false) {
            print_r($this->db->error_list);
        }
        if($ingCount > 0) {
            $stmt->bind_param($bindingTypes, ...$ingredientIds);
        }
        $succ = $stmt->execute();
        if($succ) {
            $res = $stmt->get_result();
            while ($cocktail = $res->fetch_array())
            {
                $i = new Cocktail();
                $i->setId($cocktail["id"]);
                $i->setTitle($cocktail["title"]);
                $i->setDescription($cocktail["description"]);
                $i->setPreparation($cocktail["preparation"]);
                $i->setImage($cocktail["image"]);
                $i->setAlcoholic($cocktail["alcoholic"]);
                $i->setIngredients($this->_getIngredients($cocktail["id"]));
                array_push($cocktails, $i);
            }
        }
        return $cocktails;
    }

}