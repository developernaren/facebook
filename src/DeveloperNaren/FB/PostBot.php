<?php
namespace DeveloperNaren\FB;

use GuzzleHttp\Client;

class PostBot
{

    private $version = 'v2.3';
    private $baseUrl = 'https://graph.facebook.com';
    private $accessToken;
    private $status;
    private $facebook;
    private $fbUserId = 200585973614992;
    private $finalUrl;
    private $postingAs;
    private $postTo;


    function __construct(Facebook $facebook)
    {

        $this->facebook = $facebook;
        $this->preparePost();
        $this->prepareUrl();

        //$this->images = implode();


    }

    function prepareUrl()
    {

        $accessToken = with(new AccessToken())->get();
        $this->finalUrl = $this->baseUrl . '/' . $this->version;
        $this->postingAs = $this->facebook->getPostAs();

        if ($this->postingAs == "page") {
            $this->finalUrl .= '/' . $this->facebook->getPageId();
        } else {
            $this->finalUrl .= '/me';
        }

        $this->finalUrl .= '/feed/?access_token=' . $accessToken;


//        $images = $this->facebook->getImage();


    }


    private function preparePost()
    {
        $this->prepareStatus();
    }


    function post()
    {

        $client = new Client();


        $formParam = [];
        $formParam['message'] = $this->status;

        if( !empty( $this->facebook->getLink() ) ) {
            $formParam['link'] = $this->facebook->getLink();
        }

        $res = $client->request('POST', $this->finalUrl, [
            'form_params' => $formParam
        ]);

        return $res->getBody()->getContents();

    }

    function getAccessToken($func)
    {

        $this->accessToken = call_user_func($func);
    }

    function requestAndStoreAccessToken()
    {

    }


    function prepareRequest()
    {


    }

    private function prepareStatus()
    {
        $this->status = implode(PHP_EOL, $this->facebook->getStatus());
    }


}