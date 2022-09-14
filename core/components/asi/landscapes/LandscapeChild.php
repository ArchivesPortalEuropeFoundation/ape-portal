<?php
namespace asi\landscapes;

class LandscapeChild {

    protected $id;
    protected $value;
    protected $children;

    public function __construct($id, $value) {
        $this->id = $id;
        $this->value = $value;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getId() {
        return $this->id;
    }

    public function setValue($val) {
        $this->value = $val;
    }

    public function getValue() {
        return $this->value;
    }

    public function setChildren($children) {
        $this->children=$children;
    }

    public function getChildren() {
        return $this->children;
    }

    public function addChild($child) {
        $this->children[]=$child;
    }

    public function hasChildren() {
        if(is_array($this->children) && count($this->children) > 0) return true;
        return false;
    }

}