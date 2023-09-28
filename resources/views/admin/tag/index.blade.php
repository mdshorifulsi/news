@extends('admin_layouts')
@section('title','All Tag')
@section('admin_content')
<section class="content">
    <div class="r ow clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <button type="button" id="btnright" class="btn btn-primary  waves-effect m-r-20" data-toggle="modal" data-target="#addTag"> + Add Tag</button>
                <h4 id="listtitle">All Tag list</h4>
            </div>
            <div class="card">
                <div class="body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                            <thead>
                                <tr>
                                    <th>S.no</th>
                                    <th>Tag Bangla</th>
                                    <th>Tag English</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($tag as $key=>$row)
                                <tr>
                                    <td>{{ ++$key }}</td>
                                    <td>{{$row->tagname_en}}</td>
                                    <td>{{$row->tagname_bn}}</td>
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
                                    
                                    <a href=""  
                                     class="btn btn-sm btn-success  waves-effect m-r-20 update_tag_Form"
                                    data-toggle="modal" 
                                    data-target="#updateTag"
                                    data-id="{{$row->id}}"
                                    data-tagname_bn="{{$row->tagname_bn}}"
                                    data-tagname_en="{{$row->tagname_en}}" >
                                    <i class="material-icons">edit</i>
                                </a>

                                    <button class="btn btn-danger" type="button" onclick="deleteTag({{ $row->id }})"><i class="material-icons">delete</i></button>
                                      <form id="delete-form-{{$row->id}}" action="{{route('admin.tag.delete',$row->id)}}"  method="PUT" style="display: none ; " >
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
    <div class="modal fade" id="addTag" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="defaultModalLabel">Modal title</h4>
                    <span id="errormsg"></span>
                </div>
                <div class="modal-body">
                    <form action="" id="addTagForm" method="POST" enctype="multipart/form-data" >
                        @csrf
                        <div class="form-group">
                            <label>Tag name Bangla:</label>
                            <input type="text" id="tagname_bn"  name="tagname_bn"class="form-control" placeholder="Enter Tag Name Bangla">
                            <span class="text-danger" id="tag_bn_error"></span>
                        </div>
                        <div class="form-group">
                            <label>Tag English:</label>
                            <input type="text" id="tagname_en"  name="tagname_en"class="form-control" placeholder=" Enter Tag name English">
                            <span class="text-danger" id="tag_en_error"></span>
                        </div>
                        <div class="modal-footer">
                            <button type="close" class="btn btn-link waves-effect" data-dismiss="modal">CLOSE</button>
                            <button type="button" class="btn btn-link waves-effect addTag">Tag submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

        <!-- update data modal -->

      <div class="modal fade" id="updateTag" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="defaultModalLabel">Update Tag</h4>
                    <span id="errormsg"></span>
                </div>
                <div class="modal-body">
                    <form action="" id="updateTagForm" method="POST" enctype="multipart/form-data" >
                        @csrf

                        <input type="hidden" id="up_id">
                        <div class="form-group">
                            <label>Tag name Bangla:</label>
                            <input type="text" id="up_tagname_bn"  name="up_tagname_bn"class="form-control" placeholder=" English Tag Bangla">
                            <span class="text-danger" id="up_tag_bn_error"></span>
                        </div>
                        <div class="form-group">
                            <label>Tag name English:</label>
                            <input type="text" id="up_tagname_en"  name="up_tagname_en"class="form-control" placeholder=" Enter Tag English">
                            <span class="text-danger" id="up_tag_en_error"></span>
                        </div>
                        <div class="modal-footer">
                            <button type="close" class="btn btn-link waves-effect" data-dismiss="modal">CLOSE</button>
                            <button type="button" class="btn btn-link waves-effect updateTag">update Category</button>
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
    $( document ).ready(function() {

        $(document).on('click','.addTag',function(e){
            e.preventDefault();

            let tagname_bn=$('#tagname_bn').val();
            let tagname_en=$('#tagname_en').val();
            // console.log(catname_bn,catname_en)

            $.ajax({

                url:"{{route('admin.tag.store')}}",
                method:"post",
                data:{
                    "_token": "{{ csrf_token() }}",
                    tagname_bn:tagname_bn,
                    tagname_en:tagname_en
                },

                success:function(response){
                    if(response.status == 'success'){
                   
                   $('#addTag').modal('hide');
                   $('#addTagForm')[0].reset();
                    $('.table-responsive').load(location.href+' .table-responsive');

                    Command: toastr["success"]("Tag Insert Successfully .", "Success")

                        toastr.options = {
                        "closeButton": true,
                        "progressBar": true,
                        "positionClass": "toast-top-right",
                        "onclick": null,
                        "showDuration": "300",
                        "hideDuration": "1000",
                        "timeOut": "5000",
                        "extendedTimeOut": "1000",
                        "showEasing": "swing",
                        "hideEasing": "linear",
                        "showMethod": "fadeIn",
                        "hideMethod": "fadeOut"
                        }


                  
                   }

                },

                error:function(error){

                    $('#tag_bn_error').text(error.responseJSON.errors.tagname_bn);
                    $('#tag_en_error').text(error.responseJSON.errors.tagname_bn);

                   
                },


            });



        });



            // show Tag value
        $(document).on('click','.update_tag_Form',function(){

            let id=$(this).data('id');
            let tagname_bn=$(this).data('tagname_bn');
            let tagname_en=$(this).data('tagname_en');

            $('#up_id').val(id);
            $('#up_tagname_bn').val(tagname_bn);
            $('#up_tagname_en').val(tagname_en);

        });


        // update Tag


        $(document).on('click','.updateTag',function(e){
            e.preventDefault();

            let up_id=$('#up_id').val();
            let up_tagname_bn=$('#up_tagname_bn').val();
            let up_tagname_en=$('#up_tagname_en').val();
            // console.log(catname_bn,catname_en)

            $.ajax({

                url:"{{route('admin.tag.update')}}",
                method:"post",
                data:{
                    "_token": "{{ csrf_token() }}",
                    up_id:up_id,
                    up_tagname_bn:up_tagname_bn,
                    up_tagname_en:up_tagname_en
                },

                success:function(response){
                    if(response.status == 'success'){
                   
                   $('#updateTag').modal('hide');
                   $('#updateTagForm')[0].reset();
                    $('.table-responsive').load(location.href+' .table-responsive');

                    Command: toastr["success"]("Tag Update Successfully .", "updated")

                        toastr.options = {
                        "closeButton": true,
                        "progressBar": true,
                        "positionClass": "toast-top-right",
                        "onclick": null,
                        "showDuration": "300",
                        "hideDuration": "1000",
                        "timeOut": "5000",
                        "extendedTimeOut": "1000",
                        "showEasing": "swing",
                        "hideEasing": "linear",
                        "showMethod": "fadeIn",
                        "hideMethod": "fadeOut"
                        }


                  
                   }

                },

                error:function(error){

                    $('#up_tag_bn_error').text(error.responseJSON.errors.up_tag_bn_error);
                    $('#up_tag_en_error').text(error.responseJSON.errors.up_tag_en_error);

                   
                },


            });



        });
   
    });


  //active start

    $(document).on('click','.active',function(e){
   e.preventDefault();

   let id=$(this).data('id');

    $.ajax({
        url:"{{url('/admin/tag/active/')}}/"+id,
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
                    title: 'Tag Active successfully'
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
        url:"{{url('admin/tag/inactive/')}}/"+id,
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
                    title: 'Tag InActive successfully'
                });
            }
        }
    });
});

// inactive end

//Tag delete start
   function deleteTag(id){
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
        
        //Tag delete end



    </script>






    
    @endsection