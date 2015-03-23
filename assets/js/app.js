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
		"activation" : 'activate',
		"dashboard" : "dashboard",
		"forgotPassword" : 'forgotPassword',
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

app.appRouter.on('route:activate',function(){
	if (!app.activationView){
		app.activationView = new ActivationView();
	}
	app.activationView.render();
});

app.appRouter.on('route:defaultAction',function(action){
	console.log('Default');
	// check to see if already stored
	if (app.user){
		app.appRouter.navigate('/dashboard',true);				
	} else {
		if (!app.landingView){
			app.landingView = new LandingView();
		}
		console.log($('#landing-page').html());
		app.landingView.render();		
	}
});

app.appRouter.on('route:fanSetup',function(action){
	if (!app.fanSetup){
		app.fanSetup = new FanSetupView()
	}
	app.fanSetup.render();
});
app.appRouter.on('route:artistSetup',function(action){
	if (!app.artistSetup){
		app.artistSetup = new ArtistSetupView()
	}
	app.artistSetup.render();
});
app.appRouter.on('route:forgotPassword',function(action){
	if (!app.forgotPassword){
		app.forgotPassword = new ForgottenPasswordView()
	}
	app.forgotPassword.render();
});

app.appRouter.on('route:dashboard',function(){
	if (app.user){
		if (app.user.type == 'artist'){
			if (!app.artistDashboard){
				app.artistDashboard = new ArtistDashboardView()
			}
			app.artistDashboard.render();		
		} else {
			if (!app.fanDashboard){
				app.fanDashboard = new FanDashboardView()
			}
			app.fanDashboard.render();				
		}		
	} else {
		app.appRouter.navigate('/login',true);		
	}
});

app.alert = function(message){
	$('.js-alerts').html(message);
	$('.js-alerts').show().delay(20000).hide(0);
}
app.message = function(message){
	$('.js-messages').html(message);
	$('.js-messages').show().delay(20000).hide(0);
}

Backbone.history.start();
