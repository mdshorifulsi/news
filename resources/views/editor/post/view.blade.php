@extends('admin_layouts')
@section('title','Post view')
@section('admin_content')

<section class="content">
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-xs-12 col-sm-3">
                 <div class="card profile-card">
                    <div class="profile-footer">
                        <ul>
                            <li class="text-center">
                                <strong>Category name</strong>
                            </li>
                            <li>
                                <strong class="text-danger">{{$post->category->catname_bn}} || {{$post->category->catname_en}}</strong>
                            </li>
                            <li class="text-center">
                                <strong>Tags name</strong>
                            </li>
                            <li>
                                @foreach($post->tags as $tag)
                                <strong>{{$tag->tagname_bn}} || {{$tag->tagname_en}} </strong>
                                @endforeach
                                </li>
                                <li class="text-center">
                                    <strong>District name</strong>
                                </li>
                                <li>
                                    <strong class="text-danger">{{$post->district->districtname_bn}} || {{$post->district->districtname_en}}</strong>
                                </li>
                                <hr>
                                 <button id="postbtn">
                                    <a id="posthrf" href="{{route('editor.post.index')}}">Back to All Post</a>
                                 </button>
                            </ul>
                        </div>
                    </div>  
                </div>
                <div class="col-xs-12 col-sm-9">
                    <div class="card">
                        <div class="body">
                            <div>
                                <div class="tab-content">
                                    <div role="tabpanel" class="tab-pane fade in active" id="home">
                                        <div class="panel panel-default panel-post">
                                            <div class="panel-heading">
                                                <div class="media">
                                                    
                                                    <div class="media-body">
                                                        <h4 class="media-heading">
                                                            
                                  
                                           post Title Bangla: {{$post->title_bn}}
                                      <br>
                                      <br>
                                           post Title English:  {{$post->title_en}}
                                            <hr>
                                        </h4>
                                            post Created :    {{$post->created_at}}
                                        </div>
                                     </div>
                                    </div>
                                    <div class="panel-body">
                                        <div class="post">       
                                            <div class="post-content">
                                                <img src="{{asset($post->images_one)}}" class="img-responsive" />
                                            </div>
                                            <div class="post-heading">
                                            Post Body Bangla 
                                            <p>{{$post->body_bn}}</p>
                                            <hr>
                                            post Body English 
                                            <p>{{$post->body_en}}</p>
                                    </div>
                                    </div>
                                </div>
                             </div>
                         </div>
                        </div>
                    </div>
                </div>
            </div>
            </div>
            </div>
        </div>
    </section>
@endsection