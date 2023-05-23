<?php

class Type extends Entity {
    public $id;
    public $name;

    protected static $dao = TypeDAO::class;

}
