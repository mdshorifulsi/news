@extends('admin_layouts')
@section('title','Namaz')
@section('admin_content')
<section class="content">
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
    
                <h4 id="listtitle">Namaj Time</h4>
            </div>
        </div>
        <div class="container-fluid">
            
                <div class="row clearfix">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="card">

                            <form action="{{route('admin.namaj.update',$namaj->id)}}" method="POST" enctype="multipart/form-data" >
                                @csrf
                                <div class="body">
                                    <div class="row clearfix">
                                        <div class="col-lg-4 col-md-4 col-sm-3 col-xs-4">
                                        <div class="form-group">
                                            <div class="form-line">
                                            	<label>Fojor</label>
                                                <input type="test" name="fojor" value="{{$namaj->fojor}}" class="form-control" placeholder="image Title English">
                                            </div>
                                        </div>
                                    </div>

                                     <div class="col-lg-4 col-md-4 col-sm-3 col-xs-4">
                                        <div class="form-group">
                                            <div class="form-line">
                                            	<label>Johor</label>
                                                <input type="test" name="johor" value="{{$namaj->johor}}"  class="form-control" placeholder="image Title English">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-4 col-md-4 col-sm-3 col-xs-4">
                                        <div class="form-group">
                                            <div class="form-line">
                                            	<label>Asor</label>
                                                <input type="test" name="asor" value="{{$namaj->asor}} " class="form-control" placeholder="image Title English">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-4 col-md-4 col-sm-3 col-xs-4">
                                        <div class="form-group">
                                            <div class="form-line">
                                            	<label>Magrib</label>
                                                <input type="test" name="magrib" value="{{$namaj->magrib}}" class="form-control" placeholder="image Title English">
                                            </div>
                                        </div>
                                    </div>

                                     <div class="col-lg-4 col-md-4 col-sm-3 col-xs-4">
                                        <div class="form-group">
                                            <div class="form-line">
                                            	<label>Esha</label>
                                                <input type="test" name="esha" value="{{$namaj->esha}}" class="form-control" placeholder="image Title English">
                                            </div>
                                        </div>
                                    </div>

                                     <div class="col-lg-4 col-md-4 col-sm-3 col-xs-4">
                                        <div class="form-group">
                                            <div class="form-line">
                                            	<label>Jumma</label>
                                                <input type="test" name="jummah" value="{{$namaj->jummah}}" class="form-control" placeholder="image Title English">
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