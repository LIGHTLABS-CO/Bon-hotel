<?php
$data = json_decode(file_get_contents("php://input"), true);
if (!$data) exit;

$file = "reviews.json";
$reviews = file_exists($file) ? json_decode(file_get_contents($file), true) : [];

$data["date"] = date("m/d/Y");
$reviews[] = $data;

file_put_contents($file, json_encode($reviews, JSON_PRETTY_PRINT));
?>
