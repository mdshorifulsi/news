@extends('layouts')
@section('content')
@section('title','Category')

<section class="news-section">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12 col-sm-12">
				
				<div class="row">
					<div class="col-md-9">
						@foreach($categorypost as $row)
						<div class="col-md-4 col-sm-4">
							<div class="top-news">
								<a href="{{route('post_details',$row->id)}}">
									<img src="{{asset($row->images_one)}}" alt="Notebook">
								</a>
								<h4 class="heading-02">
									<a href="{{route('post_details',$row->id)}}">
										@if(Session()->get('language')=='bangla')
										{{$row->title_bn}}
										@else
										{{$row->title_en}}
										@endif
									</a>
								</h4>
							</div>
						</div>
						@endforeach
					</div>

					
				</div>
			</div>
		</div>
	</div>
</section>

@endsection