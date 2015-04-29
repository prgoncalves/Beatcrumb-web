var app = app || {};

ContactView = Backbone.View.extend({
	el : '#form',
	render : function (){
		var data = [];
		var content = _.template($('#addContact').html(),data);
		this.$el.html(content);
	},
	events : {
		'click .js-saveContact' : 'saveContact'
	},
	saveContact : function(ev){
		ev.preventDefault();
		console.log('Save me save me');
	}
});