
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('assets/css/bootstrap.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/jquery-ui.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/jquery-editable-select.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/style.css')}}">
    @vite('resources/js/app.js')
    <title>Point of sale</title>
</head>
<body>
<!-- ============================== MAIN SECTION START ============================== -->
<section id="mainSection">
    <div class="row mx-0">
        <!-- ============================== CALCULATION AREA START ============================== -->
        <div class="col-xl-6 px-1">
            <div class="top-area-btns d-xl-none">
                <div class="show-on-mob text-center">
                    <a href="#calculationArea" class="btn btn-green active-btn" type="button"><i class="fa fa-shopping-cart"></i> Cart</a>
                    <a href="#productArea" class="btn btn-green" type="button"><i class="fa fa-shopping-bag"></i> Product</a>
                </div>
    
            </div>
            <div id="calculationArea" class="calculation-area">
            
                    <cart />
            
            </div>
        </div>
 

    </div>
</section>
<!-- ============================== CUSTOMER MODAL ============================== -->
<div class="modal fade" id="addCustomer" data-backdrop="false">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add customer</h4>
                <button type="button" class="btn close" data-dismiss="modal"><i class="fa fa-times"></i></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="">Name:</label>
                            <input type="text" class="form-control" placeholder="">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="">Phone:</label>
                            <input type="number" class="form-control" placeholder="">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="">Father's name:</label>
                            <input type="text" class="form-control" placeholder="">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="">Email:</label>
                            <input type="text" class="form-control" placeholder="">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="">Previous due:</label>
                            <input type="email" class="form-control" placeholder="">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="">Date of birth:</label>
                            <input type="text" class="form-control datepicker" placeholder="DD-MM-YYYY">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="">Group:</label>
                            <select class="form-control" id="editable-select">
                                <option selected>Aprilia</option>
                                <option>Ktm</option>
                                <option>MVagusta</option>
                                <option>Ducati</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="">Delivery address:</label>
                            <input type="email" class="form-control" placeholder="">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn">Save changes</button>
                <button type="button" class="btn" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>

<!-- ============================== PRODUCT ADD MODAL ============================== -->
</div>
<!-- ============================== PAYMENT MODAL ============================== -->


<!-- ============================== MAIN SECTION START ============================== -->
<section id="mainSection">
    <div id="app">

        @auth
    <div class="row mx-0">
        <!-- ============================== CALCULATION AREA START ============================== -->

        <carts></carts>

        <!-- ============================== PRODUCT AREA START ============================== -->
        <div id="productArea" class="col-xl-6 px-1">
            <div class="top-area-btns d-none d-xl-block">
                <div class="right-part">
                
                   <a class="btn btn-green" href="{{route('admin.logout')}}">
  <i class="fa fa-sign-out"></i> <span>Logout</span>
</a>
                </div>
            </div>
            <products></products>
        </div>
    </div>
    </div>

    @endauth
</section>

<!--==========================================================================-->
<div class="modal fade" id="exampleModal" data-backdrop="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Modal title</h4>
                <button type="button" class="btn close" data-dismiss="modal"><i class="fa fa-times"></i></button>
            </div>
            <div class="modal-body">
                <p>Modal body text goes here.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn">Add to cart</button>
                <button type="button" class="btn" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>
<!-- ============================== EDIT MODAL ============================== -->
<div class="modal fade" id="editModal" data-backdrop="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Modal title</h4>
                <button type="button" class="btn close" data-dismiss="modal"><i class="fa fa-times"></i></button>
            </div>
            <div class="modal-body">
                <p>Modal body text goes here.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn">Save changes</button>
                <button type="button" class="btn" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>
<!-- ============================== CUSTOMER MODAL ============================== -->
<div class="modal fade" id="addCustomer" data-backdrop="false">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add customer</h4>
                <button type="button" class="btn close" data-dismiss="modal"><i class="fa fa-times"></i></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="">Name:</label>
                            <input type="text" class="form-control" placeholder="">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="">Phone:</label>
                            <input type="number" class="form-control" placeholder="">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="">Father's name:</label>
                            <input type="text" class="form-control" placeholder="">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="">Email:</label>
                            <input type="text" class="form-control" placeholder="">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="">Previous due:</label>
                            <input type="email" class="form-control" placeholder="">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="">Date of birth:</label>
                            <input type="text" class="form-control datepicker" placeholder="DD-MM-YYYY">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="">Group:</label>
                            <select class="form-control" id="editable-select">
                                <option selected>Aprilia</option>
                                <option>Ktm</option>
                                <option>MVagusta</option>
                                <option>Ducati</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="">Delivery address:</label>
                            <input type="email" class="form-control" placeholder="">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn">Save changes</button>
                <button type="button" class="btn" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>

</div>
<!-- ============================== ALERT BOX MODAL ============================== -->
<div class="modal fade text-center" id="alertBox" data-backdrop="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Alert!</h4>
            </div>
            <div class="modal-body">
                <span>Modal body text goes here.</span>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn mx-auto" data-dismiss="modal">OK</button>
            </div>
        </div>
    </div>
</div>
<!-- ============================== TYPE A NOTe MODAL ============================== -->
<div class="modal fade text-center" id="typeNoteBox" data-backdrop="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Type a note!</h4>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group mb-0">
                        <input type="text" class="form-control" placeholder="Write a note">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <div class="btns mx-auto">
                    <button type="button" class="btn">OK</button>
                    <button type="button" class="btn" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- ============================== PAYMENT HOLD MODAL ============================== -->
<div class="modal fade text-center" id="holdBox" data-backdrop="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Hold!</h4>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group mb-0">
                        <input type="text" class="form-control" placeholder="Hold number">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <div class="btns mx-auto">
                    <button type="button" class="btn">Submit</button>
                    <button type="button" class="btn" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- ============================== HOLD SALE MODAL ============================== -->
<div class="modal fade" id="holdSaleModal" data-backdrop="false">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Hold sale</h4>
                <button type="button" class="btn close" data-dismiss="modal"><i class="fa fa-times"></i></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-9 hold-sale-details">
                        <h5 class="text-center">Sale details</h5>
                        <p class="my-3"><b>Customer:</b> Walk-in-customer</p>
                        <table class="table table02 mb-0">
                            <thead class="">
                            <tr>
                                <th scope="col">Item</th>
                                <th scope="col">Price</th>
                                <th scope="col">Qty/Amt</th>
                                <th scope="col">Discount</th>
                                <th scope="col">Total</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr class="table-row">
                                <td>AMD Ryzen 5 3600 Processor</td>
                                <td>16,800 tk</td>
                                <td>10 kg</td>
                                <td>10%</td>
                                <td>15,120</td>
                            </tr>
                            <tr class="table-row">
                                <td>AMD Ryzen 5 3600 Processor</td>
                                <td>16,800 tk</td>
                                <td>10 kg</td>
                                <td>10%</td>
                                <td>15,120</td>
                            </tr>
                            </tbody>
                        </table>
                        <div class="sec-final-calculation">
                            <table class="table mb-0">
                                <tbody>
                                <tr class="table-row">
                                    <td>Total Item: <span>0</span></td>
                                    <td>Sub Total</td>
                                    <td>tk <span>0.00</span></td>
                                </tr>
                                <tr class="table-row">
                                    <td></td>
                                    <td>Discount</td>
                                    <td>tk <span>0.00</span></td>
                                </tr>
                                <tr class="table-row">
                                    <td></td>
                                    <td>Total Discount</td>
                                    <td>tk <span>0.00</span></td>
                                </tr>
                                <tr class="table-row">
                                    <td></td>
                                    <td>Shipping/Other</td>
                                    <td>tk <span>0.00</span></td>
                                </tr>
                                <tr class="table-row">
                                    <td></td>
                                    <td>Total Payable</td>
                                    <td>tk <span>0.00</span></td>
                                </tr>
                                <tr class="table-row">
                                    <td></td>
                                    <td>Paid amount</td>
                                    <td>tk <span>0.00</span></td>
                                </tr>
                                <tr class="table-row">
                                    <td></td>
                                    <td>Due amount</td>
                                    <td>tk <span>0.00</span></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div class="row">
                    
                    <div class="col-lg-7 px-0 pl-lg-3">
                        <div class="bottom-area-btns text-center">
                            <button type="button" class="btn">Delete</button>
                            <button type="button" class="btn" data-dismiss="modal">Cancel</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script src="{{asset('assets/js/jquery.min.js')}}"></script>
<script src="{{asset('assets/js/bootstrap.min.js')}}"></script>
<script src="{{asset('assets/js/popper.min.js')}}"></script>
<script src="{{asset('assets/js/jquery-ui.min.js')}}"></script>
<script src="{{asset('assets/js/jquery-editable-select.min.js')}}"></script>
<script src="{{asset('assets/js/calculate.js')}}"></script>
<script src="{{asset('assets/js/style.js')}}"></script>
<script type="text/javascript">

    function increaseValue() {
        var value = parseInt(document.getElementById('number').value, 10);
        value = isNaN(value) ? 0 : value;
        value++;
        document.getElementById('number').value = value;
    }

    function decreaseValue() {
        var value = parseInt(document.getElementById('number').value, 10);
        value = isNaN(value) ? 0 : value;
        value < 1 ? value = 1 : '';
        value--;
        document.getElementById('number').value = value;
    }

</script>
</body>
</html>
