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
                <h3>{{ $purchase ? 'Update': 'purchase' }}  product Add</h3>
            </div>
            <div class="card-body">
                <form action="{{$purchase ? url('/purchasePost'.'/'.$purchase->id): url('/purchasePost') }}"
                    class="form" method="post">
                    @csrf
                    <h4>Product Information</h4>

                    <div class="form-group row">

                        <label for="inputEmail3" class="col-sm-2 col-form-label">Name *</label>
                        <div class="col-sm-10">
                              <input type="text" class="form-control" placeholder="Enter Name" name="name"
                                        value="{{ $purchase ? $purchase->name: '' }}"><br>
                        </div>
                        @error('name')
                                <br><span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">Unit *</label>
                        <div class="col-sm-10">
                            <select class="form-control" id="" name="unit">
                                            <option value="">Select Unit</option>
                                            @forelse ($units as $item)
                                            <option value="{{ $item->name }}" @if($purchase) {{ $item->name === $purchase->unit ? "selected": '' }} @endif>{{ $item->name }}</option>
                                            @empty
                                                <span>No units</span>
                                            @endforelse
                                        </select><br>
                        </div>
                        @error('unit')
                                <br><span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">Code</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" placeholder="Enter Code" name="code"
                                        value="{{ $purchase ? $purchase->code: '' }}"><br>
                        </div>
                        @error('code')
                                <br><span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group row">
                         <label for="inputEmail3" class="col-sm-2 col-form-label">Description</label>

                         <div class="col-sm-10">
                              <input type="text" class="form-control" placeholder="Enter Description" name="describtion"
                                        value="{{ $purchase ? $purchase->describtion: '' }}"><br>
                         </div>

                          @error('describtion')
                                <br><span class="text-danger">{{ $message }}</span>
                                @enderror
                    </div>

                    <div class="form-group row">
                         <label for="inputEmail3" class="col-sm-2 col-form-label">Status *</label>
                         <div class="col-sm-10">
                             <input class="form-check-input" type="radio" name="status" value="1"
                                        id="inlineRadio1"
                                        {{ $purchase ? $purchase->status == 1 ? "checked" : "" : "" }}>
                                    <label class="form-check-label" for="inlineRadio1">&nbsp;&nbsp;Active</label>

                                    <input class="form-check-input" type="radio" name="status" value="0"
                                        id="inlineRadio2"
                                        {{ $purchase ? $purchase->status == 0 ? "checked" : "": ""   }}>
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
                <h3>Purchase Product <br> {!! $purchase ? '<a href=" '.url('/purchase').'" class="btn btn-primary">Add
                        Purchase</a>': "" !!} </h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="">
                        <table class="table" id="myTable">
                            <thead>
                                <tr>
                                    <th scope="col">Name</th>
                                    <th scope="col">Unit</th>
                                    <th scope="col">Code</th>
                                    <th scope="col">Describtion</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                @forelse($purchases as $item)
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->unit }}</td>
                                    <td>{{ $item->code }}</td>
                                    <td>{{ $item->describtion }}</td>
                                    <td>{!! !!$item->status ? '<span class="badge bg-success">Active</span>': '<span
                                            class="badge bg-danger">Inactive</span>' !!}</td>
                                    <td><a href="{{ url('/purchase'.'/'.$item->id) }}"
                                            class="btn btn-sm btn-info text-white">Edit</a></td>
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
    $(document).ready(function () {
        $('#myTable').DataTable();
    });

</script>
@endsection
