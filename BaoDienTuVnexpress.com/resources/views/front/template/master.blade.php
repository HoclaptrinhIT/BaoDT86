
<!DOCTYPE html>
<html dir="ltr" lang="vi">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="robots" content="noodp,index,follow" />
    <meta name='revisit-after' content='1 days' />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>@yield('title')</title>
    <meta name="description" content="@yield('description')" />
    <meta name="keywords" content="@yield('keywords')" />
    <link rel="shortcut icon" type="image/x-icon" href="{{url('images/favicon/'.$favicon->Description)}}" />
    <link rel="canonical" href="@yield('url')" />    
    <meta property="og:locale" itemprop="inLanguage" content="vi_VN"  />   
    <meta property="og:url" content="@yield('url')" /> 
    <meta property="og:type" content="article" />
    <meta property="og:title" content="@yield('title')" />
    <meta property="og:description" content="@yield('description')" />
    <meta property="og:image" content="@yield('images')" />    
    <meta property="og:site_name" content="wed tin tức vnexpress" />    
    <meta name="copyright" content="wed tin tức vnexpress"/> 
    <meta name="author" content="wed tin tức vnex">
    <meta name="geo.placename" content="Ho Chi Minh, Viet Nam"/>
    <meta name="geo.region" content="VN-HCM"/>

   
    <link href="{{url('/public/fontawesome-free-5.15.4/css/all.css')}}" rel="stylesheet" />
    <link href="{{url('/public/bootstrap-3.4.1/dist/css/bootstrap.css')}}" rel="stylesheet" />
    <link href="{{url('/public/css/style.css')}}" rel="stylesheet" />
    <script type="text/javascript">var url = "{!!url('/')!!}";</script> 

  </head>
  <body >  
    <input type="hidden" id="_token" value="{{ csrf_token() }}" />
    <div id="wrapper">
     @include('front.template.header')
      <div class="content">
        @yield('content')
      </div>
      @include('front.template.footer')
      
    </div>
  </body>
  <script src="{{url('/public/js/jquery.js')}}"></script>
  <script src="{{url('/public/bootstrap-3.4.1/dist/js/bootstrap.min.js')}}"></script> 
  <script src="{{url('/public/js/front.js')}}"></script>  
  </html>