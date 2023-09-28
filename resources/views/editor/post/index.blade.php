@extends('admin_layouts')
@section('title','All Post')
@section('admin_content')
<section class="content">
    <div class="r ow clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <!-- <button type="button" id="postbtn" class="btn btn-success" ><a href="{{route('editor.post.create')}}"> + Add post </a></button> -->
                <button id="postbtn"><a id="posthrf" href="{{route('editor.post.create')}}"> +Add post</a></button>
                <h4 id="listtitle">All Post list</h4>
            </div>
            <div class="card">
                <div class="body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                            <thead>
                                <tr>
                                    <th>S.no</th>
                                    <th>Title (Bangla)</th>
                                    <th>Title (English)</th>
                                    <th>Categories</th>
                                    {{-- <th>Tags</th>
                                    <th>District</th> --}}
                                    <th>Images</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($post as $key=>$row)
                                <tr>
                                    <td>{{ ++$key }}</td>
                                    <td>{{$row->title_bn}}</td>
                                    <td>{{$row->title_en}}</td>
                                     
                                 
                                    <td>
                                        {{$row->category->catname_en}} 
                                    </td>
                                    
                                      <td>
                                    
                                    <img class="rounded float-start" src="{{ asset($row->images_one) }}"  width="150">
                                </td>

    
                                        <td>
                                    @if($row->is_approved==1)
                                    <span class="label label-success">approved</span>
                                    @else
                                    <button class="btn btn-sm btn-success">
                                    <i class="material-icons">thumb_down</i> </button>
                                    @endif
                                        </td>

                                    
                                    <td>

                                    <a href="{{route('editor.post.edit',$row->id)}}">
                                        <button class="btn btn-sm btn-success">
                                    Edit</button> </a>

                                    <a href="{{route('editor.post.view',$row->id)}}">
                                        <button class="btn btn-sm btn-info">
                                    view</button> </a>

                                   



                                    <button class="btn btn-danger" type="button" onclick="deletePost({{ $row->id }})"><i class="material-icons">delete</i></button>
                                      <form id="delete-form-{{$row->id}}" action="{{route('editor.post.delete',$row->id)}}"  method="PUT" style="display: none ; " >
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