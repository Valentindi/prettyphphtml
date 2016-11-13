<?php


include_once("controller/index.ctrl.php");

$ctrl = new index_ctrl();
echo $ctrl ->get_html("root");