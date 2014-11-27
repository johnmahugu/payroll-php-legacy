jQuery(document).ready(function($){
		
	Post.renderView = function(){
	
		$(".right").html("");
		
		var tblPost = new ui.Table('posts');
		var tablePost = tblPost.getTable();
		tablePost.css({display:'none'});
		tablePost.appendTo($(".right"));
		
		Post.renderFlexiGrid();
	};
	
	Post.renderFlexiGrid = function(){
		
		$("#posts").flexigrid({

			url: '../index.php?action=post',
			dataType: 'json',
			colModel : [
				{display: '#', name : '#', sortable : true, align: 'left'},
				{display: 'Name', name : 'name', width : 180, sortable : true, align: 'left'},
				{display: 'Department', name : 'dept', width : 180, sortable : true, align: 'left'}],
			buttons : [
				{name: 'Add', bclass: '', onpress : function(){Post.renderFormView();}},
				{separator: true},
				{name: 'Delete', bclass: '', onpress : function(){
				
					if(confirm("Delete?"))
						$.getJSON('../index.php',{action:'post',mode:'delete',id:$('.trSelected').attr('alt')},function(){
						
							$(".pReload").click();
						});
				}},
			],
			searchitems : [
				{display: 'Name', name : 'name'},
				{display: 'Department', name : 'dept', isdefault: true}],
			sortname: "name",
			sortorder: "asc",
			usepager: true,
			title: 'Posts',
			useRp: false,
			rp: 15,
			showTableToggleBtn: false,
			width: $('.right').width()-10,//700,
			onRowClick:function(){
			
				Post.renderFormView($(this).attr('alt'));
			},
			onSubmit: function addFormData(){
			
				var dt = $('#sform').serializeArray();
				$("#posts").flexOptions({params: dt});

				return true;
			},
			height: 200
		});
	};
}); 