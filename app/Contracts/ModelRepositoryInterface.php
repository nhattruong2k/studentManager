<?php

namespace App\Contracts;

interface ModelRepositoryInterface
{
    public function getAll();
    public function paginate($request);
    public function getById($id);
    public function delete($request);
    public function create($request);
    public function update($request, $id);
    public function filter($query, $column, $request);
    public function getByAttr($attr, $value);
}