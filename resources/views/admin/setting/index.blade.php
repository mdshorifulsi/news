@extends('admin_layouts')
@section('title','Setting')
@section('admin_content')
<section class="content">
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <h4 id="listtitle">Setting</h4>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <form action="{{route('admin.setting.update',$setting->id)}}" method="POST" enctype="multipart/form-data" >
                            @csrf
                            <div class="body">
                                <div class="row clearfix">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <label>Project Name</label>
                                                <input type="test" name="project_name" value="{{$setting->project_name}}" class="form-control" >
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <label>email</label>
                                                <input type="email" name="email" value="{{$setting->email}}"  class="form-control" >
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <div class="col-md-6 ">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <img src="{{URL::to($setting->project_logo)}}"style="width: 350px;height: 250px;">
                                            </div>
                                            <input type="hidden" name="old_image" value="{{$setting->project_logo}}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <label>Change Logo</label>
                                                <div class="form-group">
                                                    <input type="file" name="project_logo">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection