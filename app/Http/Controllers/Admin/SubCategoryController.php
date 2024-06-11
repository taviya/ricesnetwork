<?php

namespace App\Http\Controllers\Admin;

use App\Models\SubCategory;
use App\Models\Category;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Str;

class SubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = SubCategory::get();
            return DataTables::of($data)
                ->addIndexColumn()
                
                ->editColumn('category_id', function ($row) {
                    return $row->getCategory->title;
                })
                ->editColumn('image', function ($row) {
                    $baseUrl = config('app.url'); // Retrieve the base URL from the configuration
                    $imagePath = $baseUrl . $row->image; // Combine base URL with the image path from the database
                    return '<img src="' . $imagePath . '" height="100" width="100" />';
                })
                ->addColumn('action', function ($row) {
                    $btn = '<i class="fas fa-2x fa-eye text-primary show-sub_category" data-id="' . $row->id . '"></i> <i class="fas fa-2x fa-trash text-danger delete-sub_category" data-id="' . $row->id . '"></i>';
                    return $btn;
                })
                ->rawColumns(['action','image'])
                ->make(true);
        } else {
            $categories = Category::get();
            return view('admin.sub_category.index', compact('categories'));
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
            'category_id' => 'required',
            'image' => 'required|nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $input = $request->all();
        if ($request->hasfile('image')) {
            $file = $request->file('image');
            $extenstion = $file->getClientOriginalExtension();
            $filename = Str::random(10) . '.' . $extenstion;
            $file->move('public/category/', $filename);
        }
        SubCategory::create([
            'title' => $input['title'],
            'category_id' => $input['category_id'],
            'image' => '/public/category/' . $filename
        ]);
        return response()->json(array('status' => TRUE, 'message' => 'Sub Category add successfully'));
    }

    /**
     * Display the specified resource.
     */
    public function show(SubCategory $subCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SubCategory $subCategory)
    {
        $categories = Category::get();
        $html = view('admin.sub_category.edit', compact('subCategory', 'categories'))->render();
        return response()->json(array('status' => TRUE, 'data' => $html));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SubCategory $subCategory)
    {
        $this->validate($request, [
            'title' => 'required',
            'category_id' => 'required',
        ]);

        $input = $request->all();

        if ($request->hasfile('image')) {
            $file = $request->file('image');
            $extenstion = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extenstion;
            $file->move('public/category/', $filename);
            $input['image'] = '/public/category/' . $filename;
        }

        unset($input['_method']);
        unset($input['update_id']);
        $subCategory->update($input);
        return response()->json(array('status' => TRUE, 'message' => 'Sub Category update successfully'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SubCategory $subCategory)
    {
        $subCategory->delete();
        return response()->json(array('status' => TRUE, 'message' => 'Sub Category delete successfully.'));
    }

    public function getSubcategories(Request $request)
    {
        $categoryId = $request->category_id;
        $subcategories = Subcategory::where('category_id', $categoryId)->get();
        return response()->json(['status' => TRUE, 'data' => $subcategories]);
    }
}
