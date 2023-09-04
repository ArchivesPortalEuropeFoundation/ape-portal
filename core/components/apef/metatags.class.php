<?php
class MetaTags {

    // Properties
    public $title;
    public $description;

    // Methods
    function set_title($title) {
        $this->title = $title;
    }
    function get_title() {
        return $this->title;
    }

    function set_description($description) {
        $this->description = $description;
    }
    function get_description() {
        return $this->description;
    }
}