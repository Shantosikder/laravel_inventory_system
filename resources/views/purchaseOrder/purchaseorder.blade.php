@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="card">
            <div class="card-header">
                <h3>Purchase Order</h3>
            </div>
            <div class="card-body">
                <form action="{{ url('/purchaseorderPost') }}" class="form" method="post">
                    @csrf
                    <h4>Order Information</h4>
                    <div class="row">
                        <div class="row">
                            <div class="col-4">
                                <div class="form-group">
                                    <div class="col-lg-10">
                                        <label for="">Supplier * </label><br>
                                        <select name="supplier" id="" class="form-control">
                                            <option value="">Seleect One</option>
                                            @forelse($suppliers as $supplier)
                                            <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                                            @empty
                                            <span>No Supplier</span>
                                            @endforelse
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <div class="col-lg-10">
                                        <label for="">Date * </label><br>
                                        <div class="form-check-inline col-lg-12">
                                            <input type="date" class="form-control" name="date">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <div class="col-lg-10">
                                        <label for="">Order No. </label><br>
                                        <div class="form-check-inline col-lg-12">
                                            <input type="text" class="form-control" name="order_no" placeholder="Order No.">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><br><br>
             
                    <table class="table table-light table-striped table-bordered ">
                        <thead class="thead-light">
                            <tr>
                                <th>Product name</th>
                                <th>Quantity</th>
                                <th>Unit price</th>
                                <th>Total cost</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody id="productsHolder">
                      
                                <tr id="product1" class="addedProducts">
                                    <td>
                                        <select name="product_name[]" id="" class="form-control">
                                            <option value="">Select One</option>
                                            @forelse($purchases as $purchase)
                                            <option value="{{ $purchase->name }}">{{ $purchase->name }}</option>
                                            @empty
                                            <span>No Supplier</span>
                                            @endforelse
                                        
                                        </select>
                                    </td>
                                    <td>
                                        <input type="number"  name="quantity[]" oninput="onQuantityChange(event)" class="form-control">
                                    </td>
                                    <td><input type="number"  name="unit_price[]" class="form-control" oninput="onPriceChange(event)"></td>
                                    <td class="total">৳<span>0.00</span></td>
                                    <td><button type="button" class="btn btn-danger" onclick="onDelete('product1')">X</button></td>
                                </tr>
                         

                        </tbody>
                        <tfoot>
                            <tr>
                                <td><button type="button" class="btn btn-info text-white" onclick="onProductAdd()">Add Product</button></td>
                                <td colspan="2"><strong>Total Amount</strong></td>
                                <td><strong> ৳<span id="grandTotal">0.00</span></strong></td>
                                <td></td>
                            </tr>

                        </tfoot>
                    </table>
                    <button class="btn btn-primary btn-block">Save</button>
                </form>
            </div>
        </div>
    </div>
</div>



@section('script-section')
    <script>
        
        const calculateGrandTotal = () => {
            const totalContainer = document.querySelectorAll('.total');
            let grandTotal = 0;
            totalContainer.forEach(element => {
               grandTotal += parseFloat(element.children[0].innerText);
            });
            $('#grandTotal').text(grandTotal);
        }
        const onDelete = (id) => {
            $('#'+id).remove();
            calculateGrandTotal();
        }

        const onProductAdd = () => {
            const countAddedProducts = document.querySelectorAll('.addedProducts').length + 1;
            $('#productsHolder').append(`  <tr id="product${countAddedProducts}" class="addedProducts">
                                    <td>
                                        <select name="product_name[]" id="" class="form-control">
                                            <option value="">Select One</option>
                                            @forelse($purchases as $purchase)
                                            <option value="{{ $purchase->name }}">{{ $purchase->name }}</option>
                                            @empty
                                            <span>No Products</span>
                                            @endforelse
                                        
                                        </select>
                                    </td>
                                    <td>
                                        <input type="number"  name="quantity[]" oninput="onQuantityChange(event)" class="form-control">
                                    </td>
                                    <td><input type="number"  name="unit_price[]" class="form-control" oninput="onPriceChange(event)"></td>
                                    <td class="total">৳<span>0.00</span></td>
                                    <td><button type="button" class="btn btn-danger" onclick="onDelete('product${countAddedProducts}')">X</button></td>
                                </tr> `)
           
        }

        
        const onQuantityChange = (e) => {
            const quantity = e.target.value;
            const price = e.target.parentNode.parentNode.children[2].children[0].value;
            const container = e.target.parentNode.parentNode.children[3].children[0];
            if(price !== ""){
                container.innerHTML = quantity*price
                calculateGrandTotal()
            }
        }
        const onPriceChange = (e) => {
            const price = e.target.value;
            const quantity = e.target.parentNode.parentNode.children[1].children[0].value;
            const container = e.target.parentNode.parentNode.children[3].children[0];
            if(quantity !== ""){
                container.innerHTML = quantity*price
                calculateGrandTotal()
            }
        }
    </script>
@endsection
@endsection

