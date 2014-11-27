ui = {custom:{form:{}}};

jQuery(document).ready(function($){	
		
	ui.custom.form.Table = function(id,cssClass){
	
		this.customTable = new ui.Table(id,cssClass);
		
		this.newRow = function(id,cssClass){
		
			this.customTable.newRow(id,cssClass); 
		};
		
		this.newCell = function(caption,element){
		
			this.customTable.newCell(caption);
			this.customTable.uiTblCell.attr('valign',"top");
			this.customTable.newCell(element);
			this.customTable.uiTblCell.attr('valign',"top");
		};
		
		this.getTable = function(){
		
			return this.customTable.uiTbl;
		}
	}
});