<script id="search-results" type="text/template">
    <div class="messages js-messages"></div>
    <div class="alerts js-alerts"></div>
	<div class="searchBlock">
	      <div class="searchArtists">
	      	<% _.each(artists, function(value) { %>
	      		<p><%=value.artist_name%></p>
	      	<% }); %>
	      </div>
	      <div class="searchTracks">
	      	<% _.each(tracks, function(value) { %>
                <div class="search-result">
	      		<p><%=value.artist_name%></p>
	      		<p><%=value.filename%></p>
	      		<a class="fan-crumb playTrack" href="tracks/play/<%=value.id%>/<%=value.uuid%>"></a>
 				<div data-id="<%=value.id%>" class="discover-crumb shareTrack"></div>
				<div class="discover-three-crumb">
            		<div class="three-crumb-one"></div>
                	<div class="three-crumb-two"></div>
                	<div class="three-crumb-three"></div>
            	</div>
                </div>
	      	<% }); %>

	      </div>
	</div>
</script>