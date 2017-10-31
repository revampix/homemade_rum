<?php
ini_set('display_errors', 1);

require_once 'perfCascade.php';

$conn = new mysqli();
$conn->connect('127.0.0.1', 'root', 'root', 'rum', 3306);

$pageViewId = $_GET['page_view_id'];

$query = 'SELECT * FROM `navigation_timings` where `page_view_id` = ' . $pageViewId;
$res = $conn->query($query);

$navigationTimings = $res->fetch_assoc();


$query = 'SELECT * FROM `resource_timings` where `page_view_id` = '  . $pageViewId;
$res = $conn->query($query);

for($resourceTimings = array(); $row = $res->fetch_assoc(); $resourceTimings[] = $row);

$navigationTimings['restiming'] = $resourceTimings;

$perfCascade = new PerfCascade();

header('Content-Type: application/json');
echo json_encode($perfCascade->boomerangToPerfCascade($navigationTimings));