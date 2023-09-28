@extends('layouts')
@section('content')
@section('title','details')
@php

$id=$details->category->id;
$samepost=App\Models\Post::where('id',$id)->take(6)->get();

@endphp
<section class="single-page">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-12">
					<ol class="breadcrumb">   
					   
						<li>
							<h2>
							@if(Session()->get('language')=='bangla')
							{{$details->category->catname_bn}}
							@else
							{{$details->category->catname_en}}
							@endif
						</h2>
					</li>
					</ol>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12 col-sm-12">			
					<header class="headline-header margin-bottom-10">
						
						<h1 class="headline">
							@if(Session()->get('language')=='bangla')
							{{$details->title_bn}}
							@else
							{{$details->title_en}}
							@endif
						</h1>
					</header>
		 
		 
				 <div class="article-info margin-bottom-20">
				  <div class="row">
						<div class="col-md-6 col-sm-6"> 
						 <ul class="list-inline">
						 
						 
						 
						 </ul>
						
						</div>
											
					</div>				 
				 </div>				
			</div>
		  </div>
		  <!-- ******** -->
		  <div class="row">
			<div class="col-md-8 col-sm-8">
				<div class="single-news">
					<img src="{{asset($details->images_one)}}" alt="" />
					<h4 class="caption"> 
						@if(Session()->get('language')=='bangla')
							{{$details->imagesone_title_bn}}
						@else
							{{$details->imagesone_title_en}}
						@endif</h4>

					<p>
						@if(Session()->get('language')=='bangla')
							{{$details->body_bn}}
						@else
							{{$details->body_en}}

						@endif</p>
				</div>
				<i class="fa fa-clock-o"></i> {{date('Y-m-d')}} <br><br>
				<!-- ********* -->
				<div class="row">
					<div class="col-md-12"><h2 class="heading">আরো সংবাদ</h2></div>

					@foreach($samepost as $row)
					<div class="col-md-4 col-sm-4">
						<div class="top-news sng-border-btm">
							<a href="#"><img src="{{asset($row->images_one)}}" alt="Notebook"></a>
							<h4 class="heading-02"><a href="#">
							@if(Session()->get('language')=='bangla')
							{{$row->title_bn}}
						@else
							{{$row->title_en}}

						@endif
					</a> </h4>
						</div>
					</div>
					@endforeach	
				</div>
				
			</div>
			
		  </div>
		</div>
	</section>

@endsection