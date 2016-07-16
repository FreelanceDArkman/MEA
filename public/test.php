<?php
class Security2 {
    public static function encrypt($input, $key) {

        //#Gm2014$06$30@97
        $size = mcrypt_get_block_size(MCRYPT_RIJNDAEL_128, MCRYPT_MODE_ECB);
        $input = Security2::pkcs5_pad2($input, $size);
        $td = mcrypt_module_open(MCRYPT_RIJNDAEL_128, '', MCRYPT_MODE_ECB, '');
        $iv = mcrypt_create_iv (mcrypt_enc_get_iv_size($td), MCRYPT_RAND);
        mcrypt_generic_init($td, $key, $iv);
        $data = mcrypt_generic($td, $input);
        mcrypt_generic_deinit($td);
        mcrypt_module_close($td);
        $data = base64_encode($data);
        return $data;
    }

    private static function pkcs5_pad2 ($text, $blocksize) {
        $pad = $blocksize - (strlen($text) % $blocksize);
        return $text . str_repeat(chr($pad), $pad);
    }

    public static function decrypt($sStr, $sKey) {
        $decrypted= mcrypt_decrypt(
            MCRYPT_RIJNDAEL_128,
            $sKey,
            base64_decode($sStr),
            MCRYPT_MODE_ECB
        );
        $dec_s = strlen($decrypted);
        $padding = ord($decrypted[$dec_s-1]);
        $decrypted = substr($decrypted, 0, -$padding);
        return $decrypted;
    }
}



$datedata =  $_GET["value"];
$MEASecEncoe = new Security2();
// . substr($datedata, -4,2). ((int)substr($datedata, -8, 4)) + 543;

$newDate = substr($datedata, -2) . substr($datedata, -4,2) . (( (int)substr($datedata, -8, 4) )+543) ;
//$ecPass =  $MEASecEncoe->encrypt($newDate,"#Gm2014$06$30@97");





 <script type="text/javascript">


        function  check(){
           return confirm('ท่านกำลังทำการเปลี่ยนแผนการลงทุนครบจํานวนครั้งที่กองทุนฯ กําหนด กรุณายืนยันการทำรายการ หรือยกเลิก');
        }
     


        $(document).ready(function(){


            $('#maxVal1').on('keyup',function(){

              var val =  $(this).val();
                if(val <= 100){

                    $('#maxVal2').val(100 -val);
                }else {

                    alert('กรุณาใส่ข้อมูล ไม่เกิน 100');
                }


            });

            $('#maxVal2').on('keyup',function(){
                var val =  $(this).val();

                if(val <= 100){

                    $('#maxVal1').val(100 -val);
                }else {

                    alert('กรุณาใส่ข้อมูล ไม่เกิน 100');
                }


            });



            var colors = [
                ['#D3B6C6', '#9B6BCC'], ['#C9FF97', '#72c02c'], ['#BEE3F7', '#3498DB'], ['#FFC2BB', '#E74C3C']
            ];




                Circles.create({
                id:         'circles-1',
                    @if($CurrnentPlan)
                    percentage: '{{$CurrnentPlan[0]->EQUITY_RATE}}',
                    @else
                            @if($effective)
                            percentage: '{{$effective[0]->EQUITY_RATE}}',
                            @else
                                percentage: '0',
                            @endif
                    @endif
                radius:     70,
                width:      2,
                    @if($CurrnentPlan)
                number:     '{{$CurrnentPlan[0]->EQUITY_RATE}}',
                    @else
                            @if($effective)
                            number: '{{$effective[0]->EQUITY_RATE}}',
                            @else
                            number: '0',
                            @endif
                    @endif
                text:       '%',
                colors:      ['#FFC2BB', '#fe5000'],
                duration:   2000,
            });

            Circles.create({
                id:         'circles-2',
                @if($CurrnentPlan)
                percentage: '{{$CurrnentPlan[0]->DEBT_RATE}}',
                @else
                        @if($effective)
                        percentage: '{{$effective[0]->DEBT_RATE}}',
                        @else
                        percentage: '0',
                        @endif
                @endif

                radius:     70,
                width:      2,
                    @if($CurrnentPlan)
                number: '{{$CurrnentPlan[0]->DEBT_RATE}}',
                @else
                        @if($effective)
                        number:'{{$effective[0]->DEBT_RATE}}',
                        @else
                        number:'0',
                        @endif
                @endif
                text:       '%',
                colors:     ['#ffeba7', '#ffbf3f'],
                duration:   2000,
            });





            $.validator.addMethod("valueNotEquals", function(value, element, arg){
                return arg != value;
            }, "Value must not equal arg.");


            //$("form").validate({
            //	rules: {
            //		SelectName: { valueNotEquals: "default" }
            //	},
            //	messages: {
            //		SelectName: { valueNotEquals: "Please select an item!" }
            //	}
            //});


            var flag100 = $("#flag100").val();
            var arrval_1 =  $("#TYPE_TOPIC").val().split(',');

            var maxeq_1 = arrval_1[2]
            var mineq_1 = arrval_1[1]
            var maxdeb_1 =arrval_1[4]
            var mindeb_1 =arrval_1[3]

            if(flag100 == 2) {
                maxeq_1 = 100;
            }

            $("#maxVal1").attr('placeholder',mineq_1 + "-" + maxeq_1)

            $(".minmax_label").html('ค่าที่สามารถใส่ได้ ระหว่าง ' + mineq_1 + "-" + maxeq_1)


            $("#TYPE_TOPIC").on('change',function(){

//                alert($(this).val());

                var arrval = $(this).val().split(',');

                var maxeq = arrval[2]
                var mineq = arrval[1]
                var maxdeb =arrval[4]
                var mindeb =arrval[3]

                if(flag100 == 2) {
                    maxeq = 100;
                }

                $("#maxVal1").attr('placeholder',mineq + "-" + maxeq)
                $(".minmax_label").html('ค่าที่สามารถใส่ได้ ระหว่าง ' + mineq + "-" + maxeq)
//                $("#maxVal2").attr('placeholder',mindeb + "-" + maxdeb)



            });

            // Validation
            $("#sky-form1").validate({
                // Rules for form validation
                rules:
                {

                    TYPE_TOPIC:{
                        valueNotEquals: "default"
                    },
                    maxVal1:{
                        required: true,
                        number:true
                    },
                    maxVal2:{
                        required: true,
                        number:true
                    }

                },

                // Messages for form validation
                messages:
                {

                    TYPE_TOPIC:{
                        valueNotEquals: "Please select an item!"
                    }

                },

// Ajax form submition
                submitHandler: function(form)
                {



                    var arrval =  $("#TYPE_TOPIC").val().split(',');


                    var flag100 = $("#flag100").val();

                    var maxeq = arrval[2]
                    if(flag100 == 2){
                        maxeq = 100;
                    }else if (flag100 == 0){
                        maxeq = 50;
                    }

                    var mineq = arrval[1]
                    var maxdeb =arrval[4]
                    var mindeb =arrval[3]


                    var maxVal1 = $("#maxVal1").val();
                    var maxVal2 = $("#maxVal2").val();


//                    if(((parseInt(maxVal1)>=parseInt(mineq) && parseInt(maxVal1)<=parseInt(maxeq)) && (parseInt(maxVal2)>=parseInt(mindeb) && parseInt(maxVal2)<=parseInt(maxdeb)) ) ){
                    if(((parseInt(maxVal1)>=parseInt(mineq) && parseInt(maxVal1)<=parseInt(maxeq)) ) ){
                        $(form).submit();
                    }else {
                        alert('ท่านเลือกจำนวนสัดส่วนตราสารทุน เกินจำนวนที่กำหนด' );
                    }
//                    $(form).ajaxSubmit(
//                            {
//                                beforeSend: function()
//                                {
//                                    $('#sky-form3 button[type="submit"]').attr('disabled', true);
//                                },
//                                success: function()
//                                {
//                                    $("#sky-form3").addClass('submited');
//                                }
//                            });
                },

                // Do not change code below
                errorPlacement: function(error, element)
                {
                    error.insertAfter(element.parent());
                }
            });


        });



</script>
echo  $newDate;

//var_dump($output);
//$output = shell_exec("/backend/md5/md5.bat -e ss 2>&1");
////$output = shell_exec("./backend/md5/md5.sh -e ss 2>&1");
//////echo passthru("md5.bat");
//var_dump($output);
?>