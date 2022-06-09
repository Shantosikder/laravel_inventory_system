@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="card">
            <div class="card-header d-grid gap-2 d-md-flex justify-content-between">
                <h3 class="pt-1">Purchase Receipt Details</h3>
                <button class="btn btn-primary me-md-2" type="button" onclick="print()">Print</button>
            </div>
            <div class="card-body">
                <div class="row col-lg-12">
                    <div class="col-lg-6">
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <th>Order No</th>
                                    <td>{{ $order_no }}</td>
                                </tr>
                                <tr>
                                    <th>Order Date</th>
                                    <td>{{ $orderDate }}</td>
                                </tr>
                                <tr>
                                    <th>Recived Date</th>
                                    <td></td>
                                    
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-lg-6">
                        <table class="table table-bordered">     
                            <tbody> 
                            <tr>
                                 <th colspan="2" class="text-center">Supplier Info</th>
                            </tr>          
                                <tr> 
                                    <th >Name</th>
                                    <td>{{ $supplier->name }}</td>
                                </tr>
                                <tr>
                                    <th>Company Name</th>
                                    <td>{{ $supplier->company_name }}</td>
                                </tr>
                                <tr>
                                    <th>Mobile</th>
                                    <td>{{ $supplier->mobile }}</td>
                                    
                                </tr>
                                <tr>
                                        <th>Address</th>
                                        <td>{{ $supplier->address }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row col-lg-12">
                    <div class="col-lg-12">
                        <table class="table table-bordered">
                            <thead>
                                <tr class="text-center">
                                    <th>Product Name</th>
                                    <th>Quantity</th>
                                    <th>Unit Price</th>
                                     <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($allOrders as $item)
                                    <tr>
                                        <td class="text-center">{{ $item['product_name'] }}</td>
                                        <td class="text-center">{{ $item['quantity'] }}</td>
                                        <td class="text-center">৳{{ $item['unit_price'] }}</td>
                                        <td class="text-center">৳{{ $item['total'] }}</td>
                                    </tr>
                                    
                                @empty
                                    <tr>
                                        <td colspan="100" class="text-center">No products</td>
                                    </tr>
                                @endforelse         
                              
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="row col-lg-12">
                    <div class="col-lg-4"></div>
                    <div class="col-lg-4"></div>
                    <div class="col-lg-4">
                        <table class="table table-bordered align-right">
                            <tbody class="">
                                <tr >
                                    <th>Total Amount</th>
                                    <td>৳{{ $grandTotal }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection