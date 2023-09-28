@extends('admin_layouts')
@section('title','Tv')
@section('admin_content')
<section class="content">
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
            	<h4 id="listtitle">Live Tv</h4>
            </div>
        </div>
        <div class="container-fluid">
	        <div class="row clearfix">
	            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
	                <div class="card">
	                	<form action="{{route('admin.tv.update',$tv->id)}}" method="POST" enctype="multipart/form-data" >
	                		@csrf
                            <div class="body">
                                <div class="row clearfix">
                                     <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="form-line">
                                            	<label>Tv name</label>
                                                <input type="test" name="tv_name" value="{{$tv->tv_name}}" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                  
                                </div>

                                <div class="row clearfix">
                                     <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="form-line">
                                            	<label>embade_code</label>
                                                <input type="test" name="embade_code" value="{{$tv->embade_code}}" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endsection