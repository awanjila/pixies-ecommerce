<?php

namespace App\Http\Controllers\FrontEnd;
use Carbon\Carbon;
use App\Models\Brand;
use App\Models\Order;
use App\Models\Contact;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\Category;
use App\Mail\ContactMail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Validator;

class CatalogController extends Controller
{
    public function Index(){

      $categories=Category::latest()->get();
      $products=Product::latest()->get();

      $hotProducts = Product::where('sales_count', '>', 0)
        ->orderBy('sales_count', 'desc')
        ->limit(10)
        ->get();

        $product = Product::select('id', 'product_name')
        ->selectRaw('selling_price - buying_price as price_difference')
        ->with('category') // Eager load the category relationship
        ->orderByDesc('price_difference')
        ->first();


      return view('frontend.index', compact('categories', 'products', 'hotProducts', 'product'));
    }//endmethod

    public function vueindex()
    {
        $products = Product::orderBy('id', 'DESC')->paginate(12); // Add pagination
        return response()->json([
            'status' => 200,
            'products' => $products
        ]);
    }



    public function vuecategory(){
      try {
          // Fetch products from the database
          $categories = Category::with('products')->get();


          // Return the products as JSON or to a view
          return response()->json(['categories' => $categories]);
      } catch (\Exception $e) {
          // Log the error
          \Log::error('Error fetching categories: ' . $e->getMessage());

          // Return an error response
          return response()->json(['error' => 'Error fetching categories'], 500);
      }

  }//endmethod



    public function searchProducts(Request $request){

      if ($request->search) {

        $searchproducts= Product::where('product_name', 'LIKE','%'.$request->search.'%')->latest()->paginate(10);
        return view('frontend.catalog.search', compact('searchproducts'));
    }else{


        return redirect()->back()->with('message', 'Empty Search');


    }

    }//endmethod


    



    public function showProducts($slug)
    {
        // Retrieve the category with the given slug
        $category = Category::where('slug', $slug)->firstOrFail();
        $brands = Brand::latest()->get();
        $products = $category->products()->paginate(14);
        // Retrieve products within the same category
       
        // Retrieve a list of all categories (if needed)
        // $categories = Category::latest()->get();
        // dd($products);
        $categories = Category::has('products')->inRandomOrder()->take(10)->get();
    
        // Retrieve hot products
        // $hotproducts = Product::where('sales_count', '>', 0)
        //     ->orderBy('sales_count', 'desc')
        //     ->limit(12)
        //     ->get();
    
        // Prepare the data to be sent as JSON
        $data = [
            'category' => $category,
            'products' => $products,
            'categories' => $categories,
            // 'hotproducts' => $hotproducts,
            'brands' => $brands,
        ];
    
        // Return the data as JSON response
        // return response()->json($data);
// dd($products);
return view('frontend.catalog.category.category_product', [
  'category' => $category,
  'products' => $category->products
]);
  
    }//endmethod

    public function showBrandProducts($slug){}//endmethod



   public function show($slug)
{
    $product = Product::with(['category', 'brand'])->where('slug', $slug)->firstOrFail();

    $hotproducts = Product::where('sales_count', '>', 0)
        ->orderBy('sales_count', 'desc')
        ->limit(10)
        ->get();

    // JSON-LD tailored to your fields
    $productSchema = [
        "@context" => "https://schema.org/",
        "@type" => "Product",
        "name" => $product->product_name,
        "image" => $product->product_image ? [asset('storage/' . $product->product_image)] : [],
        "description" => $product->product_description,
        "sku" => $product->product_code,
        "mpn" => $product->product_code,
        "brand" => [
            "@type" => "Brand",
            "name" => $product->brand->name ?? 'Wabegadgets'
        ],
        "offers" => [
            "@type" => "Offer",
            "url" => route('show.product', $product->slug),
            "priceCurrency" => "KES",
            "price" => $product->selling_price,
            "priceValidUntil" => $product->expire_date ?? now()->addYear()->format('Y-m-d'),
            "itemCondition" => "https://schema.org/NewCondition",
            "availability" => $product->product_store && $product->product_store > 0 
                ? "https://schema.org/InStock" 
                : "https://schema.org/OutOfStock",
            "seller" => [
                "@type" => "Organization",
                "name" => "Wabegadgets"
            ]
        ]
    ];

    return view('frontend.catalog.product.product_detail', compact('product', 'hotproducts', 'productSchema'));
}//endmethod
    
    /**
     * Delete a product image
     */
    public function deleteProductImage(Request $request)
    {
        try {
            $request->validate([
                'image_id' => 'required|exists:product_images,id'
            ]);
            
            $image = ProductImage::findOrFail($request->image_id);
            
            // Delete the physical file
            $filePath = public_path('upload/product/' . $image->filename);
            if (file_exists($filePath)) {
                unlink($filePath);
            }
            
            // Delete from database
            $image->delete();
            
            return response()->json([
                'success' => true,
                'message' => 'Image deleted successfully'
            ]);
            
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete image: ' . $e->getMessage()
            ], 500);
        }
    }



public function showCart(){



  return view('frontend.cart');
}//endmethod

public function checkout(){
  // Generate the checkout URL based on your application logic
  $checkoutUrl = route('show.checkout'); // Assuming 'show.checkout' is the name of your route
  
  // Pass the checkout URL to the view
  // return response()->json(['checkoutUrl' => $checkoutUrl]);
   return view('frontend.checkout')->with('checkoutUrl', $checkoutUrl);
}


  public function CheckoutInvoice(Request $request)
  {

      $validator = Validator::make($request->all(), [
          'name' => 'required',
          'phone' => 'required',
          'email' => 'required',
          'address' => 'required',
      ]);

      if ($validator->fails()) {
          return redirect()->back()->withErrors($validator);
      }

      $contents = Cart::content();

      $order = Order::create([
              // 'customer_id'=>1, // Make this dynamic - related to the authenticated customer
              'customer_name'=>$request->name,
              'customer_email'=>$request->email,
              'customer_phone'=>$request->phone,
              'customer_address'=>$request->address,
              'order_date'=>Carbon::now(),
              'order_status'=>'pending',
              'total_products'=>Cart::count(),
              'sub_total'=>Cart::subtotal(),
              'invoice_no'=>rand(1000000, 9999999), // Consider creating a generator to ensure unique invoice numbers
              'total'=>Cart::total(),
              'vat'=>Cart::tax(),
              'coupon_code'=>$request->coupon_code,
              // 'payment_status'=>$request->name,
              // 'pay'=>$request->name,
              // 'due'=>$request->name,
      ]);

      // return view('backoffice.invoice.product_invoice', compact('contents', 'checkout_info'));
      \Log::info('Coupon Code:', ['coupon_code' => $order->coupon_code]);
      return view('frontend.catalog.checkout_invoice', [
        'contents' => $contents,
        'checkout_info' => $order,
      ]);

  }//endmethod

   

  public function Contact(){
    return view('frontend.contact');
  }//endmethod



    public function SendMail(Request $request){
        $data=$this->validate($request, [
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required|digits:10|numeric',
            'enquiry' => 'required',
        ]);


        $contact=new Contact;
        $contact->name= $request->name;
        $contact->email= $request->email;
        $contact->phone= $request->phone;
        $contact->enquiry= $request->enquiry;

        //dd($contact);

        $contact->save();

        if ($contact->save()==true){
            $admin_email='keruboalice0@gmail.com';
            //call nullable
            Mail::to($admin_email)->send(new ContactMail($data));
        }

        Session::flash('success', 'Your Message Has Been Sent, ' . $request->name . '! Thank you for shopping with us.');
        // Redirect back to the main page (you can adjust the route name as needed).
        return redirect()->route('catalog.index');


    }//endmethod

    public function faq(){

      return view('frontend.faq');
    }//endmethod


    public function Shop(){

    $categories = Category::latest()->get();
    $products = Product::latest()->get();
    $hotproducts = Product::where('sales_count', '>', 0)
    ->orderBy('sales_count', 'desc')
    ->limit(10)
    ->get();

    return view('frontend.catalog.product.all-shop', compact('categories', 'hotproducts', 'products'));


    }//endmethod


    public function About(){
        return view('frontend.about');
    }//endmethod    

    public function Shipping(){
        return view('frontend.shipping');
    }//endmethod

    public function PrivacyPolicy(){
        return view('frontend.privacy_policy');
    }//endmethod

    public function TermsConditions(){
        return view('frontend.terms_conditions');
    }//endmethod

    public function Returns(){
        return view('frontend.returns');
    }//endmethod
  }