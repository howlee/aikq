<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//CN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
    <?php
    $title = isset($title) ? $title : '爱看球-爱看球直播|世界杯直播|俄罗斯|沙特|爱看球JRS|JRS直播|NBA直播|NBA录像|CBA直播|英超直播|西甲直播|低调看|直播吧|CCTV5在线';
    $keywords = isset($keywords) ? $keywords : '爱看球,爱看球直播,俄罗斯,沙特,JRS,JRS直播,NBA直播,NBA录像,CBA直播,英超直播,西甲直播,足球直播,篮球直播,低调看,直播吧,CCTV5在线,CCTV5+';
    $description = isset($description) ? $description : '爱看球是一个专业为球迷提供免费的NBA,CBA,英超,西甲,德甲,意甲,法甲,中超,欧冠,世界杯等各大体育赛事直播、解说平台，无广告，无插件，高清，直播线路多';
    ?>
    <meta charset="UTF-8">
    <title>{{$title}}</title>
    <meta name="Keywords" content="{{$keywords}}">
    <meta name="Description" content="{{$description}}">
    <meta http-equiv="X-UA-Compatible" content="edge" />
    <meta name="renderer" content="webkit|ie-stand|ie-comp">
    <meta name="baidu-site-verification" content="nEdUlBWvbw">
    @if(isset($ma_url))
    <meta http-equiv="mobile-agent" content="format=xhtml; url={{$ma_url}}">
    <meta http-equiv="mobile-agent" content="format=html5; url={{$ma_url}}">
    @endif
    <link rel="stylesheet" type="text/css" href="{{env('CDN_URL')}}/css/pc/style.css?time={{date('YmdHi')}}">
    @yield('css')
    <link rel="Shortcut Icon" data-ng-href="{{env('CDN_URL')}}/img/pc/ico.ico" href="{{env('CDN_URL')}}/img/pc/ico.ico">
    <script type="text/javascript">
        if(/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) {
            if(/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) {
                var url = window.location.href;
                if (url.indexOf("mp.dlfyb.com") != -1) {
                    url = url.replace(/(https?:\/\/)(mp\.)?/, "$1m.");
                    window.location.href = url;
                } else {
                    url = url.replace(/(https?:\/\/)(www\.)?/, "$1m.");
                    window.location.href = url;
                }
            }
        }
    </script>
</head>
<body>
<div id="Navigation">
    @yield('h1')
    <div class="inner">
        <a href="{{env('WWW_URL')}}"><img class="icon" src="{{env('CDN_URL')}}/img/pc/logo_akq.png"></a>
        {{--<p class="wx">关注【<span> i看球 </span>】公众号，看球领现金红包！<img src="{{env('CDN_URL')}}/img/pc/WechatIMG60.jpeg"></p>--}}
        <a class="column{{isset($check) && $check == 'all' ? ' on' : ''}}" href="/">直播</a>
        <a class="column{{isset($check) && $check == 'anchor' ? ' on' : ''}}" href="/anchor/">主播</a>
        {{--<a class="column{{isset($check) && $check == 'videos' ? ' on' : ''}}" href="/live/subject/videos/all/1.html">录像</a>--}}
        <a class="column{{isset($check) && $check == 'news' ? ' on' : ''}}" href="/news/">资讯</a>
        {{--<a class="column" href="https://www.liaogou168.com/recommends.html" target="_blank">推荐</a>--}}
{{--        <a class="column {{isset($check) && $check == 'business' ? ' on' : ''}}" href="/business.html" target="_blank">源调用</a>--}}
        {{--<a class="column{{isset($check) && $check == 'basket' ? ' on' : ''}}" href="/basketball.html">篮球</a>--}}
        <a class="column" href="/download/index.html" target="">下载</a>
        @yield('nav_inner')
    </div>
</div>
@yield('content')
<?php //$links = \App\Http\Controllers\PC\Live\LiveController::links(); ?>
<div id="Bottom">
    {{--<p>友情链接：@foreach($links as $link)<a target="_blank" href="{{$link['url']}}">{{$link['name']}}</a>@endforeach </p>--}}
    {{--<p class="business"><a target="_blank" href="/live/business.html">视频调用</a></p>--}}
    <p><a target="_blank" href="{{env('WWW_URL')}}">爱看球</a><a target="_blank" href="{{env('WWW_URL')}}">JRS直播</a><a target="_blank" href="{{env('WWW_URL')}}">低调看直播</a></p>
    <p>Copyright 2014-2015 ©aikanqiu.com, All rights reserved.</p>
    <p>免责声明：本站所有直播和视频链接均由网友提供，如有侵权问题，请及时联系，我们将尽快处理。</p>
    <p>业务联系QQ：2080989735（商务合作）</p>
</div>
@yield('bottom')
</body>
<script type="text/javascript" src="//apps.bdimg.com/libs/jquery/2.1.4/jquery.min.js"></script>
<!--[if lte IE 8]>
<script type="text/javascript" src="{{env('CDN_URL')}}/js/public/pc/jquery_191.js"></script>
<![endif]-->
@yield('js')
<script>
    var _hmt = _hmt || [];
    (function() {
        var hm = document.createElement("script");
        hm.src = "https://hm.baidu.com/hm.js?2966b2031ac2b01631362b1474d7f853";
        var s = document.getElementsByTagName("script")[0];
        s.parentNode.insertBefore(hm, s);
    })();
</script>
@if(isset($submitBD))
<script>
    (function(){
        var bp = document.createElement('script');
        var curProtocol = window.location.protocol.split(':')[0];
        if (curProtocol === 'https') {
            bp.src = 'https://zz.bdstatic.com/linksubmit/push.js';
        }
        else {
            bp.src = 'http://push.zhanzhang.baidu.com/push.js';
        }
        var s = document.getElementsByTagName("script")[0];
        s.parentNode.insertBefore(bp, s);
    })();
</script>
@endif
</html>