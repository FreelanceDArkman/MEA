var ContactForm = function () {

    return {
        
        //Contact Form
        initContactForm: function () {

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

	        // Validation
	        $("#sky-form3").validate({
	            // Rules for form validation
	            rules:
	            {
	                name:
	                {
	                    required: true
	                },
	                email:
	                {
	                    required: true,
	                    email: true
	                },
					PHONE:{
						required: true,
						number: true
					},
					DEP_LNG:{
						required: true
					},
					TYPE_TOPIC:{
						valueNotEquals: "default"
					},
					DETAIL:
	                {
	                    required: true

	                },
	                captcha:
	                {
	                    required: true,
	                    remote: 'frontend/assets/plugins/sky-forms-pro/skyforms/captcha/process.php'
	                }
	            },
	                                
	            // Messages for form validation
	            messages:
	            {
	                name:
	                {
	                    required: 'กรุณากรอกชื่อ-สกุล',
	                },
	                email:
	                {
	                    required: 'กรุณากรอกที่อยู่อีเมล์',
	                    email: 'อีเมล์ที่ท่านกรอกไม่ตรงกับ format'
	                },
					PHONE:{
						required: 'กรุณากรอกเบอร์โทรศัพท์',
						number: 'เบอร์โทรศัพท์จะต้องเป็นตัวเลขเท่านั้น'
					},
					DEP_LNG:{
						required: 'กรุณากรอกหน่วยงาน'
					},
					TYPE_TOPIC:{
						valueNotEquals: "Please select an item!"
					},
					DETAIL:
	                {
	                    required: 'กรณุกรอกรายละเอียด'
	                },
	                captcha:
	                {
	                    required: 'Please enter characters',
	                    remote: 'Correct captcha is required'
	                }
	            },
	                                
	            // Ajax form submition                  
	            submitHandler: function(form)
	            {
	                $(form).ajaxSubmit(
	                {
	                    beforeSend: function()
	                    {
	                        $('#sky-form3 button[type="submit"]').attr('disabled', true);
	                    },
	                    success: function()
	                    {
	                        $("#sky-form3").addClass('submited');
	                    }
	                });
	            },
	            
	            // Do not change code below
	            errorPlacement: function(error, element)
	            {
	                error.insertAfter(element.parent());
	            }
	        });
        }

    };
    
}();