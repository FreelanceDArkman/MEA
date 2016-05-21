<!-- Owl Clients v1 -->
<?php
$data = getClientLink();
?>

{{--{{var_dump($data)}}--}}
<div class="headline"></div>
<div class="owl-clients-v1">

    @if($data != null)

        @foreach($data as  $item )
            <div class="item">
                <a href="{{$item->URL}}" target="_blank" ><img src="{{asset('contents/') .'/client_'. $item->ID. '.png'}}" alt=""></a>
            </div>
        @endforeach
    @endif


        {{--<div class="item">--}}
            {{--<a href="http://www.sec.or.th/TH/Pages/Home.aspx" target="_blank" ><img src="{{asset('frontend/assets/client/1.png')}}" alt=""></a>--}}
        {{--</div>--}}
        {{--<div class="item">--}}
            {{--<a href="https://www.bot.or.th/Thai/Pages/default.aspx" target="_blank"><img src="{{asset('frontend/assets/client/2.png')}}" alt=""></a>--}}
        {{--</div>--}}
        {{--<div class="item">--}}
            {{--<a href="http://www.set.or.th/set/mainpage.do?language=th&country=TH" target="_blank" ><img src="{{asset('frontend/assets/client/3.png')}}" alt=""></a>--}}
        {{--</div>--}}
        {{--<div class="item">--}}
            {{--<a href="https://www.info.go.th/#/th/search///" target="_blank" ><img src="{{asset('frontend/assets/client/4.png')}}" alt=""></a>--}}
        {{--</div>--}}
</div>
<!-- End Owl Clients v1 -->