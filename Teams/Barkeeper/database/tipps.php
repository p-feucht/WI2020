<?php

require_once($_SERVER["DOCUMENT_ROOT"]."/database/db.php");
require_once($_SERVER["DOCUMENT_ROOT"]."/database/models/tipp.php");

class Tipps {

    private $db;

    function __construct()
    {
        global $dbConnection;
        $this->db = $dbConnection;
    }

    public function findById($id) {
        $tipp = new Tipp();
        $stmt = $this->db->prepare("SELECT * FROM `tipps` WHERE id=?");
        if($stmt == false) {
            print_r($this->db->error_list);
        }
        $stmt->bind_param('i', $id);
        $succ = $stmt->execute();
        if($succ) {
            $res = $stmt->get_result()->fetch_assoc();
            $tipp->setId($res["id"]);
            $tipp->setTitle($res["title"]);
            $tipp->setContent($res["content"]);
            $tipp->setLikes($res["likes"]);
        }
        return $tipp;
    }

    public function findAll() {
        $tipps = [];
        $stmt = $this->db->prepare("SELECT * FROM `tipps`");
        $succ = $stmt->execute();
        if($succ) {
            $res = $stmt->get_result();
            while ($tipp = $res->fetch_array())
            {
                $i = new Tipp();
                $i->setId($tipp["id"]);
                $i->setTitle($tipp["title"]);
                $i->setContent($tipp["content"]);
                $i->setLikes($tipp["likes"]);
                array_push($tipps, $i);
            }
        }
        return $tipps;
    }
}