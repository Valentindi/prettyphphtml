<?php

class ctrl_classes {
    static function get_controller($tag, $parent){


        $pphphtml_config = simplexml_load_file("config/pphphtml-config.xml");
        $ctrl_path = $_SERVER["DOCUMENT_ROOT"] . "/" .$pphphtml_config->$tag['ctrl'];

        if (!file_exists($ctrl_path)) {
            return new Error("Controller not found");
        }

        include_once ($ctrl_path);
        switch ($tag){
            case "index": return new index_ctrl($parent); break;
            case "head": return new head_ctrl($parent); break;
            case "body": return new body_ctrl($parent); break;
            case "headbar": return new headbar_ctrl($parent); break;
            case "signupform": return new signupform_ctrl($parent); break;
            case "signup": return new signup_ctrl($parent); break;
        }
        return new ctrl();

    }
}