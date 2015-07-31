			</div>
	</div>
	<footer>
		<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
		<script src="//cdnjs.cloudflare.com/ajax/libs/underscore.js/1.6.0/underscore-min.js"></script>
		<script src="//cdnjs.cloudflare.com/ajax/libs/backbone.js/1.1.2/backbone-min.js"></script>
		<script src="//crypto-js.googlecode.com/svn/tags/3.1.2/build/rollups/md5.js"></script>
		<script src="/assets/js/soundmanager2-jsmin.js"></script>
		<script src="/assets/js/iscroll-infinite.js"></script>
		
		<script src="/assets/js/models/artistModel.js?v=<?php echo VERSION;?>"></script>
		<script src="/assets/js/models/fanModel.js?v=<?php echo VERSION;?>"></script>
		<script src="/assets/js/models/artistTrackModel.js?v=<?php echo VERSION;?>"></script>
		<script src="/assets/js/models/userModel.js?v=<?php echo VERSION;?>"></script>
		<script src="/assets/js/models/genreModel.js?v=<?php echo VERSION;?>"></script>
		<script src="/assets/js/models/contactModel.js?v=<?php echo VERSION;?>"></script>
		<script src="/assets/js/models/settingModel.js?v=<?php echo VERSION;?>"></script>
		<script src="/assets/js/models/trackModel.js?v=<?php echo VERSION;?>"></script>

		<script src="/assets/js/collections/artistCollection.js?v=<?php echo VERSION;?>"></script>
		<script src="/assets/js/collections/artistTracksCollection.js?v=<?php echo VERSION;?>"></script>
		<script src="/assets/js/collections/fanCollection.js?v=<?php echo VERSION;?>"></script>
		<script src="/assets/js/collections/genreCollection.js?v=<?php echo VERSION;?>"></script>
		<script src="/assets/js/collections/contactsCollection.js?v=<?php echo VERSION;?>"></script>
		<script src="/assets/js/collections/settingsCollection.js?v=<?php echo VERSION;?>"></script>
		<script src="/assets/js/collections/beatboxCollection.js?v=<?php echo VERSION;?>"></script>

		<script src="/assets/js/views/loginView.js?v=<?php echo VERSION;?>"></script>
		<script src="/assets/js/views/landingView.js?v=<?php echo VERSION;?>"></script>
		<script src="/assets/js/views/artistSetupView.js?v=<?php echo VERSION;?>"></script>
		<script src="/assets/js/views/fanSetupView.js?v=<?php echo VERSION;?>"></script>
		<script src="/assets/js/views/activationView.js?v=<?php echo VERSION;?>"></script>
		<script src="/assets/js/views/fanDashboardView.js?v=<?php echo VERSION;?>"></script>
		<script src="/assets/js/views/artistDashboardView.js?v=<?php echo VERSION;?>"></script>
		<script src="/assets/js/views/forgottenPasswordView.js?v=<?php echo VERSION;?>"></script>
		<script src="/assets/js/views/artistSettingsView.js?v=<?php echo VERSION;?>"></script>
		<script src="/assets/js/views/fanSettingsView.js?v=<?php echo VERSION;?>"></script>
		<script src="/assets/js/views/discoverTracksView.js?v=<?php echo VERSION;?>"></script>
		<script src="/assets/js/views/discoverView.js?v=<?php echo VERSION;?>"></script>
		<script src="/assets/js/views/favouritesView.js?v=<?php echo VERSION;?>"></script>
		<script src="/assets/js/views/addEditContactView.js?v=<?php echo VERSION;?>"></script>
		<script src="/assets/js/views/beatboxView.js?v=<?php echo VERSION;?>"></script>
		<script src="/assets/js/views/pageHeader.js?v=<?php echo VERSION;?>"></script>
		<script src="/assets/js/views/shareActivation.js?v=<?php echo VERSION;?>"></script>
		<script src="/assets/js/views/searchResultsView.js?v=<?php echo VERSION;?>"></script>
		<script src="/assets/js/app.js?v=<?php echo VERSION;?>"></script>
		<script>
		soundManager.setup({
		  url: '/assets/swf/',
		  flashVersion: 9, // optional: shiny features (default = 8)
		  // optional: ignore Flash where possible, use 100% HTML5 mode
		  // preferFlash: false,
		  onready: function() {
		  },
		  ontimeout : function (){
		  },
		});
		soundManager.onerror = function(){
			  app.alert('Unable to play that track!');
		};
		</script>
	</footer>

</body>
</html>
