<div class="tab-v1">
    <ul class="nav nav-tabs">
<?php  $arr = explode('/',Route::getCurrentRoute()->getPath())        ?>



        @if($sortby == 1 || $sortby == null)
            <li class="active"><a href="/{{$arr[0]}}/1" >มาใหม่</a></li>
            <li><a href="/{{$arr[0]}}/2" >เปิดดู</a></li>
            <li><a href="/{{$arr[0]}}/3" >ดาวน์โหลด</a></li>
        @elseif($sortby == 2)
            <li ><a href="/{{$arr[0]}}/1">มาใหม่</a></li>
            <li class="active"><a href="/{{$arr[0]}}/2"  >เปิดดู</a></li>
            <li><a href="/{{$arr[0]}}/3">ดาวน์โหลด</a></li>
        @elseif($sortby == 3)
            <li ><a href="/{{$arr[0]}}/1" >มาใหม่</a></li>
            <li ><a href="/{{$arr[0]}}/2"  >เปิดดู</a></li>
            <li class="active"><a href="/{{$arr[0]}}/3" >ดาวน์โหลด</a></li>
        @endif

    </ul>

</div>