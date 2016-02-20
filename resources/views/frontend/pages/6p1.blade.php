@extends('frontend.layouts.content')
@section('content')

    <div class="heading heading-v1 margin-bottom-40">
        <h2>ถามตอบ </h2>

    </div>

    <div class="row">
        <!-- Blog Sidebar -->
        <div class="col-md-3">
            <div class="headline-v2 bg-color-light"><h2>ถาม-ตอบ</h2></div>
            <ul class="nav nav-pills nav-stacked">

                @if($qatopic)

                    @foreach($qatopic as $index => $item)
                        <li class=""><a href="/qa/{{$item->FAQ_CATE_ID}}"  ><i class="fa fa-circle"></i> {{$item->FAQ_CATE_NAME}}</a></li>

                    @endforeach

                @endif
            </ul>


        </div>
        <!-- End Blog Sidebar -->

        <!-- Blog All Posts -->
        <div class="col-md-9">

            <div class="tab-content">
                <div class="tab-pane fade active in" id="home-2">
                    <div class="tag-box tag-box-v3">

                    @if($netasset)

                            @foreach($netasset as $index => $item)
                                <p><span class="dropcap dropcap-bg bg-color-dark">Q</span>{{$item->FAQ_QUESTION_DETAIL}}</p>
                                <div class="clearfix"></div>
                                <blockquote class="hero">
                                    <p><em>"{{$item->FAQ_ANSWER_DETAIL}}"</em></p>
                                    {{--<small><em>Etiam porta sem malesuada</em></small>--}}
                                </blockquote>

                                <hr class="devider devider-dashed">
                            @endforeach
                    @endif

                    </div>
                </div>

            </div>

            <div class="text-center">
                {{$netasset->links()}}
            </div>

        </div>
        <!-- End Blog All Posts -->
    </div>



@stop

