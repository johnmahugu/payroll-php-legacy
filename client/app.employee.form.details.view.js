jQuery(document).ready(function($){	
	
	Employee.renderFormView = function(employeeId){
	
		$(".right").html("");
		$("body").mask('Loading Employee Details...');
		
		var txtEmpNo = new TextBox('empno','empno');
		txtEmpNo.attr('readonly',true);
		
		var txtSurname = new TextBox('surname','surname');
		txtSurname.get(0).CharType = EnumCharType.Alpha; 
		txtSurname.keydown(ui.custom.Event.KeyEvent);
		txtSurname.focus(function(){
		
			$(this).css({backgroundColor:'#fff'});
		});
		
		var txtOthernames = new TextBox('othernames','othernames');
		txtOthernames.get(0).CharType = EnumCharType.Alpha; 
		txtOthernames.keydown(ui.custom.Event.KeyEvent);
		txtOthernames.focus(function(){
		
			$(this).css({backgroundColor:'#fff'});
		});
		
		var txtPhone = new Phone('safcom','safcom');
		var txtPhoneb = new Phone('zain','zain');
		
		var txtEmail = new TextBox('email1','email1');
		var txtEmailb = new TextBox('email2','email2');
		
		var txtNssf = new TextBox('nssf','nssf');
		var txtNhif = new TextBox('nhif','nhif');
		
		var txtPin = new TextBox('pin','pin');
		var txtCountry = new TextBox('country','country');
		var txtCity = new TextBox('city','city');
		
		var txtDob = new TextBox('dob','dob');
		txtDob.attr('readonly',true);
		txtDob.focus(function(){
		
			$(this).css({backgroundColor:'#fff'});
		});
		
		var txtStart = new TextBox('start','start');
		txtStart.attr('readonly',true);
		txtStart.focus(function(){
		
			$(this).css({backgroundColor:'#fff'});
		});
		
		var txtEnd = new TextBox('end','end');
		txtEnd.attr('readonly',true);
		txtEnd.focus(function(){
		
			$(this).css({backgroundColor:'#fff'});
		});
				
		var txtBankAcc = new TextArea('bankacc','bankacc');
		txtBankAcc.setRows(5);
		txtBankAcc.setCols(30);
		
		var txtAddress = new TextArea('address1','address1');
		txtAddress.setRows(5);
		txtAddress.setCols(30);
		
		var txtAddressb = new TextArea('address2','address2');
		txtAddressb.setRows(5);
		txtAddressb.setCols(30);
		
		var cboPost = new ComboBox('post','post');
		
		var cboGender = new ComboBox('gender','gender');
		cboGender.addOption('M',"Male");
		cboGender.addOption('F',"Female");
		
		var cboStatus = new ComboBox('status','status');
		cboStatus.addOption('single','Single');
		cboStatus.addOption('married','Married');
		cboStatus.addOption('divorced','Divorced');
			
		var chkActive = new CheckBox('active','active');
		
		var frmEmployee = new ui.widget.Form("employee-form","../index.php");
		frmEmployee.register(((!!employeeId)?'edit':'new'),'employee');
	
		$.getJSON('../index.php',(!!employeeId)?{action:'employee','id':employeeId}:{action:'post',field:'name'},function(json){
		
			if(!!employeeId){
		
				employee = json;
				posts = employee.posts;
				
				frmEmployee.addId('id',employee.id);
				frmEmployee.addId('paydetailsid',employee.paydetails);
				
				txtEmpNo.val(employee.no);
				txtSurname.val(employee.surname);
				txtOthernames.val(employee.othernames);
				
				txtAddress.html(employee.address1);
				txtAddressb.html(employee.address2);
				
				txtPhone.addCountryPrefix(employee.phone1.countryPrefixSafcom);
				txtPhone.addServicePrefix(employee.phone1.servicePrefixSafcom);
				txtPhone.addFirstSuffix(employee.phone1.firstSuffixSafcom);
				txtPhone.addSecondSuffix(employee.phone1.secondSuffixSafcom);
				
				txtPhoneb.addCountryPrefix(employee.phone2.countryPrefixZain);
				txtPhoneb.addServicePrefix(employee.phone2.servicePrefixZain);
				txtPhoneb.addFirstSuffix(employee.phone2.firstSuffixZain);
				txtPhoneb.addSecondSuffix(employee.phone2.secondSuffixZain);
				
				txtEmail.val(employee.email1);
				txtEmailb.val(employee.email2);
				
				txtNssf.val(employee.nssf);
				txtNhif.val(employee.nhif);
				
				txtPin.val(employee.pin);
				txtCountry.val(employee.country);
				txtCity.val(employee.city);
				
				txtDob.val(employee.dob);
				txtStart.val(employee.start);
				txtEnd.val(employee.end);
				
				cboGender.val(employee.gender);
				cboStatus.val(employee.status);
				
				txtBankAcc.html(employee.bankacc);
				chkActive.checked((employee.active == 'false')?false:true);
			}
			else {
				
				posts = json;
				
				//txtEmpNo.val(employee.no);
				
				txtPhone.addCountryPrefix("");
				txtPhone.addServicePrefix("");
				txtPhone.addFirstSuffix("");
				txtPhone.addSecondSuffix("");
				
				txtPhoneb.addCountryPrefix("");
				txtPhoneb.addServicePrefix("");
				txtPhoneb.addFirstSuffix("");
				txtPhoneb.addSecondSuffix("");
				chkActive.checked(true);
			}	
		
			$(posts).each(function(i,post){
			
				cboPost.addOption(post.id,post.name);
			
				if(!!employeeId)
					if(employee.post == post.name)	
						cboPost.val(post.id);
				
				$("body").unmask();
			});
		});
		
		frmEmployee.onSubmit(function(){
			
			if(!!$('#surname').val() && !!$('#othernames').val()
			&& !!$('#start').val() && !!$('#end').val() &&!!$('#dob').val()){
			
				$("body").mask('Saving Employee Details...');
				frmEmployee.valid(true);
			}	
			else{
			
				if(!!!$('#surname').val())
					$('#surname').css({backgroundColor:'pink'});
				if(!!!$('#othernames').val())
					$('#othernames').css({backgroundColor:'pink'});
				if(!!!$('#start').val())
					$('#start').css({backgroundColor:'pink'});
				if(!!!$('#end').val())
					$('#end').css({backgroundColor:'pink'});
				if(!!!$('#dob').val())
					$('#dob').css({backgroundColor:'pink'});
			}	
		});
		
		frmEmployee.onComplete(function(updateMsg){
			
			$("body").unmask();
			if(updateMsg.msg == 'Failed')
				alert("Update Failed!");
			else	Employee.renderView();
	
		});
		
		frmEmployee.addRow();
		frmEmployee.add("Employee No",txtEmpNo);
		frmEmployee.addRow();
		frmEmployee.add("Surname",txtSurname);
		frmEmployee.add("Othernames",txtOthernames);
		frmEmployee.addRow();
		frmEmployee.add("Post",cboPost);
		frmEmployee.addRow();
		frmEmployee.add("Address1",txtAddress);
		frmEmployee.add("Address2",txtAddressb);
		frmEmployee.addRow();
		frmEmployee.add("Phone1",txtPhone);
		frmEmployee.add("Phone2",txtPhoneb);
		frmEmployee.addRow();
		frmEmployee.add("Email1",txtEmail);
		frmEmployee.add("Email2",txtEmailb);
		frmEmployee.addRow();
		frmEmployee.add("NSSF",txtNssf);
		frmEmployee.add("NHIF",txtNhif);
		frmEmployee.addRow();
		frmEmployee.add("PIN",txtPin);
		frmEmployee.addRow();
		frmEmployee.add("Gender",cboGender);
		frmEmployee.addRow();
		frmEmployee.add("Country",txtCountry);
		frmEmployee.add("City",txtCity);
		frmEmployee.addRow();
		frmEmployee.add("DOB",txtDob);
		frmEmployee.addRow();
		frmEmployee.add("Start Date",txtStart);
		frmEmployee.add("End Date",txtEnd);
		frmEmployee.addRow();
		frmEmployee.add("Marital Status",cboStatus);
		frmEmployee.addRow();
		frmEmployee.add("Bank Account Details",txtBankAcc);
		frmEmployee.addRow();
		frmEmployee.add("Active",chkActive);
		frmEmployee.addDefaultButtons();
		
		return frmEmployee;
	}
}); 
