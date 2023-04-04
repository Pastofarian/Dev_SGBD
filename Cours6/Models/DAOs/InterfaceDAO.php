<?php

interface InterfaceDAO
{
    public function connect ();
    public function fetch ($id);
    public function fetch_all ();
    public function destroy ($id);
    public function store ($obj);
    public function where ($attr, $value);
    public function first ($attr, $value);
    public function insertStore ($statement, $data, $obj);
    public function insertUpdate ($statement, $data, $obj);

}