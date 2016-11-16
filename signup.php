<?php

include_once("modules/login/controller/signup.ctrl.php");

$ctrl = new signup_ctrl();
echo $ctrl ->get_html("root");