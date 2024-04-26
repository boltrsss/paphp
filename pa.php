<?php

function adjustPropellerAdsBid($apiKey, $zoneId, $cpmBid) {
    $url = 'https://api.propellerads.com/v1/bid/update';

    // Prepare request parameters
    $params = [
        'api_key' => $apiKey,
        'zone_id' => $zoneId,
        'cpm' => $cpmBid,
    ];

    // Build query string
    $queryString = http_build_query($params);

    // Final API URL with query string
    $apiUrl = $url . '?' . $queryString;

    // Make API request using curl
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $apiUrl);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    curl_close($ch);

    // Decode JSON response
    $data = json_decode($response, true);

    // Check if API request was successful
    if ($data && isset($data['success']) && $data['success'] === true) {
        return true; // Bid adjustment successful
    } else {
        return false; // Bid adjustment failed
    }
}

// Example usage to adjust CPM bid for a specific zone
$apiKey = 'your_api_key_here';
$zoneId = 'your_zone_id_here';
$newCpmBid = 0.5; // New CPM bid value in USD

$bidAdjusted = adjustPropellerAdsBid($apiKey, $zoneId, $newCpmBid);

if ($bidAdjusted) {
    echo "CPM bid adjusted successfully.";
} else {
    echo "Failed to adjust CPM bid.";
}
?>
