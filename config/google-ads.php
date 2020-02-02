<?php
return [
    //Environment=> test/production
    'env' => 'test',
    //Google Ads
    'production' => [
        'developerToken' => "YOUR-DEV-TOKEN",
        'clientCustomerId' => "CLIENT-CUSTOMER-ID",
        'userAgent' => "YOUR-NAME",
        'clientId' => "CLIENT-ID",
        'clientSecret' => "CLIENT-SECRET",
        'refreshToken' => "REFRESH-TOKEN"
    ],
    'test' => [
        'developerToken' => "dB3g2EOh4aeEqtoDhEHFlQ",
        'clientCustomerId' => "512-387-0186",
        'userAgent' => "xuzhen",
        'clientId' => "521056098405-4h1ad3van2pi7unt08u161ejb530afjc.apps.googleusercontent.com",
        'clientSecret' => "_nggkLgq9VwtSuisDFR3-cFd",
        'refreshToken' => "1//0eQA4_ne0HytaCgYIARAAGA4SNwF-L9IrKHPdnYtGEzKaHXzdplDxtIaQi5VqsrGq8P-n5SSaF5iJuApod5wh-eaISwkQw6pmP58"
    ],
    'oAuth2' => [
        'authorizationUri' => 'https://accounts.google.com/o/oauth2/v2/auth',
        'redirectUri' => 'urn:ietf:wg:oauth:2.0:oob',
        'tokenCredentialUri' => 'https://www.googleapis.com/oauth2/v4/token',
        'scope' => 'https://www.googleapis.com/auth/adwords'
    ]
];