jQuery(document).ready(function($){	

	Post.renderFormView = function(postId){
	
		$(".right").html("");
		$("body").mask('wait...');
		
		var txtName = new TextBox('name','name');
		txtName.focus(function(){
		
			$(this).css({backgroundColor:'#fff'});
		});
		
		var txtDescr = new TextArea('descr','descr');
		txtDescr.setRows(5);
		txtDescr.setCols(30);
		var cdoDept = new ComboBox('dept','dept');
		
		var frmPost = new ui.widget.Form("dept-form","../index.php");
		frmPost.register(((!!postId)?'edit':'new'),'post');
		
		
		$.getJSON('../index.php',(!!postId)?{action:'post','id':postId}:{action:'dept',field:'name'},function(json){
		
			var depts;
			var post;
			
			if(!!postId){
			
				post = json;
				depts = json.departments;
				
				frmPost.addId('id',post.id);
				txtName.val(post.name);
				txtDescr.html(post.descr);
			}
			else depts = json;
			
			$(depts).each(function(i,dept){
				
				cdoDept.addOption(dept.id,dept.name);
				
				if(!!postId)
					if(post.department == dept.name)	
						cdoDept.val(dept.id);
				
				$("body").unmask();
			});
		});
		
		frmPost.onSubmit(function(){
			
			if(!!$('#name').val()){
				
				$("body").mask('Saving Post...');
				frmPost.valid(true);
			}	
			else	$('#name').css({backgroundColor:'pink'});
		});
		
		frmPost.onComplete(function(jsonResult){
			
			$("body").unmask();
			Post.renderView();
		});
		
		frmPost.addRow();
		frmPost.add("Post",txtName);
		frmPost.addRow();
		frmPost.add("Description",txtDescr);
		frmPost.addRow();
		frmPost.add("Department",cdoDept);
		frmPost.addDefaultButtons();
		frmPost.getForm().appendTo($(".right"));
	}
});	