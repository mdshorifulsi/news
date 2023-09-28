@extends('admin_layouts')
@section('title','District')
@section('admin_content')
<section class="content">
    <div class="r ow clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <button type="button" id="btnright" class="btn btn-primary  waves-effect m-r-20" data-toggle="modal" data-target="#addDistrict"> + Add District</button>
                <h4 id="listtitle">All District list</h4>
            </div>
            <div class="card">
                <div class="body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                            <thead>
                                <tr>
                                    <th>S.no</th>
                                    <th>District Bangla</th>
                                    <th>Districtae English</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($district as $key=>$row)
                                <tr>
                                    <td>{{ ++$key }}</td>
                                    <td>{{$row->districtname_bn}}</td>
                                    <td>{{$row->districtname_en}}</td>
                                    <td>
                                     <a href=""  
                                     class="btn btn-sm btn-success  waves-effect m-r-20 update_district_Form"
                                    data-toggle="modal" 
                                    data-target="#updateDistrice"
                                    data-id="{{$row->id}}"
                                    data-districtname_bn="{{$row->districtname_bn}}"
                                    data-districtname_en="{{$row->districtname_en}}" >
                                    <i class="material-icons">edit</i>
                                </a>



                                    <button class="btn btn-danger" type="button" onclick="deleteDistrict({{ $row->id }})"><i class="material-icons">delete</i></button>
                                      <form id="delete-form-{{$row->id}}" action="{{route('admin.district.delete',$row->id)}}"  method="PUT" style="display: none ; " >
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
    <div class="modal fade" id="addDistrict" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="defaultModalLabel">Modal title</h4>
                    <span id="errormsg"></span>
                </div>
                <div class="modal-body">
                    <form action="" id="addDistrictForm" method="POST" enctype="multipart/form-data" >
                        @csrf
                        <div class="form-group">
                            <label>District Bangla:</label>
                            <input type="text" id="districtname_bn"  name="districtname_bn"class="form-control" placeholder=" English District Bangla">
                            <span class="text-danger" id="dis_bn_error"></span>
                        </div>
                        <div class="form-group">
                            <label>District English:</label>
                            <input type="text" id="districtname_en"  name="districtname_en"class="form-control" placeholder=" Enter District English">
                            <span class="text-danger" id="dis_en_error"></span>
                        </div>
                        <div class="modal-footer">
                            <button type="close" class="btn btn-link waves-effect" data-dismiss="modal">CLOSE</button>
                            <button type="button" class="btn btn-link waves-effect addDistrict">Dristrict submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>



     <!-- update data modal -->

      <div class="modal fade" id="updateDistrice" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="defaultModalLabel">Update District</h4>
                    <span id="errormsg"></span>
                </div>
                <div class="modal-body">
                    <form action="" id="updateDistriceForm" method="POST" enctype="multipart/form-data" >
                        @csrf

                        <input type="hidden" id="up_id">
                        <div class="form-group">
                            <label>District Bangla:</label>
                            <input type="text" id="up_districtname_bn"  name="up_districtname_bn"class="form-control" placeholder=" English District Bangla">
                            <span class="text-danger" id="up_dis_bn_error"></span>
                        </div>
                        <div class="form-group">
                            <label>District English:</label>
                            <input type="text" id="up_districtname_en"  name="up_districtname_en"class="form-control" placeholder=" Enter District English">
                            <span class="text-danger" id="up_dis_en_error"></span>
                        </div>
                        <div class="modal-footer">
                            <button type="close" class="btn btn-link waves-effect" data-dismiss="modal">CLOSE</button>
                            <button type="button" class="btn btn-link waves-effect updateDistrice">update</button>
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

        $(document).on('click','.addDistrict',function(e){
            e.preventDefault();

            let districtname_bn=$('#districtname_bn').val();
            let districtname_en=$('#districtname_en').val();
            // console.log(catname_bn,catname_en)

            $.ajax({

                url:"{{route('admin.district.store')}}",
                method:"post",
                data:{
                    "_token": "{{ csrf_token() }}",
                    districtname_bn:districtname_bn,
                    districtname_en:districtname_en
                },

                success:function(response){
                    if(response.status == 'success'){
                   
                   $('#addDistrict').modal('hide');
                   $('#addDistrictForm')[0].reset();
                    $('.table-responsive').load(location.href+' .table-responsive');

                    Command: toastr["success"]("District Insert Successfully .", "Success")

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

                    $('#dis_bn_error').text(error.responseJSON.errors.districtname_bn);
                    $('#dis_en_error').text(error.responseJSON.errors.districtname_en);

                   
                },


            });



        })
   
    });


      // show District value
        $(document).on('click','.update_district_Form',function(){

            let id=$(this).data('id');
            let districtname_bn=$(this).data('districtname_bn');
            let districtname_en=$(this).data('districtname_en');

            $('#up_id').val(id);
            $('#up_districtname_bn').val(districtname_bn);
            $('#up_districtname_en').val(districtname_en);

        });


        // update category


        $(document).on('click','.updateDistrice',function(e){
            e.preventDefault();

            let up_id=$('#up_id').val();
            let up_districtname_bn=$('#up_districtname_bn').val();
            let up_districtname_en=$('#up_districtname_en').val();
            // console.log(catname_bn,catname_en)

            $.ajax({

                url:"{{route('admin.district.update')}}",
                method:"post",
                data:{
                    "_token": "{{ csrf_token() }}",
                    up_id:up_id,
                    up_districtname_bn:up_districtname_bn,
                    up_districtname_en:up_districtname_en
                },

                success:function(response){
                    if(response.status == 'success'){
                   
                   $('#updateDistrice').modal('hide');
                   $('#updateDistriceForm')[0].reset();
                    $('.table-responsive').load(location.href+' .table-responsive');

                    Command: toastr["success"]("District Update Successfully .", "updated")

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
   function deleteDistrict(id){
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