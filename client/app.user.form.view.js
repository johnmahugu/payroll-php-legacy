jQuery(document).ready(function($){	

	User.renderFormView = function(userId){
	
		$(".right").html("");
		$("body").mask('wait...');
		
		var txtUsername = new TextBox('uname','uname');
		var txtPassword = new TextBox('pword','pword');
		txtPassword.attr('type','password');
		
		var txtCPassword = new TextBox('cpword','cpword');
		txtCPassword.attr('type','password');
		
		var cboRole = new ComboBox('role','role');
		
		var frmUser = new ui.widget.Form("user-form","../index.php");
		frmUser.register(((!!userId)?'edit':'new'),'user');
		
		
		$.getJSON('../index.php',(!!userId)?{action:'user','id':userId}:{action:'role',field:'name'},function(json){
		
			var roles;
			var user;
			
			if(!!userId){
			
				user = json;
				roles = json.roles;
				
				frmUser.addId('id',user.id);
				txtUsername.val(user.name);
			}
			else roles = json;
			
			$(roles).each(function(i,role){
				
				cboRole.addOption(role.id,role.name);
				
				if(!!userId)
					if(user.role == role.name)	
						cboRole.val(role.id);
				
				$("body").unmask();
			});
		});
		
		frmUser.onSubmit(function(){
			
			
			var validationCallback = function(){
			
				if(txtUsername.val() ==  "" || txtUsername.val().length < 6)
					txtUsername.focus();
				else{
				
					txtPassword.val('');
					txtCPassword.val('');
					txtPassword.focus();
				}
			}
			
			frmUser.valid(User.validate(txtUsername.val(),txtPassword.val(),txtCPassword.val()));
			
			if(!frmUser.getForm().isValid)
				validationCallback();
			else	
				$("body").mask('saving...');	
		});
		
		frmUser.onComplete(function(jsonResult){
			
			$("body").unmask();
			User.renderView();
		});
		
		frmUser.addRow();
		frmUser.add("Username",txtUsername);
		frmUser.addRow();
		frmUser.add("Password",txtPassword);
		frmUser.addRow();
		frmUser.add("Confirm Password",txtCPassword);
		frmUser.addRow();
		frmUser.add("Role",cboRole);
		frmUser.addDefaultButtons();
		frmUser.getForm().appendTo($(".right"));
	}
});	