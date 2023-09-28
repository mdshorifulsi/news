@extends('admin_layouts')
@section('title','Update Post')
@section('admin_content')
<section class="content">
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <button type="button" id="btnright" class="btn btn-primary  waves-effect m-r-20" > + All Post
                </button>
                <h4 id="listtitle">Update post</h4>
            </div>
        </div>
        <div class="container-fluid">
            
                <div class="row clearfix">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="card">

                            <form action="{{route('admin.post.update',$post->id)}}" method="POST" enctype="multipart/form-data">
                                @csrf
                            <div class="body">
                                <label>Post Title Bangla</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" id="title_bn" name="title_bn" value="{{$post->title_bn}}" class="form-control" placeholder="Enter title (Bangla)">
                                    </div>
                                </div>
                                <label>Post Title English</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" id="title_en" name="title_en" value="{{$post->title_en}}" class="form-control" placeholder="Enter title (English)">
                                    </div>
                                </div>
                                <label>Post Body Bangla.......</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <textarea class="form-control" id="exampleFormControlTextarea1" name="body_bn" rows="5">{{$post->body_bn}}
                                        </textarea>
                                    </div>
                                </div>
                                <label>Post Body English......</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <textarea class="form-control" id="exampleFormControlTextarea1" name="body_en" rows="5">{{$post->body_en}}
                                        </textarea>
                                    </div>
                                </div>


                                <div class="row clearfix">
                                    <div class="col-lg-4 col-md-4 col-sm-3 col-xs-4">
                                        <label for="category"> Add new Image </label>
                                        <div class="form-group">
                                           <input type="file" name="images_one">
                                        </div>
                                    </div>
                                <div class="col-lg-4 col-md-4 col-sm-3 col-xs-4">
                                    <label for="category">Old Image </label>
                                        <img src="{{URL::to($post->images_one)}}"style="width: 350px;height: 250px;">
                                            <input type="hidden" name="old_image" value="{{$post->images_one}}">
                                        </div>
                                    </div>
                                     
                                <div class="row clearfix">
                                    <div class="col-md-6 ">

                                        <div class="form-group">
                                            <label for="category"> Image title Bangla </label>
                                            <div class="form-line">
                                                <input type="test" name="imagesone_title_bn" value="{{$post->imagesone_title_bn}}" class="form-control" placeholder="image Title English">
                                            </div>
                                        </div>
                                    </div>

                                     <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="category"> Image title English </label>
                                            <div class="form-line">
                                                <input type="test" name="imagesone_title_en"  value="{{$post->imagesone_title_en}}" class="form-control" placeholder="image Title English">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row clearfix">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                    <div class="form-group">
                                        <label for="category">Select Category</label>
                                        <select class="form-control" id="category_id" name="category_id">
                                        <option> >> Select Category Name...</option>
                                        @foreach($category as $row)
                                        <option
                                        {{$row->id==$post->id ? 'selected': ''}}
                                         value="{{$row->id}}">{{$row->catname_bn}} || {{$row->catname_en}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                <div class="form-group">
                                    <label for="category">Select Tag</label>
                                        <select name="tags[]" id="tag" class="form-control show-tick"  multiple >
                                            @foreach($tag as $tag)
                                            <option 
                                            @foreach($post->tags as $post_tag)
                                            {{$post_tag->id==$tag->id ? 'selected': ''}}
                                            @endforeach

                                            value="{{$tag->id}}">{{$tag->tagname_bn}} || {{$tag->tagname_en}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                    <div class="form-group">
                                        <label for="category">Select District</label>
                                         <select class="form-control" id="district_id" name="district_id">
                                        <option> >> Select District Name...</option>
                                        @foreach($district as $row)
                                        <option
                                        {{$row->id==$post->id ? 'selected': ''}}

                                         value="{{$row->id}}">{{$row->districtname_bn}} || {{$row->districtname_en}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="reset" id="reset" class="btn btn-danger" value="Reset">reset</button>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</section>


@endsection