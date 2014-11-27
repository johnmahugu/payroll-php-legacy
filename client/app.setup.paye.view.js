jQuery(document).ready(function($){
	
	Setup.Paye.renderFlexiGrid = function(){
	
		$("#paye").flexigrid({

			url: '../index.php?action=paye',
			dataType: 'json',
			colModel : [
				{display: '#', name : '#', sortable : true, align: 'right'},
				{display: 'Monthly Lower Bound', name : 'mlbound', width : 180, sortable : true, align: 'right'},
				{display: 'Monthly Upper Bound', name : 'mubound', width : 180, sortable : true, align: 'right'},
				{display: 'Annual Lower Bound', name : 'albound', width : 180, sortable : true, align: 'right'},
				{display: 'Annual Upper Bound', name : 'aubound', width : 180, sortable : true, align: 'right'},
				{display: 'Rate(%)', name : 'rate', width : 180, sortable : true, align: 'right'}],
			buttons : [
				{name: 'Update', bclass: '', onpress : function(){
				
					$('BODY').mask('saving....');
					
					var result = [];
					
					$('.due-update').each(function(i,e){
						
						result[i] = {
						'id':$(e).attr('alt'),	
						'mlbound':$($(e).children().eq(1).html()).html(),
						'mubound':$($(e).children().eq(2).html()).html(),
						'albound':$($(e).children().eq(3).html()).html(),
						'aubound':$($(e).children().eq(4).html()).html(),
						'rate':$($(e).children().eq(5).html()).html()};
					});
						
					$.post('../index.php',{action:'paye',mode:'update',rs:result},function(data){
					
						var json = $.parseJSON(data);
						
						if(json.msg == 'Succeded')
							$('#paye tr td div').css({backgroundColor:'transparent'});
						else
							alert("Update Failed!");
							
						$('BODY').unmask();	
					});
				}}
			],
			title: 'Paye Rates',
			onRowClick:function(){
			
			},
			onSuccess:function(){
			
				$("BODY").unmask('');
				
				$('#paye td').each(function(i,e){
				
					if(!$(this).attr('alt')){
					
						var editor = $(document.createElement("INPUT"));
						editor.attr('type','text');
						editor.css({float:'right'});
						editor.val($($(e).html()).html());
						editor.hide();
						editor.blur(function(){
						
							$(this).hide();
							$($(this).siblings().get(0)).show();
							$($(this).siblings().get(0)).html($(this).val());
						});
						
						$(this).append(editor);
						$(this).dblclick(function() {
					  
							editor.show();
							editor.focus();
							$($(this).get(0).parentNode).addClass('due-update');
							$($($(this).children()).get(0)).hide();
							$($($(this).children()).first()).css({backgroundColor:'#ccc'});
						});
					}
				});
			},
			onSubmit: function addFormData(){
			
				var dt = $('#sform').serializeArray();
				$("#paye").flexOptions({params: dt});

				return true;
			},
			height: 200
		});
	}
});