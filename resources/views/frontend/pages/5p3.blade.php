@extends('frontend.layouts.content_chart')
@section('content')
    <?php
    $data = getmemulist();
    ?>
    <div class="heading heading-v1 margin-bottom-40">
        <h2>{{ getMenuName($data,5,3) }}</h2>

    </div>




    <div class="row">
        <!-- Blog Sidebar -->
        <div class="col-md-3">

            <div class="headline-v2 bg-color-light"><h2>{{ getGoupName($data,5) }}</h2></div>
            <!-- Tags v2 -->
            <ul class="list-inline tags-v2 margin-bottom-50">
                <li><a href="/membershipform">{{ getMenuName($data,5,1) }}</a></li>
                <li><a href="/form">{{ getMenuName($data,5,2) }}</a></li>
                <li><a href="/otherforms">{{ getMenuName($data,5,3) }}</a></li>



            </ul>
            <!-- End Tags v2 -->


        </div>
        <!-- End Blog Sidebar -->

        <!-- Blog All Posts -->
        <div class="col-md-9">

            @include('frontend.includes.sort')
            {{--<div class="tab-v1">--}}
                {{--<ul class="nav nav-tabs">--}}

                    {{--@if($sortby == 1 || $sortby == null)--}}
                        {{--<li class="active"><a href="/otherforms/1" >มาใหม่</a></li>--}}
                        {{--<li><a href="/otherforms/2" >เปิดดู</a></li>--}}
                        {{--<li><a href="/otherforms/3" >ดาวโหลด</a></li>--}}
                    {{--@elseif($sortby == 2)--}}
                        {{--<li ><a href="/otherforms/1" >มาใหม่</a></li>--}}
                        {{--<li class="active"><a href="/otherforms/2"  >เปิดดู</a></li>--}}
                        {{--<li><a href="/otherforms/3" >ดาวโหลด</a></li>--}}
                    {{--@elseif($sortby == 3)--}}
                        {{--<li ><a href="/otherforms/1" >มาใหม่</a></li>--}}
                        {{--<li ><a href="/otherforms/2"  >เปิดดู</a></li>--}}
                        {{--<li class="active"><a href="/otherforms/3" >ดาวโหลด</a></li>--}}
                    {{--@endif--}}

                {{--</ul>--}}

            {{--</div>--}}

            <br/>





            <style>



            </style>



            @if($netasset)



                <div class="row news-v1">


                    <div class="col-xs-12 col-md-12">

                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>ไฟล์แนบ</th>
                                    <th>ขนาดไฟล์</th>
                                    @if($sortby== 1 || $sortby == 2)
                                        <th>จํานวนการดูข้อมลู </th>
                                        <th>วันที่ดูข้อมูลล่าสุด</th>
                                    @else
                                        <th>จำนวนการดาวน์โหลด</th>
                                        <th>วันที่ดาวน์โหลดข้อมุลล่าสุด</th>
                                    @endif

                                    <th>ดาวน์โหลด</th>
                                    <th>คัดลอก URL</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($netasset as $index => $item)
                                    <tr>
                                        <td><a target="_blank" href="/view/{{$item->NEWS_CATE_ID ."-". $item->NEWS_TOPIC_ID}}"><i class="fa fa-file-pdf-o" style="color: red"></i> {{$item->FILE_NAME}}</a></td>
                                        <td style="text-align: center">{{ getfilesize($item->FILE_PATH)     }}</td>
                                        @if($sortby== 1 || $sortby == 2)
                                            <td style="text-align: center">{{$item->VIEW_STAT}}</td>
                                            <td style="text-align: center">{{get_date_notime($item->LAST_VIEW_DATE)}}</td>
                                        @else
                                            <td style="text-align: center">{{$item->DL_STAT}}</td>
                                            <td style="text-align: center">{{get_date_notime($item->LAST_DL_DATE)}}</td>
                                        @endif
                                        <td style="text-align: center"> <a  class="download_pdf" href="/download/{{$item->NEWS_CATE_ID ."-". $item->NEWS_TOPIC_ID}}"><i class="fa fa-download"></i></a></td>
                                        <td style="text-align: center">

                                            <input style="display: none" type="text"  id="copy_clip_{{$item->NEWS_TOPIC_ID}}" name="Element To Be Copied" id="copy-me" value="{{ asset('download/' . $item->NEWS_CATE_ID ."-". $item->NEWS_TOPIC_ID) }}" />


                                            <a href="#" data-copyclip="copy_clip_{{$item->NEWS_TOPIC_ID}}" class="copy-btn"><i class="fa fa-clipboard"></i></a>

                                            {{--<button  >Copy</button><br/><br/>--}}

                                            {{--<input style="display: none"  id="copyme_{{$item->NEWS_TOPIC_ID}}"  />--}}
                                            {{--<button data-copytarget="#copyme_{{$item->NEWS_TOPIC_ID}}">copy</button>--}}
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>

                            </table>
                        </div>

                    </div>






                    <div class="clearfix"></div>
                </div>


                @endif




                        <!-- End Pager v3 -->
        </div>
        <!-- End Blog All Posts -->

        <div class="clearfix"></div>
    </div>

@stop

