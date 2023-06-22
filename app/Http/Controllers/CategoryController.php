<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Pagination\Paginator;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $query = Category::query();

        if ($search) {
            $query->where('name', 'LIKE', "%$search%");
        }

        $categories = $query->latest()->paginate(10);
        Paginator::useBootstrap();

        return view('category.index', compact('categories', 'search'))
            ->with('i', ($categories->currentPage() - 1) * 5);
    }

    public function create()
    {
        return view('category.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'status' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);






        // if ($image = $request->file('image')) {
        //     $destinationPath = 'images/';
        //     $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
        //     $image->move($destinationPath, $profileImage);
        //     $input['image'] = "$profileImage";
        // }
        $imagename = date('d-m-y') . "-" . $request->image->getClientOriginalName();
        $PriorPath = ('images');
        if (!$PriorPath) {
            File::makeDirectory('images');
        }
        $path = $request->image->move($PriorPath, $imagename);




        DB::table('categories')->insert([
            'name' => $request->name,
            'status' => $request->status,
            'image' => $path,

        ]);

        return redirect()->route('category.index')
            ->with('success', 'Category created successfully.');
    }


    public function getCategory(Request $request)
    {
        // Read value
        $draw = $request->input('draw');
        $start = $request->input('start');
        $length = $request->input('length');

        $searchValue = $request->input('search.value');

        // Total records
        $totalRecords = Category::count();

        // Apply search filter
        $filteredRecords = Category::where('name', 'like', '%' . $searchValue . '%')
            ->count();

        // Fetch records with pagination and search
        $records = Category::where('name', 'like', '%' . $searchValue . '%')
            ->orderBy('id', 'desc')
            ->skip($start)
            ->take($length)
            ->get();

        $data = [];
        $counter = $start + 1;

        foreach ($records as $record) {
            $status = $record->status == '1' ? '<span class="badge rounded-pill text-success bg-success text-light">Active</span>' : '<span class="badge rounded-pill text-danger bg-danger text-light">Inactive</span>';



            $row = [
                '<h3>' . $counter . '</h3>',
                '<h3>' . $record->name . '</h3>',
                '<h3>' . $status . '</h3>',
                $image = $record->image ? '<img src="' . asset($record->image) . '" alt="Category Image" width="100">' : 'No Image',


                '<a href="' . route('category.edit', $record->id) . '" class="btn"><h3><i class="fa-regular fa-pen-to-square"></i></h3></a>&nbsp;' .
                    '<a href="' . route('category.show', $record->id) . '" class="btn"><h3><i class="fa-solid fa-eye"></i></h3></a>&nbsp;' .
                    '<form action="' . route('category.destroy', $record->id) . '" method="POST" style="display:inline">
                ' . csrf_field() . '
                ' . method_field('DELETE') . '
                <button type="submit" class="btn"><h3><i class="fa-solid fa-trash-can"></i></h3></button>
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

    public function show(Category $category)
    {
        return view('category.show', compact('category'));
    }


    public function edit(Category $category)
    {
        return view('category.edit', compact('category'));
    }


    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()->route('category.index')
            ->with('success', 'Category deleted successfully');
    }

    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required',
            'status' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $previousImage = $category->image;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = date('d-m-y') . "-" . $image->getClientOriginalName();
            $destinationPath = 'images';
            $path = $image->move($destinationPath, $imageName);

            if ($previousImage) {
                // Delete the previous image
                File::delete(public_path($previousImage));
            }

            $category->image = $path;
        } elseif ($request->has('delete_image')) {
            // Delete the image if delete_image checkbox is selected
            if ($previousImage) {
                File::delete(public_path($previousImage));
            }
            $category->image = null;
        }

        $category->name = $request->name;
        $category->status = $request->status;
        $category->save();

        return redirect()->route('category.index')
            ->with('success', 'Category updated successfully.');
    }
}
