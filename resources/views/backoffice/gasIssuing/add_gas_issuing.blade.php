@extends('layouts.admin_app')

@section('title')
Customers Issued With Gass
@endsection

@section('content')

<link rel="stylesheet" href="{{asset('assets/css/attend.css')}}">
<style>
    .switch-toggle{
        width: auto;
    }
    .switch-toggle label:not(.disabled){
        cursor: pointer;
    }
    .switch-candy a{
        border: 1px solid #333;
        border-radius: 3px;
        background-color: white;
        background-image: -webkit-linear-gradient(top,rgba(255, 255, 255, 0.2), transparent);
        background-image: linear-gradient(to bottom, rgba(255, 255, 255, 0.2), transparent);
    }
    .switch-toggle.switch-candy, .switch-light.switch-candy > span{
        background-color: #5a6268;
        border-radius: 3px;
        box-shadow: inset 0 2px 6px rgba(0, 0, 0, 0.3), 0 1px 0 rgba(255, 255, 255, 0.2);
    }
</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<div class="content">
    <!-- Start Content-->
    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <h4>

                                <a href=" {{route('gas.issuing.list')}} " class="btn btn-primary float-sm-right"> <i class="fas fa-list"></i>Customers Issued With a Gas</a>
                            </h4>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <!-- end page title -->
        <div class="row">
            <div class="col-12">
                <div class="card">




                    <div class="card-body">
                        <form action="{{route('gas.issuing.store')}} " method="post" id="myForm">
                            @csrf
                            <div class="form-group col-md-4">
                                <label for="date" class="control-label">Issuing Date</label>
                                <input type="date" name="date" id="date" class="checkdate form-control form-control-sm singledatepicker" placeholder="Attendance Date" autocomplete="off">
                            </div>
                            <table class="table sm table-bordered table-striped dt-responsive" style="width: 100%">
                                <thead>
                                    <tr>
                                        <th rowspan="2" class="text-center" style="vertical-align: middle">Sl.</th>
                                        <th rowspan="2" class="text-center" style="vertical-align: middle">Customer Name</th>
                                        <th rowspan="2" class="text-center" style="vertical-align: middle">Gas Type</th>
                                        <th colspan="3" class="text-center" style="vertical-align: middle">Issuing  Status</th>
                                    </tr>
                                    <tr>
                                        <th class="text-center btn present_all" style="display: table-cell;background-color:#114190">Not Issued</th>
                                        <th class="text-center btn leave_all" style="display: table-cell;background-color:red">Issued</th>
                                        <th class="text-center btn absent_all" style="display: table-cell;background-color:#114190">Returned</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($gas_issued_customers as $key => $item)
                                    <tr id="div {{$item->id}}" class="text-center">
                                        <input type="hidden" name="item_id[]" value="{{$item->id}}" class="item_id">
                                        <td>{{$key+1}}</td>
                                        <td>{{$item->name}}</td>
                                        <td>
                                            <select id="gas_type" name="gas_type[]">
                                                <option value="">Choose Gas Type</option>
                                                <option value="6Kg Shell">6Kg Shell</option>
                                                <option value="13Kg Shell">13Kg Shell</option>
                                                <option value="6Kg Kgas">6Kg Kgas</option>
                                                <option value="13Kg Kgas">13Kg Kgas</option>
                                                <option value="6Kg Pro gas">6Kg Pro gas</option>
                                                <option value="13Kg Pro gas">13Kg Pro gas</option>
                                            </select>
                                        </td>
                                        <td colspan="3">
                                            <div class="switch-toggle switch-3 switch-candy">
                                                <input class="present" id="present{{$key}}" name="issuing_status{{$key}}" value="Not Issued" type="radio" checked="checked">

                                                <label for="present{{$key}}">Not Issued</label>
                                                <input class="leave" id="leave{{$key}}" name="issuing_status{{$key}}" value="Issued" type="radio">

                                                <label for="leave{{$key}}">Issued</label>
                                                <input class="absent" id="absent{{$key}}" name="issuing_status{{$key}}" value="Returned" type="radio">

                                                <label for="absent{{$key}}">Returned</label>
                                                <a></a>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <button type="submit" class="btn btn-success btn-sm"> Submit </button>
                        </form>
                    </div>
                    <!-- end card body-->

                </div>
                <!-- end card -->
            </div>
            <!-- end col-->
        </div>
        <!-- end row-->
    </div>
    <!-- container -->
</div>
<!-- content -->

<script type="text/javascript">
    $(document).on('click','.present',function(){
        $(this).parents('tr').find('.datetime').css('pointer-events','none').css('background-color','#dee2e6').css('color','#495057');
    });
    $(document).on('click','.leave',function(){
        $(this).parents('tr').find('.datetime').css('pointer-events','').css('background-color','white').css('color','#495057');
    });
    $(document).on('click','.absent',function(){
        $(this).parents('tr').find('.datetime').css('pointer-events','none').css('background-color','#dee2e6').css('color','#dee2e6');
    });
</script>
<script type="text/javascript">
    $(document).on('click','.present_all',function(){
        $("input[value=Present]").prop('checked',true);
        $('.datetime').css('ponter-events','none').css('background-color','#dee2e6').css('color','#495057');
    });
    $(document).on('click','.leave_all',function(){
        $("input[value=Leave]").prop('checked',true);
        $('.datetime').css('ponter-events','').css('background-color','white').css('color','#495057');
    });
    $(document).on('click','.absent_all',function(){
        $("input[value=Absent]").prop('checked',true);
        $('.datetime').css('ponter-events','none').css('background-color','#dee2e6').css('color','#dee2e6');
    });
</script>


@endsection
