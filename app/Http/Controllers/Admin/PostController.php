<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\District;
use App\Models\Category;
use App\Models\Tag;
use Brian2694\Toastr\Facades\Toastr;
use Str;
use Auth;
use File;

class PostController extends Controller
{
    public function index()
    {
        $post = Post::with('category')->latest()->get();
        return view('admin.post.index', compact('post'));
    }

    public function create()
    {
        $district = District::get();
        $category = Category::get();
        $tag = Tag::get();


        return view('admin.post.create', compact('district', 'category', 'tag'));
    }

    public function store(Request $request)
    {
        $post = new post;
        $post->title_bn = $request->title_bn;
        $post->category_id = $request->category_id;
        $post->title_en = $request->title_en;
        $post->slug_bn = Str::slug($request->title_bn);
        $post->slug_en = Str::slug($request->title_en);
        $post->body_bn = $request->body_bn;
        $post->body_en = $request->body_en;
        $post->district_id = $request->district_id;
        $post->user_id = Auth::id();
        $post->imagesone_title_bn = $request->imagesone_title_bn;
        $post->imagesone_title_en = $request->imagesone_title_en;

        if ($request->hasFile('images_one')) {
            $file = $request->file('images_one');
            $name = rand(11111, 99999) . '.' . $file->getClientOriginalExtension();
            $post->images_one = $request->file('images_one')->move("images/post_images", $name);
        }



        $post->save();

        // $post->categories()->attach($request->categories);
        $post->tags()->attach($request->tags);

        Toastr::success('Post Insert successfully Saved:', 'success');
        return redirect()->route('admin.post.index');

    }

    public function edit($id)
    {

        $post = Post::find($id);
        $category = Category::get();
        $tag = Tag::get();
        $district = District::get();

        return view('admin.post.edit', compact('post', 'category', 'tag', 'district'));

    }

    public function update(Request $request, $id)
    {

        $post = Post::find($id);
        $post->title_bn = $request->title_bn;
        $post->category_id = $request->category_id;
        $post->title_en = $request->title_en;
        $post->slug_bn = Str::slug($request->title_bn);
        $post->slug_en = Str::slug($request->title_en);
        $post->body_bn = $request->body_bn;
        $post->body_en = $request->body_en;
        $post->district_id = $request->district_id;
        $post->user_id = Auth::id();
        $post->imagesone_title_bn = $request->imagesone_title_bn;
        $post->imagesone_title_en = $request->imagesone_title_en;

        if ($request->hasFile('images_one')) {
            $file = $request->file('images_one');
            $name = rand(11111, 99999) . '.' . $file->getClientOriginalExtension();
            $post->images_one = $request->file('images_one')->move("images/post_images", $name);
        }

        $post->save();
        $post->tags()->sync($request->tags);

        return redirect()->route('admin.post.index');
    }


    public function destroy($id)
    {

        $post = Post::find($id);


        if (File::exists($post->images_one)) {
            File::delete($post->images_one);
        }

        $post->tags()->detach();
        $post->delete();
        Toastr::error('Post Deleted successfully:', 'Deleted');
        return redirect()->route('admin.post.index');

    }


    public function view($id)
    {
        $post = Post::find($id);

        return view('admin.post.view', compact('post'));

    }


    public function inactive($id)
    {

        Post::where('id', $id)
            ->update(['status' => 0]);
        return response()->json([
            'status' => 'success',
        ]);

    }

    public function active($id)
    {

        Post::where('id', $id)
            ->update(['status' => 1]);
        return response()->json([
            'status' => 'success',
        ]);
    }



    public function big_thumbnail_no($id)
    {

        Post::where('id', $id)
            ->update(['big_thumbnail' => 0]);
        return response()->json([
            'status' => 'success',
        ]);

    }

    public function big_thumbnail_yes($id)
    {

        Post::where('id', $id)
            ->update(['big_thumbnail' => 1]);
        return response()->json([
            'status' => 'success',
        ]);
    }


    public function first_section_no($id)
    {

        Post::where('id', $id)
            ->update(['first_section' => 0]);
        return response()->json([
            'status' => 'success',
        ]);

    }

    public function first_section_yes($id)
    {

        Post::where('id', $id)
            ->update(['first_section' => 1]);
        return response()->json([
            'status' => 'success',
        ]);
    }

}