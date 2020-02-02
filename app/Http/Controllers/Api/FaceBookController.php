<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use FacebookAds\Api;
use FacebookAds\Object\AdSet;
use FacebookAds\Object\AdAccount;
use FacebookAds\Object\Fields\AdSetFields;
use FacebookAds\Object\Fields\CampaignFields;
use FacebookAds\Logger\CurlLogger;

class FaceBookController extends Controller
{
    /**
     * Facebook广告分析接口
    */
    public function faceBook(){
        set_time_limit(0);
        $access_token = 'EAAHoO10qr5sBAGVWPFIljXPL0ZBo6fDpPRgkjbfN5XwAiSmqQyS10fKZBbtVLkbYFVYUbdZB8avLr0G38p2GMIcJ5kjL7B3lKtdZBZCLRWfQjOaV8ZCJZCN9iuUn7OyzaXuD3SZApIGXoGwisQphcowlwPVOxy35g9JlweD9z9h9z7fCwyiPHLwamW2AZBZBfuVBYZD';
        $ad_account_id = 'act_1041504709526344';
        $app_secret = 'c917170475a83d3f0aeaab6be2a236cb';
        $app_id = '536816640503707';

        $api = Api::init($app_id, $app_secret, $access_token);
        $api->setLogger(new CurlLogger());

        $fields = array(
            'results',
            'result_rate',
            'reach',
            'budget',
            'schedule',
            'split_test_split',
            'split_test_variable',
        );
        $params = array(
            'level' => 'adset',
            'filtering' => array(),
            'breakdowns' => array('ad_id'),
            'time_range' => array('since' => '2019-10-17','until' => '2019-11-16'),
        );
        echo json_encode((new AdAccount($ad_account_id))->getInsights(
            $fields,
            $params
        )->getResponse()->getContent(), JSON_PRETTY_PRINT);





















//        set_time_limit(0);
////        ini_set('max_execution_time', 600);//秒为单位，自己根据需要定义
//        $app_id = 'EAAHoO10qr5sBAL8NVGTdAzGix8fvKnYlUTyCF3ZAz27bGkM9t5IIo0pb991j2IssiduiSkpZCkNqiqmZAoxCKfIZCzYb6lEduoBnYAQEZAxu1Ix6BTttGGV9yl2ceyyJRnFfAQZCPg8N4Mga63v98Xg8QSfe5j4TZB0VHzQpiDjgVtzyZBl45cUYbcnRZBMNO5AgDoujUeh9kNAn1M9yCSt7Y9BVK55fTrZA6RgFbSHk7d0uTGpfd4XsDF7ZAXf6bSArmgZD';
//        $app_secret = 'c917170475a83d3f0aeaab6be2a236cb';
//        $access_token = 'EAAHoO10qr5sBAL8NVGTdAzGix8fvKnYlUTyCF3ZAz27bGkM9t5IIo0pb991j2IssiduiSkpZCkNqiqmZAoxCKfIZCzYb6lEduoBnYAQEZAxu1Ix6BTttGGV9yl2ceyyJRnFfAQZCPg8N4Mga63v98Xg8QSfe5j4TZB0VHzQpiDjgVtzyZBl45cUYbcnRZBMNO5AgDoujUeh9kNAn1M9yCSt7Y9BVK55fTrZA6RgFbSHk7d0uTGpfd4XsDF7ZAXf6bSArmgZD';
//
//        Api::init($app_id, $app_secret, $access_token);
//        $api = Api::instance();
//
//
//        $account_id = 'act_1041504709526344';
//        $campaign_id = '107373057390683';
//
//        $account = new AdAccount($account_id);
//        $adset = $account->createAdSet(
//            array(),
//            array(
//                AdSetFields::NAME => 'My Test AdSet',
//                AdSetFields::CAMPAIGN_ID => $campaign_id,
//                AdSetFields::DAILY_BUDGET => 150,
//                AdSetFields::START_TIME => (new \DateTime("+1 week"))->format(\DateTime::ISO8601),
//                AdSetFields::END_TIME => (new \DateTime("+2 week"))->format(\DateTime::ISO8601),
//                AdSetFields::BILLING_EVENT => 'IMPRESSIONS',
//                AdSetFields::TARGETING => array('geo_locations' => array('countries' => array('US'))),
//                AdSetFields::BID_AMOUNT => '1000',
//            )
//        );
//
////        echo $adset->id;
//
//        dd($adset);
//
//        // 初始化一个新会话并实例化一个Api对象
//        Api::init($app_id, $app_secret, $access_token);
//
////        // Api对象现在可以通过单例访问
//        $api = Api::instance();
////        dd($api);
//
//        $account = new AdAccount('act_1041504709526344');
////        $cursor = $account->getCampaigns(['id','name']);
//
//        // Loop over objects
////        foreach ($cursor as $campaign) {
////            echo $campaign->{CampaignFields::NAME}.PHP_EOL;
////        }
//
//        dd($account);
//        // Access objects by index
////        if ($cursor->count() > 0) {
////            echo "The first campaign in the cursor is: ".$cursor[0]->{CampaignFields::NAME}.PHP_EOL;
////        }
//
//        // Fetch the next page
//        $cursor->fetchAfter();
//        // New Objects will be appended to the cursor
    }
}
