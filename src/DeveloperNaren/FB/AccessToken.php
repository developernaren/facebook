<?php
namespace DeveloperNaren\FB;

class AccessToken
{

    function __construct()
    {



    }


    function get() {

        $call = config('fb.access_token');
        return call_user_func( $call );
    }



}