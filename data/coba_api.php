<?php
$curl = curl_init();
$category = 'happiness';
curl_setopt_array($curl, [
    // CURLOPT_URL => "https://booking.kai.id/api/stations2",
    // CURLOPT_URL => "https://al-quran-8d642.firebaseio.com/data.json?print=pretty",
    CURLOPT_URL => "https://api.api-ninjas.com/v1/quotes?category={$category}",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "GET",
    CURLOPT_HTTPHEADER => [
        "x-api-key: HsYoutl6H6KEMk+xa2CSvA==4bdtsy5ABoBSWwDz",
        "accept: application/json",
        "content-type: application/json"
    ],
]);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
    echo "cURL Error #:" . $err;
} else {
    echo $response;
    // $hasil = json_decode($response, true);
    // if (is_array($hasil) && count($hasil)) {
    //     foreach ($hasil as $row) :
    //         echo $row["author"] . "\n";
    //     endforeach;
    // }
}
