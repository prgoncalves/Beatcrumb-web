<script id="artistSettings" type="text/template">
  <div class="landing-page-wrapper">
    <div class="main-container">
		<div class="settings-contacts">
			<%_.each(contacts,function(value) {console.log(value) %>
            	<div class="fan-block">
                	<div class="fan-info">
                    	<div class="fan-mini-picture">
                        	<img src="<%=value.image%><"/>
                        </div>
                        <h5 class="fan-name"><%=value.name%>-<%=value.email%></h5>
                    </div>
                </div>
			<% }); %>					                    
		</div>
		<div class="settings-profile"></div>
		<div class="messages js-messages"></div>
   		<div class="alerts js-alerts"></div>
		<p><a href="#logout">Logout</a></p>
    </div>
  </div>
</script>