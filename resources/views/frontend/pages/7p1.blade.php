@extends('frontend.layouts.content')
@section('content')

    <div class="heading heading-v1 margin-bottom-40">
        <h2>ข่าวประชาสัมพันธ์</h2>

    </div>


    <div class="row">
        <!-- Blog Sidebar -->
        <div class="col-md-3">

            <div class="headline-v2 bg-color-light"><h2>ข่าวประชาสัมพันธ์</h2></div>
            <!-- Tags v2 -->
            <ul class="list-inline tags-v2 margin-bottom-50">
                <li><a href="/news">ข่าวประชาสัมพันธ์</a></li>
                <li><a href="/newsfund">ข่าวกองทุน</a></li>



            </ul>
            <!-- End Tags v2 -->


        </div>
        <!-- End Blog Sidebar -->

        <!-- Blog All Posts -->
        <div class="col-md-9">


            <div class="row news-v1">

                @if($netasset)
                    @foreach($netasset as $index => $item)


                        <div class="col-md-4 md-margin-bottom-40">
                            <div class="news-v1-in">
                                @if($item->THUMBNAIL)
                                    <img class="img-responsive" src="{{$item->THUMBNAIL}}" alt="">
                                @else
                                    <img class="img-responsive" src="frontend/assets/img/main/img11.jpg" alt="">
                                @endif




                                @if($item->FILE_PATH)
                                    <h3><a target="_blank" href="{{$item->FILE_PATH}}" ><i class="fa fa-file-pdf-o" style="color: red"></i>{{$item->FILE_NAME}}</a></h3>
                                @else
                                    <h3><a href="#" data-toggle="modal" data-target="#modol_{{$item->NEWS_TOPIC_ID}}">{{$item->FILE_NAME}}</a></h3>
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
                                    {{--<li class="pull-right"><a href="#"><i class="fa fa-comments-o"></i> 14</a></li>--}}
                                </ul>


                                @if($item->FILE_PATH)


                                @endif

                            </div>
                        </div>

                    @endforeach
                @endif


            </div>
            <!-- End Pager v3 -->
        </div>
        <!-- End Blog All Posts -->

        <div class="clearfix"></div>

        <div class="text-center">
            {{$netasset->links()}}
        </div>
    </div>



@stop

