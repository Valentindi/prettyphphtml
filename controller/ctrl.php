<?php

include_once("models/pphphtml.php");
include_once("config/ctrl_classes.php");

class controller
{
    public function __construct($parent)
    {
        $this -> parent_ctrl = $parent;
        $this -> child_ctrl = array();
    }

    /**
     * @param $tag
     * @return HTML of this element
     */
    function get_html($tag)
    {
        echo $this->render_html_from_tag($tag);
    }

    /**
     * @param $tag
     * @return renders html from special tag.
     */

    private function render_html_from_tag($tag)
    {

        $pphphtml_config = simplexml_load_file("config/pphphtml-config.xml");
        $view_path = $pphphtml_config->$tag['view'];

        if (file_exists($_SERVER["DOCUMENT_ROOT"] . "/" . $view_path)) {
            $view_file = fopen($_SERVER["DOCUMENT_ROOT"] . "/" . $view_path, "r") or die("Unable to open file!");
            $view_html = fread($view_file, filesize($_SERVER["DOCUMENT_ROOT"] . "/" . $view_path));
            fclose($view_file);

            $view_pphphtml = new pphphtml($view_html);
            if ($view_pphphtml->has_tags()) {
                $tags = $view_pphphtml->get_tags();
                for ($i = sizeof($tags) - 1; $i >= 0; $i--) {
                    $view_pphphtml->replace_tag($tags[$i], $this -> get_child_html($tags[$i]));
                }
            }


            return $view_pphphtml->get_html();
        } else {
            echo new Error( $_SERVER["DOCUMENT_ROOT"] . "/" . $view_path . " DO NOT EXISTS");
        }
    }

    /**
     * @param $tag
     * @return generated HTML of childs;
     */

    private function get_child_html($tag)
    {

        $pphphtml_config = simplexml_load_file("config/pphphtml-config.xml");
        $ctrl_path = $pphphtml_config->$tag['ctrl'];
        if (file_exists($ctrl_path)) {
            require_once($ctrl_path);
            $class = $pphphtml_config->$tag['class'];
            $child_ctrl = ctrl_classes::get_controller($tag, $this);
            array_push($this -> child_ctrl, $child_ctrl);
            return $child_ctrl->render_html_from_tag($tag);
        }


    }

    /**
     * @return array[ctrl] children_ctrls;
     */
    public function getChildCtrl(): array
    {
        return $this->child_ctrl;
    }

    /**
     * @return ctrl parent_ctrls();
     */
    public function getParentCtrl()
    {
        return $this->parent_ctrl;
    }


}