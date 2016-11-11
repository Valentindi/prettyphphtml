<?php

class ctrl_classes {
    static function get_controller($tag){


        $pphphtml_config = simplexml_load_file("config/pphphtml-config.xml");
        $ctrl_path = $_SERVER["DOCUMENT_ROOT"] . "/" .$pphphtml_config->$tag['ctrl'];
        if (!file_exists($ctrl_path)) {
            return new Error("Controller not found");
        }

        include_once ($ctrl_path);
        switch ($tag){
            case "index": return new index_ctrl(); break;
            case "head": return new head_ctrl(); break;
            case "body": return new body_ctrl(); break;
        }
        return new ctrl();

    }
}