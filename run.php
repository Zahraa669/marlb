<?php
/*
######################################
Created By Alip Dzikri © 2019 ~ PT.MiskinTerus inc
BOLEH RECODE 
JANGAN HAPUS AUTHOR Ya Anjing
######################################
Have any Question ? or want to request another tools ?
https://wa.me/6287889538910
*/
$email = 'amshop02@gmail.com';
$password = 'Saninkicker123$';

$urlencode = urlencode($email);
$urlencode1 = urlencode($password);
$cookie=get_cookie();
$csrf=get_between($cookie, 'decide_csrf" value="', '" /><input');
$session=get_between($cookie, 'Set-Cookie: decide_session=', '; path=/;');
$device_id=get_between($cookie, 'Set-Cookie: deviceId=', '; Max-Age=');
//2
//CURL
sleep(4);
$header = array();
$header[] = "Host: www.marlboro.id";
$header[] = "User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:68.0) Gecko/20100101 Firefox/68.0";
$header[] = "Accept: text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8";
$header[] = "Accept-Language: en-US,en;q=0.5";
$header[] = "Accept: application/json";
$header[] = "Accept-Encoding: gzip, deflate, br";
$header[] = "DNT: 1";    
$header[] = "Connection: keep-alive";
$header[] = "Upgrade-Insecure-Requests: 1";
$header[] = 'Cookie: scs=1; deviceId='.$device_id.'; decide_session='.$session;
$c = curl_init("https://www.marlboro.id/auth/login");
    curl_setopt($c, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($c, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($c, CURLOPT_POSTFIELDS, 'email='.$urlencode.'&password='.$urlencode1.'&remember_me=remember_me&ref_uri=/&decide_csrf='.$csrf.'&param=&exception_redirect=false');
    curl_setopt($c, CURLOPT_POST, true);
    curl_setopt($c, CURLOPT_ENCODING, "");
    curl_setopt($c, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($c, CURLOPT_HEADER, true);
    curl_setopt($c, CURLOPT_HTTPHEADER, $header);
    $response = curl_exec($c);
    preg_match_all('/^Set-Cookie:\s*([^;]*)/mi', $response, $sesi);
preg_match_all('/^Set-Cookie:\s*([^;]*)/mi', $response, $matches);
$cookies = array();
foreach($matches[1] as $item) {
    parse_str($item, $cookie);
    $cookies = array_merge($cookies, $cookie);
}
preg_match_all("/[0-9]{13}/", $cookies['decide_session'], $xx);

echo "[+]LOGIN ".$email."  \n";
if(preg_match('/success/i', $response)){
	echo "[+]Sukses Login ".$email." \n";
sleep(4);
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://www.marlboro.id/aldmic/catalog?_='.$xx[0][0].'');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
$headers = array();
$headers[] = 'Host: www.marlboro.id';
$headers[] = 'Accept: */*';
$headers[] = 'X-Requested-With: XMLHttpRequest';
$headers[] = 'User-Agent: Mozilla/5.0 (Linux; Android 7.1.1; SM-J250F) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/76.0.3809.132 Mobile Safari/537.36';
$headers[] = 'Sec-Fetch-Mode: cors';
$headers[] = 'Sec-Fetch-Site: same-origin';
$headers[] = 'Referer: https://www.marlboro.id/profile';
$headers[] = 'Accept-Encoding: gzip, deflate, br';
$headers[] = 'Accept-Language: id-ID,id;q=0.9,en-US;q=0.8,en;q=0.7,ms;q=0.6';
$headers[] = 'Cookie: '.$sesi[1][1].'';
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
$result = curl_exec($ch);

$jsresult = (json_decode($result, true));

$dir = $jsresult['data']['url'];
echo $dir;
sleep(2);
$cc = curl_init();
$halip = array();
$halip[] = 'Authority: loyalty.aldmic.com';
$halip[] = 'cache-control: max-age=0';
$halip[] = 'upgrade-insecure-requests: 1';
$halip[] = 'user-agent: Mozilla/5.0 (Linux; Android 7.1.1; SM-J250F) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/76.0.3809.132 Mobile Safari/537.36';
$halip[] = 'sec-fetch-mode: navigate';
$halip[] = 'sec-fetch-user: ?1';
$halip[] = 'accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3';
$halip[] = 'sec-fetch-site: none';
$halip[] = 'referer: https://www.marlboro.id/profile ';
$halip[] = 'accept-encoding: gzip, deflate, br';
$halip[] = 'accept-language: id-ID,id;q=0.9,en-US;q=0.8,en;q=0.7,ms;q=0.6';
curl_setopt($cc, CURLOPT_URL, $dir);
curl_setopt($cc, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($cc, CURLOPT_HTTPHEADER, $halip);
curl_setopt($cc, CURLOPT_CUSTOMREQUEST, 'GET');
curl_setopt($cc, CURLINFO_HEADER_OUT, true);
curl_setopt($cc, CURLOPT_HEADER, 1);
$result2 = curl_exec($cc);
preg_match_all('/^Set-Cookie:\s*([^;]*)/mi', $result2, $mamah);
$cf_duid = $mamah[1][0];
$xsrf_token = $mamah[1][1];
$aldmic_session = $mamah[1][2];
$aldmic_key = $mamah[1][3];
echo $aldmic_key;
if($aldmic_key == null){
	die(" SILAHKAN RUN ULANG SCRIPT \n");
	}
echo "\n";
echo "\n";
sleep(2);
echo "[+]CATALOG Special Deals \n";

$oke = array();
$oke[] = 'Host: loyalty.aldmic.com';
$oke[] = 'Upgrade-Insecure-Requests: 1';
$oke[] = 'User-Agent: Mozilla/5.0 (Linux; Android 7.1.1; SM-J250F) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/76.0.3809.132 Mobile Safari/537.36';
$oke[] = 'Sec-Fetch-Mode: navigate';
$oke[] = 'Sec-Fetch-User: ?1';
$oke[] = 'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3';
$oke[] = 'Sec-Fetch-Site: same-origin';
$oke[] = 'Referer: https://loyalty.aldmic.com/catalog/6';
$oke[] = 'Accept-Language: id-ID,id;q=0.9,en-US;q=0.8,en;q=0.7,ms;q=0.6';
$oke[] = 'Cookie: '.$cf_duid.'';
$oke[] = 'Cookie: '.$xsrf_token.'';
$oke[] = 'Cookie: '.$aldmic_key.'';
$oke[] = 'Cookie: '.$aldmic_session.'';

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://loyalty.aldmic.com/catalog/9');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
curl_setopt($ch, CURLOPT_HTTPHEADER, $oke);
$alip = curl_exec($ch);
$rapi = "\n =========================================== \n";
preg_match_all('/<a href="(.*?)" class="red-btn">/', $alip, $ouh);
preg_match_all('/<h4>(.*?)<\/h4>/', $alip, $catalog);
echo $rapi;
echo $ouh[1][0];
echo "\n";
echo $catalog[1][0];
echo "\n";
echo $ouh[1][1];
echo "\n";
echo $catalog[1][1];
echo "\n";
echo $ouh[1][2];
echo "\n";
echo $catalog[1][2];
echo "\n";
echo $ouh[1][3];
echo "\n";
echo $catalog[1][3];
echo "\n";
echo $ouh[1][4];
echo "\n";
echo $catalog[1][4];
echo "\n";
echo $ouh[1][5];
echo "\n";
echo $catalog[1][5];
echo "\n";
echo $ouh[1][6];
echo "\n";
echo $catalog[1][6];
echo "\n";
echo $ouh[1][7];
echo "\n";
echo $catalog[1][7];
echo "\n";
echo $ouh[1][8];
echo "\n";
echo $catalog[1][8];
echo "\n";
echo $ouh[1][9];
echo "\n";
echo $catalog[1][9];
echo $rapi;
echo "[+]CATALOG E - VOUCHER \n";
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://loyalty.aldmic.com/catalog/3');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
curl_setopt($ch, CURLOPT_HTTPHEADER, $oke);
$alip2 = curl_exec($ch);
preg_match_all('/<a href="(.*?)" class="red-btn">/', $alip2, $ouh2);
preg_match_all('/<h4>(.*?)<\/h4>/', $alip2, $catalog2);
echo $rapi;
echo $ouh2[1][0];
echo "\n";
echo $catalog2[1][0];
echo "\n";
echo $ouh2[1][1];
echo "\n";
echo $catalog2[1][1];
echo "\n";
echo $ouh2[1][2];
echo "\n";
echo $catalog2[1][2];
echo "\n";
echo $ouh2[1][3];
echo "\n";
echo $catalog2[1][3];
echo "\n";
echo $ouh2[1][4];
echo "\n";
echo $catalog2[1][4];
echo "\n";
echo $ouh2[1][5];
echo "\n";
echo $catalog2[1][5];
echo "\n";
echo $ouh2[1][6];
echo "\n";
echo $catalog2[1][6];
echo "\n";
echo $ouh2[1][7];
echo "\n";
echo $catalog2[1][7];
echo "\n";
echo $ouh2[1][8];
echo "\n";
echo $catalog2[1][8];
echo "\n";
echo $ouh2[1][9];
echo "\n";
echo $catalog2[1][9];
echo $rapi;
sleep(2);
echo "[+]CATALOG FOOD \n";
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://loyalty.aldmic.com/catalog/2');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
curl_setopt($ch, CURLOPT_HTTPHEADER, $oke);
$alip3 = curl_exec($ch);
if(preg_match('/<div class="no-item-cont" style="height: 500px">/', $alip3)){
	echo "NO VOUCHER AVAIBLE \n";
	echo "\n";
	} else {
preg_match_all('/<a href="(.*?)" class="red-btn">/', $alip3, $ouh3);
preg_match_all('/<h4>(.*?)<\/h4>/', $alip3, $catalog3);
echo $rapi;
echo $ouh3[1][0];
echo "\n";
echo $catalog3[1][0];
echo "\n";
echo $ouh3[1][1];
echo "\n";
echo $catalog3[1][1];
echo "\n";
echo $ouh3[1][2];
echo "\n";
echo $catalog3[1][2];
echo "\n";
echo $ouh3[1][3];
echo "\n";
echo $catalog3[1][3];
echo "\n";
echo $ouh3[1][4];
echo "\n";
echo $catalog3[1][4];
echo "\n";
echo $ouh3[1][5];
echo "\n";
echo $catalog3[1][5];
echo "\n";
echo $ouh3[1][6];
echo "\n";
echo $catalog3[1][6];
echo "\n";
echo $ouh3[1][7];
echo "\n";
echo $catalog3[1][7];
echo "\n";
echo $ouh3[1][8];
echo "\n";
echo $catalog3[1][8];
echo "\n";
echo $ouh3[1][9];
echo "\n";
echo $catalog3[1][9];
echo $rapi;
}
echo "[+]CATALOG LIFESTYLE \n";
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://loyalty.aldmic.com/catalog/4');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
curl_setopt($ch, CURLOPT_HTTPHEADER, $oke);
$alip4 = curl_exec($ch);
if(preg_match('/<div class="no-item-cont" style="height: 500px">/', $alip4)){
	echo "NO VOUCHER AVAIBLE \n";
	echo "\n";
	} else {
preg_match_all('/<a href="(.*?)" class="red-btn">/', $alip4, $ouh4);
preg_match_all('/<h4>(.*?)<\/h4>/', $alip4, $catalog4);
echo $rapi;
echo $ouh4[1][0];
echo "\n";
echo $catalog4[1][0];
echo "\n";
echo $ouh4[1][1];
echo "\n";
echo $catalog4[1][1];
echo "\n";
echo $ouh4[1][2];
echo "\n";
echo $catalog4[1][2];
echo "\n";
echo $ouh4[1][3];
echo "\n";
echo $catalog4[1][3];
echo "\n";
echo $ouh4[1][4];
echo "\n";
echo $catalog4[1][4];
echo "\n";
echo $ouh4[1][5];
echo "\n";
echo $catalog4[1][5];
echo "\n";
echo $ouh4[1][6];
echo "\n";
echo $catalog4[1][6];
echo "\n";
echo $ouh4[1][7];
echo "\n";
echo $catalog4[1][7];
echo "\n";
echo $ouh4[1][8];
echo "\n";
echo $catalog4[1][8];
echo "\n";
echo $ouh4[1][9];
echo "\n";
echo $catalog4[1][9];
echo $rapi;
}
echo " [+]CATALOG PULSA \n";
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://loyalty.aldmic.com/catalog/5');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
curl_setopt($ch, CURLOPT_HTTPHEADER, $oke);
$alip5 = curl_exec($ch);
if(preg_match('/<div class="no-item-cont" style="height: 500px">/', $alip5)){
	echo "NO VOUCHER AVAIBLE \n";
	echo "\n";
	} else {
preg_match_all('/<a href="(.*?)" class="red-btn">/', $alip5, $ouh5);
preg_match_all('/<h4>(.*?)<\/h4>/', $alip5, $catalog5);
echo $rapi;
echo $ouh5[1][0];
echo "\n";
echo $catalog5[1][0];
echo "\n";
echo $ouh5[1][1];
echo "\n";
echo $catalog5[1][1];
echo "\n";
echo $ouh5[1][2];
echo "\n";
echo $catalog5[1][2];
echo "\n";
echo $ouh5[1][3];
echo "\n";
echo $catalog5[1][3];
echo "\n";
echo $ouh5[1][4];
echo "\n";
echo $catalog5[1][4];
echo $rapi;
}
	
echo "DONE\n";
echo "Created By Alip Dzikri \n";
}


function get_cookie(){
$c = curl_init("https://www.marlboro.id/auth/login");
    curl_setopt($c, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($c, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($c, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($c, CURLOPT_MAXREDIRS, 15);
    curl_setopt($c, CURLOPT_TIMEOUT, 30);
    curl_setopt($c, CURLOPT_ENCODING, "");
    curl_setopt($c, CURLOPT_CUSTOMREQUEST, "GET");
    curl_setopt($c, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
    curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($c, CURLOPT_HEADER, true);
    $response = curl_exec($c);
    return $response;
}

//other function
function get_between($string, $start, $end)
    {
        $string = " ".$string;
        $ini = strpos($string,$start);
        if ($ini == 0) return "";
        $ini += strlen($start);
        $len = strpos($string,$end,$ini) - $ini;
        return substr($string,$ini,$len);
    } 
