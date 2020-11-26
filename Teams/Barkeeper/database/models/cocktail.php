<?php

require_once($_SERVER["DOCUMENT_ROOT"]."/database/db.php");
require_once($_SERVER["DOCUMENT_ROOT"]."/database/models/cocktail-ingredient.php");

class Cocktail {

    private $db;
    private $id;
    private $title;
    private $description;
    private $preparation;
    private $image;
    private $alcoholic;
    private $ingredients = [];
    private $released = false;

    function __construct($id = null, $title = null, $description = null, $preparation = null, $image = null, $alcoholic = null, $ingredients = null, $released = null)
    {
        global $dbConnection;
        $this->db = $dbConnection;
        if($id) {
            $this->id = $id;
        }
        if($title) {
            $this->title = $title;
        }
        if($description) {
            $this->description = $description;
        }
        if($preparation) {
            $this->preparation = $preparation;
        }
        if($image) {
            $this->image = $image;
        }
        if($alcoholic) {
            $this->alcoholic = $alcoholic;
        }
        if($ingredients) {
            $this->ingredients = $ingredients;
        } elseif ($id) {
            // TODO:
        }
    }

    public function save($released = false) {
        $this->released = $released;
        $stmt = $this->db->prepare("INSERT INTO `cocktails` (`title`, `description`, `preparation`, `image`, `released`, `alcoholic`) VALUES (?, ?, ?, ?, ?,TRUE)");
        if($stmt == false) {
            print_r($this->db->error_list);
        }
        $stmt->bind_param('ssssi', $this->title, $this->description, $this->preparation, $this->image, $this->released);
        $succ = $stmt->execute();
        if($succ) {
            $this->id = $this->db->insert_id;
            foreach($this->ingredients as $ingredient) {
                $ingredient->setCocktailId($this->id);
                $ingredient->save();
            }
        }
    }
    public function update() {
        $stmt = $this->db->prepare("UPDATE `cocktails` SET  `title`=?, `description`=?, `preparation`=?, `image`=?, `released`=? WHERE `id`=?");
        if($stmt == false) {
            print_r($this->db->error_list);
        }
        $stmt->bind_param('ssssii', $this->title, $this->description, $this->preparation, $this->image, $this->released, $this->id);
        $succ = $stmt->execute();
        if($succ) {
            $this->id = $this->db->insert_id;
            foreach($this->ingredients as $ingredient) {
                $ingredient->setCocktailId($this->id);
                $ingredient->save();
            }
        }
    }
    public function delete() {
        $stmt = $this->db->prepare("DELETE FROM `cocktails` WHERE `id`=?");
        $stmt->bind_param('i', $this->id);
        $stmt->execute();        
    }

    public function publish($id) {
        $this->released = true;
        $this->id = $id;
        $stmt = $this->db->prepare("UPDATE `cocktails` SET `released`=? WHERE `id`=?");
        if($stmt === false) {
            print_r($this->db->error_list);
        }
        $stmt->bind_param('ii', $this->released, $this->id);
        $stmt->execute();
    }
    public function unpublish($id) {
        $this->released = false;
        $this->id = $id;
        $stmt = $this->db->prepare("UPDATE `cocktails` SET `released`=? WHERE `id`=?");
        if($stmt === false) {
            print_r($this->db->error_list);
        }
        $stmt->bind_param('ii', $this->released, $this->id);
        $stmt->execute();
    }

    public function getId() {
        return $this->id;
    }
    public function setId($id) {
        $this->id = $id;
    }

    public function getTitle() {
        return $this->title;
    }
    public function setTitle($title) {
        $this->title = $title;
    }

    public function getDescription() {
        return $this->description;
    }
    public function setDescription($description) {
        $this->description = $description;
    }

    public function getPreparation() {
        return $this->preparation;
    }
    public function setPreparation($preparation) {
        $this->preparation = $preparation;
    }

    public function getImage() {
        return $this->image;
    }
    public function setImage($image) {
        $this->image = $image;
    }

    public function getAlcoholic() {
        return $this->alcoholic;
    }
    public function setAlcoholic($alcoholic) {
        $this->alcoholic = $alcoholic;
    }

    public function getReleased() {
        return $this->released;
    }
    public function setReleased($released) {
        $this->released = $released;
    }

    public function isAlcoholic() {
        if($this->alcoholic) {
            return "Alkoholisch";
        } else {
            return "Alkoholfrei";
        }
    }

    public function getIngredients() {
        return $this->ingredients;
    }
    public function setIngredients($ingredients) {
        $this->ingredients = $ingredients;
    }
    public function addIngredient($ingredientId, $amount) {
        $ingredient = new CocktailIngredient();
        $ingredient->setIngredientId($ingredientId);
        $ingredient->setAmount($amount);
        if(isset($this->id)) {
            $ingredient->setCocktailId($this->id);
            $ingredient->save();
        }
        array_push($this->ingredients, $ingredient);
    }
    public function removeIngredient($ingredientId) {

    }

}