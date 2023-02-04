<?php

namespace App\Http\Controllers\Api;

use App\Models\TodoList;
use App\Models\User;
use App\Repositories\todo\TodoRepositoryInterface;
use Illuminate\Http\Request;

class TodoListController
{
    protected $todoRepository;

    public function __construct(TodoRepositoryInterface $todoRepository)
    {
        $this->todoRepository = $todoRepository;
    }

    public function index(Request $request)
    {
        return TodoList::all();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
        ]);
        $this->todoRepository->create($request->only([
            'name',
            'description',
        ]));

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id,Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
        ]);
        $todo = $this->todoRepository->find($id);
        $todo->update([
            'name' => $request->name,
            'description' => $request->description,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $todo = $this->todoRepository->find($id);
        $todo->delete();
        return response()->json([
            'code' => 200,
            'message' => 'Xóa thành công'
        ], 200);
    }

    public function markTodoCompleted($id, Request $request){
        $todoList = TodoList::findOrFail($id);
        if ($todoList->user_id === $request->user()->id){
            $todoList->checkTodo();
            if ($todoList->status === true){
                return \response()->json([
                    'notification' => 'check todo success'
                ]);
            }else{
                return \response()->json([
                    'notification' => 'success'
                ]);
            }
        }
    }

    public function filter(){
        $todoList = TodoList::latest()->search()->paginate();
        return response()->json([
            'code' => 200,
            'todoList' => $todoList,
            'message' => 'success'
        ]);
    }

    public function change(){
        $todoList = TodoList::latest()->change()->paginate();
        return response()->json([
            'code' => 200,
            'todoList' => $todoList,
            'message' => 'success'
        ]);
    }
}
