<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = User::where('role', 0)->get();
            return DataTables::of($data)
                ->addIndexColumn(null, 1)
                ->addColumn('status', function ($row) {
                    return $row->status == 1 ? '<span class="badge badge-success">Active</span>' : '<span class="badge badge-danger">Inactive</span>';
                })
                ->addColumn('action', function ($row) {
                    $btn = '<i class="fas fa-2x fa-eye text-primary show-user" data-id="'.$row->id.'"></i> <i class="fas fa-2x fa-trash text-danger delete-user" data-id="'.$row->id.'"></i>';
                    return $btn;
                })
                ->rawColumns(['action', 'status'])
                ->make(true);
        } else {
            return view('admin.user.index');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
        ]);
        
        $input = $request->all();

        User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
        ]);

        return response()->json(array('status' => TRUE, 'message' => 'User added successfully'));
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {   
        $html = view('admin.user.edit', compact('user'))->render();
        return response()->json(array('status' => TRUE, 'data' => $html));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $user->id,
        ]);
        
        $input = $request->all();

        unset($input['_method']);
        unset($input['update_id']);
        $user->update($input);
        return response()->json(array('status' => TRUE, 'message' => 'User update successfully'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();
        return response()->json(array('status' => TRUE, 'message' => 'Delete successfully.'));
    }
}
