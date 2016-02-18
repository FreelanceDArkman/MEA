@extends('frontend.layouts.content')
@section('content')

    {{--<div class="headline"><h2>มูลค่าลงทุน</h2></div>--}}
    <div class="heading heading-v1 margin-bottom-40">
        <h2>มูลค่ากองทุน</h2>

    </div>
    <div class="table-responsive custom-content">



            {{--@if($FUNDSIZE)--}}
                {{--@foreach($FUNDSIZE as $group)--}}
                    {{--<li>{{$group->NAV}}</li>--}}
                    {{--<option value="{{ $group->USER_PRIVILEGE_ID }}">{{ $group->USER_PRIVILEGE_DESC }}</option>--}}
                {{--@endforeach--}}
            {{--@endif--}}



        ข้อมูล ณ วันที่ {{meaFormatDate($FUNDSIZE[0]->REFERENCE_DATE)}}


        <table class="table table-bordered">
            <thead>
            <tr>
                <th></th>
                <th>นโยบายตราสารทุน</th>
                <th>นโยบายตราสารหนี้</th>

            </tr>
            </thead>
            <tbody>
            <tr>
                <td>มูลค่าต่อหน่วย (บาท)</td>
                <td>{{ meaNumbermoney($FUNDSIZE[0]->NAV_UNIT) }}</td>
                <td>{{meaNumbermoney($FUNDSIZE[1]->NAV_UNIT)}}</td>

            </tr>
            <tr>
                <td>มูลค่าทรัพย์สินสุทธิ (ล้านบาท)</td>
                <td>{{meaNumbermoney($FUNDSIZE[0]->NAV)}}</td>
                <td>{{meaNumbermoney($FUNDSIZE[1]->NAV)}}</td>


            </tr>
            <tr>
                <td>อัตราผลตอบแทนการลงทุนสะสม (%)</td>
                <td>{{meaNumbermoney($FUNDSIZE[0]->RETURN_RATE)}}</td>
                <td>{{meaNumbermoney($FUNDSIZE[1]->RETURN_RATE)}}</td>
            </tr>

            </tbody>
        </table>
    </div>


@stop

