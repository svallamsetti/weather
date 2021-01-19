<?php


namespace App\Helpers;


use Illuminate\Http\Client\Response;

class APIResponseHelper
{
    public function validateResponse(Response $response): bool
    {
        $statusCode = $response->status();
        if($statusCode>=400){
            return $response->clientError();
        }
        if($statusCode>=500){
            return $response->serverError();
        }
        if($statusCode >=200 &&  $statusCode < 300){
            return $response->successful();
        }
    }
}
