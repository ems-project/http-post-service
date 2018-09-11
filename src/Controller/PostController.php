<?php
/**
 * Created by PhpStorm.
 * User: mdk
 * Date: 11/09/2018
 * Time: 16:10
 */

namespace App\Controller;

use App\Service\HashCashService;
use Symfony\Component\HttpFoundation\File\Exception\AccessDeniedException;
use Symfony\Component\HttpFoundation\Response;

class PostController
{

    public function postAction(HashCashService $hashCash)
    {
        $response = $hashCash->getResponse();

        $response->setContent(json_encode(array(
            'submit_id' => random_int(0, 100000),
        )));
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }

    public function optionsAction(HashCashService $hashCash)
    {
        return $hashCash->getResponse();
    }



}