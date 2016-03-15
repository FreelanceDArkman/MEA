@extends('frontend.layouts.content_chart')
@section('content')

        {{--<!--=== Search Block Version 2 ===-->--}}
{{--<div class="search-block-v2">--}}
    {{--<div class="container">--}}
        {{--<div class="col-md-6 col-md-offset-3">--}}
            {{--<h2>Search again</h2>--}}
            {{--<form action="{{action('SearchController@getIndex')}}" method="post">--}}
                {{--{!! csrf_field() !!}--}}
            {{--<div class="input-group">--}}
                {{--<input type="text" onkeypress="return clickButton(event,'btn_search');" id="search_text" class="form-control" value="{{$keyword}}" name="sKeys" placeholder="Search words with regular expressions ...">--}}
                    {{--<span class="input-group-btn">--}}
                        {{--<a class="btn-u" id="btn_search" type="submit"><i class="fa fa-search"></i> ค้นหา</a>--}}
                    {{--</span>--}}
            {{--</div>--}}
                {{--</form>--}}
        {{--</div>--}}
    {{--</div>--}}
{{--</div><!--/container-->--}}
{{--<!--=== End Search Block Version 2 ===-->--}}

        <div class="container s-results margin-bottom-50">
            <div class="col-xs-12">
                {!!  $NewTopic->NEWS_TOPIC_DETAIL  !!}
            </div>


        </div>

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

