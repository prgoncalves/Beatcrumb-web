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
	      		<p><%=value.artist_name%></p>
	      		<p><%=value.filename%></p>
	      		<a class="fan-crumb playTrack" href="tracks/play/<%=value.id%>/<%=value.uuid%>">Play Me</a>
	      	<% }); %>
	      </div>
	</div>
</script>