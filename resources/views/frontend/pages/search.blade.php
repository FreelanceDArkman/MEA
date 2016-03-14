@extends('frontend.layouts.content_chart')
@section('content')

        <!--=== Search Block Version 2 ===-->
<div class="search-block-v2">
    <div class="container">
        <div class="col-md-6 col-md-offset-3">
            <h2>Search again</h2>
            <form action="{{action('SearchController@getIndex')}}" method="post">
                {!! csrf_field() !!}
            <div class="input-group">
                <input type="text" onkeypress="return clickButton(event,'btn_search');" id="search_text" class="form-control" value="{{$keyword}}" name="sKeys" placeholder="Search words with regular expressions ...">
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
    <span class="results-number">About {{$allrecord}} results</span>

    @if($recordss)
            @foreach($recordss as $key =>$value)

                @if($value['searchkey'] == "1")

                <div class="inner-results">
                    <h3><a href="#">{{$value['title'] }}</a></h3>
                    <ul class="list-inline up-ul">
                        <li>https://wrapbootstrap.com/‎</li>

                        <li><a href="#">Admin</a></li>
                        <li><a href="#">Template</a></li>
                        <li><a href="#">OnePage Template</a></li>
                        <li><a href="#">Joomla</a></li>
                    </ul>
                    <div class="overflow-h">
                        <img src="{{$value['thumb']}}" alt="">
                        <div class="overflow-a">
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum ut orci urna. Morbi blandit enim eget risus posuere dapibus. Vestibulum velit nisi, tempus in placerat non, auctor eu purus. Morbi suscipit porta libero, ac tempus tellus consectetur non. Praesent eget consectetur nunc. Aliquam erat volutpat. Suspendisse ultrices eros eros, consectetur facilisis urna posuere id.</p>
                            <ul class="list-inline down-ul">
                                <li>
                                    <ul class="list-inline star-vote">
                                        <li><i class="color-green fa fa-star"></i></li>
                                        <li><i class="color-green fa fa-star"></i></li>
                                        <li><i class="color-green fa fa-star"></i></li>
                                        <li><i class="color-green fa fa-star"></i></li>
                                        <li><i class="color-green fa fa-star-half-o"></i></li>
                                    </ul>
                                </li>
                                <li>11 months ago - By WrapBootstrap</li>
                                <li>2,092,675 views</li>
                            </ul>
                        </div>
                    </div>
                </div>
                @endif

                @if($value['searchkey'] == "0")
                    <div class="inner-results">
                        <h3><a href="#">{{$value['title'] }}</a></h3>
                        <ul class="list-inline up-ul">
                            <li>https://wrapbootstrap.com/‎</li>

                            <li><a href="#">Admin</a></li>
                            <li><a href="#">Template</a></li>
                            <li><a href="#">OnePage Template</a></li>
                            <li><a href="#">Joomla</a></li>
                        </ul>
                        <div class="overflow-h">
                            <img src="assets/img/testimonials/img1.jpg" alt="">
                            <div class="overflow-a">
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum ut orci urna. Morbi blandit enim eget risus posuere dapibus. Vestibulum velit nisi, tempus in placerat non, auctor eu purus. Morbi suscipit porta libero, ac tempus tellus consectetur non. Praesent eget consectetur nunc. Aliquam erat volutpat. Suspendisse ultrices eros eros, consectetur facilisis urna posuere id.</p>
                                <ul class="list-inline down-ul">
                                    <li>
                                        <ul class="list-inline star-vote">
                                            <li><i class="color-green fa fa-star"></i></li>
                                            <li><i class="color-green fa fa-star"></i></li>
                                            <li><i class="color-green fa fa-star"></i></li>
                                            <li><i class="color-green fa fa-star"></i></li>
                                            <li><i class="color-green fa fa-star-half-o"></i></li>
                                        </ul>
                                    </li>
                                    <li>11 months ago - By WrapBootstrap</li>
                                    <li>2,092,675 views</li>
                                </ul>
                            </div>
                        </div>
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

