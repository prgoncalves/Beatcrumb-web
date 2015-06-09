<script id="beatbox" type="text/template">
  <div class="landing-page-wrapper">
    <div class="main-container">
		<div class="beatbox">
			<% if (typeof app.availableInbox != 'undefined' && app.availableInbox.length > 0){
				_.each(app.availableInbox, function(value) { console.log(value);%>
				<div class="beatbox-track" data-track="<%=value.filename%>">
					<!--<h2 class="beatbox-artist-name"><%=value.artist_name%></h2>-->
                                        <%if (value.image){%>
						<div class="beatbox-artist-mini-picture">
							<img src="assets/<%=value.image%>" />
						</div>
					<%}%>
                                        <div class="beatbox-message"><%=value.message%></div>
					<div class="beatbox-track-name"><%=value.filename%></div>
					<div class="beatbox-listens"><%=value.plays%>
                                            <img class="" src="assets/images/ear.png"/>
                                        </div>
					<div class="beatbox-shares"><%=value.shares%></div>
					<div class="beatbox-single-crumb">
				   		<div class="beatbox-crumb active-crumb"></div>
					</div>
					<div class="beatbox-three-crumb">
                		<div class="three-crumb-one"></div>
                    	<div class="three-crumb-two"></div>
                    	<div class="three-crumb-three"></div>
                	</div>
				</div>
			<% });
			} else {%>
				<h3>You have no tracks shared at the moment</h3>
			<%}%>											
		</div>
	</div>
  </div>
</script>