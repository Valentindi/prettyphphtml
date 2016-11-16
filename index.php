<?php


include_once("view_controller/index.ctrl.php");

$ctrl = new index_ctrl();
echo $ctrl ->get_html("root");