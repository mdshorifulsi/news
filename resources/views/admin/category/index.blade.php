@extends('admin_layouts')
@section('title','category')
@section('admin_content')
<section class="content">
    <div class="r ow clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <button type="button" id="btnright" class="btn btn-primary  waves-effect m-r-20" data-toggle="modal" data-target="#addCategory"> + Add Category</button>
                <h4 id="listtitle">All category list</h4>
            </div>

            <div class="card">
                <div class="body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                            <thead>
                                <tr>
                                    <th>S.no</th>
                                    <th>Category Bangla</th>
                                    <th>Category English</th>
                                    <th>Category Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($category as $key=>$row)
                                <tr>
                                    <td>{{ ++$key }}</td>
                                    <td>{{$row->catname_en}}</td>
                                    <td>{{$row->catname_bn}}</td>
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
                                     class="btn btn-sm btn-success  waves-effect m-r-20 update_category_Form"
                                    data-toggle="modal" 
                                    data-target="#updateCategory"
                                    data-id="{{$row->id}}"
                                    data-catname_bn="{{$row->catname_bn}}"
                                    data-catname_en="{{$row->catname_en}}" >
                                    <i class="material-icons">edit</i>
                                </a>

                                <button class="btn btn-danger" type="button" onclick="deleteCategory({{ $row->id }})"><i class="material-icons">delete</i></button>
                                      <form id="delete-form-{{$row->id}}" action="{{route('admin.category.delete',$row->id)}}"  method="PUT" style="display: none ; " >
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
    <div class="modal fade" id="addCategory" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="defaultModalLabel">Insert Category</h4>
                    <span id="errormsg"></span>
                </div>
                <div class="modal-body">
                    <form action="" id="addCategoryForm" method="POST" enctype="multipart/form-data" >
                        @csrf
                        <div class="form-group">
                            <label>Category Bangla:</label>
                            <input type="text" id="catname_bn"  name="catname_bn"class="form-control" placeholder=" English Category Bangla">
                            <span class="text-danger" id="cat_bn_error"></span>
                        </div>
                        <div class="form-group">
                            <label>Category English:</label>
                            <input type="text" id="catname_en"  name="catname_en"class="form-control" placeholder=" Enter Category English">
                            <span class="text-danger" id="cat_en_error"></span>
                        </div>
                        <div class="modal-footer">
                            <button type="close" class="btn btn-link waves-effect" data-dismiss="modal">CLOSE</button>
                            <button type="button" class="btn btn-link waves-effect addCategory">Category submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


      <!-- update data modal -->

      <div class="modal fade" id="updateCategory" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="defaultModalLabel">Update Category</h4>
                    <span id="errormsg"></span>
                </div>
                <div class="modal-body">
                    <form action="" id="updateCategoryForm" method="POST" enctype="multipart/form-data" >
                        @csrf

                        <input type="hidden" id="up_id">
                        <div class="form-group">
                            <label>Category Bangla:</label>
                            <input type="text" id="up_catname_bn"  name="up_catname_bn"class="form-control" placeholder=" English Category Bangla">
                            <span class="text-danger" id="up_cat_bn_error"></span>
                        </div>
                        <div class="form-group">
                            <label>Category English:</label>
                            <input type="text" id="up_catname_en"  name="up_catname_en"class="form-control" placeholder=" Enter Category English">
                            <span class="text-danger" id="up_cat_en_error"></span>
                        </div>
                        <div class="modal-footer">
                            <button type="close" class="btn btn-link waves-effect" data-dismiss="modal">CLOSE</button>
                            <button type="button" class="btn btn-link waves-effect updateCategory">update Category</button>
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

        $(document).on('click','.addCategory',function(e){
            e.preventDefault();

            let catname_bn=$('#catname_bn').val();
            let catname_en=$('#catname_en').val();
            // console.log(catname_bn,catname_en)

            $.ajax({

                url:"{{route('admin.category.store')}}",
                method:"post",
                data:{
                    "_token": "{{ csrf_token() }}",
                    catname_bn:catname_bn,
                    catname_en:catname_en
                },

                success:function(response){
                    if(response.status == 'success'){
                   
                   $('#addCategory').modal('hide');
                   $('#addCategoryForm')[0].reset();
                    $('.table-responsive').load(location.href+' .table-responsive');

                    Command: toastr["success"]("Category Insert Successfully .", "Success")

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


        });
                    $('#cat_bn_error').text(error.responseJSON.errors.catname_bn);
                    $('#cat_en_error').text(error.responseJSON.errors.catname_bn);

                   
                },


            });



        // show category value
        $(document).on('click','.update_category_Form',function(){

            let id=$(this).data('id');
            let catname_bn=$(this).data('catname_bn');
            let catname_en=$(this).data('catname_en');

            $('#up_id').val(id);
            $('#up_catname_bn').val(catname_bn);
            $('#up_catname_en').val(catname_en);

        });


        // update category


        $(document).on('click','.updateCategory',function(e){
            e.preventDefault();

            let up_id=$('#up_id').val();
            let up_catname_bn=$('#up_catname_bn').val();
            let up_catname_en=$('#up_catname_en').val();
            // console.log(catname_bn,catname_en)

            $.ajax({

                url:"{{route('admin.category.update')}}",
                method:"post",
                data:{
                    "_token": "{{ csrf_token() }}",
                    up_id:up_id,
                    up_catname_bn:up_catname_bn,
                    up_catname_en:up_catname_en
                },

                success:function(response){
                    if(response.status == 'success'){
                   
                   $('#updateCategory').modal('hide');
                   $('#updateCategoryForm')[0].reset();
                    $('.table-responsive').load(location.href+' .table-responsive');

                    Command: toastr["success"]("Category Update Successfully .", "updated")

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

                    $('#up_cat_bn_error').text(error.responseJSON.errors.cat_en_error);
                    $('#up_cat_en_error').text(error.responseJSON.errors.cat_en_error);

                   
                },


            });



        });


  //active start

    $(document).on('click','.active',function(e){
   e.preventDefault();

   let id=$(this).data('id');

    $.ajax({
        url:"{{url('/admin/category/active/')}}/"+id,
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
                    title: 'Category Active successfully'
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
        url:"{{url('admin/category/inactive/')}}/"+id,
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
                    title: 'Category InActive successfully'
                });
            }
        }
    });
});

// inactive end


       
        //Tag delete end


   
    });

//category  delete start
   function deleteCategory(id){
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