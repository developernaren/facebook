<?php

return [

    'secret' => "APP_SECRET_HERE",
    'key' => 'APP_KEY_HERE',
    'redirect' => 'REDIRECT_URI_HERE',
    'scope' => ['email', 'manage_pages','publish_pages','user_status', 'publish_actions'],
    'access_token' =>  function() {
        return "access_token";
    }
];