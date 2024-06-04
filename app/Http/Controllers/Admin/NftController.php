<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use App\Models\Subcategory;
use App\Models\Nft;
use Illuminate\Http\Request;
use DataTables;
use Pinata\Pinata;

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
                ->editColumn('image', function ($row) {
                    return '<img src="https://alchemy.mypinata.cloud/ipfs/' . $row->image . '" height="100" width="100" />';
                })
                ->editColumn('category_id', function ($row) {
                    return $row->getCategory->title;
                })
                ->editColumn('sub_category_id', function ($row) {
                    return $row->getSubCategory->title;
                })
                ->rawColumns(['action', 'image'])
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
            'sub_category_id' => 'required|integer',
            'name' => 'required|string',
            // 'image' => 'required|string',
            'image' => 'required|nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $input = $request->all();

        if ($request->hasfile('image')) {
            $file = $request->file('image');
            $extenstion = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extenstion;
            $file->move('public/nft/', $filename);

            $image_hash = $this->apiPinata('public/nft/' . $filename);
            $input['image'] = $image_hash['IpfsHash'];
            
            $array = array(
                'name' => $input['name'],
                'image' => 'ipfs://' . $input['image'],
                'description' => 'Rices Network is a main website aimed at creating a Layer 2 agricultural system focused on decentralizing the power farming (Defa) within the ecosystem. Therefore, to connect consumers, producers, and investors together, a blockchain-based decentralized  system was created to strengthen food security, flexibility, and transparency in the future.',
                'date' => time()
            );

            $data = json_encode($array, JSON_UNESCAPED_SLASHES);
            $file_name = 'public/json/' . $input['image'] . '.json';
            $myfile = fopen($file_name, "w") or die("Unable to open file!");
            $read = fwrite($myfile, $data);
            fclose($myfile);

            $image_hash = $this->apiPinata($file_name);
            $input['json'] = $image_hash['IpfsHash'];
        
        }
        Nft::create($input);
        return response()->json(['status' => true, 'message' => 'NFT created successfully']);
    }

    public function apiPinata($filepath)
    {
        $private_key = 'ad02cb8fb0cbc01a04bb6d5e43a449cb33ecffcc133bf56484ff8fe6a37ca104';
        $public_key = 'ec5c8501a2a98e08e508';
        $pinata = new Pinata($public_key, $private_key);
        $hash = $pinata->pinFileToIPFS($filepath);
        return $hash;
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
        $subcategories = Subcategory::where('category_id', $nft->category_id)->get();
        $html = view('admin.nft.edit', compact('nft', 'categories', 'subcategories'))->render();
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
            'img' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $input = $request->all();

        if ($request->hasfile('image')) {
            $file = $request->file('image');
            $extenstion = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extenstion;
            $file->move('public/nft/', $filename);

            $image_hash = $this->apiPinata('public/nft/' . $filename);
            $input['image'] = $image_hash['IpfsHash'];
            
            $array = array(
                'name' => $input['name'],
                'image' => 'ipfs://' . $input['image'],
                'description' => 'Rices Network is a main website aimed at creating a Layer 2 agricultural system focused on decentralizing the power farming (Defa) within the ecosystem. Therefore, to connect consumers, producers, and investors together, a blockchain-based decentralized  system was created to strengthen food security, flexibility, and transparency in the future.',
                'date' => time()
            );

            $data = json_encode($array, JSON_UNESCAPED_SLASHES);
            $file_name = 'public/json/' . $input['image'] . '.json';
            $myfile = fopen($file_name, "w") or die("Unable to open file!");
            $read = fwrite($myfile, $data);
            fclose($myfile);

            $image_hash = $this->apiPinata($file_name);
            $input['json'] = $image_hash['IpfsHash'];
        
        }

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

    /**
     * NFT get API.
     */
    // public function getNft(Request $request)
    // {
    //     $perPage = $request->has('per_page') ? (int) $request->per_page : 10;
    //     $currentPage = $request->has('page') ? (int) $request->page : 1;
    //     $sortBy = $request->has('sort_by') ? $request->sort_by : 'id';
    //     $sortOrder = $request->has('sort_order') ? $request->sort_order : 'asc';
    //     $categoryId = $request->has('category_id') ? (int) $request->category_id : null;

    //     $query = Nft::with('getCategory');

    //     if ($categoryId) {
    //         $query->where('category_id', $categoryId);
    //     }

    //     $sortFunction = function ($a, $b) use ($sortBy, $sortOrder) {
    //         if ($sortOrder === 'asc') {
    //             return $a->$sortBy < $b->$sortBy ? -1 : 1;
    //         } else {
    //             return $a->$sortBy > $b->$sortBy ? -1 : 1;
    //         }
    //     };

    //     if ($sortBy === 'random') {
    //         $NFTs = $query->get()->shuffle();
    //     } else {
    //         $NFTs = $query->orderBy($sortBy, $sortOrder)->paginate($perPage, ['*'], 'page', $currentPage);
    //     }

    //     return response()->json([
    //         'status' => true,
    //         'data' => $NFTs->toArray(),
    //         'pagination' => [
    //             'total' => $NFTs->total(),
    //             'per_page' => $perPage,
    //             'current_page' => $currentPage,
    //             'last_page' => $NFTs->lastPage(),
    //         ],
    //     ]);
    // }

    public function getNft(Request $request)
    {
        $categoryId = $request->input('category_id');
        $sortBy = $request->input('sort_by', 'asc');
        $perPage = $request->input('per_page', 10);

        $query = Nft::query()->with('getCategory');

        if ($categoryId) {
            $query->where('category_id', $categoryId);
        }

        if ($sortBy === 'asc' || $sortBy === 'desc') {
            $query->orderBy('created_at', $sortBy);
        } elseif ($sortBy === 'random') {
            $query->inRandomOrder();
        }

        $nfts = $query->paginate($perPage);
        return response()->json($nfts);
    }

    public function getCategory(Request $request)
    {
        $sortBy = $request->input('sort_by', 'asc');
        $perPage = $request->input('per_page', 10);

        $query = Category::query();

        if ($sortBy === 'asc' || $sortBy === 'desc') {
            $query->orderBy('created_at', $sortBy);
        } elseif ($sortBy === 'random') {
            $query->inRandomOrder();
        }

        $nfts = $query->paginate($perPage);
        return response()->json($nfts);
    }
}
