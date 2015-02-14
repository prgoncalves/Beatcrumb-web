var app = app || {};

FanSetupView = Backbone.View.extend({
	el : '#app',
	render : function(){
		this.$el.html($('#fan-setup-form').html());
	},
	events : {
		'submit .fan-signup-form' : 'submit'
	},
	submit : function(){
	},
	showErrors: function(errors) {
	    _.each(errors, function (error) {
		var controlGroup = this.$('#' + error.name);
		controlGroup.addClass('error');
		controlGroup.find('.help-inline').text(error.message);
	    }, this);
	},
});

