<?php

class Ability extends Entity {
    public $id;
    public $name;

    protected static $dao = AbilityDAO::class;

}
