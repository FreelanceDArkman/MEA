@extends('frontend.layouts.content')
@section('content')

    <?php

    // Make the page validate
    ini_set('session.use_trans_sid', '0');

    // Create a random string, leaving out 'o' to avoid confusion with '0'
    $char = strtoupper(substr(str_shuffle('abcdefghjkmnpqrstuvwxyz'), 0, 4));

    // Concatenate the random string onto the random numbers
    // The font 'Anorexia' doesn't have a character for '8', so the numbers will only go up to 7
    // '0' is left out to avoid confusion with 'O'
    $str = rand(1, 7) . rand(1, 7) . $char;

    // Begin the session
    session_start();

    // Set the session contents
    $_SESSION['captcha_id'] = $str;

    ?>

    <div class="row margin-bottom-60" style="margin-bottom: 10px">
        <div class="col-md-6 col-sm-6">
            <!-- Google Map -->
            <iframe frameborder="0" scrolling="no" marginheight="0" marginwidth="0"width="100%" height="450" src="https://maps.google.com/maps?hl=th&q=การไฟฟ้านครหลวง อาคารสำนักงานใหญ่ เพลินจิตร เลขที่ 30 ซอยชิดลม ถนนเพลินจิตร แขวงลุมพินี เขตปทุมวัน กรุงเทพมหานคร 10330&ie=UTF8&t=roadmap&z=13&iwloc=B&output=embed"></iframe>
            <!-- End Google Map -->
        </div>
        <div class="col-md-6 col-sm-6">
            <!-- Get in Touch -->
            {{--<h3>ที่อยู่</h3>--}}
            {{--<p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, justo sit amet risus etiam porta sem</p>--}}

           {{----}}

            <div class="headline"><h2>ที่อยู่</h2></div>

            <!-- Contacts -->
            <ul class="list-unstyled who">
                <li><i class="fa fa-home"></i>การไฟฟ้านครหลวง อาคารสำนักงานใหญ่ เพลินจิตร เลขที่ 30 ซอยชิดลม ถนนเพลินจิตร แขวงลุมพินี เขตปทุมวัน กรุงเทพมหานคร 10330</li>
                <li><i class="fa fa-envelope"></i>mea_fund@mea.or.th</li>
                <li><i class="fa fa-phone"></i>1130</li>
                <li><i class="fa fa-globe"></i>รถเมล์สาย 40, 48, ปรับอากาศสาย 511 รถไฟฟ้า BTS-สถานีชิดลม</li>
            </ul>

            <hr>

            {{--<!-- Business Hours -->--}}
            {{--<h3>Business Hours</h3>--}}
            {{--<ul class="list-unstyled">--}}
                {{--<li><strong>Monday-Friday:</strong> 10am to 8pm</li>--}}
                {{--<li><strong>Saturday:</strong> 11am to 3pm</li>--}}
                {{--<li><strong>Sunday:</strong> Closed</li>--}}
            {{--</ul>--}}
        </div>
    </div>

    @if(logged_in())

    <div class="row margin-bottom-30">

        <div class="headline"><h2>สอบถาม แนะนำบริการ</h2></div>
        <div class="col-md-12 mb-margin-bottom-30">


            <p>กสช. ขอขอบคุณที่ท่านให้ความสนใจเข้าเยี่ยมชมเว็บไซต์ของเรา
                หากท่านมีข้อสอบถามหรือข้อแนะนำใดๆ สามารถกรอกลงในช่องข้อความ ด้านล่างนี้</p><br />
{{--//action="frontend/assets/php/sky-forms-pro/demo-contacts-process.php"--}}


            <form action="{{action('ContactController@SendMail')}}" method="post" id="sky-form3" class="sky-form contact-style">
                {!! csrf_field() !!}
                @if (!Session::has('message'))
                <fieldset class="no-padding">
                    <label>ชื่อ-สกุล <span class="color-red">*</span></label>
                    <div class="row sky-space-20">
                        <div class="col-md-7 col-md-offset-0">
                            <div>
                                <input type="text" name="name" id="name" class="form-control" value="{{get_username()}}">
                            </div>
                        </div>
                    </div>

                    <label>อีเมล์ <span class="color-red">*</span></label>
                    <div class="row sky-space-20">
                        <div class="col-md-7 col-md-offset-0">
                            <div>
                                <input type="text" name="email" id="email"  value="{{$userinfo[0]->EMAIL}}"  class="form-control">
                            </div>
                        </div>
                    </div>

                    <label>โทรศัพท์ <span class="color-red">*</span></label>
                    <div class="row sky-space-20">
                        <div class="col-md-7 col-md-offset-0">
                            <div>
                                <input type="text" name="PHONE" id="PHONE" value="{{$userinfo[0]->PHONE}}"  class="form-control">
                            </div>
                        </div>
                    </div>

                    <label>หน่วยงาน <span class="color-red">*</span></label>
                    <div class="row sky-space-20">
                        <div class="col-md-7 col-md-offset-0">
                            <div>
                                <input type="text" name="DEP_LNG" id="DEP_LNG" value="{{ session()->get('user_data')->dep_lng}}" class="form-control">
                            </div>
                        </div>
                    </div>


                    <label>หัวข้อเรื่อง <span class="color-red">*</span></label>
                    <div class="row sky-space-20">
                        <div class="col-md-11 col-md-offset-0">
                            <div>
                                <select name="TYPE_TOPIC" id="TYPE_TOPIC"  class="form-control">
                                    <option value="default"> กรุณาเลือก </option>
                                    <option value="งานควบคมุ ระบบบญั ชีสมาชิกและสทิ ธิประโยชน์(คส.)">งานควบคุมระบบบัญชีสมาชิกและสิทธิประโยชน์ (คส.)</option>
                                    <option value="งานบัญชีการเงิน วิเคราะห์และประเมินผลการลงทุน (บป.)">งานบัญชีการเงิน วิเคราะห์และประเมินผลการลงทุน (บป.)</option>
                                    <option value="ปัญหาการใช้งานระบบ">ปัญหาการใช้งานระบบ</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <label>รายละเอียด <span class="color-red">*</span></label>
                    <div class="row sky-space-20">
                        <div class="col-md-11 col-md-offset-0">
                            <div>
                                <textarea rows="8" name="DETAIL" id="DETAIL" class="form-control"></textarea>
                            </div>
                        </div>
                    </div>


                    <div class="row sky-space-20">
                        <div class="col-md-11 col-md-offset-0">
                            <div>
                                <label class="label">Enter characters below:</label>
                                <img src="{{asset("frontend/assets/plugins/sky-forms-pro/skyforms/captcha/image.php?")}}<?php echo time(); ?>" width="100" height="32" alt="Captcha image" />
                                <input type="text" maxlength="6" name="captcha" id="captcha">
                            </div>
                        </div>
                    </div>
                    {{--<section>--}}
                        {{--<label class="label">Enter characters below:</label>--}}
                        {{--<label class="input input-captcha">--}}

                        {{--</label>--}}
                    {{--</section>--}}

                    <p><button type="submit" class="btn-u">Send Message</button></p>
                </fieldset>
                @endif
                @if (Session::has('message'))

                <div class="alert alert-success fade in alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <strong>Well done!</strong> Your message was successfully sent!
                </div>

                @endif
            </form>


        </div><!--/col-md-9-->


    </div><!--/row-->
    @endif
@stop

