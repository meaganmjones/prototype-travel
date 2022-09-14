<?php

require 'square-php-sdk/autoload.php';

use Square\SquareClient;
use Square\Environment;
use Square\Exceptions\ApiException;
use Square\Square;

$dotenv = Dotenv::create(__DIR__);
$dotenv->load();

//$SQUARE_ACCESS_TOKEN = 'EAAAEML-BHvAQlAHou3eSoMuMQ_XCFR_MR5LqxE_ZribdD0nMw19-dV-2j5UWVEt';

$client = new SquareClient([
    'accessToken' => getenv(SQUARE_ACCESS_TOKEN),
    'environment' => Environment::SANDBOX,
]);

try {

    $apiResponse = $client->getLocationsApi()->listLocations();

    if ($apiResponse->isSuccess()) {
        $result = $apiResponse->getResult();
        foreach ($result->getLocations() as $location) {
            printf(
                "%s: %s, %s, %s<p/>", 
                $location->getId(),
                $location->getName(),
                $location->getAddress()->getAddressLine1(),
                $location->getAddress()->getLocality()
            );
        }

    } else {
        $errors = $apiResponse->getErrors();
        foreach ($errors as $error) {
            printf(
                "%s<br/> %s<br/> %s<p/>", 
                $error->getCategory(),
                $error->getCode(),
                $error->getDetail()
            );
        }
    }

} catch (ApiException $e) {
    echo "ApiException occurred: <b/>";
    echo $e->getMessage() . "<p/>";
}
