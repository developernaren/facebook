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
    private $client;


    function __construct(Facebook $facebook)
    {

        $this->client = new Client();
        $this->facebook = $facebook;
        $this->preparePost();
    }

    function prepareUrl()
    {
        $this->accessToken = with(new AccessToken())->get();
        $this->finalUrl = $this->baseUrl . '/' . $this->version;
        $this->postingAs = $this->facebook->getPostAs();

        if ($this->postingAs == "page") {
            $this->finalUrl .= '/' . $this->facebook->getPageId();
        } else {
            $this->finalUrl .= '/me';
        }

    }


    private function preparePost()
    {
        $this->prepareStatus();
    }


    function post()
    {
        $this->prepareUrl();
        $this->finalUrl .= '/feed';
        $this->finalUrl = $this->appendAccessToken();

        $formParam = ['message' => $this->status];

        if( !empty( $this->facebook->getLink() ) ) {
            $formParam['link'] = $this->facebook->getLink();
        }
        $res = $this->client->request('POST', $this->finalUrl, [
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

    function postPhoto($photoUrl)
    {
        $this->prepareUrl();
        $this->prepareStatus();
        $this->finalUrl .= '/photos';
        $this->finalUrl = $this->appendAccessToken();

        $formParam = [
            'caption' => $this->status,
            'url' => $photoUrl
        ];

        $res = $this->client->request('POST', $this->finalUrl, [
            'form_params' => $formParam
        ]);

        return $res->getBody()->getContents();
    }

    private function appendAccessToken(){

        return $this->finalUrl . '?access_token=' . $this->accessToken;
    }


}