<?php

namespace App\Contracts;

use Illuminate\Database\Eloquent\Collection;

interface BaseRepositoryInterface
{
    public function getAll();
    public function getById($id);
    public function delete($id);
    public function create($request);
    public function update($request, $id);
    public function filter($query, $column, $request);
    public function getByAttr($attr, $value);
}