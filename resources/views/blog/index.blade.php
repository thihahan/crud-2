@extends("template.master")
@section("content")
    <div class="mt-3 container">
        <div class="row d-flex justify-content-center">
            <div class="col-10">
                @if(session("status"))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{session("status")}}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                <div>
                    <form action="{{route("blog.index")}}" method="get" class="d-flex justify-content-center align-items-center">
                        <input type="text" class="form-control" value="{{request("keyword")}}" name="keyword" style="border-bottom-right-radius: 0!important;border-top-right-radius: 0!important;" placeholder="Search word">
                        <button class="btn btn-outline-primary" style="border-bottom-left-radius: 0!important;border-top-left-radius: 0!important;">Search</button>
                    </form>
                </div>
                    @if($blogs->isNotEmpty())
                        <div class="mt-3">
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th scope="col">No.</th>
                                    <th scope="col">Posts</th>
                                    <th scope="col">Controls</th>
                                    <th scope="col">Date</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($blogs as $blog)
                                    <tr>
                                        <th scope="row">{{$blog->id}}</th>
                                        <td><div>
                                                <p class="mb-0">{{Str::words($blog->title, 7)}}</p>
                                                <p class="mb-0 mt-1">{{Str::words($blog->description, 7)}}</p>
                                            </div>
                                        </td>
                                        <td class="d-flex justify-content-center align-items-center"><a href="{{route("blog.edit", $blog->id)}}" class="btn btn-outline-info">Edit</a>
                                            <form action="{{route("blog.destroy", $blog->id)}}" method="post">
                                                @csrf
                                                @method("delete")
                                                <button class="btn btn-outline-danger">Delete</button>
                                            </form>


                                        </td>
                                        <td >{{$blog->created_at->isoFormat("D-M-Y")}}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        @else
                        <div>
                            <h1 class="text-center mt-3 mb-0">There is no blog</h1>
                        </div>
                    @endif
                <div class="">
                    {{$blogs->links()}}
                </div>
            </div>
        </div>
    </div>
@endsection
