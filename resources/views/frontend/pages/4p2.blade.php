@extends('frontend.layouts.content_chart')
@section('content')

    <div class="heading heading-v1 margin-bottom-40">
        <h2>แบบทดสอบ</h2>

    </div>




    <div class="row">
        <!-- Blog Sidebar -->
        <div class="col-md-3">

            <div class="headline-v2 bg-color-light"><h2>ความรู้การลงทุน</h2></div>
            <!-- Tags v2 -->
            <ul class="list-inline tags-v2 margin-bottom-50">
                <li><a href="/download">เอกสารดาวโหลด</a></li>
                <li><a href="/test">แบบทดสอบ</a></li>



            </ul>
            <!-- End Tags v2 -->


        </div>
        <!-- End Blog Sidebar -->

        <!-- Blog All Posts -->
        <div class="col-md-9">


            <div class="tab-v1">
                <ul class="nav nav-tabs">

                    @if($sortby == 1 || $sortby == null)
                        <li class="active"><a href="/test/1" >มาใหม่</a></li>
                        <li><a href="/test/2" >เปิดดู</a></li>
                        <li><a href="/test/3" >ดาวโหลด</a></li>
                    @elseif($sortby == 2)
                        <li ><a href="/test/1" >มาใหม่</a></li>
                        <li class="active"><a href="/test/2"  >เปิดดู</a></li>
                        <li><a href="/test/3" >ดาวโหลด</a></li>
                    @elseif($sortby == 3)
                        <li ><a href="/test/1" >มาใหม่</a></li>
                        <li ><a href="/test/2"  >เปิดดู</a></li>
                        <li class="active"><a href="/test/3" >ดาวโหลด</a></li>
                    @endif

                </ul>

            </div>

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
                                    <th>จำนวนการดาวโหลด</th>
                                    <th>วันที่ทำรายการ</th>
                                    <th>ดาวโหลด</th>
                                    <th>คัดลอก URL</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($netasset as $index => $item)
                                    <tr>
                                        <td><a target="_blank" href="/view/{{$item->NEWS_CATE_ID ."-". $item->NEWS_TOPIC_ID}}"><i class="fa fa-file-pdf-o" style="color: red"></i> {{$item->FILE_NAME}}</a></td>
                                        <td style="text-align: center">{{ getfilesize($item->FILE_PATH)     }}</td>
                                        <td style="text-align: center">{{$item->DL_STAT}}</td>
                                        <td style="text-align: center">{{get_date_notime($item->LAST_DL_DATE)}}</td>
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

