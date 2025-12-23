<?php

namespace App\Http\Controllers\BackOffice;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use carbon\Carbon;
use Illuminate\Support\Str; // Make sure to include this at the top of your file

class CategoryController extends Controller
{
    public function AllCategory(){

        $categories=Category::latest()->get();

        return view('backoffice.category.all_category', compact('categories'));
    } //endmethod


    public function AddCategory(Request $request){

        $categories=Category::latest()->get();

        return view('backoffice.category.add_category', compact('categories'));
    } //endmethod


    public function StoreCategory(Request $request)
    {
        $data = $request->validate([
            'category_name' => 'required|string|max:200|unique:categories',
            'meta_title' => 'required|string',
            'category_description' => 'nullable|string',
            'category_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Handle category image upload
        if ($request->hasFile('category_image')) {
            $category_image = $request->file('category_image');
            $name_gen = hexdec(uniqid()) . '.' . $category_image->getClientOriginalExtension();
            
            // Create the upload directory if it doesn't exist
            $upload_path = public_path('upload/categories');
            if (!file_exists($upload_path)) {
                mkdir($upload_path, 0777, true);
            }

            // Move the uploaded file directly
            $category_image->move(public_path('upload/categories'), $name_gen);
            $save_url = 'upload/categories/' . $name_gen;
        }

        // Create a new Category instance with validated data
        $category = new Category([
            'category_name' => $data['category_name'],
            'meta_title' => $data['meta_title'],
            'category_description' => $data['category_description'],
            'slug' => Str::slug($data['category_name']),
            'category_image' => $save_url ?? null,
        ]);

        // Save the category
        $category->save();

        // Redirect with success message
        $notification = [
            'message' => 'Category added successfully',
            'alert-type' => 'success',
        ];

        return redirect()->route('all.category')->with($notification);
    }


    public function EditCategory($id){
        $category=Category::findOrfail($id);

        return view('backoffice.category.edit_category', compact('category'));

    } //EndMethod

    public function UpdateCategory(Request $request) {
        $category_id = $request->id;

        $data = $request->validate([
            'category_name' => 'required|string|max:200',
            'meta_title' => 'required|string',
            'category_description' => 'nullable|string',
            'category_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $category = Category::findOrFail($category_id);

        if ($request->hasFile('category_image')) {
            // Delete old image if exists
            if ($category->category_image && file_exists(public_path($category->category_image))) {
                unlink(public_path($category->category_image));
            }

            $category_image = $request->file('category_image');
            $name_gen = hexdec(uniqid()) . '.' . $category_image->getClientOriginalExtension();
            
            // Create directory if it doesn't exist
            $upload_path = public_path('upload/categories');
            if (!file_exists($upload_path)) {
                mkdir($upload_path, 0777, true);
            }

            // Move the uploaded file
            $category_image->move($upload_path, $name_gen);
            $save_url = 'upload/categories/' . $name_gen;

            $category->update([
                'category_name' => $data['category_name'],
                'meta_title' => $data['meta_title'],
                'category_description' => $data['category_description'],
                'category_image' => $save_url,
                'slug' => Str::slug($data['category_name'])
            ]);
        } else {
            $category->update([
                'category_name' => $data['category_name'],
                'meta_title' => $data['meta_title'],
                'category_description' => $data['category_description'],
                'slug' => Str::slug($data['category_name'])
            ]);
        }

        $notification = [
            'message' => 'Category Updated Successfully',
            'alert-type' => 'success'
        ];

        return redirect()->route('all.category')->with($notification);
    }

    public function DeleteCategory($id){

        Category::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Category Deleted Successfully',
            'alert-type' => 'warning'
        );

        return redirect()->back()->with($notification);


    }  //EndMethod

    public function __invoke(Request $request){
        return Category::all();

    }//endmethod


    public function index()
    {
        // Fetch only the necessary fields from the categories table
        $categories = Category::select('id', 'category_name')->get();

        return response()->json($categories);
    }//endmethod
}
