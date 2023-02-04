<?php

namespace App\Repositories\todo;

use App\Models\TodoList;
use App\Repositories\BaseRepository;

class TodoRepository extends BaseRepository implements TodoRepositoryInterface
{

    public function __construct(TodoList $todoList)
    {
        parent::__construct($todoList);
    }

}
