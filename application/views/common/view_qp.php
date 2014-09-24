<?php
#require_once APPPATH."/third_party/querypath-2.1.2/QueryPath/QueryPath.php";
require_once APPPATH."/libraries/QueryPath2.php";
#qp('http://127.0.0.1:8090/common/main/sndmail_00700211')->find('test1')->text('Hello World')->writeHTML();

function xmp_print($arr) { echo '<xmp>'; print_r($arr); echo '</xmp>'; }


$html = '<!DOCTYPE html>
<html>
        <head>
                <title>예제</title>
        </head>
        <body>
                <p class="a" id="test1">다람쥐 헌 쳇바퀴<br>타고파.</p>
                <p class="a" id="test2">다람쥐가노래를한<b>다</b>
                람쥐.</p>
                <p>다람쥐</p>
        </body>
</html>';

$children = htmlqp($html, 'body', array('convert_to_encoding' => 'utf-8'))->children('p.a');
foreach($children as $child) {
	$node = $child;
	xmp_print($node);
}
?>