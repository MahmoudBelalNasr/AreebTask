<?php

namespace App\Interfaces;

interface UserInterface{

    public function list($request);

    public function findById($id);

    public function create($data);

    public function update($data, $id);

    public function delete($id);

}
