<?php


include_once("controller/index.ctrl.php");

$ctrl = new index_ctrl();
echo "<h2>Test123</h2>";
echo $ctrl ->get_html();