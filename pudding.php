<?php
//git webhook 自动部署脚本
//项目存放物理路径


$requestBody = file_get_contents("php://input");
$token = $_SERVER['HTTP_X_GITLAB_TOKEN'];
if ($token == "") {
    //$res_log .= "token is errors".PHP_EOL;
    //file_put_contents("git-webhook-ceshi.txt", date("Y-m-d H:i:s"), FILE_APPEND);//追加写入
    //file_put_contents("git-webhook-ceshi.txt", $res_log, FILE_APPEND);//追加写入

    die('token错误');

}
if (empty($requestBody)) {
    die('send fail');
}
$content = json_decode($requestBody, true);
//若是主分支且提交数大于0
if ($token == "cc17c30cd111c7215fc8f51f87fiefan") {
    $path = "/var/www/html/feifan";
    if ($content['ref'] == 'refs/heads/master' && $content['total_commits_count'] > 0) {
        $res = shell_exec("cd {$path} && git pull 2>&1");//以www用户运行
        shell_exec("cd {$path} && php artisan route:cache 2>&1");
        $res_log = '-------------------------' . PHP_EOL;
        $res_log .= $content['user_name'] . ' 在' . date('Y-m-d H:i:s') . '向' . $content['repository']['name'] . '项目的' . $content['ref'] . '分支push了' . $content['total_commits_count'] . '个commit：' . PHP_EOL;
        $res_log .= $res . PHP_EOL;
        file_put_contents("git-webhook-log.txt", $res_log, FILE_APPEND);//追加写入
    }
}
