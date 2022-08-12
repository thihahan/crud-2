<?php

namespace App\Http\Controllers;
use App\Models\Blog;
use App\Http\Requests\StorerRequest;
use App\Http\Requests\UpdaterRequest;
use App\Models\r;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $blogs = Blog::when(request("keyword"), function($q){
            $keyword = request("keyword");
            $q->where("title", "like", "%$keyword%")
                ->orwhere("description", "like", "%$keyword%")->paginate(10);
        })->paginate(10)->withQueryString();
//        $blogs = Blog::where("id",">", 1)->orwhere("title", "like", "%blog%")->get(); // default is =
//        $blogs = Blog::whereIn("id", [4, 6, 3])->get();
//        $blogs = Blog::all()->pluck("id", "title");
//        $blogs = Blog::whereBetween("id", [4, 16])->latest("id")->get();
//        $blogs = Blog::where("id", "<", "10")->get()->Map(function($blog){
//            $blog->title = strtoupper($blog->title);
//            return $blog;
//        });
        // if you use paginate use through method
//        $blogs = Blog::paginate(10)->Through(function($blog){
//            $blog->title = strtoupper($blog->title);
//            return $blog;
//        });
//        $blogs = Blog::whereBetween("id", [4, 16])->orderBy("id", "desc")->get();
//        return $blogs;
        return view("blog.index", compact("blogs"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("blog.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorerRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorerRequest $request)
    {
        $blog = new Blog();
        $blog->title = $request->title;
        $blog->description = $request->description;
        $blog->save();
        return redirect()->route("blog.index")->with("status", "Post created successfully.");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\r  $r
     * @return \Illuminate\Http\Response
     */
    public function show(r $r)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Blog  $r
     * @return \Illuminate\Http\Response
     */
    public function edit(Blog $blog)
    {
        return view("blog.edit", compact("blog"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdaterRequest  $request
     * @param  \App\Models\Blog  $r
     * @return \Illuminate\Http\Response
     */
    public function update(UpdaterRequest $request, Blog $blog)
    {
        $blog->title = $request->title;
        $blog->description = $request->description;
        $blog->update();
        return redirect()->route("blog.index")->with("status", "Post updated successfully.")->with("status", "post updated successfully.");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Request
     */
    public function destroy(Blog $blog)
    {
        $blog->delete();
        return redirect()->route("blog.index")->with("status", "post deleted successfully");
    }
}
