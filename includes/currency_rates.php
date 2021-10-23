<?php

/**
 * @param $method [request method]
 * @param $url [url]
 * @param $data [params]
 * @return bool|string
 */
function externalApiRequest($method, $url, $data)
{
    $curl = curl_init();
    switch ($method) {
        case "POST":
            curl_setopt($curl, CURLOPT_POST, 1);
            if ($data)
                curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
            break;
        default:
            if ($data)
                $url = sprintf("%s?%s", $url, http_build_query($data));
    }
    // OPTIONS:
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_HTTPHEADER, array(
        'Content-Type: application/json',
    ));
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    // EXECUTE:
    $result = curl_exec($curl);
    if (!$result) {
        die("Error connecting please check your network connection and try refreshing this page. Thank you.");
    }
    curl_close($curl);
    return $result;
}

$btc_request = externalApiRequest('GET', 'https://api.coinbase.com/v2/exchange-rates?currency=BTC', false);
$btc_response = json_decode($btc_request, true);

/**
 * Bitcoin and euro rates
 */
$btc_rate = $btc_response['data']['rates']['USD'];
$euro_rate = 4.555;


