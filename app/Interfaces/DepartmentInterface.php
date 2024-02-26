<?php

namespace App\Interfaces;

interface DepartmentInterface{

    public function list($request);

    public function all();

    public function findById($id);

    public function create($data);

    public function update($data, $id);

    public function delete($id);

}
