<?php

namespace App\Http\Controllers\BackOffice;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Supplier;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Brand;
use Carbon\Carbon;
use Intervention\Image\Facades\Image;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use App\Exports\ProductExport;
use App\Imports\ProductImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Str; // Make sure to include this at the top of your file


class ProductController extends Controller
{
    public function AllProduct(){
        $products= Product::latest()->get();
        return view('backoffice.product.all_product',compact('products'));
    } //endmethod

    public function AddProduct(){

        $categories = Category::latest()->get();
        $suppliers = Supplier::latest()->get();
        $products = Product::latest()->get();
        $brands = Brand::all();
        return view('backoffice.product.add_product',compact('products', 'categories', 'suppliers', 'brands'));

    }//endmethod


      public function StoreProduct(Request $request){
        //  dd($request->all());
        $validateData = $request->validate([
            'product_name'=>'required |unique:products| max:200',
            'category_id'=>'required | max:200',
            'supplier_id'=>'required | max:200',
            'brand_id'=>'required | max:200',
            'meta_title'=>'required | max:200',
            'buying_price'=>'required |numeric',
            'selling_price'=>'required |numeric',
            // 'buying_date'=>'required | max:200',
            // 'expire_date'=>'required | max:200',
            'product_store'=>'required | max:200',
            'product_description'=>'required',
            'product_features'=>'required',
        ]);


       // dd($validateData);

        $product_image =$request->file('product_image');
        $name_gen= hexdec(uniqid()).'.'.$product_image->getClientOriginalExtension();
        Image::make($product_image)->resize(300, 398)->save(public_path('upload/products/'.$name_gen));
        $save_url='upload/products/'.$name_gen;

       // dd($save_url);
        $pcode = IdGenerator::generate(['table' => 'products', 'field'=> 'product_code', 'length' => 6, 'prefix'=> 'WABE-']);

        // $selling_price = $request->buying_price * 1.40;
$slug = Str::slug($request->product_name); // Generate slug from the product name


Product::insert([
    'product_name'=> $request->product_name,
    'slug'=> $slug,
    'category_id'=> $request->category_id,
    'supplier_id'=> $request->supplier_id,
     'brand_id'=> $request->brand_id,
    'meta_title'=> $request->meta_title,
    'product_code'=> $pcode,
    'buying_price'=> $request->buying_price,
    'selling_price'=>  $request->selling_price,
//            'selling_price'=>  $selling_price,
            // 'buying_date'=> $request->buying_date,
            // 'expire_date'=> $request->expire_date,
    'product_image'=> $save_url,
    'product_store'=>$request->product_store,
    'product_description'=>$request->product_description,
    'product_features'=>$request->product_features,
    'created_at'=>Carbon::now(),
]);

$notification = array(
    'message' => 'Product Added Successfully',
    'alert-type' => 'success'
);

return redirect()->route('all.product')->with($notification);

    }//endmethod
// 

    public function EditProduct($id){
        $product=Product::findOrfail($id);

        $categories = Category::latest()->get();
        $suppliers = Supplier::latest()->get();

        return view('backoffice.product.edit_product', compact('product', 'categories', 'suppliers'));


    }

    public function UpdateProduct(Request $request)
    {
        $product_id = $request->id;
        $product = Product::findOrFail($product_id);

        // Handle main product image
        if ($request->file('product_image')) {
            $image = $request->file('product_image');
            $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(300, 398)->save(public_path('upload/products/' . $name_gen));
            $save_url = 'upload/products/' . $name_gen;
            $product->product_image = $save_url;
        }

        // Update other product fields
        $product->product_name = $request->product_name;
        $product->category_id = $request->category_id;
        $product->supplier_id = $request->supplier_id;
        $product->product_code = $request->product_code;
        $product->buying_price = $request->buying_price;
        $product->selling_price = $request->selling_price;
        $product->meta_title = $request->meta_title;
        $product->product_store = $request->product_store;
        $product->product_description = $request->product_description;
        $product->product_features = $request->product_features;
        $product->created_at = Carbon::now();
        $product->save();

        // Handle additional images
        if ($request->hasFile('additional_images')) {
            foreach ($request->file('additional_images') as $addImage) {
                $add_name_gen = hexdec(uniqid()) . '.' . $addImage->getClientOriginalExtension();
                Image::make($addImage)->resize(300, 398)->save(public_path('upload/product/' . $add_name_gen));
                $add_save_url = $add_name_gen;
                $product->images()->create([
                    'filename' => $add_save_url
                ]);
            }
        }

        $notification = array(
            'message' => 'Product Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.product')->with($notification);
}


public function DeleteProduct($id){
    Product::findOrFail($id)->delete();

    $notification = array(
        'message' => 'Product Deleted Successfully',
        'alert-type' => 'warning'
    );

    return redirect()->back()->with($notification);
}

public function BarCodeProduct($id){

    $product=Product::findOrfail($id);

    return view('backoffice.product.barcode_product', compact('product'));

}


public function ImportProduct(){
      //  $product=Product::findOrfail($id);
    return view('backoffice.product.import_product');

}


public function ExportProduct(){
    return Excel::download(new ProductExport, 'products.xlsx');
}

public function Import(Request $request)
{
    Excel::import(new ProductImport, $request->file('import_file'), null, \Maatwebsite\Excel\Excel::XLSX);


    $notification = array(
        'message' => 'Product File Imported Successfully',
        'alert-type' => 'success'
    );

    return redirect()->back()->with($notification);


}

////////////////////////////////Stock Management ///////////////////////////

public function OutofStock(){
    $outofstock_products = Product::where('product_store', '<=', 0)->get();
    return view('backoffice.product.out_of_stock_product', compact('outofstock_products'));

}//endmethodhotProducts

public function ExpiredProducts(){
    $expired_products = Product::where('expire_date', '<=', \Carbon\Carbon::now()->format('Y-m-d'))->get();
    return view('backoffice.product.expired_products', compact('expired_products'));
}//endmethod

public function GetHotProducts()
{
    $hotProducts = Product::where('sales_count', '>', 0)
    ->orderBy('sales_count', 'desc')
    ->limit(10)
    ->get();

    return view('backoffice.product.hot-products', compact('hotProducts'));
}//endmethod


public function search(Request $request)
{
    $query = $request->input('query');
    
    return Product::where('product_name', 'LIKE', "%{$query}%")
        ->orWhere('product_description', 'LIKE', "%{$query}%")
        ->select('id', 'product_name', 'slug', 'selling_price', 'product_image')
        ->limit(5)
        ->get();
}//endmethod


public function getCategoryProducts($slug)
{
    try {
        $category = Category::where('slug', $slug)->firstOrFail();
        $products = Product::where('category_id', $category->id)
            ->select('id', 'product_name', 'slug', 'selling_price', 'product_image')
            ->paginate(12);

        return response()->json([
            'success' => true,
            'category' => $category,
            'products' => $products
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => 'Category not found'
        ], 404);
    }
}

public function getTrendingProducts()
{
    $trendingProducts = Product::where('sales_count', '>', 0)
        ->orderBy('sales_count', 'desc')
        ->limit(10)
        ->get();

    return response()->json($trendingProducts);
}

}
