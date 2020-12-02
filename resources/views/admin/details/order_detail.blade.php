
@extends('admin.layouts.app')

@section('head-content')
@endsection

@section('header-content')
@endsection

@section('menu-content')
        <!-- ============================================================== -->
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
                <!-- ============================================================== -->
                <!-- Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->
                <!-- <div class="row page-titles">
                    <div class="col-md-5 col-8 align-self-center">
                        <h3 class="text-themecolor m-b-0 m-t-0">Category</h3>
                    </div>
                </div> -->
                <!-- ============================================================== -->
                <!-- End Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <div class="row mt-4">
                    <div class="col-12">
                    <div class="card">
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs profile-tab" role="tablist">
                                <li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#home" role="tab">Customer</a> </li>
                                <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#profile" role="tab">Order</a> </li>
                                <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#settings" role="tab">Settings</a> </li>
                            </ul>
                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div class="tab-pane active" id="home" role="tabpanel">
                                    <div class="card-body">
                                    <h3 class="box-title m-b-0">{{$order_list->customer->customer_name}}</h3>
                                        <br>
                                        <address>
                                            {{$order_list->customer->customer_address}}
                                            <br/>
                                            <br/>
                                            <abbr title="Phone">P:</abbr> +{{$order_list->customer->phone_number}}
                                        </address>
                                    </div>
                                </div>
                                <!--second tab-->
                                <div class="tab-pane" id="profile" role="tabpanel">
                                <div class="card card-body printableArea">
                                    <h3><b>INVOICE</b> <span class="pull-right">#5669626</span></h3>
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="table-responsive m-t-40" style="clear: both;">
                                                <table class="table table-hover">
                                                    <thead>
                                                        <tr>
                                                            <th class="text-center">Item Code</th>
                                                            <th>Item Name</th>
                                                            <th class="text-right">Capital Price</th>
                                                            <th class="text-right">Sale Price</th>
                                                            <th class="text-right">Unit Discount</th>
                                                            <th class="text-right">Quantity</th>
                                                            <th class="text-right">C.Total</th>
                                                            <th class="text-right">Total</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($order_datas as $order_data)
                                                        <tr>
                                                            <td class="text-center">{{$order_data['item_id']}}</td>
                                                            <td>{{$order_data['item']['item_name']}}</td>
                                                            <td class="text-right">{{$order_data['item']['actual_price']}}</td>
                                                            <td class="text-right">{{$order_data['item']['sale_price']}}</td>
                                                            <td class="text-right">{{$order_data['discount']}}</td>
                                                            <td class="text-right">{{$order_data['item_count']}}</td>
                                                            <td class="text-right">{{$order_data['item']['actual_price'] * $order_data['item_count']}}</td>
                                                            <td class="text-right">{{$order_data['final_price']}}</td>
                                                        </tr>
                                                    @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="pull-right m-t-30 text-right">
                                                <p class="float-left">Total Capital amount: {{$total_capital_price}} MMK</p>
                                                <p>Sub - Total amount: {{$sub_total}} MMK</p>
                                                <p>Total Discount: {{$order_list['total_discount']}} MMK</p>
                                                <p>Dlivery: {{$order_list['deli_price']}} MMK</p>
                                                <hr>
                                                <h3><b>Total :</b>{{$total}} MMK</h3>
                                                <hr>
                                                <h5><b>Total Profit:</b>{{$total_profit}} MMK</h5>
                                            </div>
                                            <div class="clearfix"></div>
                                            <hr>
                                            <div class="text-right">
                                                <a href="/invoice_order/{{$order_list->order_id}}" data-toggle="tooltip" data-original-title="Detail" class="btn btn-danger">Print Invoice</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                </div>
                                <div class="tab-pane" id="settings" role="tabpanel">
                                    <div class="card-body">
                                        <div>
                                            <p class="float-left">Status: <div class="ml-3 label label-success">Confirmed</div></p>
                                        </div>
                                        <form class="form-horizontal form-material">
                                            <div class="form-group">
                                                
                                                    <button class="btn btn-sm btn-rounded btn-info">Draft Order</button>
                                                    <button class="btn btn-sm btn-rounded btn-primary">Confirm Order</button>
                                                    <button class="btn btn-sm btn-rounded btn-success float-right">Complete Order</button>
                                                
                                            </div>
                                        </form>
                                        <hr>
                                        <div>
                                            <p class="float-left">Delete Order: <button class="btn btn-danger ml-3">Delete</button></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                
                <!-- ============================================================== -->
                <!-- End PAge Content -->
                <!-- ============================================================== -->
            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
@endsection

@section('footer-content')

@endsection