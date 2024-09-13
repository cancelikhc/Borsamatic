<?php

// Sabit dolar fiyatı (örneğin)
$usd_price = 56;
// JSON formatında yanıt oluştur
$response = array(
    'price' => $usd_price
);

// JSON formatında yanıtı döndür
header('Content-Type: application/json');
echo json_encode($response);
?>