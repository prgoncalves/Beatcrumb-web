var app = app || {};

FanDashboardView = Backbone.View.extend({
	el : '#app',
	render : function(){
		var data = {
				contacts : app.contacts.attributes
		};
		this.$el.html(_.template($('#fan-dashboard').html(),data));
	},
	events : {
		'click .js-UploadPhoto' : 'uploadPhoto' 
	},
        
        initialise : function(){
		this.myScroll = new IScroll('.fans-scroll', {
		    mouseWheel: true,
		    click:true,
		});	
		document.addEventListener('touchmove', function (e) { e.preventDefault(); }, false);
	},
	uploadPhoto : function(){
		
	}
});
