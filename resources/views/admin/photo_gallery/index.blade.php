@extends('admin_layouts')
@section('title','Photo Gallery')
@section('admin_content')
<section class="content">
    <div class="r ow clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <button type="button" id="btnright" class="btn btn-primary  waves-effect m-r-20" data-toggle="modal" data-target="#addPhoto"> + Add Photo</button>
                <h4 id="listtitle">All Photo list</h4>
            </div>

            <div class="card">
                <div class="body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                            <thead>
                                <tr>
                                    <th>S.no</th>
                                    <th>photo</th>
                                    <th>photo name Bangla</th>
                                    <th>Category English</th>   
                                    <th>photo credit</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($photo_gallery as $key=>$row)
                                <tr>
                                    <td>{{ ++$key }}</td>
                                    <td>
                                    	<img src="{{ asset($row->photo) }}"  width="150" height="100px">
                                    </td>
                                    <td>{{$row->photo_name_bn}}</td>
                                    <td>{{$row->photo_name_en}}</td>
                                    <td>{{$row->photo_credit}}</td>
                                    <td>

                                    @if($row->status==1)
                                    <span class="badge btn-success">Active</span>
                                    @else
                                  
                                  <span class="badge btn-danger">In Active</span>
                                    @endif
                                    </td>
                                    <td>
                                        @if($row->status==1)
                                        <a href="" class="btn btn-sm btn-danger inactive " data-id="{{$row->id}}"><i class="material-icons">thumb_down</i></a>
                                        @else
                                    <a href=""  class="btn btn-sm btn-success active" data-id="{{$row->id}}"> <i class="material-icons">thumb_up</i></a>
                                    @endif

                                    <button class="btn btn-danger" type="button" onclick="deletePhoto({{ $row->id }})"><i class="material-icons">delete</i></button>
                                      <form id="delete-form-{{$row->id}}" action="{{route('admin.photo_gallery.delete',$row->id)}}"  method="PUT" style="display: none ; " >
                                      @csrf
                                      @method('DELETE')
                                      </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- insert data modal -->
    <div class="modal fade" id="addPhoto" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="defaultModalLabel">Insert Photo</h4>
                    <span id="errormsg"></span>
                </div>
                <div class="modal-body">
                    <form action="" id="addPhotoForm" method="POST" enctype="multipart/form-data" >
                        @csrf
                        <div class="row">
                        	<div class="col-md-6">
                        <div class="form-group">
                            <label>Photo name Bangla:</label>
                            <input type="text" id="photo_name_bn"  name="photo_name_bn"class="form-control" placeholder="  photo name Bangla">
                           
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Photo name English:</label>
                            <input type="text" id="photo_name_en"  name="photo_name_en"class="form-control" placeholder="  photo name English">
                           
                        </div>
                    </div>
                        
                    </div>

                    <div class="row">
                        	<div class="col-md-6">
                        <div class="form-group">
                        	<label for="formFile"  class="form-label">photo </label>
                        	<input class="form-control" type="file" name="photo" id="photo">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Photo credit:</label>
                            <input type="text" id="photo_credit"  name="photo_credit"class="form-control" placeholder="  Photo Credit">
                           
                        </div>
                    </div>
                </div>
                        <div class="modal-footer">
                            <button type="close" class="btn btn-link waves-effect" data-dismiss="modal">CLOSE</button>
                            <button type="button" class="btn btn-link waves-effect addPhoto"> submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


 
          

  
    </section>
    
    <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>

    <script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });



   $(document ).ready(function() {

        $(document).on('click','.addPhoto',function(e){
            e.preventDefault();

            let formData=new FormData($('#addPhotoForm')[0]);
            
            $.ajax({
            	type:"post",
                url:"{{route('admin.photo_gallery.store')}}",
                data:formData,
                contentType:false,
                processData:false,

                success:function(response){
                	if(response.status == 'success'){
                		$('#addPhoto').modal('hide');
                		$('#addPhotoForm')[0].reset();
                		$('.table').load(location.href+' .table');


                        const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                            toast.addEventListener('mouseenter', Swal.stopTimer)
                            toast.addEventListener('mouseleave', Swal.resumeTimer)
                        }
                    })
                    Toast.fire({
                        icon: 'success',
                        title: 'photo added success'
                    });

                	}
                }
            });
         
        });

    });




  //active start

    $(document).on('click','.active',function(e){
   e.preventDefault();

   let id=$(this).data('id');

    $.ajax({
        url:"{{url('/admin/photo_gallery/active/')}}/"+id,
        type:"get",
        success:function(response){
            if(response.status == 'success'){
                $('.table-responsive').load(location.href+' .table-responsive')

                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.addEventListener('mouseenter', Swal.stopTimer)
                        toast.addEventListener('mouseleave', Swal.resumeTimer)
                    }
                })
                Toast.fire({
                    icon: 'success',
                    title: 'photo gallery Active successfully'
                });

            }
        }
    });
});



   
//active end

// inactive start
$(document).on('click','.inactive',function(e){
   e.preventDefault();

   let id=$(this).data('id');

    $.ajax({
        url:"{{url('admin/photo_gallery/inactive/')}}/"+id,
        type:"get",
        success:function(response){
            if(response.status == 'success'){
                $('.table-responsive').load(location.href+' .table-responsive')

                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.addEventListener('mouseenter', Swal.stopTimer)
                        toast.addEventListener('mouseleave', Swal.resumeTimer)
                    }
                })
                Toast.fire({
                    icon: 'success',
                    title: 'photo_gallery InActive successfully'
                });
            }
        }
    });
});

// inactive end


       
        //Tag delete end


   
 
//Tag delete start
   function deletePhoto(id){
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    })
    .then((result) => {
        if(result.isConfirmed) {
            event.preventDefault();
            document.getElementById('delete-form-'+id).submit();
            Swal.fire(
                'Deleted!',
                'Your file has been deleted.',
                'success'
                )}
        })
}
 


    </script>



    
    @endsection