@extends('front.template.master')

@section('title', $PageInfo->MetaTitle )

@section('description', $PageInfo->MetaDescription)

@section('keywords', $PageInfo->MetaKeyword)

@section('url', url('/'))

@section('home', 'active')

@section('images', url('images/page/'.$PageInfo->Images))

@section('content')
    	
<div class="home_page">
		<div class="slider_wrap">
			<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">				  				  <!-- Wrapper for slides -->
				  <div class="carousel-inner" role="listbox">
				  	@if(isset($Slider) && count($Slider) > 0)
				  	@foreach($Slider as $k =>$v)
				    <div class="item @if($k == 0) active @endif ">
				    	<a href="{{$v->Alias}}" title="{{$v->Name}}">
				      		<img src="{{url('images/slider/'.$v->Images )}}" alt="{{$v->Name}}">
				    	</a>
				    </div>
				    @endforeach
				    @endif				    
				  </div>
				  <!-- Controls -->
				  <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
				    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
				    
				  </a>
				  <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
				    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
				    
				  </a>
				</div>
		</div>	
		<div class="container">
	        <div class="row">
	            <div class="col-xs-12 col-sm-12 col-md-12">
	             	<div class="home_top">
	             		<div class="home_top_left">
	             			<div class="heading">
	             				Tin mới nhất
	             			</div>
	             			<ul>
	             				@if(isset($News) && count($News) > 0 )
	             				@foreach($News as $k => $v)
	             				<li>
	             					<a href="{{url('/'.$v->Alias)}}.html" title="{{$v->Name}}">
	             						<img src="{{url('images/news/'.$v->Images)}}" alt="{{$v->Name}}">
	             						<b>{{$v->Name}}</b>
	             						<p>
	             							{{ str_limit($v->SmallDescription, $limit = 90, $end ='...')}}
	             							<span>[mở rộng]</span>
	             						</p>
	             					</a>
	             				</li>
	             				@endforeach
	             				@endif
	             			</ul>
	             		</div>
	             		<div class="home_top_right">
	             			<div class="heading">
	             				Giải trí
	             			</div>
	             			<img src="{{url('public/images/halloween.jpg')}}" alt="About"/>
	             			<p><b>Sao Việt hóa trang thành nhân vật 'Squid game'</b></p>
	             			<p>
	             				<strong>Diễn viên Lý Nhã Kỳ</strong> chọn bộ suit da, đeo mặt nạ theo tạo hình Catwoman - nhân vật nổi tiếng trong truyện tranh DC.
	             			</p>
	             			<p>
	             				 Tối 31/10, cô tổ chức tiệc Halloween tại biệt thự ở quận 1, TP HCM, trang trí bí ngô, mạng nhện từ cửa ra vào đến phòng khách và mời bạn bè đến hưởng ứng lễ hội.
	             				 <a href="{{url('gioi-thieu')}}" title="Xem thêm"> [mở rộng]	             				             				
	             			</p>
	             			<div class="home_social">
	             				 @if(isset($Social) && count($Social) > 0)
				                 @foreach($Social as $k => $v)
				                 <a href="{{$v->Alias}}" title="{{$v->Name}}">
				                   {!!$v->Font!!}
				                 </a>
				                 @endforeach
				                 @endif
	             			</div>
	             		</div>
	             	</div>
	            </div>
	        </div>
	    </div>

	    <div class="container">
	    	<div class="row">
	    		<div class="col-xs-12 col-sm-12 col-md-12">
	    			<div class="home_center">
		    			<div class="heading" style="margin-top: 25px;" >
		    				Tin thế giới
		    			</div>	
			    			<ul>    		
					    		@if(isset($NewsSale) && count($NewsSale) > 0 )
					            @foreach($NewsSale as $k => $v)
					            <div class="col-xs-12 col-sm-6 col-md-3">			
					            		<li>
					             			<a href="{{url('/'.$v->Alias)}}.html" title="{{$v->Name}}">
					             				<img src="{{url('images/news/'.$v->Images)}}" alt="{{$v->Name}}">
					             				<b>{{$v->Name}}</b>
					             				<p>
					             					{{ str_limit($v->SmallDescription, $limit = 90, $end ='...')}}
					             					<span>[mở rộng]</span>
					             				</p>
					             			</a>
					             		</li>
					            </div>
					            @endforeach
					            @endif
			        		</ul>
	        	    </div>
	            </div>
	        </div>
	    </div>

	    <div class="container">
	    	<div class="row">
	    		<div class="col-xs-12 col-sm-12 col-md-12">
	    			<div class="home_bottom">
		    			<div class="heading" style="margin-top: 25px;" >
		    				Bản tin Xem nhiều
		    			</div>	
			    			<ul>    		
					    		@if(isset($NewsViews) && count($NewsViews) > 0 )
					            @foreach($NewsViews as $k => $v)
					            <div class="col-xs-12 col-sm-6 col-md-3">			
					            		<li>
					             			<a href="{{url('/'.$v->Alias)}}.html" title="{{$v->Name}}">
					             				<img src="{{url('images/news/'.$v->Images)}}" alt="{{$v->Name}}">
					             				<b>{{$v->Name}}</b>
					             				<p>
					             					{{ str_limit($v->SmallDescription, $limit = 90, $end ='...')}}
					             					<span>[mở rộng]</span>
					             				</p>
					             			</a>
					             		</li>
					            </div>
					            @endforeach
					            @endif
			        		</ul>
	        	    </div>
	            </div>
	        </div>
	    </div>

</div>

@stop