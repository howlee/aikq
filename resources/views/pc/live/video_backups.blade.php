@extends('pc.layout.base')
@section('content')
    <div id="Content">
        @if(isset($zhuanti))
            <div id="Crumb"><a href="/">爱看球</a>&nbsp;&nbsp;>  <a href="/{{$zhuanti['name_en']}}/">{{$zhuanti['name']}}</a>  >&nbsp;&nbsp;<span class="on">{{$match['hname']}}@if(!empty($match['aname']))&nbsp;&nbsp;VS&nbsp;&nbsp;{{$match['aname']}}@endif</span></div>
        @else
            <div id="Crumb"><a href="/">爱看球</a>&nbsp;&nbsp;>&nbsp;&nbsp;<span class="on">{{$match['hname']}}@if(!empty($match['aname']))&nbsp;&nbsp;VS&nbsp;&nbsp;{{$match['aname']}}@endif</span></div>
        @endif
        <div class="inner">
            <div id="Info">
                <h1 class="name">{{$match['lname']}}直播：{{$match['hname']}}@if(!empty($match['aname']))　VS　{{$match['aname']}}@endif</h1>
                <p class="line">
                    <?php $channels = $live['channels']; ?>
                    @if(isset($channels))
                        @foreach($channels as $index=>$channel)
                            @continue($channel['player'] == \App\Models\Match\MatchLiveChannel::kPlayerExLink)
                            <?php
                                $player = $channel['player'];
                                if ($player == 11) {
                                    $link = '/live/iframe/player-'.$channel['id'].'-'.$channel['type'].'.html';
                                } else {
                                    $link = '/live/player/player-'.$channel['id'].'-'.$channel['type'].'.html';
                                }
                            ?>
                            <button id="{{$channel['channelId']}}"onclick="ChangeChannel('{{$link}}', this)">{{$channel['name']}}</button>
                        @endforeach
                    @endif
                    {{--<span>如视频出现卡顿或停止播放，请点击<a href="javascript:(function () {document.getElementById('Frame').src = document.getElementById('Frame').src;})();">[刷新]</a></span>--}}
                </p>
            </div>
            <div class="iframe" id="Video">
                @if($match['status'] == 0 && !$show_live)
                @elseif($show_live)
                @elseif($match['status'] == -1 && !$show_live)
                    {{--<p class="noframe"><img src="/img/pc/icon_matchOver.png">比赛已结束</p>--}}
                @endif
                <div class="ADWarm_RU" style="display: none;"><p onclick="document.getElementById('Video').removeChild(this.parentNode)">· 我知道了 ·</p></div>
            </div>
            <div class="share" id="Share" style="display:none;">
                复制此地址分享：<input type="text" name="share" value="" onclick="Copy()"><span></span>
            </div>
            @if(isset($articles) && count($articles) > 0)
            <div id="News">
                <div class="title">相关文章</div>
                @foreach($articles as $article)
                <a target="_blank" href="{{$article['url']}}">{{$article['title']}}</a>
                @endforeach
                <p class="clear"></p>
            </div>
            @endif
        </div>
        <div class="adbanner inner"><img src="{{env('CDN_URL')}}/img/pc/banner_pc_868.jpg"><img class="show" src="{{env('CDN_URL')}}/img/pc/image_qr_868.jpg"></div>
        <div class="adbanner inner"><a href="/download/index.html" target="_blank"><img src="{{env('CDN_URL')}}/img/pc/image_ad_pc.jpg"></a></div>
    </div>
    <div class="clear"></div>
@endsection
@section('js')
    <script type="text/javascript" src="{{env('CDN_URL')}}/js/public/pc/video.js?time=2018020001"></script>
    <script type="text/javascript">
        window.onload = function () { //需要添加的监控放在这里
            setADClose();
            LoadVideo();
        }
        function changeShare(link, obj) {
            if (obj.className.indexOf('on') != -1) {
                return;
            }
            $("#Info button").removeClass('on');
            $(obj).addClass('on');
            $("#Share input").val(link);
        }
    </script>
@endsection
@section('css')
    <link rel="stylesheet" type="text/css" href="{{env('CDN_URL')}}/css/pc/video.css?time=2018020003">
@endsection