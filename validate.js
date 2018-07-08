
                function isalphanum(ele)
                {
                    var r=/^[a-z0-9]+$/i;
                    if(r.test(ele.value))
                     {
                         alert("This Field allows Only Alpha Numeric characters.");
                         ele.value="";
                         ele.focus();
                     }
                }
                function isalpha(ele)
                {
                    var r=/[^a-zA-Z]+/i;
                    if(r.test(ele.value))
                     {
                         alert("This Field allows characters.");
                         ele.value="";
                         ele.focus();
                     }
                }
                function isnum(ele)
                {
                    var r=/\D$/i;
                    if(r.test(ele.value))
                     {
                         alert("This Field allows Only Numerics.");
                         ele.value="";
                         ele.focus();
                     }
                }

                function validateform(mmyform)
                {
                    var em=/[a-zA-Z0-9]+@[a-zA-Z0-9]+.[a-zA-Z]+/;
                    myform=document.forms[mmyform];
                    if(myform.cname.value=="" || myform.password.value=="" || myform.repass.value=="" || myform.email.value=="" || myform.contactno.value=="" || myform.address.value=="" || myform.city.value=="" || myform.pin.value=="")
                     {
                         alert("Some of the fields are Empty.");
                         return false;
                         //  myform.onsubmit=false;
                     }
					 else if(myform.password.value.length<8)
						{
						   alert("Password should be atleast of 8 digits");
						   myform.password.focus(); 
						   return false;
						}
                     else if(myform.password.value!=myform.repass.value)
                         {
                             alert("Passwords Do not Match!");
                             myform.repass.focus();
							// myform.onsubmit=false;
                            return false;
                         }
						  else if(myform.contactno.value.length!=10)
                         {
                             alert("Phone No. should be of 10 digits");
                             myform.contactno.focus();
							// myform.onsubmit=false;
                            return false;
                         }
                         else if(!em.test(myform.email.value))
                             {
                                 alert("Enter the E-mail Correctly!");
                               //  myform.onsubmit=false;
                                 return false;
                             }
						  else if(myform.pin.value.length!=6)
                         {
                             alert("Pincode should be of 6 digits only");
                             myform.pin.focus();
							// myform.onsubmit=false;
                            return false;
                         }	 


                }

                function validatesubform(mmyform)
                {

                    myform=document.forms[mmyform];
                    if(myform.subname.value=="" || myform.subdesc.value=="")
                     {
                         alert("Some of the fields are Empty.");
                         myform.onSubmit=false;
                     }
                     
                }
        function validatetestform(mmyform)
                {

                    myform=document.forms[mmyform];
                    if(myform.tname.value=="" || myform.tdesc.value=="" || myform.total.value=="" ||  myform.duration.value=="")
                     {
                         alert("Some of the fields are Empty.");
                         return false;
                      
                     }

                }

        function validateqnform(mmyform)
                {

                    myform=document.forms[mmyform];
                    if(myform.quest.value=="" || myform.optiona.value=="" || myform.optionb.value=="" ||  myform.optionc.value==""||  myform.optiond.value==""||  myform.ans.value==""||  myform.marks.value=="")
                     {
                         alert("Some of the fields are Empty.");
                         return false;
                      
                     }

                }


