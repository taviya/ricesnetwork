<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use App\Models\Nft;
use Illuminate\Http\Request;
use DataTables;

class NftController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Nft::get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<i class="fas fa-2x fa-eye text-primary show-nft" data-id="' . $row->id . '"></i> <i class="fas fa-2x fa-trash text-danger delete-nft" data-id="' . $row->id . '"></i>';
                    return $btn;
                })
                ->editColumn('category_id', function ($row) {
                    return $row->getCategory->title;
                })
                ->rawColumns(['action'])
                ->make(true);
        } else {
            $categories = Category::get();
            return view('admin.nft.index', compact('categories'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'category_id' => 'required|integer',
            'name' => 'required|string',
            // 'image' => 'required|string',
            'price' => 'required|numeric',
        ]);

        $input = $request->all();
        Nft::create($input);

        return response()->json(['status' => true, 'message' => 'NFT created successfully']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Nft  $nft
     * @return \Illuminate\Http\Response
     */
    public function show(Nft $nft)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Nft  $nft
     * @return \Illuminate\Http\Response
     */
    public function edit(Nft $nft)
    {
        $categories = Category::get();
        $html = view('admin.nft.edit', compact('nft', 'categories'))->render();
        return response()->json(array('status' => TRUE, 'data' => $html));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Nft  $nft
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Nft $nft)
    {
        $this->validate($request, [
            'category_id' => 'required|integer',
            'name' => 'required|string',
            // 'image' => 'required|string',
            'price' => 'required|numeric',
        ]);

        $input = $request->all();

        unset($input['_method']);
        unset($input['update_id']);
        $nft->update($input);
        return response()->json(array('status' => TRUE, 'message' => 'Nft update successfully'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Nft  $nft
     * @return \Illuminate\Http\Response
     */
    public function destroy(Nft $nft)
    {
        $nft->delete();
        return response()->json(array('status' => TRUE, 'message' => 'Delete successfully.'));
    }
}
