
<?php
//ben direk düz alıyorum sen boş mu dolu mu kontrollerini eklersin

$name = $_GET['name'];
$hisseAdi = mb_strtoupper($name);
$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, 'https://api.collectapi.com/economy/hisseSenedi');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');


$headers = array();
$headers[] = 'Authorization: apikey 1pI4yi9ULoz1QVEu5ufs7H:5fqYRcZXUHM49d7dn2Yu2A';
$headers[] = 'Content-Type: application/json';
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

$result = curl_exec($ch);
if (curl_errno($ch)) {
    echo 'Error:' . curl_error($ch);
}
curl_close($ch);
$dec = json_decode($result, true);

$found = false;

foreach($dec['result'] as $k => $v){
    if($hisseAdi == $v['code']){
        $found = true;
        $data = $v;
        echo $v['code'];
    }
}

?>
