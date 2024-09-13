
<?php
//ben direk düz alıyorum sen boş mu dolu mu kontrollerini eklersin

$name = $_GET['name'];
$hisseAdi = mb_strtoupper($name);
$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, 'https://api.collectapi.com/economy/liveBorsa?name=ACSEL');
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



?>
<!-- TradingView Widget BEGIN -->
<div class="tradingview-widget-container" style="height:100%;width:100%">
  <div class="tradingview-widget-container__widget" style="height:calc(100% - 32px);width:100%"></div>
  <div class="tradingview-widget-copyright"><a href="https://tr.tradingview.com/" rel="noopener nofollow" target="_blank"><span class="blue-text">Tüm piyasaları TradingView üzerinden takip edin</span></a></div>
  <script type="text/javascript" src="https://s3.tradingview.com/external-embedding/embed-widget-advanced-chart.js" async>
  {
  "autosize": true,
  "symbol": "BIST:<?php 
  foreach($dec['result'] as $k => $v){
    if($hisseAdi == $v['name']){
        $found = true;
        $data = $v;
        echo $v['name'];
    }
}
  
  ?>",
  "timezone": "Etc/UTC",
  "theme": "light",
  "style": "3",
  "locale": "tr",
  "enable_publishing": true,
  "backgroundColor": "rgba(255, 255, 255, 1)",
  "withdateranges": true,
  "range": "YTD",
  "hide_side_toolbar": false,
  "allow_symbol_change": true,
  "details": true,
  "hotlist": true,
  "calendar": false,
  "show_popup_button": true,
  "popup_width": "1000",
  "popup_height": "650",
  "support_host": "https://www.tradingview.com"
}
  </script>
</div>
<!-- TradingView Widget END -->