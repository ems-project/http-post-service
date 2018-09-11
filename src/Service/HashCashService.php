<?php
/**
 * Created by PhpStorm.
 * User: mdk
 * Date: 11/09/2018
 * Time: 16:50
 */

namespace App\Service;


use Symfony\Component\HttpFoundation\File\Exception\AccessDeniedException;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Response;

class HashCashService
{
    /**
     * @var RequestStack
     */
    private $requestStack;

    public function __construct(RequestStack $requestStack)
    {
        $this->requestStack = $requestStack;
    }


    public function getResponse()
    {
        $method = $this->requestStack->getCurrentRequest()->getMethod();

        if( $method === 'OPTIONS') {

        }
        else if( $method === 'POST') {
            $hashCash = $this->requestStack->getCurrentRequest()->headers->get('X-Hashcash', false);
            if( $hashCash === false ) {
                throw new AccessDeniedException('/');
            }
        }
        else {
            throw new AccessDeniedException('/');
        }


        $response = new Response();
        $response->headers->set('Access-Control-Allow-Origin', $this->requestStack->getCurrentRequest()->headers->get('Origin'));
        $response->headers->set('Access-Control-Allow-Methods', 'POST');
        $response->headers->set('Content-Type', 'application/json');
        $response->headers->set("Access-Control-Allow-Headers", "accept, x-hashcash, Content-type");
        return $response;
    }



}