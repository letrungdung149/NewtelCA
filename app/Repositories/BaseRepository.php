<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

class BaseRepository implements BaseRepositoryInterface
{
    protected $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }
    public function getAll()
    {
        return $this->model->all();
    }
    public function find($id)
    {
        return $this->model->find($id);
    }
    public function create($attributes = [])
    {
        return $this->model->create($attributes);
    }
    public function update($id, $attributes = [])
    {
        $object = $this->find($id);
        if ($object) {
            $object->update($attributes);
            return $object;
        }
        return false;
    }
    public function delete($id)
    {
        return $this->model->delete($id);
    }
}
