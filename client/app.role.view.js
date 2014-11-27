jQuery(document).ready(function($){
		
	Role.renderView = function(){
	
		$(".right").html("");
		
		var tblRole = new ui.Table('roles');
		var tableRole = tblRole.getTable();
		tableRole.css({display:'none'});
		tableRole.appendTo($(".right"));
		
		Role.renderFlexiGrid();
	};
	
	Role.renderFlexiGrid = function(){
		
		$("#roles").flexigrid({

			url: '../index.php?action=role',
			dataType: 'json',
			colModel : [
				{display: '#', name : '#', sortable : true, align: 'left'},
				{display: 'Name', name : 'name', width : 180, sortable : true, align: 'left'},
				{display: 'Descr', name : 'descr', width : 180, sortable : true, align: 'left'}],
			buttons : [
				{name: 'Add', bclass: '', onpress : function(){Role.renderFormView();}},
				{name: 'Delete', bclass: '', onpress : function(){
				
					if(confirm('Delete?'))
						$.getJSON('../index.php',{action:'role',mode:'delete',id:$('.trSelected').attr('alt')},function(){
						
							$(".pReload").click();
						});
				}},
				{separator: true}
			],
			searchitems : [
				{display: 'Name', name : 'name'},
				{display: 'Descr', name : 'descr', isdefault: true}],
			sortname: "name",
			sortorder: "asc",
			usepager: true,
			title: 'Roles',
			useRp: false,
			rp: 15,
			showTableToggleBtn: false,
			width: $('.right').width()-10,//700,
			onRowClick:function(){
			
				Role.renderFormView($(this).attr('alt'));
			},
			onSubmit: function addFormData(){
			
				var dt = $('#sform').serializeArray();
				$("#roles").flexOptions({params: dt});

				return true;
			},
			height: 200
		});
	};
}); 