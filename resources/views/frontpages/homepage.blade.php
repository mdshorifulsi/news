@extends('layouts')
@section('content')
@section('title','homepages')

{{-- first section condation --}}
@php
$big_thumbnail=App\Models\Post::where('big_thumbnail',1)->first();
$allnews=App\Models\Post::latest()->take(6)->get();
$popular=App\Models\Post::take(6)->get();
$first_section=App\Models\Post::where('first_section',1)->take(2)->get();
$tv=App\Models\TV::first();
@endphp

{{-- first section start --}}
<section class="news-section">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12 col-sm-12">
				<div class="row">
					<div class="col-md-6 col-sm-6">
						<div class="lead-news">
							<div class="service-img">
								<a href="{{route('post_details',$big_thumbnail->id)}}">
									<img src="{{asset($big_thumbnail->images_one)}}" alt="Notebook">
								</a>
							</div>
							<div class="content">
								<h4 class="lead-heading-01">
									<a href="{{route('post_details',$big_thumbnail->id)}}">
										@if(Session()->get('language')=='bangla')
										{{$big_thumbnail->title_bn}}
										@else
										{{$big_thumbnail->title_en}}
										@endif
									</a>
								</h4>
							</div>
						</div>
					</div>

					<div class="col-md-3 col-sm-3">
						@foreach($first_section as $v_first_section)
						<div class="lead-news">
							<div class="service-img">
								<a href="{{route('post_details',$v_first_section->id)}}">
									<img src="{{asset($v_first_section->images_one)}}">
								</a>
							</div>
							<div class="content">
								<h4 class="lead-heading-01">
									<a href="{{route('post_details',$v_first_section->id)}}">
										@if(Session()->get('language')=='bangla')
											{{$v_first_section->title_bn}}
										@else
											{{$v_first_section->title_en}}
										@endif
									</a>
								</h4>
							</div>
						</div>
						@endforeach
					</div>

					{{-- //sorbo ses --}}
					<div class="col-md-3 col-sm-3">
						<div class="tab-header">
							<ul class="nav nav-tabs nav-justified" role="tablist">
								<li role="presentation" class="active">
									<a href="#tab21" aria-controls="tab21" role="tab" data-toggle="tab" aria-expanded="false">
										@if(Session()->get('language')=='bangla')
											সর্বশেষ
										@else
											last
										@endif
										
									</a>
								</li>
								<li role="presentation" >
									<a href="#tab22" aria-controls="tab22" role="tab" data-toggle="tab" aria-expanded="true">
										@if(Session()->get('language')=='bangla')
											জনপ্রিয়
										@else
											popular
										@endif
									</a>
								</li>
							</ul>
							<div class="tab-content ">
								<div role="tabpanel" class="tab-pane in active" id="tab21">		
									<div class="news-titletab">
										@foreach($allnews as $V_last)
										<div class="news-title-02">
											<h4 class="heading-03">
												<a href="{{route('post_details',$V_last->id)}}">
													@if(Session()->get('language')=='bangla')
														{{$V_last->title_bn}}
													@else
														{{$V_last->title_en}}
													@endif	
												</a>
											</h4>
										</div>
										@endforeach
									</div>	
								</div>
								<div role="tabpanel" class="tab-pane fade" id="tab22">

									<div class="news-titletab">
										@foreach($popular as $V_popular)
										<div class="news-title-02">
											<h4 class="heading-03">
												<a href="{{route('post_details',$V_popular->id)}}">
													@if(Session()->get('language')=='bangla')
														{{$V_popular->title_bn}}
													@else
														{{$V_popular->title_en}}
													@endif
												</a>
											</h4>
										</div>
										@endforeach
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>


				<div class="row">
					<div class="col-md-9">
						@foreach($allnews as $v_allnews)
						<div class="col-md-4 col-sm-4">
							<div class="top-news">
								<a href="{{route('post_details',$v_allnews->id)}}">
									<img src="{{asset($v_allnews->images_one)}}" alt="Notebook">
								</a>
								<h4 class="heading-02">
									<a href="{{route('post_details',$v_allnews->id)}}">
										@if(Session()->get('language')=='bangla')
										{{$v_allnews->title_bn}}
										@else
										{{$v_allnews->title_en}}
										@endif
									</a>
								</h4>
							</div>
						</div>
						@endforeach
					</div>

					<div class="col-md-3">
						<!-- youtube-live-start -->
						<div class="cetagory-title-03">
						@if(Session()->get('language')=='bangla')
										{{$tv->tv_name}} লাইভ টিভি
										@else
										{{$tv->tv_name}} Live
										@endif
									 </div>
						<div class="photo">
							<div class="embed-responsive embed-responsive-16by9 embed-responsive-item" style="margin-bottom:5px;">
								{!! $tv->embade_code !!}
						
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
{{-- first section end --}}


@php 
	$firstcategory=App\Models\Category::first();
	$firstcatbig=App\Models\Post::where('category_id',$firstcategory->id)
	->orderBy('id','DESC')
	->first();
	$firstcatsmall=App\Models\Post::where('category_id',$firstcategory->id)
	->limit(3)
	->get();


	$secondcategory=App\Models\Category::skip(1)->first();
	$secondcatbig=App\Models\Post::where('category_id',$secondcategory->id)
	->orderBy('id','DESC')
	->first();
	$secondcatsmall=App\Models\Post::where('category_id',$secondcategory->id)
	->limit(3)
	->get();


	@endphp

<!-- 2nd-news-section-start -->	
<section class="news-section">
	<div class="container-fluid">
		<div class="row">
			
			<div class="col-md-6 col-sm-6">
				<div class="bg-one">
					<div class="cetagory-title-02">
						<a href="{{route('categorypost',$firstcategory->id)}}">
							@if(Session()->get('language')=='bangla')
								{{$firstcategory->catname_bn}}
							@else
								{{$firstcategory->catname_en}}
							@endif
						</a>
					</div>
					<div class="row">
						<div class="col-md-6 col-sm-6">
							<div class="top-news">
								<a href="{{route('post_details',$firstcatbig->id)}}"><img src="{{asset($firstcatbig->images_one)}}" alt="Notebook">
								</a>
								<h4 class="heading-02">
									<a href="{{route('post_details',$firstcatbig->id)}}">
										@if(Session()->get('language')=='bangla')
										{{$firstcatbig->title_bn}}
										@else
										{{$firstcatbig->title_en}}
										@endif
									</a>
								</h4>
							</div>
						</div>
						<div class="col-md-6 col-sm-6">
							@foreach($firstcatsmall as $row)
							<div class="image-title">
								<a href="{{route('post_details',$row->id)}}">
									<img src="{{asset($row->images_one)}}" alt="Notebook">
								</a>
								<h4 class="heading-03">
									<a href="{{route('post_details',$row->id)}}">
										@if(Session()->get('language')=='bangla')
										{{$row->title_bn}}
										@else
										{{$row->title_en}}
										@endif
									</a>
								</h4>
							</div>
							@endforeach
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-6 col-sm-6">
				<div class="bg-one">
					<div class="cetagory-title-02">
						<a href="{{route('categorypost',$secondcategory->id)}}">
							@if(Session()->get('language')=='bangla')
								{{$secondcategory->catname_bn}}
							@else
								{{$secondcategory->catname_en}}
							@endif
						</a>
					</div>
					<div class="row">
						<div class="col-md-6 col-sm-6">
							<div class="top-news">
								<a href="{{route('post_details',$secondcatbig->id)}}"><img src="{{asset($secondcatbig->images_one)}}" alt="Notebook">
								</a>
								<h4 class="heading-02">
									<a href="{{route('post_details',$secondcatbig->id)}}">
										@if(Session()->get('language')=='bangla')
										{{$secondcatbig->title_bn}}
										@else
										{{$secondcatbig->title_en}}
										@endif
									</a>
								</h4>
							</div>
						</div>
						<div class="col-md-6 col-sm-6">
							@foreach($secondcatsmall as $row)
							<div class="image-title">
								<a href="{{route('post_details',$row->id)}}">
									<img src="{{asset($row->images_one)}}" alt="Notebook">
								</a>
								<h4 class="heading-03">
									<a href="{{route('post_details',$row->id)}}">
										@if(Session()->get('language')=='bangla')
										{{$row->title_bn}}
										@else
										{{$row->title_en}}
										@endif
									</a>
								</h4>
							</div>
							@endforeach
						</div>
					</div>
				</div>
			</div>	
		</div>
	</div>
</section>

<!-- /.2nd-news-section-close -->


<!-- /3nd-news-section-start -->

@php 
	$threecategory=App\Models\Category::skip(2)->first();
	$threecatbig=App\Models\Post::where('category_id',$threecategory->id)
	->orderBy('id','DESC')
	->first();
	$threecatsmall=App\Models\Post::where('category_id',$threecategory->id)
	->limit(3)
	->get();


	$fourcategory=App\Models\Category::skip(3)->first();
	$fourcatbig=App\Models\Post::where('category_id',$fourcategory->id)
	->orderBy('id','DESC')
	->first();
	$fourcatsmall=App\Models\Post::where('category_id',$fourcategory->id)
	->limit(3)
	->get();


	@endphp

<!-- 3nd-news-section-start -->	
<section class="news-section">
	<div class="container-fluid">
		<div class="row">


			<div class="col-md-6 col-sm-6">
				<div class="bg-one">
					<div class="cetagory-title-02">
						<a href="{{route('categorypost',$threecategory->id)}}">
							@if(Session()->get('language')=='bangla')
								{{$threecategory->catname_bn}}
							@else
								{{$threecategory->catname_en}}
							@endif
						</a>
					</div>


					<div class="row">
						<div class="col-md-6 col-sm-6">
							<div class="top-news">
								<a href="{{route('post_details',$threecatbig->id)}}"><img src="{{asset($threecatbig->images_one)}}" alt="Notebook">
								</a>
								<h4 class="heading-02">
									<a href="{{route('post_details',$threecatbig->id)}}">
										@if(Session()->get('language')=='bangla')
										{{$threecatbig->title_bn}}
										@else
										{{$threecatbig->title_en}}
										@endif
									</a>
								</h4>
							</div>
						</div>
						<div class="col-md-6 col-sm-6">
							@foreach($threecatsmall as $row)
							<div class="image-title">
								<a href="{{route('post_details',$row->id)}}">
									<img src="{{asset($row->images_one)}}" alt="Notebook">
								</a>
								<h4 class="heading-03">
									<a href="{{route('post_details',$row->id)}}">
										@if(Session()->get('language')=='bangla')
										{{$row->title_bn}}
										@else
										{{$row->title_en}}
										@endif
									</a>
								</h4>
							</div>
							@endforeach
						</div>
					</div>
				</div>
			</div>

			<div class="col-md-6 col-sm-6">
				<div class="bg-one">
					<div class="cetagory-title-02">
						<a href="{{route('categorypost',$fourcategory->id)}}">
							@if(Session()->get('language')=='bangla')
								{{$fourcategory->catname_bn}}
							@else
								{{$fourcategory->catname_en}}
							@endif
						</a>
					</div>


					<div class="row">
						<div class="col-md-6 col-sm-6">
							<div class="top-news">
								<a href="{{route('post_details',$fourcatbig->id)}}"><img src="{{asset($fourcatbig->images_one)}}" alt="Notebook">
								</a>
								<h4 class="heading-02">
									<a href="{{route('post_details',$fourcatbig->id)}}">
										@if(Session()->get('language')=='bangla')
										{{$fourcatbig->title_bn}}
										@else
										{{$fourcatbig->title_en}}
										@endif
									</a>
								</h4>
							</div>
						</div>
						<div class="col-md-6 col-sm-6">
							@foreach($fourcatsmall as $row)
							<div class="image-title">
								<a href="{{route('post_details',$row->id)}}">
									<img src="{{asset($row->images_one)}}" alt="Notebook">
								</a>
								<h4 class="heading-03">
									<a href="{{route('post_details',$row->id)}}">
										@if(Session()->get('language')=='bangla')
										{{$row->title_bn}}
										@else
										{{$row->title_en}}
										@endif
									</a>
								</h4>
							</div>
							@endforeach
						</div>
					</div>
				</div>
			</div>




			
		</div>
	</div>
</section>

<!-- /.3rd-news-section-close -->

@php 
	$fivecategory=App\Models\Category::skip(4)->first();
	$fivecatbig=App\Models\Post::where('category_id',$fivecategory->id)
	->orderBy('id','DESC')
	->first();
	$fivecatsmall=App\Models\Post::where('category_id',$fivecategory->id)
	->limit(3)
	->get();


	$sixcategory=App\Models\Category::skip(5)->first();
	$sixcatbig=App\Models\Post::where('category_id',$sixcategory->id)
	->orderBy('id','DESC')
	->first();
	$sixcatsmall=App\Models\Post::where('category_id',$sixcategory->id)
	->limit(3)
	->get();


	@endphp
<!-- 4nd-news-section-start -->	
<section class="news-section">
	<div class="container-fluid">
		<div class="row">


			<div class="col-md-6 col-sm-6">
				<div class="bg-one">
					<div class="cetagory-title-02">
						<a href="{{route('categorypost',$fivecategory->id)}}">
							@if(Session()->get('language')=='bangla')
								{{$fivecategory->catname_bn}}
							@else
								{{$fivecategory->catname_en}}
							@endif
						</a>
					</div>


					<div class="row">
						<div class="col-md-6 col-sm-6">
							<div class="top-news">
								<a href="{{route('post_details',$fivecatbig->id)}}"><img src="{{asset($fivecatbig->images_one)}}" alt="Notebook">
								</a>
								<h4 class="heading-02">
									<a href="{{route('post_details',$fivecatbig->id)}}">
										@if(Session()->get('language')=='bangla')
										{{$fivecatbig->title_bn}}
										@else
										{{$fivecatbig->title_en}}
										@endif
									</a>
								</h4>
							</div>
						</div>
						<div class="col-md-6 col-sm-6">
							@foreach($fivecatsmall as $row)
							<div class="image-title">
								<a href="{{route('post_details',$row->id)}}">
									<img src="{{asset($row->images_one)}}" alt="Notebook">
								</a>
								<h4 class="heading-03">
									<a href="{{route('post_details',$row->id)}}">
										@if(Session()->get('language')=='bangla')
										{{$row->title_bn}}
										@else
										{{$row->title_en}}
										@endif
									</a>
								</h4>
							</div>
							@endforeach
						</div>
					</div>
				</div>
			</div>

			<div class="col-md-6 col-sm-6">
				<div class="bg-one">
					<div class="cetagory-title-02">
						<a href="{{route('categorypost',$sixcategory->id)}}">
							@if(Session()->get('language')=='bangla')
								{{$sixcategory->catname_bn}}
							@else
								{{$sixcategory->catname_en}}
							@endif
						</a>
					</div>


					<div class="row">
						<div class="col-md-6 col-sm-6">
							<div class="top-news">
								<a href="{{route('post_details',$sixcatbig->id)}}"><img src="{{asset($sixcatbig->images_one)}}" alt="Notebook">
								</a>
								<h4 class="heading-02">
									<a href="{{route('post_details',$sixcatbig->id)}}">
										@if(Session()->get('language')=='bangla')
										{{$sixcatbig->title_bn}}
										@else
										{{$sixcatbig->title_en}}
										@endif
									</a>
								</h4>
							</div>
						</div>
						<div class="col-md-6 col-sm-6">
							@foreach($sixcatsmall as $row)
							<div class="image-title">
								<a href="{{route('post_details',$row->id)}}">
									<img src="{{asset($row->images_one)}}" alt="Notebook">
								</a>
								<h4 class="heading-03">
									<a href="{{route('post_details',$row->id)}}">
										@if(Session()->get('language')=='bangla')
										{{$row->title_bn}}
										@else
										{{$row->title_en}}
										@endif
									</a>
								</h4>
							</div>
							@endforeach
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<!-- /.4rd-news-section-close -->

@php 
	$sevencategory=App\Models\Category::skip(6)->first();
	$sevencatbig=App\Models\Post::where('category_id',$sevencategory->id)
	->orderBy('id','DESC')
	->first();
	$sevencatsmall=App\Models\Post::where('category_id',$sevencategory->id)
	->limit(3)
	->get();


	$eightcategory=App\Models\Category::skip(7)->first();
	$eightcatbig=App\Models\Post::where('category_id',$eightcategory->id)
	->orderBy('id','DESC')
	->first();
	$eightcatsmall=App\Models\Post::where('category_id',$eightcategory->id)
	->limit(3)
	->get();


	@endphp
<!-- 5nd-news-section-start -->	
<section class="news-section">
	<div class="container-fluid">
		<div class="row">


			<div class="col-md-6 col-sm-6">
				<div class="bg-one">
					<div class="cetagory-title-02">
						<a href="{{route('categorypost',$sevencategory->id)}}">
							@if(Session()->get('language')=='bangla')
								{{$sevencategory->catname_bn}}
							@else
								{{$sevencategory->catname_en}}
							@endif
						</a>
					</div>


					<div class="row">
						<div class="col-md-6 col-sm-6">
							<div class="top-news">
								<a href="{{route('post_details',$sevencatbig->id)}}"><img src="{{asset($sevencatbig->images_one)}}" alt="Notebook">
								</a>
								<h4 class="heading-02">
									<a href="{{route('post_details',$sevencatbig->id)}}">
										@if(Session()->get('language')=='bangla')
										{{$sevencatbig->title_bn}}
										@else
										{{$sevencatbig->title_en}}
										@endif
									</a>
								</h4>
							</div>
						</div>
						<div class="col-md-6 col-sm-6">
							@foreach($sevencatsmall as $row)
							<div class="image-title">
								<a href="{{route('post_details',$row->id)}}">
									<img src="{{asset($row->images_one)}}" alt="Notebook">
								</a>
								<h4 class="heading-03">
									<a href="{{route('post_details',$row->id)}}">
										@if(Session()->get('language')=='bangla')
										{{$row->title_bn}}
										@else
										{{$row->title_en}}
										@endif
									</a>
								</h4>
							</div>
							@endforeach
						</div>
					</div>
				</div>
			</div>

			<div class="col-md-6 col-sm-6">
				<div class="bg-one">
					<div class="cetagory-title-02">
						<a href="{{route('categorypost',$eightcategory->id)}}">
							@if(Session()->get('language')=='bangla')
								{{$eightcategory->catname_bn}}
							@else
								{{$eightcategory->catname_en}}
							@endif
						</a>
					</div>


					<div class="row">
						<div class="col-md-6 col-sm-6">
							<div class="top-news">
								<a href="{{route('post_details',$eightcatbig->id)}}"><img src="{{asset($eightcatbig->images_one)}}" alt="Notebook">
								</a>
								<h4 class="heading-02">
									<a href="{{route('post_details',$eightcatbig->id)}}">
										@if(Session()->get('language')=='bangla')
										{{$eightcatbig->title_bn}}
										@else
										{{$eightcatbig->title_en}}
										@endif
									</a>
								</h4>
							</div>
						</div>
						<div class="col-md-6 col-sm-6">
							@foreach($eightcatsmall as $row)
							<div class="image-title">
								<a href="{{route('post_details',$row->id)}}">
									<img src="{{asset($row->images_one)}}" alt="Notebook">
								</a>
								<h4 class="heading-03">
									<a href="{{route('post_details',$row->id)}}">
										@if(Session()->get('language')=='bangla')
										{{$row->title_bn}}
										@else
										{{$row->title_en}}
										@endif
									</a>
								</h4>
							</div>
							@endforeach
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<!-- /.4rd-news-section-close -->

@php

$photogallery_big=App\Models\PhotoGallery::where('status',1)->orderBy('id','DESC')
	->first();
	$photogallery_small=App\Models\PhotoGallery::where('status',1)
	->get();

	$namaj=App\Models\Namaz::first();
	$website=App\Models\Website::latest()->get();
	

@endphp

<!-- gallery-section-start -->	
	<section class="news-section">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-8">
					<div class="gallery_cetagory-title">
						@if(Session()->get('language')=='bangla')
								ফটো গ্যালারি
							@else
								Photo Gallery
							@endif
					 
					</div>

					<div class="row">
	                    <div class="col-md-8 col-sm-8">
	                        <div class="photo_screen">
	                            <div class="myPhotos" style="width:100%">
                                      <img src="{{asset($photogallery_big->photo)}}"  alt="Avatar">
	                            </div>
	                        </div>
	                    </div>
	                    <div class="col-md-4 col-sm-4">
	                        <div class="photo_list_bg">
	                            @foreach($photogallery_small as $row)
	                            <div class="photo_img photo_border active">
	                                <img src="{{asset($row->photo)}}" alt="image" onclick="currentDiv(1)">
	                                <div class="heading-03">
	                                    @if(Session()->get('language')=='bangla')
	                                 {{$row->photo_name_bn}}
	                                 @else
									{{$row->photo_name_en}}
									@endif
	                                </div>
	                            </div>
	                            @endforeach
	                        </div>
	                    </div>
	                    <br><br>
	                    <div class="col-md-4 col-sm-4">
                            <div class="gallery_sec owl-carousel">
                            	@foreach($photogallery_small as $row)
                                <div class="video_image" style="width:100%" onclick="currentDivs(1)">
                                    <img src="{{asset($row->photo)}}"  alt="Avatar">
                                    <div class="heading-03">
                                        <div class="content_padding">
                                            @if(Session()->get('language')=='bangla')
	                                 {{$row->photo_name_bn}}
	                                 @else
									{{$row->photo_name_en}}
									@endif
                                        </div>
                                    </div>
                                </div>

                                @endforeach
                            </div>

	                    </div>
	                </div>

	                <!--=======================================
                    Video Gallery clickable jquary  start
                ========================================-->

                            <script>
                                    var slideIndex = 1;
                                    showDivs(slideIndex);

                                    function plusDivs(n) {
                                      showDivs(slideIndex += n);
                                    }

                                    function currentDiv(n) {
                                      showDivs(slideIndex = n);
                                    }

                                    function showDivs(n) {
                                      var i;
                                      var x = document.getElementsByClassName("myPhotos");
                                      var dots = document.getElementsByClassName("demo");
                                      if (n > x.length) {slideIndex = 1}
                                      if (n < 1) {slideIndex = x.length}
                                      for (i = 0; i < x.length; i++) {
                                         x[i].style.display = "none";
                                      }
                                      for (i = 0; i < dots.length; i++) {
                                         dots[i].className = dots[i].className.replace(" w3-opacity-off", "");
                                      }
                                      x[slideIndex-1].style.display = "block";
                                      dots[slideIndex-1].className += " w3-opacity-off";
                                    }
                                </script>

                <!--=======================================
                    Video Gallery clickable  jquary  close
                =========================================-->

				</div>
				<div class="col-md-2">
					<div class="gallery_cetagory-title">
						@if(Session()->get('language')=='bangla')
								নামাজের সময়
							@else
								Namaz Time
							@endif
					</div>

					<div class="row">
                        <div class="col-md-12 col-sm-12">
                           <table class="table">
						<tr>
							<th class="text-center">
								@if(Session()->get('language')=='bangla')
								ফজর :  
								@else
								Fajar :
								@endif
								{{$namaj->jummah}}
							</th>
							
						</tr>
						<tr>

							<th class="text-center">
								@if(Session()->get('language')=='bangla')
								জোহর :  
								@else
								 johor :
								@endif
								{{$namaj->johor}}
							</th>
							
						</tr>
						<tr>
							<th class="text-center">
								@if(Session()->get('language')=='bangla')
								আসর :
								@else
								asor :  
								@endif
								{{$namaj->asor}}
							</th>	
						</tr>
						<tr>
							<th class="text-center">
								@if(Session()->get('language')=='bangla')
								মাগরিব :  
								@else
								magrib :
								@endif
								{{$namaj->magrib}}
							</th>
							
						</tr>
						<tr>
							<th class="text-center">
								@if(Session()->get('language')=='bangla')
								এসা :  
								@else
								esha :
								@endif
								{{$namaj->esha}}
							</th>
							
						</tr>
						<tr>
							<th class="text-center">
								@if(Session()->get('language')=='bangla')
								জুম্মাহ :  
								@else
								jummah :
								@endif
								{{$namaj->jummah}}
							</th>
							
						</tr>


					</table>
                        </div>
                    </div>

                    


                    <script>
                        var slideIndex = 1;
                        showDivss(slideIndex);

                        function plusDivs(n) {
                          showDivss(slideIndex += n);
                        }

                        function currentDivs(n) {
                          showDivss(slideIndex = n);
                        }

                        function showDivss(n) {
                          var i;
                          var x = document.getElementsByClassName("myVideos");
                          var dots = document.getElementsByClassName("demo");
                          if (n > x.length) {slideIndex = 1}
                          if (n < 1) {slideIndex = x.length}
                          for (i = 0; i < x.length; i++) {
                             x[i].style.display = "none";
                          }
                          for (i = 0; i < dots.length; i++) {
                             dots[i].className = dots[i].className.replace(" w3-opacity-off", "");
                          }
                          x[slideIndex-1].style.display = "block";
                          dots[slideIndex-1].className += " w3-opacity-off";
                        }
                    </script>

				</div>

				<div class="col-md-2">
					<div class="gallery_cetagory-title">
						@if(Session()->get('language')=='bangla')
								গুরুত্বপূর্ণ ওয়েবসাইট
							@else
								important website
							@endif
					</div>

					<div class="row">
                        <div class="col-md-12 col-sm-12">
                           @foreach($website as $row)
				   	<div class="news-title-02">
				   		<h4 class="heading-03"><a href="{{$row->website_link}}" target="_blank"><i class="fa fa-check" aria-hidden="true"></i> 


				   		 @if(Session()->get('language')=='bangla')
							{{$row->website_name_bn}}
							
						@else
						{{$row->website_name_en}}
						@endif


						 </a> 
						</h4>
				   	</div>
				   	@endforeach
                        </div>
                    </div>

                   


                    <script>
                        var slideIndex = 1;
                        showDivss(slideIndex);

                        function plusDivs(n) {
                          showDivss(slideIndex += n);
                        }

                        function currentDivs(n) {
                          showDivss(slideIndex = n);
                        }

                        function showDivss(n) {
                          var i;
                          var x = document.getElementsByClassName("myVideos");
                          var dots = document.getElementsByClassName("demo");
                          if (n > x.length) {slideIndex = 1}
                          if (n < 1) {slideIndex = x.length}
                          for (i = 0; i < x.length; i++) {
                             x[i].style.display = "none";
                          }
                          for (i = 0; i < dots.length; i++) {
                             dots[i].className = dots[i].className.replace(" w3-opacity-off", "");
                          }
                          x[slideIndex-1].style.display = "block";
                          dots[slideIndex-1].className += " w3-opacity-off";
                        }
                    </script>

				</div>
			</div>
		</div>
	</section><!-- /.gallery-section-close -->



@endsection