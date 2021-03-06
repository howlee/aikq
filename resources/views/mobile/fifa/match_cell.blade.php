<?php
$status = $match['status'];
$mid = $match['mid'];
$lid = $match['lid'];

if($status > 0){
    $matchTime = \App\Http\Controllers\PC\CommonTool::getMatchWapCurrentTime($match['time'],$match['timehalf'],$match['status']);;
}
else{
    $matchTime = '';
}

if($status > 0)
    $matchUrl = $matchUrl.'#Match';

//角球比分
$cornerScore = "-";
//半场比分
$halfScore = "";
if ($status > 0 || $status == -1) {
    $halfScore = ($status == 1) ? "" : ('（'.$match['hscorehalf'] . " - " . $match['ascorehalf'].'）');

    if (isset($match['h_corner'])) {
        $cornerScore = $match['h_corner'] . " - " . $match['a_corner'];
    }
}

//默认是否显示
$liveUrl = \App\Http\Controllers\PC\CommonTool::matchWapLivePathWithId($match['mid']);
$matchUrl = \App\Http\Controllers\PC\CommonTool::matchWapPathWithId($mid,1);

$hicon = isset($match['hicon']) && strlen($match['hicon']) > 0 ? $match['hicon'] : env('CDN_URL').'/img/mobile/icon_teamDefault.png';
$aicon = isset($match['aicon']) && strlen($match['aicon']) > 0 ? $match['aicon'] : env('CDN_URL').'/img/mobile/icon_teamDefault.png';
?>
<a m_status="{{$match['status']}}" id="match_cell_{{$match['mid']}}" class="item" href="{{$status > 0 ? $liveUrl : $matchUrl}}">
    <div id="time_{{$match['mid']}}" class="part group">
        <p>{{date('m/d H:i',$match['time'])}}</p>
        @if($status > 0)
            <p class="live"><span class="minute">{{$matchTime}}</span></p>
        @elseif($status == -1)
            <p class="end"></p>
        @else
            <p><img src="{{env('CDN_URL')}}/img/mobile/fifa/icon_living_n.png"></p>
        @endif
    </div>
    <div class="part">
        <p class="team"><img src="{{$hicon}}">{{$match['hname']}}</p>
        <p class="team"><img src="{{$aicon}}">{{$match['aname']}}</p>
    </div>
    <div class="part">
        <p class="hscore">{{$match['hscore']}}</p>
        <p class="ascore">{{$match['ascore']}}</p>
    </div>
    <div class="part half">
        <p class="hscorehalf">{{$match['hscorehalf']}}</p>
        <p class="ascorehalf">{{$match['ascorehalf']}}</p>
    </div>
    <div class="part">
        <p>
            <span class="hyellow yellow">{{$match['h_yellow']?$match['h_yellow']:0}}</span><span class="hred red">{{$match['h_red']?$match['h_red']:0}}</span>
        </p>
        <p>
            <span class="ayellow yellow">{{$match['a_yellow']?$match['a_yellow']:0}}</span><span class="ared red">{{$match['a_red']?$match['a_red']:0}}</span>
        </p>
    </div>
</a>