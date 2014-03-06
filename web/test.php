<?php
/**
 * Created by PhpStorm.
 * User: haidx
 * Date: 14-1-3
 * Time: ??5:45
 */
//ob_start(); //?????
//phpinfo(); //??phpinfo??
//$info=ob_get_clean(); //?????????????$info
//
//
//$file=fopen('./a.txt','w');
//fwrite($file,$info);
//fclose($file);


$packageUrl = 'http://tieba.baidu.com/tbmall/redpackage/open';


//$tiebaUrl = 'http://tieba.baidu.com/tbmall/redpackage?forum_id=73787&forum_name=%C4%A7%CA%DE%CA%C0%BD%E7'; // 魔兽世界吧

$tiebaUrl = 'http://tieba.baidu.com/tbmall/redpackage?forum_id=3445247&forum_name=%D3%A2%D0%DB%C8%FD%B9%FA'; // 英雄三国吧

$content = file_get_contents($tiebaUrl);

preg_match_all('#li\s+class="package_item package_item_canget" data-field="(.*?)"\s*>#is', $content, $match);

var_dump($match);


preg_match('#PageData\.tbs\s*=\s*"(.*)?"#i', $content, $pageData);

$tbs = $pageData[1];



if ($match[1]) {

    $data = $match[1][0];
    $data = json_decode(html_entity_decode($data), true);
    $data['tbs'] = $tbs;
    $data['ie'] = 'utf-8';
    $post = http_build_query($data);

}else{

    echo 'no gift';
}
preg_match('/^[^-]\d+\.\d/','12.3',$test);
var_dump($test);
var_dump($post);




