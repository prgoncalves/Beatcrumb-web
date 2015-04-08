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
		"login"          : 'login',
		"logout"         : 'logout',
		"fansetup"       : 'fanSetup',
		"artistsetup"    : 'artistSetup',
		"activation"     : 'activate',
		"dashboard"      : "dashboard",
		"forgotPassword" : 'forgotPassword',
		"artistSettings" : 'artistSettings',
		"discover"       : 'discover',
		"favourites"     : 'favourites',
		"*action"        : "defaultAction"
	}
});

app.showLandingPage = function(){
	if (!app.landingView){
		app.landingView = new LandingView();
	}
	app.landingView.render();			
}
app.showPageHeader = function(){
	if (!app.pageHeader){
		app.pageHeader = new PageHeader();
	}
	app.pageHeader.render();	
}

app.appRouter = new AppRouter;

app.appRouter.on('route:logout', function(id){
	localStorage.removeItem('Beat_User');
	// need to call server to drop session
	$.ajax({
		url : '/api/r/user/logout'
	}).done(function(data){
	});
	app.user = undefined;
	app.appRouter.navigate('/login',true);
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
	// check to see if already stored
	if (app.user){
		app.appRouter.navigate('/dashboard',true);				
	} else {
		app.showLandingPage();
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
app.appRouter.on('route:artistSettings',function(action){
	if (app.user){
		if (!app.artistSettings){
			app.artistSettings = new ArtistSettingsView()
		}
		app.showPageHeader();
		app.artistSettings.render();		
	} else {
		app.showLandingPage();
	}
});
app.appRouter.on('route:discover',function(action){
	if (app.user){
		if (!app.discover){
			app.discover = new DiscoverView()
		}
		app.showPageHeader();
		app.discover.render();		
	} else {
		app.showLandingPage();
	}
});
app.appRouter.on('route:favourites',function(action){
	if (app.user){
		if (!app.favourites){
			app.favourites = new FavouritesView()
		}
		app.showPageHeader();
		app.favourites.render();		
	} else {
		app.showLandingPage();
	}
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
			app.showPageHeader();
			$.when(deferGenre).done(function(){
				app.artistTrackCollection.fetch({
					success:function(){
						app.artistDashboard.tracks = app.artistTrackCollection.models;
						app.artistDashboard.render();		
					},
					error:function(){
						app.artistDashboard.render();
						app.alert('Unable to load artist tracks');
					}
				});				
			});
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
