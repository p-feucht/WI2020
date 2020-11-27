<?php

require_once($_SERVER["DOCUMENT_ROOT"]."/database/db.php");
require_once($_SERVER["DOCUMENT_ROOT"]."/database/models/cocktail-ingredient.php");
require_once($_SERVER["DOCUMENT_ROOT"]."/database/models/cocktail.php");

class CocktailIngredients {

    private $db;

    function __construct()
    {
        global $dbConnection;
        $this->db = $dbConnection;
    }

    public function getIngredientsOfCocktailId($id) {
        $cocktailIngredient = new CocktailIngredient();
        $stmt = $this->db->prepare("SELECT * FROM `cocktail_ingredients` INNER JOIN ingredients ON cocktail_ingredients.ingredient_id = ingredients.id WHERE cocktail_ingredients.cocktail_id = ?");
        if($stmt == false) {
            print_r($this->db->error_list);
        }
        $stmt->bind_param('i', $id);
        $succ = $stmt->execute();
        if($succ) {
            $res = $stmt->get_result();
            while ($cocktailIngredientRow = $res->fetch_array())
            {
                $cocktailIngredient = new CocktailIngredient();
                $cocktailIngredient->setId($cocktailIngredientRow["id"]);
                $cocktailIngredient->setTitle($cocktailIngredientRow["title"]);
                $cocktailIngredient->setAmount($cocktailIngredientRow["amount"]);
                $cocktailIngredient->setRequired($cocktailIngredientRow["required"]);
                $cocktailIngredient->setIngredientId($cocktailIngredientRow["ingredient_id"]);
                $cocktailIngredient->setCocktailId($cocktailIngredientRow["cocktail_id"]);
                array_push($cocktailIngredients, $cocktailIngredient);
            }
        }
        return $cocktailIngredients;
    }
    
    public function getIngredientsOfCocktail(Cocktail $cocktail) {
        $cocktailIngredient = new CocktailIngredient();
        $stmt = $this->db->prepare("SELECT * FROM `cocktail_ingredients` INNER JOIN ingredients ON cocktail_ingredients.ingredient_id = ingredients.id WHERE cocktail_ingredients.cocktail_id = ?");
        if($stmt == false) {
            print_r($this->db->error_list);
        }
        $stmt->bind_param('i', $cocktail->getId());
        $succ = $stmt->execute();
        if($succ) {
            $res = $stmt->get_result();
            while ($cocktailIngredientRow = $res->fetch_array())
            {
                $cocktailIngredient = new CocktailIngredient();
                $cocktailIngredient->setId($cocktailIngredientRow["id"]);
                $cocktailIngredient->setTitle($cocktailIngredientRow["title"]);
                $cocktailIngredient->setAmount($cocktailIngredientRow["amount"]);
                $cocktailIngredient->setRequired($cocktailIngredientRow["required"]);
                $cocktailIngredient->setIngredientId($cocktailIngredientRow["ingredient_id"]);
                $cocktailIngredient->setCocktailId($cocktailIngredientRow["cocktail_id"]);
                array_push($cocktailIngredients, $cocktailIngredient);
            }
        }
        return $cocktailIngredients;
    }

    public function findById($id) {
        $cocktailIngredient = new CocktailIngredient();
        $stmt = $this->db->prepare("SELECT * FROM `cocktails` WHERE id=?");
        if($stmt == false) {
            print_r($this->db->error_list);
        }
        $stmt->bind_param('i', $id);
        $succ = $stmt->execute();
        if($succ) {
            $res = $stmt->get_result()->fetch_assoc();
            $cocktailIngredient = new CocktailIngredient();
            $cocktailIngredient->setId($res["id"]);
            $cocktailIngredient->setTitle($res["title"]);
            $cocktailIngredient->setAmount($res["amount"]);
            $cocktailIngredient->setRequired($res["required"]);
            $cocktailIngredient->setIngredientId($res["ingredient_id"]);
            $cocktailIngredient->setCocktailId($res["cocktail_id"]);
        }
        return $cocktailIngredient;
    }

    public function findAll() {
        $cocktailIngredients = [];
        $stmt = $this->db->prepare("SELECT * FROM `cocktails`");
        $succ = $stmt->execute();
        if($succ) {
            $res = $stmt->get_result();
            while ($cocktailIngredientRow = $res->fetch_array())
            {
                $cocktailIngredient = new CocktailIngredient();
                $cocktailIngredient->setId($cocktailIngredientRow["id"]);
                $cocktailIngredient->setTitle($cocktailIngredientRow["title"]);
                $cocktailIngredient->setAmount($cocktailIngredientRow["amount"]);
                $cocktailIngredient->setRequired($cocktailIngredientRow["required"]);
                $cocktailIngredient->setIngredientId($cocktailIngredientRow["ingredient_id"]);
                $cocktailIngredient->setCocktailId($cocktailIngredientRow["cocktail_id"]);
                array_push($cocktailIngredients, $cocktailIngredient);
            }
        }
        return $cocktailIngredients;
    }

}