<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Illuminate\Http\Request;
use DataTables;
use Image;
use Illuminate\Support\Facades\Config;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Category::get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<i class="fas fa-2x fa-eye text-primary show-category" data-id="' . $row->id . '"></i> <i class="fas fa-2x fa-trash text-danger delete-category" data-id="' . $row->id . '"></i>';
                    return $btn;
                })
                ->editColumn('image', function ($row) {
                    $baseUrl = config('app.url'); // Retrieve the base URL from the configuration
                    $imagePath = $baseUrl . '/public/category/' . $row->image; // Combine base URL with the image path from the database
                    return '<img src="' . $imagePath . '" height="100" width="100" />';
                })
                ->rawColumns(['action', 'image'])
                ->make(true);
        } else {
            return view('admin.category.index');
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
            'title' => 'required',
            'image' => 'required|nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        
        $filename = '';
        $input = $request->all();
        if ($request->hasfile('image')) {
            $file = $request->file('image');
            $extenstion = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extenstion;
            $file->move('public/category/', $filename);
        }
        Category::create([
            'title' => $input['title'],
            'image' => $filename
        ]);
        return response()->json(array('status' => TRUE, 'message' => 'Category add successfully'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        $html = view('admin.category.edit', compact('category'))->render();
        return response()->json(array('status' => TRUE, 'data' => $html));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $this->validate($request, [
            'title' => 'required',
        ]);

        $input = $request->all();
        if ($request->hasfile('image')) {
            $file = $request->file('image');
            $extenstion = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extenstion;
            $file->move('public/category/', $filename);
            $input['image'] = $filename;
        }
        
        unset($input['_method']);
        unset($input['update_id']);
        $category->update($input);
        return response()->json(array('status' => TRUE, 'message' => 'Category update successfully'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return response()->json(array('status' => TRUE, 'message' => 'Delete successfully.'));
    }
}
