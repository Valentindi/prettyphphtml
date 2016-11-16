<?php

include_once("modules/login/view_controller/signup.ctrl.php");

$ctrl = new signup_ctrl();
echo $ctrl ->get_html("signup");