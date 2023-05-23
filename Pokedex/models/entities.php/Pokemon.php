<?php

class Pokemon extends Entity {
    public $id;
    public $name;
    public $type_id;
    public $ability_id;
    public $trainer_id;

    protected static $dao = PokemonDAO::class;
    
}
