@extends('dashboard.layouts.master');

@section('content')

<div class="pagetitle">
    <h1>Tags</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
        <li class="breadcrumb-item active">Tags</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <section class="section dashboard">
    <div class="row">

      <!-- Left side columns -->
      <div class="col-lg-12">
        <div class="row">

          

          <div class="col-12">
            <div class="card top-selling overflow-auto">


              <div class="card-body pb-0">
                <div class="float_left">
                    <h5 class="card-title">Tag List</h5>
                </div>
                <div class="float_right">
                    <h5 class="card-title"><a href="#" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal">Create New</a></h5>
                </div>

                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th scope="col">No</th>
                      <th scope="col">Category Name</th>
                      <th scope="col">Created At</th>
                      <th scope="col">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($tags as $tag)
                      <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $tag->name }}</td>
                        <td>{{ $tag->created_at }}</td>
                        <td><a href="{{ route('delete.tag', encrypt($tag->tag_id)) }}" class="btn btn-danger">Delete</a></td>
                      </tr>
                    @endforeach
                    
                  </tbody>
                  <tbody>
                    
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>

    </div>
  </section>

  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Create New Tag</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form method="post" action="{{ route('create.tag') }}">
              @csrf
              <div class="row">
                <div class="col-md-9">
                  <input type="name" class="form-control" placeholder="Enter Tag Name" name='name'>
                </div>
                <div class="col-md-2">
                  <button type="submit" class="btn btn-primary" style="margin-right: 10px">Create</button>
                </div>
              </div>
            </form>
        </div>

      </div>
    </div>
  </div>
  
<style>
.float_left {
	width: 30%;
	float: left;
}
.float_right {
	width: 30%;
	float: right;
	text-align: right;
}
.float_left h5 {
	font-size: 27px;
	margin-top: 4px;
}
</style>


@endsection