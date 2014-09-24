<?php
require_once APPPATH."/third_party/querypath-2.1.2/QueryPath/QueryPath.php";
qp('http://jmnote.com/html5/sample.php')->find('title')->text('Hello World')->writeHTML();
?>