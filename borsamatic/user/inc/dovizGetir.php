<?php
function CurlGET($URL) {
	$CH = curl_init();
    curl_setopt($CH, CURLOPT_URL, $URL);
    curl_setopt($CH, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($CH, CURLOPT_CUSTOMREQUEST, 'GET');
    curl_setopt($CH, CURLOPT_ENCODING, 'gzip, deflate');
	
    $Headers = array();
	$Headers[] = 'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8';
	$Headers[] = 'User-Agent: Mozilla/5.0 (iPhone; CPU iPhone OS 12_2 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Mobile/15E148';
    curl_setopt($CH, CURLOPT_HTTPHEADER, $Headers);
	
    $Result = curl_exec($CH);
    if (curl_errno($CH)) {
        echo 'Error:' . curl_error($CH);
    }
    curl_close($CH);
	return $Result;	
}
$JSON = json_decode(CurlGET('https://api.genelpara.com/embed/para-birimleri.json'), true);
$dolar = $JSON['USD']['satis'];
$eur   = $JSON['EUR']['satis'];
$btc   = $JSON['BTC']['satis'];
$altin   = $JSON['GA']['satis'];
?>
