<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Facebook\Facebook;
use Google\AdsApi\AdWords\v201809\cm\CampaignService;
use Illuminate\Http\Request;
use Edujugon\GoogleAds\GoogleAds;
use Edujugon\GoogleAds\Reports\Report;
class GoogleControler extends Controller
{
    /**
     * 测试谷歌广告分析接口
    */
    public function google(){
        $fb = new Facebook([
            'app_id' => '572062363533288',
            'app_secret' => 'ce934044acf2b5c0898deb9d1dd4d88a',
            'default_graph_version' => 'v2.10',
            //'default_access_token' => '{access-token}', // optional
        ]);

        try {
            // Get the \Facebook\GraphNodes\GraphUser object for the current user.
            // If you provided a 'default_access_token', the '{access-token}' is optional.
//            $response = $fb->get('/me', '{access-token}');

            $response = $fb->get(
            // '/act_365918350964209?fields=insights,ads',
                '/me',
                'EAAIISaX3vZBgBABHJR4uZCaQhl2hAS4OXx695wamA0ZBLxDPGYsjKBZCMpqVqWZC177mJak79KqFsyPQWo4cssZBKJL3ZAU9O6zAQhGm4bdb1PVvJ0fstYYB5jqTlQWqVUkGEuQ3klZBq8cSK2rZBuu4w8GMYSfGtV12W8dgRMmi4a4qDU8eNC0g0bsuPZCt0ZC5I4ZD'
            );
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


        dd(uniqid());
        $ads = new GoogleAds();
//        $report = $ads->report();
//        $fields = $ads->report()->getFormats();
//        $fields = $ads->report()->from('CRITERIA_PERFORMANCE_REPORT')->getFields();
//        $report = google_report();
//        $report = $ads->service(CampaignService::class)
//            ->select(['Id', 'Name', 'Status', 'ServingStatus', 'StartDate', 'EndDate'])
//            ->get();
//        $report = $ads->service(CampaignService::class);
        $report = $ads->service(CampaignService::class)
            ->select(['Id', 'Name', 'Status', 'ServingStatus', 'StartDate', 'EndDate'])
            ->get();
        dd($report);
    }
}
