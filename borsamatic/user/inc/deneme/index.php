<?php
require_once 'simple_html_dom.php';

$html = file_get_html('http://tr.investing.com/indices/ise-100');
echo $html->find('title',0)->plaintext;
?>