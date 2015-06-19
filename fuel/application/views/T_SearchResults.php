<script id="search-results" type="text/template">
	<div class="searchArtists">
		<% _.each(artists, function(value) { %>
			<p><%=value.artist_name%></p>
		<% }); %>
	</div>
	<div class="searchTracks">
		<% _.each(tracks, function(value) { %>
			<p><%=value.artist_name%></p>
			<p><%=value.filename%></p>
		<% }); %>
	</div>
</script>