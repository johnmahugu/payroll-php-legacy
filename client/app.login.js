jQuery(document).ready(function($){
		
	App.Login = function(){	
		
		var txtUsername = new TextBox('uname','uname');
		txtUsername.val('Username');
		txtUsername.css({color:'#ccc'});
		txtUsername.focus(function(e){
		
			if($(this).val() == 'Username'){
			
				$(this).val("")
				$(this).css({color:'#000'});
			}	
		});
		
		txtUsername.blur(function(e){
		
			if($(this).val() == ''){
			
				$(this).val("Username");
				$(this).css({color:'#ccc'});
			}	
		})
		
		var txtDummyPassword = new TextBox('dpword','dpword');
		txtDummyPassword.val('Password');
		txtDummyPassword.css({color:'#ccc'});
		
		var txtPassword = new TextBox('pword','pword');
		txtPassword.attr('type','password');
		txtPassword.hide();
		
		txtDummyPassword.focus(function(){
		
			$(this).hide();
			txtPassword.show();
			txtPassword.focus();
			txtPassword.css({display:'inline'});
		});
		
		txtPassword.blur(function(e){
		
			if($(this).val() == ''){
			
				$(this).hide();
				txtDummyPassword.show();
			}		
		});
		
		txtPassword.keydown(function(e){
		
			if(e.keyCode == 13){
			
				txtUsername.attr('disabled',true);
				txtPassword.attr('disabled',true);
				
				$.post('../index.php',{action:'login',username:txtUsername.val(),password:txtPassword.val()},function(result){
					
					txtUsername.removeAttr('disabled');
					txtPassword.removeAttr('disabled');
					
					var json = $.parseJSON(result);
					if(json.msg == 'Succeded'){
					
						App.TreeMenu.renderView();
						$("#tree").show();
						$("BODY").unmask();
					}
					else{
					
						txtPassword.val("");
						txtUsername.val("");
						txtPassword.blur();
						txtUsername.blur();
					}	
				});
			}	
		})
		
		var elSpan = $('<span id="login"></span>');
		elSpan.append(txtUsername);
		elSpan.append(txtPassword);
		elSpan.append(txtDummyPassword);
		
		$("#tree").hide();
		$("BODY").mask(elSpan);
	};

	App.Logout = function(){
	
		if(confirm('logout?')){
		
			$('BODY').mask('loginout....');
			$.getJSON('../index.php',{action:'login',mode:'logout'},function(json){
			
				$('BODY').unmask();
				$(".right").html("");
				
				if(json.msg == 'loggedout'){
				
					App.Login();
				}	
			});
		}	
		else return 0;	
	};	
}); 
