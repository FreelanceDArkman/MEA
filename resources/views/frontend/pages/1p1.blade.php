@extends('frontend.layouts.content')
@section('content')
    <?php
    $data = getmemulist();
    ?>
    {{--<div class="headline"><h2>มูลค่าลงทุน</h2></div>--}}
    <div class="heading heading-v1 margin-bottom-40">
        <h2> {{ getMenuName($data,1,1) }}</h2>

    </div>

    <div id="main">
        <div class="table-responsive custom-content">



            {{--@if($FUNDSIZEref)--}}
            {{--@foreach($FUNDSIZEref as $group)--}}
            {{--<li>{{$group->dateref}}</li>--}}
            {{--<option value="{{ $group->USER_PRIVILEGE_ID }}">{{ $group->USER_PRIVILEGE_DESC }}</option>--}}
            {{--@endforeach--}}
            {{--@endif--}}



            <p class="date_topic">ข้อมูล ณ วันที่ <span style="color: red">{{get_date_notime($FUNDSIZE[0]->REFERENCE_DATE)}}</span>

                <button class="btn btn-sm rounded btn-warning" onclick="Openall()" type="button">ดูข้อมูลย้อนหลัง</button>
            </p>



            <table class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th></th>
                    <th style="text-align: center">นโยบายตราสารทุน</th>
                    <th style="text-align: center">นโยบายตราสารหนี้</th>

                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>มูลค่าต่อหน่วย (บาท)</td>
                    <td style="text-align: right">{{meaNumbermoney4($FUNDSIZE[0]->NAV_UNIT) }}</td>
                    <td style="text-align: right">{{meaNumbermoney4($FUNDSIZE[1]->NAV_UNIT)}}</td>

                </tr>
                <tr>
                    <td>มูลค่าทรัพย์สินสุทธิ (ล้านบาท)</td>
                    <td style="text-align: right">{{meaNumbermoney4($FUNDSIZE[0]->NAV)}}</td>
                    <td style="text-align: right">{{meaNumbermoney4($FUNDSIZE[1]->NAV)}}</td>


                </tr>
                <tr>
                    <td>อัตราผลตอบแทนการลงทุนสะสม (%)</td>
                    @if($FUNDSIZE[0]->RETURN_RATE < 0)
                        <td style="text-align: right"><span style="color: red">{{meaNumbermoney4($FUNDSIZE[0]->RETURN_RATE)}}</span></td>
                    @else
                        <td style="text-align: right"><span>{{meaNumbermoney4($FUNDSIZE[0]->RETURN_RATE)}}</span></td>
                    @endif

                    @if($FUNDSIZE[1]->RETURN_RATE < 0)
                        <td style="text-align: right"><span style="color: red">{{meaNumbermoney4($FUNDSIZE[1]->RETURN_RATE)}}</span></td>
                    @else
                        <td style="text-align: right"><span>{{meaNumbermoney4($FUNDSIZE[1]->RETURN_RATE)}}</span></td>
                    @endif

                </tr>

                </tbody>
            </table>


        </div>
    </div>


    <div id="all" style="display: none">
        <div class="table-responsive custom-content">

            <p class="date_topic">

                <button class="btn btn-sm rounded btn-warning" onclick="Openmain()" type="button">ย้อนกลับ</button>
            </p>
        <table class="table table-bordered table-striped">
        <thead>
        <tr>
            <th style="text-align: center">ลำดับที่</th>
            <th></th>
            <th style="text-align: center">นโยบายตราสารทุน</th>
            <th style="text-align: center">นโยบายตราสารหนี้</th>
            <th style="text-align: center">ข้อมูล ณ วันที่</th>

        </tr>
        </thead>
        <tbody>

        @foreach($FUNDSIZEref as  $index => $element )

            <tr>
                <td rowspan="3">{{ $index + 1}}</td>
                <td>มูลค่าต่อหน่วย (บาท)</td>

                @foreach($FUNDSIZE as  $index => $value )
                    @if($value->REFERENCE_DATE == $element->dateref && $value->POLICY_ID == 1)
                        <td style="text-align: right">{{meaNumbermoney4($value->NAV_UNIT) }}</td>
                    @endif

                @endforeach

                @foreach($FUNDSIZE as  $index => $value )
                    @if($value->REFERENCE_DATE == $element->dateref && $value->POLICY_ID == 2)
                        <td style="text-align: right">{{meaNumbermoney4($value->NAV_UNIT) }}</td>
                    @endif
                @endforeach

                <td rowspan="3" style="text-align: center">{{get_date_notime($element->dateref)}}</td>
            </tr>


            <tr>
                <td>มูลค่าทรัพย์สินสุทธิ (ล้านบาท)</td>

                @foreach($FUNDSIZE as  $index => $value )
                    @if($value->REFERENCE_DATE == $element->dateref && $value->POLICY_ID == 1)
                        <td style="text-align: right">{{meaNumbermoney4($value->NAV) }}</td>
                    @endif

                @endforeach

                @foreach($FUNDSIZE as  $index => $value )
                    @if($value->REFERENCE_DATE == $element->dateref && $value->POLICY_ID == 2)
                        <td style="text-align: right">{{meaNumbermoney4($value->NAV) }}</td>
                    @endif
                @endforeach

            </tr>
            <tr>
                <td>อัตราผลตอบแทนการลงทุนสะสม (%)</td>


                @foreach($FUNDSIZE as  $index => $value )
                    @if($value->REFERENCE_DATE == $element->dateref && $value->POLICY_ID == 1)
                        @if($value->RETURN_RATE < 0)
                            <td style="text-align: right"><span style="color: red">{{meaNumbermoney4($value->RETURN_RATE)}}</span></td>
                        @else
                            <td style="text-align: right"><span>{{meaNumbermoney4($value->RETURN_RATE)}}</span></td>
                        @endif
                    @endif

                @endforeach


                @foreach($FUNDSIZE as  $index => $value )
                    @if($value->REFERENCE_DATE == $element->dateref && $value->POLICY_ID == 2)
                        @if($value->RETURN_RATE < 0)
                            <td style="text-align: right"><span style="color: red">{{meaNumbermoney4($value->RETURN_RATE)}}</span></td>
                        @else
                            <td style="text-align: right"><span>{{meaNumbermoney4($value->RETURN_RATE)}}</span></td>
                        @endif
                    @endif
                @endforeach






            </tr>
        @endforeach



        </tbody>
    </table>
    </div>
    </div>



    <script>

        function Openmain() {
            jQuery("#all").slideUp('200',function(){
                jQuery("#main").slideDown()
            })

        }

        function Openall() {
            jQuery("#main").slideUp('200',function(){
                jQuery("#all").slideDown()
            })

        }


    </script>



