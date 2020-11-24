<?php

require_once($_SERVER["DOCUMENT_ROOT"]."/database/db.php");

class Tipp {

    private $db;
    private $id;
    private $title;
    private $content;
    private $likes;

    function __construct($title=null, $content=null, $likes=null)
    {
        global $dbConnection;
        $this->db = $dbConnection;
        if($title) {
            $this->title = $title;
        }
        if($content) {
            $this->content = $content;
        }
        if($likes) {
            $this->likes = $likes;
        }
    }

    public function save() {
        $stmt = $this->db->prepare("INSERT INTO `tipps` (`title`, `content`, `likes`, `dislikes`) VALUES (?, ?, ?, ?)");
        $stmt->bind_param('ssii', $this->title, $this->content, $this->likes, $this->dislikes);
        $stmt->execute();
    }
    public function update() {
        $stmt = $this->db->prepare("UPDATE `tipps` SET  `title`=?, `content`=?, `likes`=?, `dislikes`=? WHERE `id`=?");
        if($stmt == false) {
            print_r($this->db->error_list);
        }
        $stmt->bind_param('ssiii', $this->title, $this->content, $this->likes, $this->dislikes, $this->id);
        $succ = $stmt->execute();
        if($succ) {
            if($this->id == $this->db->insert_id) {
                return $this;
            }
        }
    }
    public function delete() {
        $stmt = $this->db->prepare("DELETE FROM `tipps` WHERE `id`=?");
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

    public function getContent() {
        return $this->content;
    }
    public function setContent($content) {
        $this->content = $content;
    }

    public function getLikes() {
        return $this->likes;
    }
    public function setLikes($likes) {
        $this->likes = $likes;
    }
    public function addLike() {
        $this->likes++;
        return $this->update();
    }
}