@extends('admin_layouts')
@section('title','Add Post')
@section('admin_content')
<section class="content">
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <button id="btnright"><a id="posthrf" href="{{route('admin.post.index')}}"> All Post</a></button>
                <h4 id="listtitle">Add post</h4>
            </div>
        </div>
        <div class="container-fluid">
                <div class="row clearfix">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="card">
                            <form action="{{route('admin.post.store')}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="body">
                                <label>Post Title Bangla</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" id="title_bn" name="title_bn" class="form-control" placeholder="Enter title (Bangla)">
                                    </div>
                                </div>
                                <label>Post Title English</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" id="title_en" name="title_en" class="form-control" placeholder="Enter title (English)">
                                    </div>
                                </div>
                                <label>Post Body Bangla.......</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <textarea class="form-control" id="exampleFormControlTextarea1" name="body_bn" rows="3"></textarea>
                                    </div>
                                </div>
                                <label>Post Body English......</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <textarea class="form-control" id="exampleFormControlTextarea1" name="body_en" rows="3"></textarea>
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <div class="col-lg-4 col-md-4 col-sm-3 col-xs-4">
                                        <div class="form-group">
                                           <input type="file" name="images_one">
                                        </div>
                                    </div>
                                     <div class="col-lg-4 col-md-4 col-sm-3 col-xs-4">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="test" name="imagesone_title_bn" class="form-control" placeholder="image Title English">
                                            </div>
                                        </div>
                                    </div>

                                     <div class="col-lg-4 col-md-4 col-sm-3 col-xs-4">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="test" name="imagesone_title_en" class="form-control" placeholder="image Title English">
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
                                        <option value="{{$row->id}}">{{$row->catname_bn}} || {{$row->catname_en}}</option>
                                        @endforeach
                                    </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                        <div class="form-group">
                                            <label for="category">Select Tag</label>
                                        <select name="tags[]" id="tag" class="form-control show-tick"  multiple >
                                            @foreach($tag as $tag)
                                            <option value="{{$tag->id}}">{{$tag->tagname_bn}}</option>
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
                                        <option value="{{$row->id}}">{{$row->districtname_bn}} || {{$row->districtname_en}}</option>
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