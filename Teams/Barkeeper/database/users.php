<?php

require_once($_SERVER["DOCUMENT_ROOT"]."/database/db.php");
require_once($_SERVER["DOCUMENT_ROOT"]."/database/models/user.php");

class Users {

    private $db;

    function __construct()
    {
        global $dbConnection;
        $this->db = $dbConnection;
    }

    public function login($username, $password) {
        $user = $this->findByUsername($username);
        if($user && !is_array($user)) {
            $match = $user->checkPassword($password);
            if($match) {
                return $user;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function findByUsername($username) {
        $stmt = $this->db->prepare("SELECT * FROM `user` WHERE username=?");
        if($stmt == false) {
            print_r($this->db->error_list);
        }
        $stmt->bind_param('s', $username);
        $succ = $stmt->execute();
        if($succ) {
            $res = $stmt->get_result()->fetch_assoc();
            if($res) {
                $user = new User($res["id"], $res["username"], $res["password"]);
                return $user;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function findById($id) {
        $stmt = $this->db->prepare("SELECT * FROM `user` WHERE id=?");
        if($stmt == false) {
            print_r($this->db->error_list);
        }
        $stmt->bind_param('i', $id);
        $succ = $stmt->execute();
        if($succ) {
            $res = $stmt->get_result()->fetch_assoc();
            $user = new User($res["id"], $res["username"], $res["password"]);
        }
        return $user;
    }

    public function findAll() {
        $users = [];
        $stmt = $this->db->prepare("SELECT * FROM `user`");
        $succ = $stmt->execute();
        if($succ) {
            $res = $stmt->get_result();
            while ($user = $res->fetch_array())
            {
                $user = new User($res["id"], $res["username"], $res["password"]);
                array_push($users, $user);
            }
        }
        return $users;
    }
}