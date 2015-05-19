var app = app || {};

ShareActivationView = Backbone.View.extend({
	el : '#app',
	render : function(){
		this.$el.html($('#shareActivation').html());
	},
	events : {
		'submit .js-activationForm' : 'activate'
	},
	activate : function(){
		console.log('YAY');
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
