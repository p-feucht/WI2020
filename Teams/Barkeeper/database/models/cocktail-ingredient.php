<?php

require_once($_SERVER["DOCUMENT_ROOT"]."/database/db.php");

class CocktailIngredient {

    private $db;
    private $id;
    private $ingredientId;
    private $cocktailId;
    private $title;
	private $amount;
	private $required;

    function __construct($id = null, $ingredientId = null, $cocktailId = null, $title = null, $amount = null)
    {
        global $dbConnection;
        $this->db = $dbConnection;
        if($id) {
            $this->id = $id;
        }
        if($ingredientId) {
            $this->ingredientId = $ingredientId;
        }
        if($cocktailId) {
            $this->cocktailId = $cocktailId;
        }
        if($title) {
            $this->title = $title;
        }
        if($amount) {
            $this->amount = $amount;
        }
	}
	
    public function save() {
        $stmt = $this->db->prepare("INSERT INTO `cocktail_ingredients` (`cocktail_id`, `ingredient_id`, `amount`, `required`) VALUES (?, ?, ?, '1')");
        $stmt->bind_param('iis', $this->cocktailId, $this->ingredientId, $this->amount);
        $stmt->execute();
    }
    public function update() {
        $stmt = $this->db->prepare("UPDATE `cocktail_ingredients` SET `cocktail_id`=?, `ingredient_id`=?, `amount`=?, `required`=1 WHERE `id`=?");
        $stmt->bind_param('iisi', $this->cocktailId, $this->ingredientId, $this->amount, $this->id);
        $stmt->execute();
    }
    public function delete() {
        $stmt = $this->db->prepare("DELETE FROM `cocktails` WHERE `id`=?");
        $stmt->bind_param('i', $this->id);
        $stmt->execute();        
    }

    public function getId() {
		return $this->id;
	}

	public function setId($id) {
		$this->id = $id;
	}

	public function getIngredientId() {
		return $this->ingredientId;
	}

	public function setIngredientId($ingredientId) {
		$this->ingredientId = $ingredientId;
	}

	public function getCocktailId() {
		return $this->cocktailId;
	}

	public function setCocktailId($cocktailId) {
		$this->cocktailId = $cocktailId;
	}

	public function getTitle() {
		return $this->title;
	}

	public function setTitle($title) {
		$this->title = $title;
	}

	public function getAmount() {
		return $this->amount;
	}

	public function setAmount($amount) {
		$this->amount = $amount;
	}

	public function getRequired() {
		return $this->required;
	}

	public function setRequired($required) {
		$this->required = $required;
	}

}