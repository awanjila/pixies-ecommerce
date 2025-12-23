<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function submitReview(Request $request)
    {
        // Validate the form data
        $validatedData = $request->validate([
            'user_name' => 'required|string|max:255',
            'rating' => 'required|integer|min:1|max:5',
            'review_text' => 'required|string',
            'product_id' => 'required|integer', // Add validation for product_id
        ]);
    
        // Log the validated data
        info('Validated Data:', $validatedData);
    
        // Create a new review
        $review = Review::create($validatedData);
    
        // Optionally, you might want to return a response or redirect back
        return response()->json(['message' => 'Review submitted successfully', 'review' => $review]);
    }//endmethod


    public function Reviews($productId){
        try {
            $reviews = Review::where('product_id', $productId)->orderBy('created_at', 'desc')->get();
            return response()->json(['reviews' => $reviews]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    }//endmethod






    //backend

    public function AllReview(){
        $reviews= Review::latest()->get();
        return view('backoffice.review.all_review',compact('reviews'));
    } //endmethod




    public function EditReview($id){
        $review=Review::findOrfail($id);

       

        return view('backoffice.review.edit_review', compact('review'));


    }

    public function UpdateReview(Request $request)
    {
// dd($request->all());
        $review_id = $request->id;

        if ($request->file('product_image')) {

         $image = $request->file('product_image');
         $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
         Image::make($image)->resize(300, 398)->save(public_path('upload/products/'.$name_gen));
         $save_url = 'upload/products/' . $name_gen;
         Product::findOrfail($product_id)->update([
            'product_name' => $request->product_name,
            'category_id' => $request->category_id,
            'supplier_id' => $request->supplier_id,
            'product_code' => $request->product_code,
            'buying_price' => $request->buying_price,
            'selling_price' => $request->selling_price,
            'meta_title'=> $request->meta_title,
                // 'buying_date' => $request->buying_date,
                // 'expire_date' => $request->expire_date,
            'product_image' => $save_url,
            'product_store'=>$request->product_store,
            'product_description'=>$request->product_description,
            'product_features'=>$request->product_features,
            'created_at' => Carbon::now(),
        ]);

         $notification = array(
            'message' => 'Product Updated Successfully',
            'alert-type' => 'success'
        );

         return redirect()->route('all.product')->with($notification);

     } else {
        Product::findOrfail($product_id)->update([
            'product_name' => $request->product_name,
            'category_id' => $request->category_id,
            'supplier_id' => $request->supplier_id,
            'product_code' => $request->product_code,
            'buying_price' => $request->buying_price,
            'selling_price' => $request->selling_price,
            'meta_title'=> $request->meta_title,
            // 'buying_date' => $request->buying_date,
            // 'expire_date' => $request->expire_date,
            'product_store'=>$request->product_store,
            'product_description'=>$request->product_description,
            'product_features'=>$request->product_features,
            'created_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'Product Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.product')->with($notification);
    }
}


public function DeleteReview($id){
    Review::findOrFail($id)->delete();

    $notification = array(
        'message' => 'Product Deleted Successfully',
        'alert-type' => 'warning'
    );

    return redirect()->back()->with($notification);
}
    
}
