    <div class="left-side-menu">

        <div class="h-100" data-simplebar>


            <!--- Sidemenu -->
            <div id="sidebar-menu">

                <ul id="side-menu">

                    <li class="menu-title">Navigation</li>

                    <li>
                    <a href="{{route('dashboard')}}">
                            <i class="mdi mdi-view-dashboard-outline"></i>
                            <span> Dashboard </span>
                        </a>
                    </li>







                    <li class="menu-title mt-2">Apps</li>

                    @if(Auth::user()->can('supplier.menu'))
                    <li>
                        <a href="#sidebarCrs" data-bs-toggle="collapse">
                            <i class="mdi mdi-account-multiple-outline"></i>
                            <span> Supplier Management </span>
                            <span class="menu-arrow"></span>
                        </a>
                        <div class="collapse" id="sidebarCrs">
                            <ul class="nav-second-level">
                                @if(Auth::user()->can('supplier.all'))

                                <li>
                                    <a href="{{route('supplier.all')}}">All Supplier</a>
                                </li>

                                @endif
                                    @if(Auth::user()->can('supplier.add'))

                                <li>
                                    <a href="{{route('supplier.add')}}">Add Supplier</a>
                                </li>

                                    @endif
                            </ul>
                        </div>
                    </li>

                    @endif

                  






    <li>

      <a href="#blog" data-bs-toggle="collapse">
          <i class="mdi mdi-account-multiple-outline"></i>
          <span> Blog Section </span>
           <span class="badge bg-red float-end">New</span>
          <span class="menu-arrow"></span>
      </a>
              <div class="collapse" id="blog">
                  <ul class="nav-second-level">


                        <li>
                           <a href="{{route('index.blog')}}">Blog Posts</a>
                        </li>
       
                 </ul>
            </div>
    </li>


    <li>
    <a href="#category" data-bs-toggle="collapse">
    <i class="fa fa-briefcase "></i>
    <span> Category Management </span>
    <span class="menu-arrow"></span>
    </a>
    <div class="collapse" id="category">
         <ul class="nav-second-level">
            <li>
               <a href="{{route('all.category')}}">All Category</a>
            </li>
         </ul>
    </div>
    </li>

      <li>
    <a href="#brand" data-bs-toggle="collapse">
    <i class="fa fa-briefcase "></i>
    <span> Brand Management </span>
    <span class="menu-arrow"></span>
    </a>
    <div class="collapse" id="brand">
         <ul class="nav-second-level">
            <li>
               <a href="{{route('all.brand')}}">All Brand</a>
            </li>
         </ul>
    </div>
    </li>





        <li>
       <a href="#product" data-bs-toggle="collapse">
       <i class="fa fa-briefcase "></i>
       <span> Product Management </span>
       <span class="menu-arrow"></span>
       </a>
       <div class="collapse" id="product">
           <ul class="nav-second-level">

               <li>
                  <a href="{{route('all.product')}}">All Product</a>
               </li>

               <li>
                   <a href="{{route('product.add')}}">Add Product</a>
               </li>
           </ul>
   </div>
   </li>

   <li>
       <a href="#review" data-bs-toggle="collapse">
       <i class="fa fa-briefcase "></i>
       <span> Review Management </span>
       <span class="menu-arrow"></span>
       </a>
       <div class="collapse" id="review">
           <ul class="nav-second-level">

               <li>
                  <a href="{{route('all.review')}}">Reviews</a>
               </li>

             
           </ul>
   </div>
   </li>

   <li>
       <a href="#coupon" data-bs-toggle="collapse">
       <i class="fa fa-briefcase "></i>
       <span>Coupon Management </span>
       <span class="menu-arrow"></span>
       </a>
       <div class="collapse" id="coupon">
           <ul class="nav-second-level">

               <li>
                  <a href="{{route('index.coupon')}}">Coupons</a>
               </li>

             
           </ul>
   </div>
   </li>

     
            <li>
                <a href="#order" data-bs-toggle="collapse"><i class="fa fa-briefcase sm "></i><span> Order Management </span><span class="menu-arrow"></span></a>
            <div class="collapse" id="order">
        <ul class="nav-second-level">


          
               <li>
                  <a href="{{route('pending.order')}}">Pending Order</a>
               </li>
        
               <li>
                  <a href="{{route('complete.order')}}">Complete Order</a>
               </li>
             

                <li>
                    <a href="{{route('pending.due')}}">Pending Due</a>
                </li>
        </ul>
            </div>
         </li>
                    @if(Auth::user()->can('stock.menu'))
         <li>
            <a href="#stock" data-bs-toggle="collapse"><i class="fa fa-briefcase sm "></i>
            <span> Stock Management </span>
                <span class="menu-arrow"></span>
                                                 </a>
            <div class="collapse" id="stock">
                 <ul class="nav-second-level">

                   <li>
                      <a href="{{route('stock.manage')}}">Stock</a>
                   </li>

                </ul>
            </div>
                </li>
                    @endif
                    @if(Auth::user()->can('role.menu'))
                        <li>
                 <a href="#permission" data-bs-toggle="collapse"><i class="fa fa-briefcase sm "></i><span> Roles & Permission </span><span class="menu-arrow"></span></a>
   <div class="collapse" id="permission">
           <ul class="nav-second-level">
               @if(Auth::user()->can('all.permission'))
                   <li>
                      <a href="{{route('all.permission')}}">Permission</a>
                   </li>

               @endif
               @if(Auth::user()->can('role.all'))

                   <li>
                      <a href="{{route('all.role')}}">All Roles</a>
                   </li>

               @endif
                   @if(Auth::user()->can('add.roles.permissions'))
                   <li>
                      <a href="{{route('add.roles.permissions')}}">Add Roles in Permissions</a>
                   </li>
                   @endif
                   @if(Auth::user()->can('all.roles.permissions'))

                   <li>
                      <a href="{{route('all.roles.permissions')}}">All Roles in Permissions</a>
                   </li>

                       @endif

           </ul>
      </div>
   </li>

                    @endif
    @if(Auth::user()->can('admin.menu'))

            <li>
        <a href="#admin" data-bs-toggle="collapse"> <i class="fa fa-briefcase sm "></i>
        <span> Admin User Settings </span> <span class="menu-arrow"></span> </a>
        <div class="collapse" id="admin">
            <ul class="nav-second-level">
                @if(Auth::user()->can('add.admin'))
            <li>
            <a href="{{route('add.admin')}}">Add Admin</a>
            </li>
                @endif

                    @if(Auth::user()->can('all.admin'))

            <li>
            <a href="{{route('all.admin')}}">All Admin</a>
            </li>
                        @endif
            </ul>
        </div>
        </li>
                    @endif
              


</ul>

</div>
<!-- End Sidebar -->

<div class="clearfix"></div>

</div>
<!-- Sidebar -left -->

</div>
