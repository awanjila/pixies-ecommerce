<?php

namespace App\Http\Controllers;
use App\Models\Coupon;

use Illuminate\Http\Request;

use Gloudemans\Shoppingcart\Facades\Cart;

class CouponController extends Controller
{

    
    public function IndexOfCoupons(){

        $coupons=Coupon::orderBy('created_at', 'desc')->get();
  
        return view('backoffice.coupon.index_coupon')->with('coupons', $coupons);
      }//endmethod
  
  

    public function AddCoupon(){



        return view('backoffice.coupon.add_coupon');

    }//endmethod




    public function StoreCoupon(Request $request){

     $validateData = $request->validate([
    
        'influencer_name' =>'required', 
        'code' => 'required',
         'amount' => 'required',
    ]);

     
// dd($request->all());
        $coupon = new Coupon();
        $coupon->influencer_name= $request->influencer_name;
        $coupon->code = $request->code;
        $coupon->amount = $request->amount;
        $coupon->save();
        $notification = [
            'message' => 'A Coupon has been Created Successfully',
            'alert-type' => 'success'
        ];


           // dd($notification);

        return redirect()->route('index.coupon')->with($notification);
    }//endmethod


    public function DeleteCoupon($id){

        Coupon::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Coupon Deleted Successfully',
            'alert-type' => 'warning'
        );

        return redirect()->back()->with($notification);

}//endmethod


//frontend

public function applyCoupon(Request $request)
{
    // Get the coupon code from the request
    $couponCode = $request->input('coupon_code');

    dd($couponCode);

    // Apply the discount based on the received coupon code
    // Here, you can directly apply your coupon logic without rechecking the coupon code
    // Replace this with your actual coupon logic
    if ($couponCode === 'AMORE') {
        // For demonstration purposes, let's say the discount for 'AMORE' is $50:
        $discountAmount = 50;

        // Retrieve the cart items
        $cartItems = Cart::content();

        // Iterate over the cart items and update their prices
        foreach ($cartItems as $item) {
            // Apply the discount to each item
            $item->price -= $discountAmount; // Adjust the price according to your coupon logic
        }

        // Update the cart with the modified items
        Cart::instance('default')->update($cartItems);

        // Redirect back to the cart page with a success message
        return redirect()->route('checkout.show')->with('success', 'Coupon applied successfully!');
    } else {
        // Redirect back to the cart page with an error message for an invalid coupon code
        return redirect()->route('checkout.show')->with('error', 'Invalid coupon code!');
    }
}//endofmethod


}//endofclass
