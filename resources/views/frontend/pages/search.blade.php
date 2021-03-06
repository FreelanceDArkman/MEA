@extends('frontend.layouts.content_chart')
@section('content')

        <style>

            #search_text{
                font-size: 20px;
                height: 40px;
            }
        </style>

        <!--=== Search Block Version 2 ===-->
<div class="search-block-v2">
    <div class="container">
        <div class="col-md-6 col-md-offset-3">
            <h2>ระบุคำที่ต้องการค้นหา</h2>
            <form action="{{action('SearchController@getIndex')}}" method="post">
                {!! csrf_field() !!}
            <div class="input-group">
                <input type="text" onkeypress="return clickButton(event,'btn_search');" id="search_text" class="form-control" value="{{$keyword}}" name="sKeys" >
                    <span class="input-group-btn">
                        <a class="btn-u" id="btn_search" type="submit"><i class="fa fa-search"></i> ค้นหา</a>
                    </span>
            </div>
                </form>
        </div>
    </div>
</div><!--/container-->
<!--=== End Search Block Version 2 ===-->

<!--=== Search Results ===-->
<div class="container s-results margin-bottom-50">
    <span class="results-number" style="font-weight: bold;" >ค้นหาคำว่า : {{$keyword}}</span>
    <span class="results-number">ผลการค้นหา พบ {{$allrecord}} รายการ</span>

    @if($recordss)
            @foreach($recordss as $key =>$value)

                @if($value['searchkey'] == "1")

                <div class="inner-results">
                    @if($value['file_path'] && !(($value['cate_id'] == 7 && $value['topic_id'] == 1) || ($value['cate_id'] == 8 && $value['topic_id'] == 1)))
                        <h3><a target="_blank" href="/view/{{$value['cate_id'] ."-". $value['topic_id']}}">{{$value['title'] }}</a></h3>
                    @else

                        @if(($value['cate_id'] == 7 && $value['topic_id'] == 1) || ($value['cate_id'] == 8 && $value['topic_id'] == 1))
                            @if($value['cate_id'] == 7 && $value['topic_id'] == 1)
                                <h3><a target="_blank" href="/fundboard">{{$value['title'] }}</a></h3>
                            @elseif($value['cate_id'] == 8 && $value['topic_id'] == 1)
                                <h3><a target="_blank" href="/structuralfunds">{{$value['title'] }}</a></h3>
                                @endif
                        @else
                            <h3><a target="_blank" href="/search_detail?topic={{$value['cate_id'] ."-". $value['topic_id']}}">{{$value['title'] }}</a></h3>
                        @endif
                    @endif

                    <div class="overflow-h">
                        @if($value['thumb'])
                        <img src="{{$value['thumb']}}" alt="">
                        @endif
                        <div class="overflow-a">
                            <ul class="list-inline down-ul">

                                <li>{{get_date_notime($value['create_date'])}} - By {{ $value['create_by'] }}</li>
                                @if($value['file_path'])
                                <li>ดาวน์โหลด {{ $value['dl_stat'] }} ครั้ง</li>
                                @else
                                    <li>ดูข้อมูล {{$value['view_stat']}} ครั้ง</li>
                                @endif
                            </ul>

                            @if($value['file_path'])
                                <ul class="list-inline down-ul">
                                <li class="pull-left ">

                                    {{--{{Crypt::encrypt($item->FILE_PATH)}}--}}
                                    <a  class="download_pdf" href="/download/{{$value['cate_id'] ."-". $value['topic_id']}}"><i class="fa fa-download"></i> download</a>

                                </li>
                                </ul>
                            @endif
                        </div>
                    </div>
                </div>
                @endif

                @if($value['searchkey'] == "0")
                    <div class="inner-results">






                            <p><span class="dropcap dropcap-bg bg-color-dark" style="background-color: #fe5000;">Q</span>{{$value['title'] }}</p>
                            <div class="clearfix"></div>
                            <blockquote class="hero">
                                <em>{!! $value['detail'] !!}</em>
                                <div class="clearfix"></div>
                                <ul class="list-inline up-ul">
                                    <li><a target="_blank" href="/qa/{{$value['faq_cat_id']}}">อ่านทั้งหมด>></a>‎</li>

                                </ul>
                                <div class="clearfix"></div>
                            </blockquote>
                        <div class="clearfix"></div>


                    </div>
                @endif

            <hr>
        @endforeach
    @endif

    <div class="margin-bottom-30"></div>

    <div class="text-center">
        {{$recordss->links()}}
    </div>
</div><!--/container-->
<!--=== End Search Results ===-->

<script type="text/javascript">


    $(document).ready(function(){


        $("#btn_search").on('click',function(){

            var key= $("#search_text").val();

            var arrkey = key.split(" ");

            var keyret = "";
            for(i = 0; i< arrkey.length; i++){

                if(arrkey.length == 0){

                    if(arrkey[i] != ''){
                        keyret = keyret + arrkey[i] ;
                    }
                }

                if(arrkey.length > 0){

                    if(arrkey[i] != ''){

                        if( (i+1) < arrkey.length){
                            keyret = keyret + arrkey[i] + '+';
                        }else {
                            keyret = keyret + arrkey[i] ;
                        }


                    }
                }

            }


            window.location.href = "/search?keys=" + encodeURIComponent(keyret);



        });



        $('.pagination li a').each(function(){

//                alert($(this).attr('href'));
//
//            var vallnk = $(this).attr('href');
//
//            var arrq = vallnk.split('?');
//            var arrqpage = arrq[1].split('=');
//
//            var qkey = arrqpage[0];
//            var qval = arrqpage[1];

            var key= $("#search_text").val();

            var arrkey = key.split(" ");

            var keyret = "";
            for(i = 0; i< arrkey.length; i++){

                if(arrkey.length == 0){

                    if(arrkey[i] != ''){
                        keyret = keyret + arrkey[i] ;
                    }
                }

                if(arrkey.length > 0){

                    if(arrkey[i] != ''){

                        if( (i+1) < arrkey.length){
                            keyret = keyret + arrkey[i] + '+';
                        }else {
                            keyret = keyret + arrkey[i] ;
                        }


                    }
                }

            }

            $(this).attr('href', $(this).attr('href') + '&keys=' + encodeURIComponent(keyret));


        });


    });

</script>
@stop

