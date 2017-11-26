<?php
// where are we posting to?
$url = 'http://front.rum.loc/';


$data = unserialize(file_get_contents('./beacon_1511736623.ser'));
$data['ga.clientid'] = '1241074160.1507992899';

// build the urlencoded data
$postVars = http_build_query($data);

// open connection
$ch = curl_init();

// set the url, number of POST vars, POST data
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, count($data));
curl_setopt($ch, CURLOPT_POSTFIELDS, $postVars);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Cookie: GUID="59bb902a-b0ef-444c-a855-2ea53f29c137"'));

// execute post
$result = curl_exec($ch);

var_dump($result);

// close connection
curl_close($ch);