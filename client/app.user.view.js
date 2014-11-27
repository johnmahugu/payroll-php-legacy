jQuery(document).ready(function($){
		
	User.renderView = function(){
	
		$(".right").html("");
		
		var tblUser = new ui.Table('users');
		var tableUser = tblUser.getTable();
		tableUser.css({display:'none'});
		tableUser.appendTo($(".right"));
		
		User.renderFlexiGrid();
	};
	
	User.renderFlexiGrid = function(){
		
		$("#users").flexigrid({

			url: '../index.php?action=user',
			dataType: 'json',
			colModel : [
				{display: '#', name : '#', sortable : true, align: 'left'},
				{display: 'Username', name : 'uname', width : 180, sortable : true, align: 'left'},
				{display: 'Role', name : 'role', width : 180, sortable : true, align: 'left'}],
			buttons : [
				{name: 'Add', bclass: '', onpress : function(){User.renderFormView();}},
				{name: 'Delete', bclass: '', onpress : function(){
				
					if(confirm('Delete User?'))
						$.getJSON('../index.php',{action:'user',mode:'delete',id:$('.trSelected').attr('alt')},function(){
						
							$('.pReload').click();
						})
				}},
				{separator: true}
			],
			searchitems : [
				{display: 'Username', name : 'uname'},
				{display: 'Role', name : 'role', isdefault: true}],
			sortname: "name",
			sortorder: "asc",
			usepager: true,
			title: 'Users',
			useRp: false,
			rp: 15,
			showTableToggleBtn: false,
			width: $('.right').width()-10,//700,
			onRowClick:function(){
			
				User.renderFormView($(this).attr('alt'));
			},
			onSubmit: function addFormData(){
			
				var dt = $('#sform').serializeArray();
				$("#users").flexOptions({params: dt});

				return true;
			},
			height: 200
		});
	};
}); 