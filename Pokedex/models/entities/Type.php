<?php

class Type extends Entity {

    public $id;
    public $name;
    protected static $dao = 'TypeDAO';

    public function __construct($id, $name) {
        $this->id = $id;
        $this->name = $name;
    }

    public static function create($data) {
        return new self(
            $data["id"] ?? null,
            $data["name"] ?? null
        );
    }
}
