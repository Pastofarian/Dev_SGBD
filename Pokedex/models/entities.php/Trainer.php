<?php

class Trainer extends Entity {
    public $id;
    public $name;

    protected static $dao = TrainerDAO::class;

}
