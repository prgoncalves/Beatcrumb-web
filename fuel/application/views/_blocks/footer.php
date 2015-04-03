			</div>
	</div>
	<footer>
		<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
		<script src="//cdnjs.cloudflare.com/ajax/libs/underscore.js/1.6.0/underscore-min.js"></script>
		<script src="//cdnjs.cloudflare.com/ajax/libs/backbone.js/1.1.2/backbone-min.js"></script>
		<script src="//crypto-js.googlecode.com/svn/tags/3.1.2/build/rollups/md5.js"></script>
		<script src="/assets/js/soundmanager2-jsmin.js"></script>
                <script src="/assets/js/jquery.mobile-1.4.5.min"></script>		
		
		
		<script src="/assets/js/models/artistModel.js"></script>
		<script src="/assets/js/models/fanModel.js"></script>
		<script src="/assets/js/models/artistTrackModel.js"></script>
		<script src="/assets/js/models/userModel.js"></script>
		<script src="/assets/js/models/genreModel.js"></script>
		
		<script src="/assets/js/collections/artistCollection.js"></script>		
		<script src="/assets/js/collections/artistTracksCollection.js"></script>		
		<script src="/assets/js/collections/fanCollection.js"></script>	
		<script src="/assets/js/collections/genreCollection.js"></script>	
		
		<script src="/assets/js/views/loginView.js"></script>
		<script src="/assets/js/views/landingView.js"></script>
		<script src="/assets/js/views/artistSetupView.js"></script>
		<script src="/assets/js/views/fanSetupView.js"></script>
		<script src="/assets/js/views/activationView.js"></script>
		<script src="/assets/js/views/fanDashboardView.js"></script>
		<script src="/assets/js/views/artistDashboardView.js"></script>
		<script src="/assets/js/views/forgottenPasswordView.js"></script>
		<script src="/assets/js/views/artistSettingsView.js"></script>
		<script src="/assets/js/views/discoverView.js"></script>
		<script src="/assets/js/views/favouritesView.js"></script>
		<script src="/assets/js/views/pageHeader.js"></script>
		<script src="/assets/js/app.js"></script>
		<script>
		soundManager.setup({
		  url: '/assets/swf/',
		  flashVersion: 9, // optional: shiny features (default = 8)
		  // optional: ignore Flash where possible, use 100% HTML5 mode
		  // preferFlash: false,
		  onready: function() {
		    // Ready to use; soundManager.createSound() etc. can now be called.
			console.log('I am loaded');
		  },
		  ontimeout : function (){
			console.log('Someyhing possibly went wrong!');
		  }
		});
		</script>
	</footer>

</body>
</html>
