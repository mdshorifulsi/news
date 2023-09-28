@extends('admin_layouts')
@section('title','Website')
@section('admin_content')
<section class="content">
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <button type="button" id="btnright" class="btn btn-primary  waves-effect m-r-20" data-toggle="modal" data-target="#addWebsite"> + Add website</button>
                <h4 id="listtitle">All website list</h4>
            </div>
            <div class="card">
                <div class="body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                            <thead>
                                <tr>
                                    <th>S.no</th>
                                    <th>website Name Bangla</th>
                                    <th>website Name English</th>
                                    <th>website link</th>
                                    <th> Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($website as $key=>$row)
                                <tr>
                                    <td>{{ ++$key }}</td>
                                    <td>{{$row->website_name_bn}}</td>
                                    <td>{{$row->website_name_en}}</td>
                                    <td>{{$row->website_link}}</td>
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
                                   
                                <button class="btn btn-danger" type="button" onclick="deleteWebsite({{ $row->id }})"><i class="material-icons">delete</i></button>
                                      <form id="delete-form-{{$row->id}}" action="{{route('admin.website.delete',$row->id)}}"  method="PUT" style="display: none ; " >
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
    <div class="modal fade" id="addWebsite" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="defaultModalLabel">Insert Website</h4>
                    <span id="errormsg"></span>
                </div>
                <div class="modal-body">
                    <form action="" id="addWebsiteForm" method="POST" enctype="multipart/form-data" >
                        @csrf
                        <div class="form-group">
                            <label>website Name Bangla:</label>
                            <input type="text" id="website_name_bn"  name="website_name_bn"class="form-control" placeholder=" website Name Bangla">
                            
                        </div>
                        <div class="form-group">
                            <label>website Name English:</label>
                            <input type="text" id="website_name_en"  name="website_name_en"class="form-control" placeholder=" website Name English">
                           
                        </div>

                        <div class="form-group">
                            <label>website Link:</label>
                            <input type="text" id="website_link"  name="website_link"class="form-control" placeholder=" website link">
                          
                        </div>
                        <div class="modal-footer">
                            <button type="close" class="btn btn-link waves-effect" data-dismiss="modal">CLOSE</button>
                            <button type="button" class="btn btn-link waves-effect addWebsite"> submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


      <!-- update data modal -->
  
    </section>
    
    <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
    <script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $( document ).ready(function() {

        $(document).on('click','.addWebsite',function(e){
            e.preventDefault();

            let website_name_bn=$('#website_name_bn').val();
            let website_name_en=$('#website_name_en').val();
            let website_link=$('#website_link').val();
            // console.log(catname_bn,catname_en)

            $.ajax({

                url:"{{route('admin.website.store')}}",
                method:"post",
                data:{
                    "_token": "{{ csrf_token() }}",
                    website_name_bn:website_name_bn,
                    website_name_en:website_name_en,
                    website_link:website_link,
                },

                success:function(response){
                    if(response.status == 'success'){
                   
                   $('#addWebsite').modal('hide');
                   $('#addWebsiteForm')[0].reset();
                    $('.table-responsive').load(location.href+' .table-responsive');

                    Command: toastr["success"](" Importent website Insert Successfully .", "Success")

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

                   
                },


            });



        });

      


        // update category


      
  //active start

    $(document).on('click','.active',function(e){
   e.preventDefault();

   let id=$(this).data('id');

    $.ajax({
        url:"{{url('/admin/website/active/')}}/"+id,
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
                    title: 'Website Active successfully'
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
        url:"{{url('admin/website/inactive/')}}/"+id,
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
                    title: 'website InActive successfully'
                });
            }
        }
    });
});

// inactive end


       
        //Tag delete end


   
    });
//Tag delete start
   function deleteWebsite(id){
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