<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::latest()->paginate(5);

        return view('products.index', compact('products'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View`
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'brand' => 'required',
            'code' => 'required',
            'thumbnail' => 'required',
            'price' => 'required',
            'description' => 'required',
            'quantity' => 'required',
            'status' => 'required',
            'cat_id' => 'required',
        ]);

        Product::create($request->all());

        return redirect()->route('products.index')
            ->with('success', 'Product created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     *  @param  \App\Models\Product  $product
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required',
            'detail' => 'required',
        ]);

        $product->update($request->all());

        return redirect()->route('products.index')
            ->with('success', 'Product updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('products.index')
            ->with('success', 'Product deleted successfully.');
    }

    public function getProduct(Request $request)
    {
        // Read value
        $draw = $request->input('draw');
        $start = $request->input('start');
        $length = $request->input('length');

        $searchValue = $request->input('search.value');

        // Total records
        $totalRecords = Product::count();

        // Apply search filter
        $filteredRecords = Product::where('name', 'like', '%' . $searchValue . '%')
            ->count();

        // Fetch records with pagination and search
        $records = Product::where('name', 'like', '%' . $searchValue . '%')
            ->orderBy('id', 'desc')
            ->skip($start)
            ->take($length)
            ->get();

        $data = [];
        $counter = $start + 1;

        foreach ($records as $record) {
            $status = $record->status == "1" ? '<span class="badge rounded-pill text-success bg-success text-light">Active</span>' : '<span class="badge rounded-pill text-danger bg-danger text-light">Inactive</span>';
            $category = Category::find($record->category_id);
            $categoryname = $category ? $category->name :'n/A';

            $image = $record->image ? '<img src="' . asset('Product_thumbnails/' . $record->image) . '" alt="Product Image" width="100">' : 'No Image';

            $row = [
                $counter,
                $record->name,
                $record->brand,
                $record->code,
                $image,
                '$' . $record->price,
                $record->description,
                $record->stock_quantity,
                $status,
                $categoryname,
                '<a href="' . route('product.edit', $record->id) . '" class="btn"><i class="fa-regular fa-pen-to-square"></i></a>&nbsp;' .
                '<a href="' . route('product.show', $record->id) . '" class="btn"><i class="fa-solid fa-eye"></i></a>&nbsp;' .
                '<form action="' . route('product.destroy', $record->id) . '" method="POST" style="display:inline">
                    ' . csrf_field() . '
                    ' . method_field('DELETE') . '
                    <button type="submit" class="btn"><i class="fa-solid fa-trash-can"></i></button>
                </form>'
            ];

            $data[] = $row;
            $counter++;
        }

        $response = [
            'draw' => intval($draw),
            'recordsTotal' => $totalRecords,
            'recordsFiltered' => $filteredRecords,
            'data' => $data,
        ];

        return response()->json($response);
    }



}
