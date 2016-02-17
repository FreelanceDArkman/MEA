@extends('frontend.layouts.content')
@section('content')

    <div class="sorting-block">
        <div class="content-xs">
            <ul class="sorting-nav sorting-nav-v1 text-center">
                <li class="filter" data-filter="all">All</li>
                <li class="filter" data-filter="category_1">UI Design</li>
                <li class="filter" data-filter="category_2">Wordpress</li>
                <li class="filter" data-filter="category_3">HTML5/CSS3</li>
                <li class="filter" data-filter="category_4">Bootstrap 3</li>
            </ul>
        </div>

        <ul class="row sorting-grid">
            <li class="col-md-3 col-sm-6 col-xs-12 mix category_1 category_3" data-cat="1">
                <a href="#">
                    <img class="img-responsive" src="frontend/assets/img/main/img11.jpg" alt="">
                        <span class="sorting-cover">
                            <span>Happy New Year</span>
                            <p>Anim pariatur cliche reprehenderit</p>
                        </span>
                </a>
            </li>
            <li class="col-md-3 col-sm-6 col-xs-12 mix category_3 category_1" data-cat="3">
                <a href="#">
                    <img class="img-responsive" src="frontend/assets/img/main/img12.jpg" alt="">
                        <span class="sorting-cover">
                            <span>Happy New Year</span>
                            <p>Anim pariatur cliche reprehenderit</p>
                        </span>
                </a>
            </li>
            <li class="col-md-3 col-sm-6 col-xs-12 mix category_2 category_1" data-cat="2">
                <a href="#">
                    <img class="img-responsive" src="frontend/assets/img/main/img13.jpg" alt="">
                        <span class="sorting-cover">
                            <span>Happy New Year</span>
                            <p>Anim pariatur cliche reprehenderit</p>
                        </span>
                </a>
            </li>
            <li class="col-md-3 col-sm-6 col-xs-12 mix category_3 category_4" data-cat="3">
                <a href="#">
                    <img class="img-responsive" src="frontend/assets/img/main/img3.jpg" alt="">
                        <span class="sorting-cover">
                            <span>Happy New Year</span>
                            <p>Anim pariatur cliche reprehenderit</p>
                        </span>
                </a>
            </li>
            <li class="col-md-3 col-sm-6 col-xs-12 mix category_2 category_1 category_4" data-cat="2">
                <a href="#">
                    <img class="img-responsive" src="frontend/assets/img/main/img2.jpg" alt="">
                        <span class="sorting-cover">
                            <span>Happy New Year</span>
                            <p>Anim pariatur cliche reprehenderit</p>
                        </span>
                </a>
            </li>
            <li class="col-md-3 col-sm-6 col-xs-12 mix category_4" data-cat="1">
                <a href="#">
                    <img class="img-responsive" src="frontend/assets/img/main/img6.jpg" alt="">
                        <span class="sorting-cover">
                            <span>Happy New Year</span>
                            <p>Anim pariatur cliche reprehenderit</p>
                        </span>
                </a>
            </li>
            <li class="col-md-3 col-sm-6 col-xs-12 mix category_2 category_3  category_4" data-cat="2">
                <a href="#">
                    <img class="img-responsive" src="frontend/assets/img/main/img8.jpg" alt="">
                        <span class="sorting-cover">
                            <span>Happy New Year</span>
                            <p>Anim pariatur cliche reprehenderit</p>
                        </span>
                </a>
            </li>
            <li class="col-md-3 col-sm-6 col-xs-12 mix category_1 category_2 category_3" data-cat="1">
                <a href="#">
                    <img class="img-responsive" src="frontend/assets/img/main/img1.jpg" alt="">
                        <span class="sorting-cover">
                            <span>Happy New Year</span>
                            <p>Anim pariatur cliche reprehenderit</p>
                        </span>
                </a>
            </li>
            <li class="col-md-3 col-sm-6 col-xs-12 mix category_4 category_2" data-cat="1">
                <a href="#">
                    <img class="img-responsive" src="frontend/assets/img/main/img11.jpg" alt="">
                        <span class="sorting-cover">
                            <span>Happy New Year</span>
                            <p>Anim pariatur cliche reprehenderit</p>
                        </span>
                </a>
            </li>
            <li class="col-md-3 col-sm-6 col-xs-12 mix category_3 category_2" data-cat="3">
                <a href="#">
                    <img class="img-responsive" src="frontend/assets/img/main/img12.jpg" alt="">
                        <span class="sorting-cover">
                            <span>Happy New Year</span>
                            <p>Anim pariatur cliche reprehenderit</p>
                        </span>
                </a>
            </li>
        </ul>

        <div class="clearfix"></div>
    </div>

@stop

