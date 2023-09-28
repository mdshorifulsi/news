@extends('admin_layouts')
@section('title','breakingnews')
@section('admin_content')

<section class="content">
    <div class="r ow clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <button type="button" id="btnright" class="btn btn-primary  waves-effect m-r-20" data-toggle="modal" data-target="#addbreakingnews"> + Add breakingnews</button>
                <h4 id="listtitle">All breakingnews list</h4>
            </div>
            <div class="card">
                <div class="body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                            <thead>
                                <tr>
                                    <th>S.no</th>
                                    <th>breakingnews Bangla</th>
                                    <th>breakingnews English</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($breakingnews as $key=>$row)
                                <tr>
                                    <td>{{ ++$key }}</td>
                                    <td>{{$row->breakingnews_bn}}</td>
                                    <td>{{$row->breakingnews_en}}</td>
                                    <td>
                                     <a href=""  
                                     class="btn btn-sm btn-success  waves-effect m-r-20 update_braking_Form"
                                    data-toggle="modal" 
                                    data-target="#updateBraking"
                                    data-id="{{$row->id}}"
                                    data-breakingnews_bn="{{$row->breakingnews_bn}}"
                                    data-breakingnews_en="{{$row->breakingnews_en}}" >
                                    <i class="material-icons">edit</i>
                                </a>
                                    <button class="btn btn-danger" type="button" onclick="deleteBrakeingnews({{ $row->id }})"><i class="material-icons">delete</i></button>
                                      <form id="delete-form-{{$row->id}}" action="{{route('admin.breakingnews.delete',$row->id)}}"  method="PUT" style="display: none ; " >
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
    <div class="modal fade" id="addbreakingnews" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="defaultModalLabel">Modal title</h4>
                    <span id="errormsg"></span>
                </div>
                <div class="modal-body">
                    <form action="" id="addbreakingnewsForm" method="POST" enctype="multipart/form-data" >
                        @csrf
                        <div class="form-group">
                            <label>Breakingnews Bangla:</label>
                            <input type="text" id="breakingnews_bn"  name="breakingnews_bn"class="form-control" placeholder=" Breakingnews Bangla">
                            <span class="text-danger" id="bnews_bn_error"></span>
                        </div>
                        <div class="form-group">
                            <label>Breakingnews English:</label>
                            <input type="text" id="breakingnews_en"  name="breakingnews_en"class="form-control" placeholder=" Breakingnews English">
                            <span class="text-danger" id="bnews_en_error"></span>
                        </div>
                        <div class="modal-footer">
                            <button type="close" class="btn btn-link waves-effect" data-dismiss="modal">CLOSE</button>
                            <button type="button" class="btn btn-link waves-effect addbreakingnews">breakingnews submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


     <!-- update data modal -->

      <div class="modal fade" id="updateBraking" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="defaultModalLabel">Update District</h4>
                    <span id="errormsg"></span>
                </div>
                <div class="modal-body">
                    <form action="" id="updateBrakingForm" method="POST" enctype="multipart/form-data" >
                        @csrf

                        <input type="hidden" id="up_id">
                        <div class="form-group">
                            <label>Braking News Bangla:</label>
                            <input type="text" id="up_breakingnews_bn"  name="up_breakingnews_bn"class="form-control" placeholder=" Breakingnews Bangla">
                            <span class="text-danger" id="up_dis_bn_error"></span>
                        </div>
                        <div class="form-group">
                            <label>Braking News English:</label>
                            <input type="text" id="up_breakingnews_en"  name="up_breakingnews_en"class="form-control" placeholder=" Breakingnews English">
                            <span class="text-danger" id="up_dis_en_error"></span>
                        </div>
                        <div class="modal-footer">
                            <button type="close" class="btn btn-link waves-effect" data-dismiss="modal">CLOSE</button>
                            <button type="button" class="btn btn-link waves-effect updateBraking">update</button>
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

        $(document).on('click','.addbreakingnews',function(e){
            e.preventDefault();

            let breakingnews_bn=$('#breakingnews_bn').val();
            let breakingnews_en=$('#breakingnews_en').val();
            // console.log(catname_bn,catname_en)

            $.ajax({

                url:"{{route('admin.breakingnews.store')}}",
                method:"post",
                data:{
                    "_token": "{{ csrf_token() }}",
                    breakingnews_bn:breakingnews_bn,
                    breakingnews_en:breakingnews_en
                },

                success:function(response){
                    if(response.status == 'success'){
                   
                   $('#addbreakingnews').modal('hide');
                   $('#addbreakingnewsForm')[0].reset();
                    $('.table-responsive').load(location.href+' .table-responsive');

                    Command: toastr["success"]("breakingnews Insert Successfully .", "Success")

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

                    $('#bnews_bn_error').text(error.responseJSON.errors.breakingnews_bn);
                    $('#bnews_en_error').text(error.responseJSON.errors.breakingnews_en);

                   
                },


            });



        })
   
    });



      // show District value
        $(document).on('click','.update_braking_Form',function(){

            let id=$(this).data('id');
            let breakingnews_bn=$(this).data('breakingnews_bn');
            let breakingnews_en=$(this).data('breakingnews_en');

            $('#up_id').val(id);
            $('#up_breakingnews_bn').val(breakingnews_bn);
            $('#up_breakingnews_en').val(breakingnews_en);

        });


        // update category


        $(document).on('click','.updateBraking',function(e){
            e.preventDefault();

            let up_id=$('#up_id').val();
            let up_breakingnews_bn=$('#up_breakingnews_bn').val();
            let up_breakingnews_en=$('#up_breakingnews_en').val();
            // console.log(catname_bn,catname_en)

            $.ajax({

                url:"{{route('admin.braking.update')}}",
                method:"post",
                data:{
                    "_token": "{{ csrf_token() }}",
                    up_id:up_id,
                    up_breakingnews_bn:up_breakingnews_bn,
                    up_breakingnews_en:up_breakingnews_en
                },

                success:function(response){
                    if(response.status == 'success'){
                   
                   $('#updateBraking').modal('hide');
                   $('#updateBrakingForm')[0].reset();
                    $('.table-responsive').load(location.href+' .table-responsive');

                    Command: toastr["success"]("Braking news Update Success .", "updated")

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




     //District delete start
   function deleteBrakeingnews(id){
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
 

 //District delete end
    </script>



    
    @endsection