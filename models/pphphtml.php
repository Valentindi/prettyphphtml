<?php
class pphphtml {
    private $raw_pphphtml;
    function __construct($pphphtml){
        $this -> raw_pphphtml = $pphphtml;
    }

    public function get_tags(){
        $temp_tags = explode("}}", $this -> raw_pphphtml);
        $tags = null;
        for ($i = 0; $i < sizeof($temp_tags) -1; $i++){
            $tags[$i] = preg_replace('/\s+/', '', trim(str_replace("{{", '', $temp_tags[$i])));
        }

        return $tags;

    }

    public function has_tags(){
        $count_opening_brackets = substr_count($this -> raw_pphphtml, "{{");
        $count_closing_brackets = substr_count($this -> raw_pphphtml, "}}");

        if($count_closing_brackets != $count_opening_brackets){
            return new Error("Opening and Closing Brackets don't match");
        }

        if($count_opening_brackets <= 0){
            return false;
        }

        return true;
    }

    public function replace_tag($tag, $replacement){
        $this -> raw_pphphtml = str_replace("{{".$tag."}}", $replacement, $this ->raw_pphphtml);
    }

    public function get_html(){
        return $this -> raw_pphphtml;
    }
}