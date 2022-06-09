@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="card">
            @if (session('success'))
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <div class="card-header">
                <h3>{{ $supplier ? 'Update': 'Supplier' }}  Add</h3>
            </div>
            <div class="card-body">
                <form action="{{$supplier ? url('/supplierPost'.'/'.$supplier->id): url('/supplierPost') }}" class="form" method="post">
                    @csrf
                    <h4>Supplier Information</h4>

                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">Name *</label>
                        <div class="col-sm-10">

                             <input type="text" class="form-control" placeholder="Enter Name" name="name" value="{{ $supplier ? $supplier->name: "" }}"><br>
                        </div>

                        @error('name')
                                    <br><span class="text-danger">{{ $message }}</span>
                        @enderror  
                    </div>

                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">                Company Name *</label>

                        <div class="col-sm-10">
                              <input type="text" class="form-control" placeholder="Enter Company Name" name="company_name" value="{{ $supplier ? $supplier->company_name: "" }}"><br>
                        </div>
                         @error('company_name')
                                    <br><span class="text-danger">{{ $message }}</span>
                                @enderror
                        
                    </div>

                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">   Mobile No *</label>

                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="mobile" placeholder="Enter Mobile No" value="{{ $supplier ? $supplier->mobile: "" }}"><br>
                        </div>
                         @error('mobile')
                                    <br><span class="text-danger">{{ $message }}</span>
                                @enderror
                    </div>

                    <div class="form-group row">
                         <label for="inputEmail3" class="col-sm-2 col-form-label">Address *</label>

                         <div class="col-sm-10">
                             <input type="text" class="form-control" placeholder="Enter Addess" name="address" value="{{ $supplier ? $supplier->address: "" }}"><br>
                         </div>
                          @error('address')
                                    <br><span class="text-danger">{{ $message }}</span>
                                @enderror
                    </div>

                     @if ($supplier)
                            <div class="form-group row">
                                 <label for="inputEmail3" class="col-sm-2 col-form-label">Opening due *</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="opening_due" value="{{ $supplier ? $supplier->opening_due: "" }}">
                                </div>
                                @error('opening_due')
                                    <br><span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            @endif

                    <div class="form-group row">
                         <label for="inputEmail3" class="col-sm-2 col-form-label">Status *</label>

                         <div class="col-sm-10">

                            <input class="form-check-input" type="radio" name="status" value="1"
                                        id="inlineRadio1" {{ $supplier ? $supplier->status == 1 ? "checked" : "" : "" }}>
                                         <label class="form-check-label" for="inlineRadio1" >&nbsp;&nbsp;Active</label>

                                          <input class="form-check-input" type="radio" name="status" value="0" id="inlineRadio2"
                                        {{ $supplier ? $supplier->status == 0 ? "checked" : "": ""   }}>

                                         <label class="form-check-label" for="inlineRadio2">&nbsp;&nbsp;Inactive</label>
                         </div>
                          @error('status')
                                    <br><span class="text-danger">{{ $message }}</span>
                                @enderror
                    </div>

                    <button class="btn btn-primary btn-block">SAVE</button>
                </form>
            </div>
        </div>
        <div class="card mt-5">
            <div class="card-header">
                <h3>Supplier <br> {!! $supplier ? '<a href=" '.url('/supplier').'" class="btn btn-primary">Add Supplier</a>': "" !!}  </h3>
            </div>
            <div class="card-body">

                <div class="row">
                    <div class="">
                        <table class="table" id="myTable">
                            <thead>
                                <tr>
                                    <th scope="col">Name</th>
                                    <th scope="col">Company Name</th>
                                    <th scope="col">Mobile</th>
                                    <th scope="col">Address</th>
                                    <th scope="col">Opening Due</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($suppliers as $item)
                                    
                                <tr>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->company_name }}</td>
                                    <td>{{ $item->mobile }}</td>
                                    <td>{{ $item->address }}</td>
                                    <td>৳ {{ $item->opening_due }}</td>
                                    <td>{!! !!$item->status ? '<span class="badge bg-success">Active</span>': '<span class="badge bg-danger">Inactive</span>'  !!}</td>
                                    <td><a href="{{ url('/supplier'.'/'.$item->id) }}" class="btn btn-sm btn-info text-white">Edit</a></td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="100" class="text-center">No units found</td>
                                </tr>
                                    
                                @endforelse
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script-section')
    <script>
        $(document).ready( function () {
            $('#myTable').DataTable();
        } );
    </script>
@endsection
