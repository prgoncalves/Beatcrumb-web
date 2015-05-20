<script id="beatbox" type="text/template">
  <div class="landing-page-wrapper">
    <div class="main-container">
		<div class="beatbox">
			<%_.each(app.availableInbox, function(value) { console.log(value);%>
				<%=value.message%> 
			<% }); %>											
		</div>
	</div>
  </div>
</script>