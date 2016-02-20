@extends('frontend.layouts.content')
@section('content')

    <div class="heading heading-v1 margin-bottom-40">
        <h2>คำสั่งแต่งตั้งคณะกรรมการ</h2>

    </div>




    <div class="row">
        <!-- Blog Sidebar -->
        <div class="col-md-3">

            <div class="headline-v2 bg-color-light"><h2>ประมวลระเบียบ</h2></div>
            <!-- Tags v2 -->
            <ul class="list-inline tags-v2 margin-bottom-50">
                <li><a href="/announce">ประกาศ</a></li>
                <li><a href="/actfund">พระราชบัญญัติกองทุนสำรองเลี้ยงชีพ</a></li>
                <li><a href="/board">คำสั่งแต่งตั้งคณะกรรมการ</a></li>
                <li><a href="/fundregulations">ข้อบังคับกองทุน</a></li>

            </ul>
            <!-- End Tags v2 -->


        </div>
        <!-- End Blog Sidebar -->

        <!-- Blog All Posts -->
        <div class="col-md-9">
            <div class="sorting-block">
                {{--<div class="content-xs">--}}
                {{--<ul class="sorting-nav sorting-nav-v1 text-center">--}}
                {{--<li class="filter" data-filter="all">All</li>--}}
                {{--<li class="filter" data-filter="category_1">UI Design</li>--}}
                {{--<li class="filter" data-filter="category_2">Wordpress</li>--}}
                {{--<li class="filter" data-filter="category_3">HTML5/CSS3</li>--}}
                {{--<li class="filter" data-filter="category_4">Bootstrap 3</li>--}}
                {{--</ul>--}}
                {{--</div>--}}

                <ul class="row sorting-grid">
                    @if($netasset)
                        @foreach($netasset as $index => $item)
                            <li class="col-md-3 col-sm-6 col-xs-12 mix category_1 category_3" data-cat="1">
                                <a target="_blank" href="{{$item->FILE_PATH}}">
                                    <img class="img-responsive" src="frontend/assets/custom_pic/pdf.jpg" alt="">
                            <span class="sorting-cover">
                                <span>{{$item->FILE_NAME}}</span>
                                {{--<p>Anim pariatur cliche reprehenderit</p>--}}
                            </span>
                                </a>
                            </li>

                        @endforeach
                    @endif
                </ul>

                <div class="clearfix"></div>

                <div class="text-center">
                    {{$netasset->links()}}
                </div>
            </div>
            <!-- End Pager v3 -->
        </div>
        <!-- End Blog All Posts -->
    </div>


@stop

