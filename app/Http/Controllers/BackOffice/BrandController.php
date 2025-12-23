<?php

namespace App\Http\Controllers\BackOffice;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;
use carbon\Carbon;
use Illuminate\Support\Str; // Make sure to include this at the top of your file
use Image;

class BrandController extends Controller
{
    public function AllBrand(){

        $brands=Brand::latest()->get();

        return view('backoffice.brand.all_brand', compact('brands'));
    } //endmethod


    public function AddBrand(Request $request){

        $brands=Brand::latest()->get();

        return view('backoffice.brand.add_brand', compact('brands'));
    } //endmethod


    public function EditBrand($id){
        $brandy=Brand::findOrfail($id);

        return view('backoffice.brand.edit_brand', compact('brand'));

    } //EndMethod

    public function UpdateBrand(Request $request){
        $validateData = $request->validate([
            'brand_name' => 'required|max:200',
            'brand_description' => 'required',
            'brand_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $brand_id = $request->id;
        $brand = Brand::findOrFail($brand_id);

        // Delete old image
        if ($brand->brand_image && file_exists(public_path($brand->brand_image))) {
            unlink(public_path($brand->brand_image));
        }

        // Upload new image
        $image = $request->file('brand_image');
        $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
        Image::make($image)->resize(300, 300)->save('upload/brand/' . $name_gen);
        $save_url = 'upload/brand/' . $name_gen;

        $brand->update([
            'brand_name' => $request->brand_name,
            'brand_description' => $request->brand_description,
            'brand_image' => $save_url,
            'updated_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'brand Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.brand')->with($notification);

    } //EndMethod

    public function DeleteBrand($id){

        Brand::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Brand Deleted Successfully',
            'alert-type' => 'warning'
        );

        return redirect()->back()->with($notification);


    }  //EndMethod

    public function __invoke(Request $request){
        return Brand::all();

    }//endmethod

    public function StoreBrand(Request $request){
        $validateData = $request->validate([
            'brand_name' => 'required|max:200',
            'brand_description' => 'required',
            'brand_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $slug = Str::slug($request->brand_name); // Generate slug from the product name
        $image = $request->file('brand_image');
        $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
        Image::make($image)->resize(300, 300)->save('upload/brand/' . $name_gen);
        $save_url = 'upload/brand/' . $name_gen;

        Brand::insert([
            'brand_name' => $request->brand_name,
            'brand_description' => $request->brand_description,
            'brand_image' => $save_url,
            'created_at' => Carbon::now(),
            'slug' => $slug,
        ]);

        $notification = array(
            'message' => 'Brand Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }
}
