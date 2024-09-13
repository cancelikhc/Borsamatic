<?php

include ('simple_html_dom.php');

$html = file_get_html('https://www.borsaistanbul.com/tr/endeks-detay/1000/bist-100');

$sonuc=$html->find('.printableArea');
echo $sonuc[0];
foreach($sonuc as $key){
    
    

}

//foreach ($html->find('.currency a') as $element) {
//
//    $adi=$element->href;
//    
//    foreach($html->find('#h_td_fiyat_id_'.$adi.'') as $element){
//        $fiyat=$element->plaintext;
//
//        echo $adi.' '.$fiyat.'<br>';
//    }
//}

?>