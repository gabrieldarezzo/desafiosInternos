<?php


require_once 'simple_html_dom.php';


$url = 'https://google.com/';


$ch = curl_init();

// Set the url, number of POST vars, POST data
curl_setopt($ch, CURLOPT_URL, $url );

//curl_setopt( $ch, CURLOPT_POST, true );
//curl_setopt( $ch, CURLOPT_POSTFIELDS, json_encode( $fields ) );

//curl_setopt( $ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true );
// curl_setopt($ch, CURLOPT_VERBOSE, 0); 

// Avoids problem with https certificate
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1; .NET CLR 1.0.3705; .NET CLR 1.1.4322)');

// Execute post
$result = curl_exec($ch);

// Close connection
curl_close($ch);



$html = str_get_html($result);

//$html->find('A', 1)->class = 'bar';

$url_moved = $html->find('A', 0)->href;



$ch = curl_init();

// Set the url, number of POST vars, POST data
curl_setopt($ch, CURLOPT_URL, $url_moved );

//curl_setopt( $ch, CURLOPT_POST, true );
//curl_setopt( $ch, CURLOPT_POSTFIELDS, json_encode( $fields ) );

//curl_setopt( $ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true );
// curl_setopt($ch, CURLOPT_VERBOSE, 0); 

// Avoids problem with https certificate
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1; .NET CLR 1.0.3705; .NET CLR 1.1.4322)');

// Execute post
$result = curl_exec($ch);

// Close connection
curl_close($ch);

print $result; 