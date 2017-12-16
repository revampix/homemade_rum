<?php
ini_set('display_errors', 1);

// Hacking quickly to handle Cross Origin Requests
// Better if we implemente this in NIGIX level
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
    header('Access-Control-Allow-Headers: X-Requested-With, content-type, access-control-allow-origin, access-control-allow-methods, access-control-allow-headers');
    header('Access-Control-Max-Age: 86400');

    exit;
}

header('Access-Control-Allow-Origin: *');

require_once  __DIR__ . '/../autoload.php';


/** @var \FluentPDO $dbAdapter */
$dbAdapter = DatabaseFactory::getDbAdapter();
/** @var QueryBuilder $queryBuilder */
$queryBuilder = new QueryBuilder();

// Depending on the size of beacon data Boomerang may send GET or POST
$beacon = !empty($_GET) ? $_GET : $_POST;
/*
$beacon = unserialize(file_get_contents(__DIR__ . '/../../proof-of-concpet/test/beacon_1508696981.ser'));*/

$navigationTimings = array_filter($beacon, 'is_scalar');
// Chrome sends time to first paint with '.'
$navigationTimings['nt_first_paint'] = str_replace('.', '', $navigationTimings['nt_first_paint']);


if (!empty($beacon)) {

    $navigationTimingsData = $queryBuilder->generateNavigationTimingsData($navigationTimings);
    $pageViewId = $dbAdapter->insertInto('navigation_timings')->values($navigationTimingsData)->execute();


    if (!empty($beacon['restiming'])) {
        $resourceTimingDecompression = new ResourceTimingDecompression_v_0_3_4();

        $resTimings = $resourceTimingDecompression->decompressResources(json_decode($beacon['restiming'], true));
        foreach ($resTimings as $timingData) {
            $dbAdapter->insertInto('resource_timings', $queryBuilder->generateResourceTimingsQuery($timingData, $pageViewId))->execute();

        }
    }

    // Handling GA Client Id and storing it in DB.
    $gaClientId = !empty($beacon['ga_clientid']) ? $beacon['ga_clientid'] : '';
    if (empty($gaClientId)) {
        $gaClientId = !empty($beacon['ga.clientid']) ? $beacon['ga.clientid'] : '';
    }

    if (!empty($gaClientId)) {
        $gaReferenceData = $queryBuilder->generateGoogleAnalyticsReferenceQuery($beacon['ga_clientid'], $guid, $pageViewId);
        $dbAdapter->insertInto('google_analytics_reference')->values($gaReferenceData)->execute();
    }

    $mobileConnectionDecoder = new Beacon_MobileConnection();
    $mobileConnectionData = $mobileConnectionDecoder->extractMobileConnectionAttributesFromBeacon($beacon);

    if (!empty($mobileConnectionData)) {
        $gaReferenceData = $queryBuilder->generateMobileConnectionQuery($mobileConnectionData, $pageViewId);
        $dbAdapter->insertInto('mobile_connection')->values($gaReferenceData)->execute();
    }
}