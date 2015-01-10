var app = app || {};

if (localStorage.Beat_User)
	app.user = JSON.parse(localStorage.Beat_User);

_.extend(Backbone.Router.prototype,{

    refresh: function() {
        var _tmp = Backbone.history.fragment;
        this.navigate( _tmp + (new Date).getTime() );
        this.navigate( _tmp, { trigger:true } );
    }
});

var AppRouter = Backbone.Router.extend({
	routes:{
		"login" : 'login',
		"logout" : 'logout',
		"fansetup": 'fanSetup',
		"artistsetup" : 'artistSetup',
		"*action": "defaultAction"
	}
});

app.appRouter = new AppRouter;

app.appRouter.on('route:logout', function(id){
	console.log('Logout');
});

app.appRouter.on('route:login',function(){
	if (!app.loginView){
		app.loginView = new LoginView();
	}
	app.loginView.render();
});

app.appRouter.on('route:defaultAction',function(action){
	console.log('Default');
	if (!app.landingView){
		app.landingView = new LandingView();
	}
	console.log($('#landing-page').html());
	app.landingView.render();
});

app.appRouter.on('route:fanSetup',function(action){
	console.log('fanSetup');
});
app.appRouter.on('route:artistSetup',function(action){
	console.log('artistSetup');
	if (!app.artistSetup){
		app.artistSetup = new ArtistSetupView()
	}
	app.artistSetup.render();
});

Backbone.history.start();
