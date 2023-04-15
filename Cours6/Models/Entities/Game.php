<?php

class Game extends BaseEntity {
    protected $id;
    protected $name;
    protected $type_id; //$type_id permet à l'objet Game d'être créé sans créer immédiatement un objet Type
    protected $type;
    protected static $dao = "GameDAO";
    
    public function __construct ($id, $name, $type_id) {
        $this->id = $id;
        $this->name = $name;
        $this->type_id = $type_id;
        $this->type = null;
        //$type est remplacé dans les paramètres du constructeur et est initialisé à null comme ça on est sûr que l'objet Type n'est pas appelé à chaque fois qu'on crée une nouvelle instance de Game
    }
    
    public function __toString() {
        $type = $this->getType(); // Va chercher l'objet Type juste quand on en a besoin
        return "{$this->id} : {$this->name} ({$type})";
    }

    public function getType() {
        if ($this->type === null) {
            $this->type = Type::find($this->type_id);
        }
        return $this->type;
    }

    public function consoles () {
        return $this->belongsToMany(Console::class, "consoles", "console_game", "game_id", "console_id");
    }
    
    public function type () {
        return $this->belongsTo(Type::class, "type");
    }

}

//https://docs.php.earth/php/ref/oop/design-patterns/lazy-loading/