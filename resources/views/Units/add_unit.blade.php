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
                <h3>{{ $unit ? 'Update': 'Unit' }} Add</h3>
            </div>
            <div class="card-body">
                <form action="{{$unit ? url('/addUnitUpdate'.'/'.$unit->id): url('/addunit') }}" class="form" method="post">
                    @csrf
                    <h4>Unit Information</h4>
                    
                     <div class="form-group row">
                     <label for="inputEmail3" class="col-sm-2 col-form-label">Name *</label>
                        <div class="col-sm-10">
                        <input type="text" name="name" value="{{ $unit ? $unit->name: "" }}" class="form-control" id="inputEmail3" placeholder="Enter Name">
                           </div>
                               @error('name')
                                    <br><span class="text-danger">{{ $message }}</span>
                                @enderror
                              </div> <br>
                              {{-- input form end --}}

                              <div class="form-group row">
                                  <label for="inputEmail3" class="col-sm-2 col-form-label">Status *</label>
                                  <div class="col-sm-10">

                                     <input class="form-check-input" type="radio" name="status" value="1"
                                        id="inlineRadio1" {{ $unit ? $unit->status == 1 ? "checked" : "" : "" }}>
                                    <label class="form-check-label" for="inlineRadio1" >&nbsp;&nbsp;Active</label>

                                      <input class="form-check-input" type="radio" name="status" value="0" id="inlineRadio2"
                                        {{ $unit ? $unit->status == 0 ? "checked" : "": ""   }}>
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
            <div>
                <div class="card-header">
                    <h3>Unit <br>{!! $unit ? '<a href=" '.url('/addunit').'" class="btn btn-primary">Add Unit</a>': "" !!}  </h3>
            </div>
            <div class="card-body">
                <h4>Unit Information</h4>
                <div class="row">
                    <div class="col-lg-12">
                        <table class="table" id="myTable">
                            <thead>
                                <tr>
                                    <th scope="col">Name</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($units as $item)
                                    
                                <tr>
                                    <td>{{ $item->name }}</td>
                                    <td>{!! !!$item->status ? '<span class="badge bg-success">Active</span>': '<span class="badge bg-danger">Inactive</span>'  !!}</td>
                                    <td><a href="{{ url('/addunit'.'/'.$item->id) }}" class="btn btn-sm btn-info text-white">Edit</a></td>
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
</div>
@endsection

@section('script-section')
    <script>
        $(document).ready( function () {
            $('#myTable').DataTable();
        } );
    </script>
@endsection
