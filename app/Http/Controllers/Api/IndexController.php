<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Facebook\Facebook;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    /**
     * 测试Facebook
    */
    public function face(){
        $fb = new Facebook([
            'app_id' => '572062363533288',
            'app_secret' => 'ce934044acf2b5c0898deb9d1dd4d88a',
            'default_graph_version' => 'v2.10',
            //'default_access_token' => '{access-token}', // optional
        ]);

        // Use one of the helper classes to get a Facebook\Authentication\AccessToken entity.
        //   $helper = $fb->getRedirectLoginHelper();
        //   $helper = $fb->getJavaScriptHelper();
        //   $helper = $fb->getCanvasHelper();
        //   $helper = $fb->getPageTabHelper();

        try {
            // Get the \Facebook\GraphNodes\GraphUser object for the current user.
            // If you provided a 'default_access_token', the '{access-token}' is optional.
            $response = $fb->get('/me', '{access-token}');
        } catch(\Facebook\Exceptions\FacebookResponseException $e) {
            // When Graph returns an errors
            echo 'Graph returned an errors: ' . $e->getMessage();
            exit;
        } catch(\Facebook\Exceptions\FacebookSDKException $e) {
            // When validation fails or other local issues
            echo 'Facebook SDK returned an errors: ' . $e->getMessage();
            exit;
        }

        $me = $response->getGraphUser();
        echo 'Logged in as ' . $me->getName();
    }
}
