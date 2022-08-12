@extends("template.master")
@section("title")
    Create Blog
@endsection
@section("content")
{{--    @if($errors != [])--}}
{{--        {{$errors}}--}}
{{--    @endif--}}
    <div class="container mt-3">
        <div class="row d-flex justify-content-center">
            <div class="col-10">
                <div>
                    <form action="{{route("blog.store")}}" method="post">
                        @csrf
                        <label for="blog-title">Blog title</label>
                        <input type="text" class="form-control @error("title") is-invalid @enderror" id="blog-title" value="{{old("title")}}" name="title">
                        @error("title")
                            <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                        <label for="blog-description" class="mt-3">Blog description</label>
                        <textarea class="form-control @error("description") is-invalid @enderror" name="description" id="blog-description" cols="30" rows="10">{{old("description")}}</textarea>
                        @error("description")
                            <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                        <button class="btn btn-primary mt-3">Create post</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection
