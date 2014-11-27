jQuery(document).ready(function($){	

	ui.widget.Form = function(id,actionUrl){
	
		this.form = new ui.Form(id,actionUrl);
		this.formEl = this.form.getForm();
		this.formEl.isValid = false;
		this.formLayout = new ui.widget.two.dimension.Layout();
		this.url = actionUrl;
		
		this.register = function(mode,name){
		
			this.form.registerForm(name,mode);
		};
		
		this.addId = function(id,value){
		
			this.form.appendId(id,value);
		};
		
		this.addRow = function(){
			
			this.formLayout.newRow();
		};
		
		this.cellAlignment = function(cellHorizaontalAlign){
		
			if(!!cellHorizaontalAlign)
				this.cellAlign = cellHorizaontalAlign;	
			else this.cellAlign = 'right';
		}
		
		this.add = function(caption,element,halign){
		
			if(!!halign);
			else	halign = this.cellAlign;

			this.formLayout.newCell(caption,element,halign);
		};
		
		this.renderLayoutInForm = function(){
		
			this.formEl.append(this.formLayout.getTable());
		};
		
		this.addDefaultButtons = function(bool,halign){
		
			this.renderLayoutInForm();
			this.addRow();
			
			if(!bool)
				this.add("",this.form.getButtons(),halign);
			else	this.add(this.form.getButtons(),"",halign);	
		};
		
		this.onSubmit = function(beforeSubmit){
		
			this.form.onSubmit(beforeSubmit);
		};
		
		this.valid = function(isValid){
		
			this.formEl.isValid = isValid;
		};
		
		this.onComplete = function(callback){
		
			var form = this.formEl;
			var isValid = this.isValid;
			var actionUrl = this.url;
			
			this.form.doJsonRpc(function(){
			
				if(form.isValid)
					jQuery.getJSON(actionUrl,form.serialize(),callback);
			});
		};
		
		this.getForm = function(){
		
			return this.form.getForm();
		};
	};
});