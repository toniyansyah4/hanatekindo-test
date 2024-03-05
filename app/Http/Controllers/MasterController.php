<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class MasterController extends Controller
{
    public function dashboard()
    {
        $list = User::count();
        $active = User::where('user_status', 1)->count();
        return view('dashboard', compact('list', 'active'));
    }

    public function datatables()
    {
        $data = User::latest()
        ->get();

        if ($data->isEmpty()) {
            return DataTables::of($data)->toJson();
        }

        return DataTables::of($data)
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
    }

    public function index()
    {
        return view('master.index');
    }

    public function store(UserRequest $request)
    {
        try {
            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'email_verified_at' => Carbon::now()
            ]);
            return redirect()->route('master.index')->with('success', 'User created successfully');
        } catch (\Exception $e) {
            return redirect()->route('master.index')->with('error', 'User failed to create');
        }
    }

    public function create()
    {
        return view('master.create');
    }

    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('master.show', compact('user'));
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('master.edit', compact('user'));
    }

    public function update(ProfileUpdateRequest $request, $id)
    {
        $user = User::findOrFail($id);
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);
        return redirect()->route('master.index')->with('success', 'User updated successfully');
    }

    public function destroy($id)
    {
        try {
            User::find($id)->delete();
            return redirect()->route('master.index')->with('success', 'User deleted successfully');
        } catch (\Exception $e) {
            return redirect()->route('master.index')->with('error', 'User failed to delete');
        }
    }
}
