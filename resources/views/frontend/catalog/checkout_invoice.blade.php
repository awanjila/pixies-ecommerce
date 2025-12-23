@extends('layouts.front_app')

@section('title', 'Unpaid Invoice | wabegadgets')

@section('meta_title', 'Unpaid Invoice | wabegadgets')

@push('styles')
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        body {
            background: #f8f9fa; /* Light gray background */
            min-height: 100vh;
            font-family: 'Roboto', sans-serif;
        }

        .card {
            margin: 3vh auto;
            max-width: 950px;
            width: 90%;
            box-shadow: 0 6px 20px 0 rgba(0, 0, 0, 0.19);
            border-radius: 1rem;
            border: transparent;
        }

        .cart {
            background-color: #fff;
            padding: 4vh 5vh;
            border-bottom-left-radius: 1rem;
            border-top-left-radius: 1rem;
        }

        .client-details,
        .order-details,
        .payment-method {
            background-color: #fff;
            padding: 4vh 5vh;
            margin-bottom: 2vh;
            border-radius: 1rem;
            box-shadow: 0 6px 20px 0 rgba(0, 0, 0, 0.19);
        }

        .client-details h5,
        .order-details h5,
        .payment-method h5 {
            font-size: 1.5rem;
            color: #e74c3c;
            margin-bottom: 2vh;
        }

        .table {
            border: 1px solid #2c3e50;
        }

        .table th,
        .table td {
            border: 1px solid #2c3e50;
            padding: 0.5rem;
        }

        .summary {
            background-color: #2c3e50; /* Dark gray background */
            border-top-right-radius: 1rem;
            border-bottom-right-radius: 1rem;
            padding: 4vh;
            color: #ecf0f1; /* Light gray text color */
        }

        .title h4 {
            font-size: 2rem; /* Larger title */
            color: #e74c3c; /* Red color for title */
            margin-bottom: 2vh;
        }

        .btn {
            background-color: #e74c3c; /* Red color */
            border-color: #e74c3c; /* Red border color */
            color: white;
            width: 100%;
            font-size: 1rem; /* Larger font size */
            margin-top: 2vh;
            padding: 1.5vh;
            border-radius: 0;
            cursor: pointer;
            transition: background-color 0.3s; /* Smooth color transition */
        }

        .btn:hover {
            background-color: #c0392b; /* Darker red on hover */
        }

        .input-group .form-control {
            margin-top: 5px; /* Adjust the value as needed */
        }
    </style>
@endpush

@section('content')
    <div class="card">
        <div class="row">
            <div class="col-md-8 cart">
                <div class="title">
                    <h4><b>Unpaid Invoice</b></h4>
                </div>
                <div class="client-details">
                    <h5><b>Client Details</b></h5>
                    <p><strong>Organization:</strong> Foxtrot UC</p>
                    <p><strong>Name:</strong> {{ $checkout_info->customer_name }}</p>
                    <p><strong>Phone:</strong> {{ $checkout_info->customer_phone }}</p>
                    <p><strong>Email:</strong>  {{ $checkout_info->customer_email }}</p>
                    <p><strong>Delivery Address:</strong> {{ $checkout_info->customer_address }}</p>
                    <p><strong>Date Ordered:</strong> {{ $checkout_info->order_date->format('d-m-Y') }}</p>
                </div>
                <div class="order-details">
                    <h5><b>Order Details</b></h5>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Item</th>
                                <th>Quantity</th>
                                <th>Price</th>
                                <th>Total</th>
                            </tr>
                        </thead>

                      
                        <tbody>
                            @foreach($contents as $key => $item)
                                <tr>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->qty }}</td>
                                    <td>Ksh {{ $item->price }}</td>
                                    <td>Ksh {{ $item->qty * $item->price }}</td>
                                </tr>
                            @endforeach
                        </tbody>
              
                    </table>
                  

                    <coupon-component :coupon-code="'{{ $checkout_info->coupon_code }}'" @coupon-applied="applyCoupon"></coupon-component>
                </div>
            </div>
            <div class="col-md-4 summary">
                <div>
                    <h5><b>Order Summary</b></h5>
                </div>
                <hr>
                <div class="row">
                    <div class="col">{{ Cart::count() }} ITEMS</div>
                    <div class="col text-right">Ksh {{ Cart::total() }}.00</div>
                </div>
                <div class="row" style="border-top: 1px solid rgba(0,0,0,.1); padding: 2vh 0;">
                    <div class="col">TOTAL PRICE</div>
                    <div class="col text-right">Ksh {{ Cart::total() }}.00</div>
                </div>

                <form class="mb-3" method="post" action="{{ url('/final-invoice') }}">
                    @csrf

                    <!-- Hidden input fields for invoice details -->
                    <input type="hidden" name="customer_name" value="{{ $checkout_info->customer_name }}">
                    <input type="hidden" name="customer_phone" value="{{ $checkout_info->customer_phone }}">
                    <input type="hidden" name="customer_email" value="{{ $checkout_info->customer_email }}">
                    <input type="hidden" name="customer_address" value="{{ $checkout_info->customer_address }}">
                    <input type="hidden" name="order_status" value="pending">
                    <input type="hidden" name="order_date" value="{{ date('d-F-Y') }}">
                    <input type="hidden" name="total_products" value="{{ Cart::count() }}">

                    <!-- Payment method selection -->
                    <div class="payment-method">
                        <h5><label for="payment_status" class="form-label">Payment Method</label></h5>
                        <select name="payment_status" class="form-select" id="payment_status">
                            <option value="mpesa">Mpesa</option>
                            <option value="Cash On Delivery">Cash On Delivery</option>
                        </select>
                    </div>

                    <!-- Amount to pay input -->
                    <div class="mb-3">
                        <label for="pay" class="form-label">Amount to Pay</label>
                        <input class="form-control" type="text" name="pay" placeholder="Amount to Pay" value="Ksh {{ Cart::total() }}.00" readonly>
                    </div>

                    <!-- Submit button -->
                    <div class="mb-3 text-center">
                        <button class="btn btn-warning" type="submit" style="width: 100%;">Complete Order</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection