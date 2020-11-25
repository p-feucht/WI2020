<?php
require_once("../../database/tipps.php");

$id = $_GET["id"];
$tippsFactory = new Tipps();
$tipp = $tippsFactory->findById($id);
$tipp->addLike();

http_response_code(200);
header('Content-Type: application/json');
echo json_encode(["id" => $tipp->getId(), "likes" => $tipp->getLikes()]);
