<?php

require_once($_SERVER["DOCUMENT_ROOT"]."/database/db.php");

class User {

    private $db;
    private $id;
    private $username;
    private $passwordHash;
    private $hashOptions = [
        'cost' => 12
    ];

    function __construct($id=null, $username=null, $passwordHash=null) {
        global $dbConnection;
        $this->db = $dbConnection;
        if($id) $this->id = $id;
        if($username) $this->username = $username;
        if($passwordHash) $this->passwordHash = $passwordHash;
    }

    public function save() {
        $stmt = $this->db->prepare("INSERT INTO `user` (`username`, `paswword`) VALUES (?, ?)");
        if($stmt == false) {
            print_r($this->db->error_list);
        }
        $stmt->bind_param('ss', $this->username, $this->passwordHash);
        $succ = $stmt->execute();
        if($succ) {
            $this->id = $this->db->insert_id;
            return $this;
        }
    }
    public function update() {
        $stmt = $this->db->prepare("UPDATE `user` SET  `username`=?, `paswword`=? WHERE `id`=?");
        if($stmt == false) {
            print_r($this->db->error_list);
        }
        $stmt->bind_param('ss', $this->username, $this->passwordHash, $this->id);
        $succ = $stmt->execute();
        if($succ) {
            if($this->id == $this->db->insert_id) {
                return $this;
            }
        }
    }

	public function getId() {
		return $this->id;
	}

	public function setId($id) {
		$this->id = $id;
	}

	public function getUsername() {
		return $this->username;
	}

	public function setUsername($username) {
		$this->username = $username;
    }
    
    public function setNewPassword($passwordOld, $passwordNew) {
        if(password_verify($passwordOld, $this->passwordHash)) {
            $this->passwordHash = password_hash($passwordNew, PASSWORD_BCRYPT, $this->hashOptions);
        }
    }
    
    public function checkPassword($password) {
        return password_verify($password, $this->passwordHash);
    }

}