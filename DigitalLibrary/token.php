<?php

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://test.instamojo.com/oauth2/token/');     
curl_setopt($ch, CURLOPT_HEADER, FALSE);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);

$payload = Array(
    'grant_type' => 'client_credentials',
    'client_id' => 'test_Z083YINDsoLVhTERbnqFPOAEZhCeZ3olY7l',
    'client_secret' => 'test_JWHJ5SqSnZ6sNiF5XEpRQD1tA6v7hGXLUI7grAewXunjFW92BT75G6C4PZmuUX6NZl4Aefl2iQwMC4sX1roqhSpOjqTSrNs5OBOzZrWug22CsGJe6u7gNAdaY9V'
  );

curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($payload));
$response = curl_exec($ch);
curl_close($ch); 

echo $response;

?>