<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BackOffice\CustomerController;
use App\Http\Controllers\BackOffice\SupplierController;
use App\Http\Controllers\BackOffice\AttendanceController;
use App\Http\Controllers\BackOffice\CategoryController;
use App\Http\Controllers\BackOffice\BrandController;
use App\Http\Controllers\BackOffice\ProductController;
use App\Http\Controllers\BackOffice\POSController;
use App\Http\Controllers\BackOffice\OrderController;
use App\Http\Controllers\BackOffice\RoleController;
use App\Http\Controllers\BackOffice\CartController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CouponController;

use App\Http\Controllers\Auth\ClientRegisterController;
use App\Http\Controllers\Auth\ClientLoginController;


use App\Http\Controllers\FrontEnd\CatalogController;

use App\Http\Controllers\ReviewController;

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/



////////////////Frontend Catalog///////////////

// Client Registration Routes
Route::get('client/register', [ClientRegisterController::class, 'showRegistrationForm'])->name('client.register');
Route::post('client/register', [ClientRegisterController::class, 'register'])->name('client.register.post');

// Client Login Routes
Route::get('client/login', [ClientLoginController::class, 'showLoginForm'])->name('client.login');
Route::post('client/login', [ClientLoginController::class, 'login'])->name('client.login.post');
Route::post('client/logout', [ClientLoginController::class, 'logout'])->name('client.logout');



Route::get('/visit', [AdminController::class, 'trackVisit']);
Route::post('/submit-review', [ReviewController::class, 'submitReview'])->name('submit-review');
Route::get('/reviews/{productId}', [ReviewController::class, 'Reviews'])->name('all-review');




//Customer Controller
    Route::controller(CatalogController::class)->group(function(){
    Route::get('/', 'Index')->name('catalog.index');
    Route::get('/category/{slug}', 'showProducts')->name('category.products');
    Route::get('/brand/{slug}', 'showBrandProducts')->name('brand.products');
    Route::get('show/product/{slug}', 'show')->name('show.product');
    Route::get('show/cart', 'showCart')->name('show.cart');
    

    Route::get('checkout', 'checkout')->name('show.checkout');
    // Route::get('search', 'searchProducts')->name('search');
    Route::post('/checkout/invoice', 'CheckoutInvoice')->name('checkout.invoice');
    Route::get('/contact/us', 'Contact')->name('contact');
    Route::post('/sendmail', 'SendMail')->name('sendmail');
    Route::get('/faqs', 'faq')->name('faqs');
    Route::get('/shop',  'Shop')->name('shop');
    Route::get('/about/us',  'About')->name('about');
    Route::get('/shipping',  'Shipping')->name('shipping');
    Route::get('/privacy/policy',  'PrivacyPolicy')->name('privacy.policy');
    Route::get('/terms/conditions',  'TermsConditions')->name('terms.conditions');
    Route::get('/return/policy',  'Returns')->name('returns');
    
    // Product image management routes
    Route::delete('/product/delete-image', 'deleteProductImage')->name('product.deleteImage');
});



//Admin

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.admin_dashboard');
    })->name('dashboard');
});



// Route::get('/', function () {

//         return view('launchpage');

// });

// Route::get('/dashboard', function () {
//     return view('admin.admin_dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::get('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::get('admin/logout', [AdminController::class, 'AdminDestroy'])->name('admin.logout');
Route::get('/logout', [AdminController::class, 'adminLogout'])->name('admin.logout.page');


Route::middleware('auth')->group(function () {
    Route::get('admin/profile', [AdminController::class, 'adminProfile'])->name('admin.profile');
    Route::post('admin/profile/store', [AdminController::class, 'adminProfileStore'])->name('admin.profile.store');
    Route::get('admin/change/password', [AdminController::class, 'adminChangePassword'])->name('admin.change.password');
    Route::post('admin/password/update', [AdminController::class, 'adminUpdatePassword'])->name('admin.update.password');
    Route::get('/get-logged-in-user', [AdminController::class, 'getLoggedInUser']);

});





//Customer Controller
Route::controller(CustomerController::class)->group(function(){
    Route::get('all/customer', 'AllCustomer')->name('customer.all')->middleware('permission:customer.all');
    Route::get('add/customer', 'AddCustomer')->name('customer.add')->middleware('permission:customer.add');
    Route::post('customer/store', 'StoreCustomer')->name('customer.store');
    Route::get('edit/customer/{id}', 'EditCustomer')->name('edit.customer')->middleware('permission:customer.edit');
    Route::get('customer/details/{id}', 'DetailCustomer')->name('details.customer');
    Route::post('customer/update', 'UpdateCustomer')->name('customer.update');
    Route::get('customer/delete/{id}', 'DeleteCustomer')->name('delete.customer')->middleware('permission:customer.delete');



    //CartComponent
     Route::get('/get-customers', 'GetCustomers')->name('customer.get');

    

})->middleware(['auth', 'verified']);


//Supplier Controller
Route::controller(SupplierController::class)->group(function(){
    Route::get('all/supplier', 'AllSupplier')->name('supplier.all')->middleware('permission:supplier.all');
    Route::get('add/supplier', 'AddSupplier')->name('supplier.add')->middleware('permission:supplier.add');
    Route::post('supplier/store', 'StoreSupplier')->name('supplier.store');
    Route::get('edit/supplier/{id}', 'EditSupplier')->name('edit.supplier')->middleware('permission:supplier.edit');
    Route::get('supplier/details/{id}', 'DetailSupplier')->name('details.supplier');
    Route::post('supplier/update', 'UpdateSupplier')->name('supplier.update');
    Route::get('supplier/delete/{id}', 'DeleteSupplier')->name('delete.supplier')->middleware('permission:supplier.delete');

})->middleware(['auth', 'verified']);


//All Category Route
Route::controller(CategoryController::class)->group(function(){
    Route::get('all/category', 'AllCategory')->name('all.category');
    Route::get('add/category', 'AddCategory')->name('category.add');
    Route::post('store/category', 'StoreCategory')->name('category.store');
    Route::post('update/category', 'UpdateCategory')->name('category.update');
    Route::get('edit/category/{id}', 'EditCategory')->name('edit.category');
    Route::get('delete/category/{id}', 'DeleteCategory')->name('delete.category');

})->middleware(['auth', 'verified']);


//All Brand Route
Route::controller(BrandController::class)->group(function(){
    Route::get('all/brand', 'AllBrand')->name('all.brand');
    Route::get('add/brand', 'AddBrand')->name('brand.add');
    Route::post('store/brand', 'StoreBrand')->name('brand.store');
    Route::post('update/brand', 'UpdateBrand')->name('brand.update');
    Route::get('edit/brand/{id}', 'EditBrand')->name('edit.brand');
    Route::get('delete/brand/{id}', 'DeleteBrand')->name('delete.brand');

})->middleware(['auth', 'verified']);

//All Product Route
Route::controller(ProductController::class)->group(function(){
    Route::get('all/product', 'AllProduct')->name('all.product');
    Route::get('add/product', 'AddProduct')->name('product.add');
    Route::post('store/product', 'StoreProduct')->name('product.store');
    Route::post('update/product', 'UpdateProduct')->name('product.update');
    Route::get('edit/product/{id}', 'EditProduct')->name('edit.product');
    Route::get('delete/product/{id}', 'DeleteProduct')->name('delete.product');
    Route::get('import/product', 'ImportProduct')->name('import.product');
    Route::get('barcode/product/{id}', 'BarCodeProduct')->name('barcode.product');
    Route::get('export/product', 'ExportProduct')->name('export.product');
    Route::get('out/of/stock', 'OutofStock')->name('out_of_stock');
    Route::get('expired/products', 'ExpiredProducts')->name('expired_products');
    Route::get('hot/products', 'GetHotProducts')->name('hot.products');
    Route::post('import', 'Import')->name('import');


})->middleware(['auth', 'verified']);




//All Review Route
Route::controller(ReviewController::class)->group(function(){
    Route::get('all/review', 'AllReview')->name('all.review');
    Route::get('add/review', 'AddReview')->name('review.add');
    Route::post('store/review', 'StoreReview')->name('review.store');
    Route::post('update/review', 'UpdateReview')->name('review.update');
    Route::get('edit/review/{id}', 'EditReview')->name('edit.review');
    Route::get('delete/review/{id}', 'DeleteReview')->name('delete.review');
    


})->middleware(['auth', 'verified']);


//All POS Route


    // All POS Routes
    Route::get('pos', [POSController::class, 'POS'])->name('pos');
    Route::get('pos/restaraunt', [POSController::class, 'POSRestaraunt'])->name('pos.restaraunt');
    Route::post('/add-cart', [POSController::class, 'AddCart'])->name('add.to.cart');
    Route::get('/All-Pos-Item', [POSController::class, 'AllPosItem'])->name('all.pos.item');
    Route::post('update/pos', [POSController::class, 'UpdatePOS'])->name('pos.update');
    Route::post('/create/invoice', [POSController::class, 'CreateInvoice'])->name('create.invoice');
    Route::post('/create-invoice', [POSController::class, 'CreateBarInvoice'])->name('create.bar.invoice');
    Route::get('delete/pos/{id}', [POSController::class, 'DeletePOS'])->name('delete.pos');
    Route::post('/cart-update/{rowid}', [POSController::class, 'CartUpdate']);
    Route::get('/cart-remove/{rowid}', [POSController::class, 'CartRemove']);



//All POS Route
Route::controller(OrderController::class)->group(function(){

    Route::post('/final-invoice', 'FinalInvoice')->name('final.invoice');
    Route::get('/pending-order', 'PendingOrder')->name('pending.order');
    Route::get('/complete-order', 'CompleteOrder')->name('complete.order');
    Route::get('/order-details/{order_id}', 'OrderDetails')->name('order.details');
    Route::get('order/invoice/download/{id}', 'OrderInvoice')->name('invoice.download');
    Route::post('/order/status/update', 'OrderStatusUpdate')->name('order.status.update');
    Route::get('/stock', 'StockManage')->name('stock.manage');

  
    ////DUE Routes/////
    Route::get('/pending/due', 'PendingDue')->name('pending.due');
    Route::get('/order/due/{id}', 'OrderDueAjax')->name('order.due');
    Route::post('update/due', 'UpdateDue')->name('update.due');

    //////Reports/////
    Route::get('todays/sales', 'TodaysSales')->name('todays_sales_report');
    Route::get('sales/report', 'SalesReport')->name('sales.report');

    
    //Pos Bar//

     Route::post('/complete-order-final-invoice', 'FinalInvoiceBarRes')->name('final.invoice.bar.res');

})->middleware(['auth', 'verified']);

//All Role Route
Route::controller(RoleController::class)->group(function(){

    Route::get('/all-permission', 'AllPermission')->name('all.permission');
    Route::get('/add-permission', 'AddPermission')->name('permission.add');
    Route::post('/store-permission', 'StorePermission')->name('permission.store');
    Route::get('edit/permission/{id}', 'EditPermission')->name('edit.permission');
    Route::get('delete/permission/{id}', 'DeletePermission')->name('delete.permission');
    Route::post('permission/update', 'UpdatePermission')->name('permission.update');

//Roles
    Route::get('/all-role', 'AllRole')->name('all.role');
    Route::get('/add-role', 'AddRole')->name('role.add');
    Route::post('/store-role', 'StoreRole')->name('role.store');
    Route::get('edit/role/{id}', 'EditRole')->name('edit.role');
    Route::get('delete/role/{id}', 'DeleteRole')->name('delete.role');
    Route::post('role/update', 'UpdateRole')->name('role.update');


    //Roles in Permissions

    Route::get('add/roles/permissions', 'AddRolePermissions')->name('add.roles.permissions');
    Route::get('all/roles/permissions', 'AllRolePermissions')->name('all.roles.permissions');
    Route::get('edit/roles/permissions/{id}', 'EditRolePermissions')->name('admin.edit.roles');
    Route::post('role/permission/store', 'StoreRolePermissions')->name('role.permission.store');
    Route::post('role/permission/update/{id}', 'UpdateRolePermissions')->name('role.permission.update');
    Route::get('role/permission/delete/{id}', 'DeleteRolePermissions')->name('admin delete.roles');



})->middleware(['auth', 'verified']);


Route::controller(CartController::class)->group(function(){
    Route::post('pos/add-to-cart', 'addToCart')->name('cart.add');
    Route::get('cart-items', 'CartItems')->name('cart.items');
    Route::delete('/cart-items/{rowId}', 'DeleteItems');
    Route::post('/update-cart/{rowid}', 'CartUpdate');
    Route::get('/cart-count', 'CartCount');
    Route::post('/cart-items/{rowId}/update-quantity', 'updateQuantity');

})->middleware(['auth', 'verified']);


//Advance Salary Controller
Route::controller(AdminController::class)->group(function(){
    Route::get('all/admin/user/setting', 'AllAdminUser')->name('all.admin');
    Route::get('add/admin/user/setting', 'AddAdminUser')->name('add.admin');
    Route::get('edit/admin/user/setting/{id}', 'EditAdminUser')->name('edit.admin');
    Route::post('store/admin/user/setting', 'StoreAdminUser')->name('store.admin');
    Route::post('update/admin/user/setting', 'UpdateAdminUser')->name('update.admin');
    Route::get('delete/admin/user/setting/{id}', 'DeleteAdminUser')->name('delete.admin');


    ///////////////////////////////Database Back Routes/////////////////////////////////
    Route::get('database/backup', 'DataBaseBkp')->name('database.backup');
    Route::get('backup/now', 'DataBaseBkpNow');
    // Route::get('{getFileName}', 'DownloadDataBase');
    Route::get('delete/database/{getFileName}', 'DeleteDataBase');

})->middleware(['auth', 'verified']);


// Route::controller(PrinterController::class)->group(function(){
//     Route::get('print/receipt', 'PrintReceipt')->name('print.receipt');

// })->middleware(['auth', 'verified']);



Route::middleware('checkUserActivity')->group(function () {
    // Your routes here
});


Route::controller(BlogController::class)->group(function(){
   
    Route::get('index/blog', 'IndexOfBlogs')->name('index.blog');
    Route::post('store/blog', 'StoreBlog')->name('store.blog');
    Route::get('delete/blog/{id}', 'DeleteBlog')->name('delete.blog');
    Route::get('edit/blog/{id}', 'EditBlog')->name('edit.blog');
    Route::post('update/blog', 'UpdateBlog')->name('update.blog');

    Route::get('add/blog/category', 'AddBlogCategory')->name('add.blog.category');
    Route::get('add/blog', 'AddBlog')->name('add.blog');
    Route::get('index/blog/category', 'IndexOfBlogCategories')->name('index.blog.category');
    Route::post('store/blog/category', 'StoreBlogCategory')->name('store.blog.category');
    Route::get('delete/blog/category/{id}', 'DeleteBlogCategory')->name('delete.blog.category');


    ///frontend///

    Route::get('show/blog/{slug}', 'ShowBlog')->name('blogs.show');
    // Route::get('blogs', 'IndexOfClientBlogs')->name('blogs.index');

    Route::get('all/posts', 'IndexOfClientBlogs')->name('blogs.index');

 });

 Route::controller(CouponController::class)->group(function(){
    Route::get('add/coupon', 'AddCoupon')->name('add.coupon');
    Route::get('index/coupon', 'IndexOfCoupons')->name('index.coupon');
    Route::post('store/coupon', 'StoreCoupon')->name('store.coupon');
    Route::get('delete/coupon/{id}', 'DeleteCoupon')->name('delete.coupon');
     Route::get('edit/coupon/{id}', 'EditCoupon')->name('edit.coupon');
    Route::post('update/coupon', 'UpdateCoupon')->name('update.coupon');

    ///frontend///

    Route::post('apply/coupon', 'ApplyCoupon')->name('apply.coupon');

    // Route::get('posts', 'IndexOfClientBlogs')->name('blogs.index');
   

 });




























