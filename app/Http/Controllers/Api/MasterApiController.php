<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileUpdateRequest;
use App\Http\Requests\UserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class MasterApiController extends Controller
{
    public function dashboard()
    {
        $list = User::count();
        $active = User::where('user_status', 1)->count();
        return response()->json([
            'total' => $list,
            'active' => $active,
            'inactive' => $list - $active
        ]);
    }

    public function datatables()
    {
        $data = User::latest()
        ->get();

        if ($data->isEmpty()) {
            return DataTables::of($data)->toJson();
        }

        $datatables = DataTables::of($data)
        ->editColumn('user_status',function ($item) {
            if ($item->user_status == 1) {
                return '<span class="bg-green-500 text-white px-2 py-1 rounded-full">Active</span>';
            } else {
                return '<span class="bg-red-500 text-white px-2 py-1 rounded-full">Inactive</span>';
            }
        })
        ->addColumn('no', function ($item) {
            $no = 1;
            return $no++;
        })
        ->addColumn('action', function ($item) {
            return "<div class='space-x-1'>
            <a href=". route('master.edit', ['id' => $item->id]) ." class='inline-block bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-2 rounded'>Edit</a> 
            | <a href=". route('master.destroy', ['id' => $item->id]) ." class='inline-block bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded'>Delete</a></div>";
        })
        ->rawColumns(['user_status', 'action'])
        ->toJson();
        return $datatables;
    }

    public function index(Request $request)
    {
        $perPage = $request->per_page;
        $users = User::latest()->paginate($perPage);
        return UserResource::collection($users);
    }

    public function store(UserRequest $request)
    {
        try {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'email_verified_at' => Carbon::now()
            ]);
            return response()->json([
                'status' => 'success',
                'message' => 'User created successfully',
                'data' => $user
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'User failed to create',
                'data' => []
            ], 500);
        }
    }

    public function show($id)
    {
        $user = User::findOrFail($id);
        return response()->json($user);
    }

    public function update(ProfileUpdateRequest $request, $id)
    {
        $user = User::findOrFail($id);
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);
        return response()->json([
            'status' => 'success',
            'message' => 'User updated successfully',
            'data' => $user
        ], 200);
    }

    public function destroy($id)
    {
        try {
            $user = User::findOrFail($id);
            $user->delete();
            return response()->json([
                'status' => 'success',
                'message' => 'User deleted successfully',
                'data' => []
            ], 204); 
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error', // 'status' => 'failed
                'message' => 'User failed to delete',
                'data' => []
            ], 500);
        }
    }
}
