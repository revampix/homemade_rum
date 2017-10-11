<?php
ini_set('display_errors', 1);

// Depending on the size of beacon data Boomerang may send GET or POST
$beacon = !empty($_GET) ? $_GET : $_POST;

print_r($beacon);

require_once 'query.php';
require_once 'Beacon/Decode/resourcetimingDecompression.0.3.4.php';


$perfInserts = new Query();

$mysqli = mysqli_connect('127.0.0.1', 'username', 'password', 'database', '3306');

$navigationTimings = array_filter($beacon, 'is_scalar');

// Chrome sends time to first paint with '.'
$navigationTimings['nt_first_paint'] = str_replace('.', '', $navigationTimings['nt_first_paint']);

$guid = isset($_COOKIE['GUID']) ? $_COOKIE['GUID'] : null;

if (!empty($beacon)) {
    $res = $mysqli->query($perfInserts->insertNavigationTimings($navigationTimings, $guid));
    $insertId = $mysqli->insert_id;
    if (!empty($beacon['restiming'])) {
        $resourceTimingDecompression = new ResourceTimingDecompression_v_0_3_4();

        $resTimings = $resourceTimingDecompression->decompressResources(json_decode($beacon['restiming'], true));
        foreach ($resTimings as $timingData) {
            $mysqli->query($perfInserts->insertResourceTimingsQuery($timingData, $insertId));
        }
    }
}


echo $mysqli->error;