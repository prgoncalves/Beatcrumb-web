var app = app || {};

ShareActivationView = Backbone.View.extend({
	el : '#app',
	render : function(){
		this.$el.html($('#shareActivation').html());
	},
	events : {
		'click .activateShare' : 'activate',
		'click .alreadyShare'  : 'already',
	},
	activate : function(event){
		if (this.validate()){
			// get the data
			console.log('Activate');
			return false;
		} else {
			return false;
		}
	},
	already : function(event){
		if (this.validate()){
			// get the data
			console.log('Already');
			return false;
		} else {
			return false;
		}
	},
	validate : function(){
		result = true;
		if ($('.js-activationForm input[name="username"]').val()){
			$('.js-activationForm input[name="username"]').removeClass('error');			
		} else {
			$('.js-activationForm input[name="username"]').addClass('error');
			result = false;
		}
		if ($('.js-activationForm input[name="password"]').val()){
			$('.js-activationForm input[name="password"]').removeClass('error');
		} else {
			$('.js-activationForm input[name="password"]').addClass('error');
			result = false;
		}
		return result;		
	}
});
