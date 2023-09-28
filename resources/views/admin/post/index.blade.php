@extends('admin_layouts')
@section('title','All Post')
@section('admin_content')
<section class="content">
    <div class="r ow clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <button id="postbtn"><a id="posthrf" href="{{route('admin.post.create')}}"> +Add post</a></button>
                <h4 id="listtitle">All Post list</h4>
            </div>
            <div class="card">
                <div class="body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                            <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Images</th>
                                    <th>Categories</th>
                                    <th>first_sec</th>
                                    <th>big_thum</th>
                                    <th>Approve</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($post as $key=>$row)
                                <tr>
                                    <td>{{$row->title_bn}} ||
                                    {{$row->title_en}}</td>
                                    <td>
                                        {{$row->category->catname_en}} 
                                    </td>
                                    <td>
                                        <img class="rounded float-start" src="{{ asset($row->images_one) }}"  width="150">
                                    </td>
                                    <td>
                                         @if($row->first_section==1)
                                        <a href="" class="first_section_no" data-id="{{$row->id}}"><button class="btn btn-sm btn-success">yes</button></a>
                                        @else
                                    <a href=""  class="first_section_yes" data-id="{{$row->id}}"> <button class="btn btn-sm btn-danger">No</button></a>
                                    @endif
                                    </td>

                                    <td>
                                         @if($row->big_thumbnail==1)
                                        <a href="" class="big_thumbnail_no" data-id="{{$row->id}}"><button class="btn btn-sm btn-success">yes</button></a>
                                        @else
                                    <a href=""  class=" big_thumbnail_yes" data-id="{{$row->id}}"> <button class="btn btn-sm btn-danger">No</button></a>
                                    @endif
                                    </td>
                                    <td>
                                         @if($row->status==1)
                                        <a href="" class="inactive" data-id="{{$row->id}}"><button class="btn btn-sm btn-success">yes</button></a>
                                        @else
                                    <a href=""  class=" active" data-id="{{$row->id}}"> <button class="btn btn-sm btn-danger">No</button></a>
                                    @endif
                                    </td>

                                    <td>
                                    <a href="{{route('admin.post.edit',$row->id)}}">
                                        <button class="btn btn-sm btn-success">
                                    Edit</button> </a>

                                    <a href="{{route('admin.post.view',$row->id)}}">
                                        <button class="btn btn-sm btn-info">
                                    view</button> </a>

                                    <button class="btn btn-danger" type="button" onclick="deletePost({{ $row->id }})"><i class="material-icons">delete</i></button>
                                      <form id="delete-form-{{$row->id}}" action="{{route('admin.post.delete',$row->id)}}"  method="PUT" style="display: none ; " >
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



 </section>
 

 <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>

<script>

     $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });



  //active start

    $(document).on('click','.active',function(e){
   e.preventDefault();

   let id=$(this).data('id');

    $.ajax({
        url:"{{url('/admin/post/active/')}}/"+id,
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
                    title: 'post Active successfully'
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
        url:"{{url('admin/post/inactive/')}}/"+id,
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
                    title: 'post InActive successfully'
                });
            }
        }
    });
});

// inactive end

//big thumnil start

    $(document).on('click','.big_thumbnail_no',function(e){
   e.preventDefault();

   let id=$(this).data('id');

    $.ajax({
        url:"{{url('/admin/post/big_thumbnail_no/')}}/"+id,
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
                    title: 'post Active successfully'
                });

            }
        }
    });
});



   
//active end

// inactive start
$(document).on('click','.big_thumbnail_yes',function(e){
   e.preventDefault();

   let id=$(this).data('id');

    $.ajax({
        url:"{{url('admin/post/big_thumbnail_yes/')}}/"+id,
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
                    title: 'post InActive successfully'
                });
            }
        }
    });
});
//big thumnil close




//first_section thumnil start

    $(document).on('click','.first_section_no',function(e){
   e.preventDefault();

   let id=$(this).data('id');

    $.ajax({
        url:"{{url('/admin/post/first_section_no/')}}/"+id,
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
                    title: 'first_section Active successfully'
                });

            }
        }
    });
});



   
//active end

// inactive start
$(document).on('click','.first_section_yes',function(e){
   e.preventDefault();

   let id=$(this).data('id');

    $.ajax({
        url:"{{url('admin/post/first_section_yes/')}}/"+id,
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
                    title: 'first inActive success'
                });
            }
        }
    });
});
//first_section close
       
 //category  delete start
   function deletePost(id){
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