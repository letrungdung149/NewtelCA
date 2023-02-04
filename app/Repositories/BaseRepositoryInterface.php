<?php

namespace App\Repositories;

use Exception;
use Illuminate\Database\Eloquent\Model;

/**
 * Interface BaseRepositoryInterface
 *
 * @package App\Repositories
 */
interface BaseRepositoryInterface
{

    public function getAll();
    public function find($id);
    public function create(array $attributes);
    public function update(Model $model, array $attributes = []);
    public function delete($id);
}
