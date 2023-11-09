@extends('dashboard.layouts.master');

@section('content')

<div class="pagetitle">
    <h1>Dashboard</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
        <li class="breadcrumb-item active">Dashboard</li>
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
                    <h5 class="card-title">Blogs</h5>
                </div>
                <div class="float_right">
                    <h5 class="card-title"><a href="#" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal">Create New</a></h5>
                </div>

                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th scope="col">Post Image</th>
                      <th scope="col">Title</th>
                      <th scope="col">Description</th>
                      <th scope="col">Category</th>
                      <th scope="col">Tag</th>
                      <th scope="col">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($articles as $article)
                        <tr>
                            <td><img src="{{ asset('storage/BlogImages/' . $article->image); }}" alt="blogImg"></td>
                            <td>{{ substr($article->title,0,50).".. " }}</td>
                            <td>{{ substr($article->description,0,150).".. " }}</td>
                            <td>{{$article->category->name}}</td>
                            <td>
                                <ul>                   
                                    @foreach ($article->AllTags as $item)
                                        <li>{{$item}}</li>
                                    @endforeach
                                </ul>
                            </td>
                            <td>
                                <a href="#" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#editModal_{{ $loop->iteration }}">Edit</a>
                                <a href="{{ route('delete.blog', encrypt($article->article_id)) }}" class="btn btn-danger">Delete</a>
                            </td>
                        </tr>

                        <!-- Modal -->
                        <div class="modal fade" id="editModal_{{ $loop->iteration }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Edit Blog</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                

                                    <form method="post" action="{{ route('edit.blog') }}" enctype="multipart/form-data">
                                        @csrf
                                        <div class="mb-3">
                                            <label for="" class="form-label">Title</label>
                                            <input type="text" class="form-control" name='title' value="{{$article->title}}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="" class="form-label">Description</label>
                                            <textarea class="form-control" name='description' required>{{$article->description}}</textarea>
                                        </div>

                                        <div class="mb-3">
                                            <label for="" class="form-label">Category</label>
                                            <select class="form-control" name='category' required>>
                                                <option value="">Select Category</option>
                                                @foreach ($categories as $category)
                                                    <option value="{{$category->category_id}}" {{ ($category->category_id == $article->category_id) ? 'selected' : '' }} >{{ $category->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="mb-3">
                                            <label for="" class="form-label">Tags</label>
                                            <select class="js-example-basic-multiple" name="tags[]" multiple="multiple" required>
                                                @foreach ($tags as $tag)
                                                    <option value="{{$tag->tag_id}}">{{ $tag->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="mb-3">
                                            <label for="" class="form-label">Image</label>
                                            <input type="file" class="form-control" name='image'>
                                        </div>

                                        <input type="text" name="image-old" value="{{$article->image}}">
                                        <input type="text" name="article_id" value="{{$article->article_id}}">

                                        <button type="submit" class="btn btn-primary" style="margin-right: 10px">Update</button>
                                    </form>

                                </div>
                            </div>
                            </div>
                        </div>

                    @endforeach
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
          <h5 class="modal-title" id="exampleModalLabel">Create New Blog</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          

            <form method="post" action="{{ route('add.blog') }}" enctype="multipart/form-data">
                  @csrf
                  <div class="mb-3">
                    <label for="" class="form-label">Title</label>
                    <input type="text" class="form-control" name='title' required>
                  </div>
                  <div class="mb-3">
                    <label for="" class="form-label">Description</label>
                    <textarea class="form-control" name='description' required></textarea>
                  </div>

                  <div class="mb-3">
                    <label for="" class="form-label">Category</label>
                    <select class="form-control" name='category' required>>
                        <option value="">Select Category</option>
                        @foreach ($categories as $category)
                            <option value="{{$category->category_id}}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                  </div>

                  <div class="mb-3">
                    <label for="" class="form-label">Tags</label>
                    <select class="js-example-basic-multiple" name="tags[]" multiple="multiple" required>
                        @foreach ($tags as $tag)
                            <option value="{{$tag->tag_id}}">{{ $tag->name }}</option>
                        @endforeach
                      </select>
                  </div>

                  <div class="mb-3">
                    <label for="" class="form-label">Image</label>
                    <input type="file" class="form-control" name='image'>
                  </div>


                  <button type="submit" class="btn btn-primary" style="margin-right: 10px">Create</button>
            </form>

        </div>
      </div>
    </div>
  </div>



  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

  

  <script>
  $(document).ready(function() {
    $('.js-example-basic-multiple').select2();
});
</script>


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
.select2.select2-container {
	width: 100% !important;
}
.select2-container .select2-dropdown {
    z-index: 9999;
}

</style>


@endsection