<?php


include_once("controller/ctrl.php");


class index_ctrl extends controller {
    public function __construct()
    {
        $this -> child_ctrl = array();
    }


    public function getParentCtrl()
    {
        return null; // TODO: Change the autogenerated stub
    }


}