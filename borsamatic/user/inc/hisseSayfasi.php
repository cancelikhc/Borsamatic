<?php

$name = $_GET['name'];
$ch = curl_init();
if ($name === null || !preg_match('/^[a-zA-Z]+$/', $name)) {
    die('Geçersiz para birimi.');
}

curl_setopt($ch, CURLOPT_URL, 'https://api.collectapi.com/economy/liveBorsa');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');


$headers = array();
$headers[] = 'Authorization: apikey 2wmUR67qpbaEefjnyXQ9zt:3GaGPjguW0JIaEop3Ldf7O';
$headers[] = 'Content-Type: application/json';
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

$result = curl_exec($ch);
if (curl_errno($ch)) {
    echo 'Error:' . curl_error($ch);
}
curl_close($ch);
$lbdec = json_decode($result, true);

$found = false;

foreach($lbdec['result'] as $k => $v){
    if($name == $v['name']){
        $found = true;
        $data = $v;
        $currency = $v['name'];
        $price = $v['price'];

        echo $v['price'];

$file = 'damla.json';

// Kullanıcıdan gelen GET parametrelerini al


// Eğer para birimi belirtilmemişse veya geçersiz ise, hata mesajı gönder


// API'den anlık fiyatı al (Örneğin sadece sabit bir değer atıyorum)
$api_price = $price; // Bu değeri gerçek bir API'den çekebilirsiniz.

// JSON dosyasını okuma
$json_data = file_get_contents($file);

// JSON verisini PHP dizisine dönüştürme
$data = json_decode($json_data, true);

// Eğer belirtilen para birimi daha önce eklenmemişse, yeni bir para birimi ekleyin
if (!isset($data[$currency])) {
    $data[$currency] = [];
}

// Yeni fiyat verisini oluşturma
$new_price_data = array('time' => time(), 'price' => $api_price);

// Eğer maksimum 10 kayıt varsa, en eski kaydı sil
if (count($data[$currency]) >= 24) {
    array_shift($data[$currency]);
}

// Yeni fiyat verisini ekleyin
$data[$currency][] = $new_price_data;

// Güncellenmiş veriyi JSON formatına dönüştürme
$new_json_data = json_encode($data);

// JSON verisini dosyaya yazma
file_put_contents($file, $new_json_data);

echo "Para birimi: $currency, Fiyat: $api_price";

}}


$file = 'damla.json';
$json_data = file_get_contents($file);

// JSON verisini PHP dizisine dönüştürme
$data = json_decode($json_data, true);


?>