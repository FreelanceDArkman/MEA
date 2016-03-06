@extends('frontend.layouts.content_chart')
@section('content')
    <?php
    $data = getmemulist();
    ?>

    <div class="heading heading-v1 margin-bottom-40">
        <h2>{{ getMenuName($data,3,3) }}</h2>

    </div>




    <div class="row">
        <!-- Blog Sidebar -->
        <div class="col-md-3">

            <div class="headline-v2 bg-color-light"><h2>{{ getGoupName($data,3) }}</h2></div>
            <!-- Tags v2 -->
            <ul class="list-inline tags-v2 margin-bottom-50">
                <li><a href="/fundboard">{{ getMenuName($data,3,1) }}</a></li>
                <li><a href="/structuralfunds">{{ getMenuName($data,3,2) }}</a></li>
                <li><a href="/yearbook">{{ getMenuName($data,3,3) }}</a></li>


            </ul>
            <!-- End Tags v2 -->


        </div>
        <!-- End Blog Sidebar -->

        <!-- Blog All Posts -->
        <div class="col-md-9">


            <div class="tab-v1">
                <ul class="nav nav-tabs">

                    @if($sortby == 1 || $sortby == null)
                        <li class="active"><a href="/yearbook/1" >มาใหม่</a></li>
                        <li><a href="/yearbook/2" >เปิดดู</a></li>
                        <li><a href="/yearbook/3" >ดาวโหลด</a></li>
                    @elseif($sortby == 2)
                        <li ><a href="/yearbook/1" >มาใหม่</a></li>
                        <li class="active"><a href="/yearbook/2"  >เปิดดู</a></li>
                        <li><a href="/yearbook/3" >ดาวโหลด</a></li>
                    @elseif($sortby == 3)
                        <li ><a href="/yearbook/1" >มาใหม่</a></li>
                        <li ><a href="/yearbook/2"  >เปิดดู</a></li>
                        <li class="active"><a href="/yearbook/3" >ดาวโหลด</a></li>
                    @endif

                </ul>

            </div>

            <br/>









            @if($netasset)

                @foreach(array_chunk($netasset->all(),3) as $row)

                    <div class="row news-v1">

                        @foreach($row as $index => $item)


                            <div class="col-md-4 md-margin-bottom-40">
                                <div class="news-v1-in">
                                    @if($item->THUMBNAIL)
                                        <img class="img-responsive" src="{{$item->THUMBNAIL}}" alt="">
                                    @else
                                        <img class="img-responsive" src="frontend/assets/img/main/img11.jpg" alt="">
                                    @endif




                                    @if($item->FILE_PATH)
                                        <h3><a target="_blank" href="/view/{{$item->NEWS_CATE_ID ."-". $item->NEWS_TOPIC_ID}}"><i class="fa fa-file-pdf-o" style="color: red"></i>{{$item->FILE_NAME}}</a></h3>
                                    @else
                                        <h3>
                                            {{--{!! Form::open(['method' => 'DELETE', 'id'=>'delForm']) !!}--}}
                                            <a href="#"  data-modal="{{$item->NEWS_TOPIC_ID}}" data-param="{{$item->NEWS_CATE_ID ."-". $item->NEWS_TOPIC_ID}}">{{$item->FILE_NAME}}</a>
                                            {{--{!! Form::close() !!}--}}
                                        </h3>
                                        <div class="modal fade bs-example-modal-lg" id="modol_{{$item->NEWS_TOPIC_ID}}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                                                        <h4 id="myLargeModalLabel2" class="modal-title">{{$item->FILE_NAME}}</h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        {!!html_entity_decode($item->NEWS_TOPIC_DETAIL)!!}
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                        <!--<button type="button" class="btn btn-primary">Save changes</button>-->
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif



                                    {{--<p><i class="fa fa-file-pdf-o" style="color: red"></i></p>--}}
                                    <ul class="list-inline news-v1-info">
                                        <li><span>By</span> <a href="#">{{$item->CREATE_BY}}</a></li>
                                        <li>|</li>
                                        <li><i class="fa fa-clock-o"></i> {{get_date_notime($item->CREATE_DATE)}}</li>
                                        @if($item->FILE_PATH)
                                            <li class="pull-right ">

                                                {{--{{Crypt::encrypt($item->FILE_PATH)}}--}}
                                                <a  class="download_pdf" href="/download/{{$item->NEWS_CATE_ID ."-". $item->NEWS_TOPIC_ID}}"><i class="fa fa-download"></i> download</a>

                                            </li>
                                        @endif
                                    </ul>


                                    @if($item->FILE_PATH)


                                    @endif

                                </div>
                            </div>

                        @endforeach

                        <div class="clearfix"></div>
                    </div>

                @endforeach
            @endif







            <div class="text-center">
                {{$netasset->links()}}
            </div>
            <!-- End Pager v3 -->
        </div>
        <!-- End Blog All Posts -->

        <div class="clearfix"></div>
    </div>
    <script>




        $(document).ready(function(){

            //var $link = $("a[data-modal]");



            $("a[data-modal]").on('click',function(){


                var $param = $(this).attr('data-param');
                var $modal = $(this).attr('data-modal');

                $('#modol_' + $modal).modal('show')

                var jsondata = {rec : $param};

                $.ajax({
                    type: 'post', // or post?
                    dataType: 'json',
                    url: '/viewrecord',
                    data: jsondata,

                    success: function(data) {



                        // var ii = data;
//                                ) {
//                                    // notice that we are expecting a json array with success = true and a payload
//                                    //$('.modal').empty().append(data.payload).modal();
//                                } else {
//                                    // for debugging
//                                    if (data// alert(data);
//                                }
                    },
                    error: function(xhr, textStatus, thrownError) {
                        alert(xhr.status);
                        alert(thrownError);
                        alert(textStatus);
                    }
                });



                return false;

            });



        });
        //JS

    </script>

@stop

