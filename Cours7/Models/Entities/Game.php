<?php

class Game extends BaseEntity {
    protected $id;
    protected $name;
    protected $type_id; 
    protected $type;
    protected static $dao = "GameDAO";
    
    public function __construct ($id, $name, $type_id) {
        $this->id = $id;
        $this->name = $name;
        $this->type_id = $type_id;
        $this->type = null;
    }
    
    public function __toString() {
        $type = $this->getType(); 
        return "{$this->id} : {$this->name} ({$type})";
    }

    public function getType() {
        if ($this->type === null) {
            $this->type = Type::find($this->type_id);
        }
        return $this->type;
    }

}

//https://docs.php.earth/php/ref/oop/design-patterns/lazy-loading/