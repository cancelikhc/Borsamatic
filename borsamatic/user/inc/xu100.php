<?php
$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, 'https://api.collectapi.com/economy/borsaIstanbul');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');


$headers = array();
$headers[] = 'Authorization: apikey 70n2733NhhVtTAiRYIdIFH:6QO2V6Ea77coGS4xm422yq';
$headers[] = 'Content-Type: application/json';
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

$result = curl_exec($ch);
if (curl_errno($ch)) {
    echo 'Error:' . curl_error($ch);
}
curl_close($ch);
$bist = json_decode($result, true);

foreach($bist['result'] as $k => $v){
    echo $v['current'];
    $data = $v;
    $currency = 'XU100';
    $price = $v['current'];
    


}
$file = 'xu100.json';
// API'den anlık fiyatı al (Örneğin sadece sabit bir değer atıyorum)
$api_price = $price;
// JSON dosyasını okuma
$json_data = file_get_contents($file);

// JSON verisini PHP dizisine dönüştürme
$data = json_decode($json_data, true);

// Eğer belirtilen para birimi daha önce eklenmemişse, yeni bir para birimi ekleyin
if (!isset($data[$currency])) {
$data[$currency] = [];
}

// Yeni fiyat verisini oluşturma
$new_price_data = array('time' => time(), 'current' => $api_price);

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


$file = 'xu100.json';
$json_data = file_get_contents($file);

// JSON verisini PHP dizisine dönüştürme
$data = json_decode($json_data, true);


// Kullanıcıdan gelen GET parametrelerini al


// Eğer para birimi belirtilmemişse veya geçersiz ise, hata mesajı gönder
 // Bu değeri gerçek bir API'den çekebilirsiniz.




?>



         