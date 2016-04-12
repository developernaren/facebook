<?php

namespace DeveloperNaren\FB;


use DeveloperNaren\Fb\Exceptions\IncompleteFbConfig;

class Facebook
{

    private $key;
    private $secret;
    private $redirect;
    private $postAs = 'person';
    private $pageId;
    private $status = [];
    private $link = [];
    private $image = [];
    private $configKeys = ['key', 'secret', 'redirect'];
    private $albumId;



    function __construct( $config )
    {
        $this->checkConfig($config);
        $this->assignConfig($config);

    }

    /**
     * @param $config
     * @throws IncompleteFbConfig
     */
    private function checkConfig($config)
    {
        $providedConfig = array_keys( array_filter($config));
        $keyDiff = array_diff($providedConfig, $this->configKeys);
        if (!empty($keyDiff)) {

            throw new IncompleteFbConfig("Missing Config key :" . implode(',', $keyDiff));
        }
    }

    /**
     * @param $config
     */
    private function assignConfig($config)
    {
        foreach ($config as $key => $value) {
            if (in_array($key, $this->configKeys)) {
                $this->{$key} = $value;
            }
        }
    }



    function asPage( $id ) {

        $this->postAs = "page";
        $this->pageId = $id;
        return $this;

    }

    /**
     * @return mixed
     */
    public function getKey()
    {
        return $this->key;
    }

    /**
     * @return mixed
     */
    public function getSecret()
    {
        return $this->secret;
    }

    /**
     * @return mixed
     */
    public function getRedirect()
    {
        return $this->redirect;
    }

    /**
     * @return string
     */
    public function getPostAs()
    {
        return $this->postAs;
    }

    /**
     * @return mixed
     */
    public function getPageId()
    {
        return $this->pageId;
    }

    /**
     * @return array
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @return array
     */
    public function getLink()
    {
        return $this->link;
    }

    /**
     * @return array
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @return mixed
     */
    public function getAlbumId()
    {
        return $this->albumId;
    }

    function addStatus( $status ) {

        $this->status[] = $status;
        return $this;
    }


    function addLink( $link ) {

        $this->link = $link;
        return $this;
    }

    function addImage( $image ) {

        $this->image[] = $image;
        return $this;
    }

    function createAlbum() {

    }

    function toAlbum( $album ) {

        $this->albumId = $album;
        return $this;
    }



    function post() {

        return with( new PostBot( $this ) )->post();
    }




}