<?php
class TypeDAO extends DAO {
    public function __construct () {
        parent::__construct("types");
    }
    protected function create($result) {
        $type = new Type();
        $type->id = $result['id'];
        $type->name = $result['name'];

        return $type;
    }    

}
