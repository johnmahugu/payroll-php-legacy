jQuery(document).ready(function($){
	
	Setup.Nhif.renderFlexiGrid = function(){
	
		$("#nhif").flexigrid({

			url: '../index.php?action=nhif',
			dataType: 'json',
			colModel : [
				{display: '#', name : '#', width : 20, sortable : true, align: 'left'},
				{display: 'Lower Bound', name : 'lbound', width : 180, sortable : true, align: 'right'},
				{display: 'Upper Bound', name : 'ubound', width : 180, sortable : true, align: 'right'},
				{display: 'Amount', name : 'amount', width : 180, sortable : true, align: 'right'}],
			buttons : [
				{name: 'Update', bclass: '', onpress : function(){
		
					if(!!$('.due-update').length){
					
						$('BODY').mask('saving....');
						
						var result = [];
						
						$('.due-update').each(function(i,e){
							
							result[i] = {
							'id':$(e).attr('alt'),	
							'lbound':$($(e).children().eq(1).html()).html(),
							'ubound':$($(e).children().eq(2).html()).html(),
							'amount':$($(e).children().eq(3).html()).html()};
						});
							
						$.post('../index.php',{action:'nhif',mode:'update',rs:result},function(data){
						
							var json = $.parseJSON(data);
							
							if(json.msg == 'Succeded'){
							
								$('#nhif tr td div').css({backgroundColor:'transparent'});
								$('.due-update').removeClass('due-update');
							}	
							else
								alert("Update Failed!");
								
							$('BODY').unmask();	
						});
					}
				}}
			],
			title: 'NHIF Rates',
			onRowClick:function(){
				
			},
			onSuccess:function(){
			
				$("BODY").unmask('');
				
				$('#nhif td').each(function(i,e){
						
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
						$(this).dblclick(function(){

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
				$("#nhif").flexOptions({params: dt});

				return true;
			},
			height: 300
		});
	}
});