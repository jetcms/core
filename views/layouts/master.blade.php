<!DOCTYPE html>
<html lang="ru">
<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{csrf_token()}}">

  <!--не выводить описание из яндекс каталога-->
  <meta name="robots" content="noyaca"/>
  <!--не выводить описание из DMOZ-->
  <meta name="robots" content="noodp"/>
  <meta name="descri" content="noodp"/>

  @section('head_seo')
    {!! SEO::generate() !!}
  @show

  <link href="/css/app.css" rel="stylesheet">

  @section('head')
  @show
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
  <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
  <![endif]-->


</head>
<body>

  @include('jetcms.menu::widgets.top_menu')
  @include('jetcms.menu::widgets.sub_top_menu')

  @section('body')
    <div class="container">
      <div class="row">
        <div class="col-md-3">
          @section('body_left')

          @show
        </div>
        <div class="col-md-8">
          @section('body_center')
            @if (isset($page))
              {!!$page->content or ''!!}
            @endif
          @show
        </div>
        <div class="col-md-1">
          @section('body_right')
            @include('jetcms.core::chunk.share')
          @show
        </div>
      </div>
    </div>
  @show

  @include('jetcms.core::widgets.footer')
  <script src="/js/all.js"></script>
  @include('jetcms.core::chunk.analytic')

  @stack('script')

</body>
</html>