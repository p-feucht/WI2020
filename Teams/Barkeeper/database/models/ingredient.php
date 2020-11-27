<?php

require_once($_SERVER["DOCUMENT_ROOT"]."/database/db.php");

class Ingredient {

    private $db;
    private $id;
    private $title;

    function __construct($id=null, $title=null)
    {
        global $dbConnection;
        $this->db = $dbConnection;
        if($id) {
            $this->id = $id;
        }
        if($title) {
            $this->title =$title;
        }
    }

    public function findById($id) {
        $stmt = $this->db->prepare("SELECT * FROM ingredients WHERE id=?");
        if($stmt == false) {
            print_r($this->db->error_list);
        }
        $stmt->bind_param('i', $id);
        $succ = $stmt->execute();
        if($succ) {
            $res = $stmt->get_result()->fetch_assoc();
            $this->id = $res["id"];
            $this->title = $res["title"];
        }
        
    }
    public function save() {
        $stmt = $this->db->prepare("INSERT INTO `ingredients` (`title`) VALUES (?)");
        $stmt->bind_param('s', $this->title);
        $stmt->execute();
    }
    public function update() {
        $stmt = $this->db->prepare("UPDATE `ingredients` SET  `title`=? WHERE `id`=?");
        $stmt->bind_param('ii', $this->title, $this->id);
        $stmt->execute();
    }
    public function delete() {
        $stmt = $this->db->prepare("DELETE FROM `ingredients` WHERE `id`=?");
        $stmt->bind_param('i', $this->id);
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

}