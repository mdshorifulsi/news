
	@php
	function bn_date($str){

		$en=array(1,2,3,4,5,6,7,8,9,0);
		$bn=array('১','২','৩','৪','৫','৬','৭','৮','৯','০');
		$str=str_replace($en,$bn,$str);

		$en=array('January',' February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');

		$en_short=array('Jan',' Feb', 'Mar', 'Apr', 'May', 'Jun', 'July', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec');

		$en=array('জানুয়ারি', 'ফেব্রুয়ারি', 'মার্চ', 'এপ্রিল', 'মে', 'জুন', 'জুলাই', 'আগস্ট', 'সেপ্টেম্বর', 'অক্টোবর', 'নভেম্বর', 'ডিসেম্বর');

		$str=str_replace($en,$bn,$str);
		$str=str_replace($en_short,$bn,$str);


		$en=array('Saterday','Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thrusday', 'Friday');
		$en_short=array('Sat','Sun', 'Mon', 'Tue', 'Wed', 'Thr', 'Fri');
		$bn=array('শনিবার', 'রবিবার', 'সোমবার', 'মঙ্গলবার', 'বুধবার', 'বৃহস্পতিবার', 'শুক্রবার');
		$bn_short=array('শনি', 'রবি', 'সোম', 'মঙ্গল', 'বুধ', 'বৃহস্পতি', 'শুক্র');
		
		$str=str_replace($en,$bn,$str);
		$str=str_replace($en_short,$bn_short,$str);

		$en=array('am','pm');
		$en=array('পূর্বাহ্ণ','অপরাহ্ণ');

		$str=str_replace($en,$bn,$str);
		$str=str_replace($en_short,$bn_short,$str);

		$en=array('১২','২৪');
		$en=array('৬','১২');

		$str=str_replace($en,$bn,$str);
		return $str;

	}


@endphp

<!DOCTYPE html>
<htm l lang="en">
    <head>
        <meta charset="utf-8">
         <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>@yield('title')</title>
 
        <link href="{{asset('assets/frontend/assets/css/bootstrap.min.css')}}" rel="stylesheet">
        <link href="{{asset('assets/frontend/assets/css/menu.css')}}" rel="stylesheet">
         <link href="{{asset('assets/frontend/assets/css/font-awesome.min.css')}}" rel="stylesheet">
        <link href="{{asset('assets/frontend/assets/css/font-awesome.css')}}" rel="stylesheet">
        <link href="{{asset('assets/frontend/assets/css/responsive.css')}}" rel="stylesheet">
        <link href="{{asset('assets/frontend/assets/css/owl.carousel.min.css')}}" rel="stylesheet">
        <link href="{{asset('assets/frontend/style.css')}}" rel="stylesheet">

    </head>
    <body>
    <!-- header-start -->
	<section class="hdr_section">
		<div class="container-fluid">			
			<div class="row">
				@php
				$setting=App\Models\Setting::first();
				@endphp
				<div class="col-xs-6 col-md-2 col-sm-4">
					<div class="header_logo">
						<a href="{{URL::to('/')}}"><img src="{{asset($setting->project_logo)}}" style="height:80px"></a> 
					</div>
				</div>              
				<div class="col-xs-6 col-md-8 col-sm-8">
					<div id="menu-area" class="menu_area">
						<div class="menu_bottom">
							<nav role="navigation" class="navbar navbar-default mainmenu">
						<!-- Brand and toggle get grouped for better mobile display -->
								<div class="navbar-header">
									<button type="button" data-target="#navbarCollapse" data-toggle="collapse" class="navbar-toggle">
										<span class="sr-only">Toggle navigation</span>
										<span class="icon-bar"></span>
										<span class="icon-bar"></span>
										<span class="icon-bar"></span>
									</button>
								</div>
								<!-- Collection of nav links and other content for toggling -->
								<div id="navbarCollapse" class="collapse navbar-collapse">
									<ul class="nav navbar-nav">
										@php
										$category=App\Models\Category::get();
										@endphp
										@foreach($category as $v_category)
										<li><a href="{{route('categorypost',$v_category->id)}}">

											@if(Session()->get('language')=='bangla')
										<strong>
											{{$v_category->catname_bn}}
											@else
											{{$v_category->catname_en}}
											@endif
										</strong>
										</a>
									</li>
									@endforeach
								</ul>
							</div>
						</nav>											
					</div>
				</div>					
			</div> 
			<div class="col-xs-12 col-md-2 col-sm-12">
				<div class="header-icon">
					<ul>
						@if(Session()->get('language')=="english")
						<li class="version"><a href="{{route('language.bangla')}}">বাংলা</a></li>
						@else
						<li class="version"><a href="{{route('language.english')}}">English</a></li>
						@endif
							
					</ul>
				</div>
			</div>
		</div>
	</div>
</section>

@php
$breakingnews=App\Models\Breakingnews::get();
@endphp

<section>
    <div class="container-fluid">
			<div class="row scroll">
			<br>
				<div class="col-md-2 col-sm-3 scroll_01 ">
					@if(Session()->get('language')=='bangla')
						Breaking News
					@else
						শিরোনাম :
					@endif	
				</div>
				<div class="col-md-10 col-sm-9 scroll_02">
					<marquee>
						@foreach($breakingnews as $v_breakingnews)
						@if(Session()->get('language')=='bangla') 
							{{$v_breakingnews->breakingnews_bn}}  ** 
							@else
							{{$v_breakingnews->breakingnews_en}}  ** 
							@endif
							@endforeach
					</marquee>
				</div>
			</div>
    	</div>

    <section>
    	<div class="container-fluid">
    		<div class="row">
    			<div class="col-md-12 col-sm-12">
					<div class="date">
						<ul>
							<li><i class="fa fa-map-marker" aria-hidden="true"></i> 
								@if(Session()->get('language')=='bangla')
								ঢাকা
								@else
								Dhaka
								@endif
							   </li>
							<li>
								<i class="fa fa-calendar" aria-hidden="true"></i>
								@if(Session()->get('language')=='bangla')
								{{bn_date(date('d M Y, l, h:i:s a'))}}
								@else
								{{Date('d M Y,l,h:i:s a')}}
								@endif
									</li>
							<li><i class="fa fa-clock-o" aria-hidden="true"></i>
							@if(Session()->get('language')=='bangla')
								আপডেট ৫ মিনিট আগে
								@else
								Update 5 minite ago
								@endif

							</li>
						</ul>
						
					</div>
				</div>
    		</div>
    	</div>
    </section> 

	
	 
 @yield('content')
	

	<section>
		<div class="container-fluid">
			<div class="top-footer">
				<div class="row">
					<div class="col-md-3 col-sm-4">
						<div class="foot-logo">
							<img src="{{asset($setting->project_logo)}}" style="height:80px" style="height: 50px;" />
						</div>
					</div>
					<div class="col-md-6 col-sm-4">
						 <div class="social">
                            <ul>
                                <li><a href="" target="_blank" class="facebook"> <i class="fa fa-facebook"></i></a></li>
                                <li><a href="" target="_blank" class="twitter"> <i class="fa fa-twitter"></i></a></li>
                                <li><a href="" target="_blank" class="instagram"> <i class="fa fa-instagram"></i></a></li>
                                <li><a href="" target="_blank" class="android"> <i class="fa fa-android"></i></a></li>
                                <li><a href="" target="_blank" class="linkedin"> <i class="fa fa-linkedin"></i></a></li>
                                <li><a href="" target="_blank" class="youtube"> <i class="fa fa-youtube"></i></a></li>
                            </ul>
                        </div>
					</div>
					
				</div>
			</div>
		</div>
	</section>

	<section class="bottom-footer">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-6 col-sm-6">
					<div class="copyright">						
						All rights reserved © 2023 {{$setting->project_name}}<br>
						{{$setting->email}}
					</div>
				</div>
				<div class="col-md-6 col-sm-6">
					<div class="btm-foot-menu">
						<ul>
							@php
							$tags=App\Models\Tag::limit(10)->get();
							@endphp
							@foreach($tags as $v_tag)
							<li><a href="#">
								@if(Session()->get('language')=='bangla')
									{{$v_tag->tagname_bn}}
								@else
									{{$v_tag->tagname_en}}
								@endif

								</a></li>
							@endforeach
						</ul>
					</div>
				</div>
			</div>
		</div>
	</section>
	
	<script src="{{asset('assets/frontend/assets/js/jquery.min.js')}}"></script>
	<script src="{{asset('assets/frontend/assets/js/bootstrap.min.js')}}"></script>
	<script src="{{asset('assets/frontend/assets/js/main.js')}}"></script>
	<script src="{{asset('assets/frontend/assets/js/owl.carousel.min.js')}}"></script>
</body>
</html> 