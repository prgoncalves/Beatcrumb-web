<script id="discover-page" type="text/template">
  <div class="landing-page-wrapper">
    <div class="main-container">
        <div class="discover-left">
            <div class="discover-scroll">
				<% _.each(genres, function(value) { %>
					<div class="genre-item" data-id="<%=value.id%>"><%=value.name%></div>
				<% }); %>											
            </div>
        </div>
		<div class="discover-right" id="discover-right">
		</div>
    
		<div class="messages js-messages"></div>
   		<div class="alerts js-alerts"></div>
        
        </div>
        <div class="copyright-container">
            <p><span id="u148-2">Beatcrumb Inc 2014</span></p>
        </div>
  </div>
</script>
<script id="discover-tracks" type="text/template">
		<div class="artist-mini-picture">
		    <img src="/images/noelleartist-u388-fr.png"/>
		</div>
		<h2 class="discover-artist-name">Noelle</h2>
		<div class="discover-listens"></div>
		<div class="discover-single-crumb">
		    <div class="discover-crumb active-crumb"></div>
		</div>
		<div class="discover-three-crumb"></div>
</script>
