@extends("template.master")
@section("title")
    Edit Blog
@endsection
@section("content")
    <div class="container mt-3">
        <div class="row d-flex justify-content-center">
            <div class="col-10">
                <div>
                    <form action="{{route("blog.update", $blog->id)}}" method="post">
                        @csrf
                        @method("put")
                        <label for="blog-title">Blog title</label>
                        <input type="text" class="form-control" id="blog-title" value="{{$blog->title}}" name="title">
                        <label for="blog-description" class="mt-3">Blog description</label>
                        <textarea class="form-control" name="description" id="blog-description" cols="30" rows="10">{{$blog->description}}</textarea>
                        <button class="btn btn-primary mt-3">Create post</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection
