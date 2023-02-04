<?php

namespace App\Http\Controllers\Api;

use App\Models\Role;
use App\Models\User;
use App\Repositories\user\UserRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Repositories\User\UserRepository;

class UserController
{
    private $user;
    private $role;
    protected $userRepository;

    public function __construct(User $user, Role $role,UserRepositoryInterface $userRepository)
    {
        $this->user = $user;
        $this->role = $role;
        $this->userRepository = $userRepository;
    }

    public function index(Request $request)
    {
        $roles = $this->role->all();
        $users = $this->user->latest()->search()->paginate();
        return response()->json([
            'code' => 200,
            'role' => $roles,
            'user' => $users,
            'message' => 'success'
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
        ]);
        $this->userRepository->create($request->only([
            'name',
            'email'
        ]));
    }

    public function update(Request $request, $id)
    {
            $request->validate([
                'name' => 'required',
                'email' => 'required',
            ]);
            $user = $this->userRepository->find($id);
            $user->update([
                'name' => $request->name,
                'email' => $request->email,
            ]);

    }

    public function destroy($id)
    {
        $user = $this->userRepository->find($id);

        $user->delete();
        return \response()->json([
            'code' => 200,
            'message' => 'success'
        ]);
    }


    function search($name)
    {
        $result = User::where('name', 'LIKE', '%' . $name . '%')->get();
        if (count($result)) {
            return Response()->json([
                'code' => '200',
                'data' => $result,
                'message' => 'success'
            ]);
        } else {
            return response()->json(['Result' => 'No Data not found'], 404);
        }
    }

}
