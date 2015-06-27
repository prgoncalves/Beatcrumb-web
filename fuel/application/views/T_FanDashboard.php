<script id="fan-dashboard" type="text/template">
  <div class="landing-page-wrapper">
    <div class="main-container">

    <div class="messages js-messages"></div>
    <div class="alerts js-alerts"></div>
        <div class="fan-profile">

            <div class="fan-profile-left">
                <div class="fan-name"><h1 class="fan-header"><%=app.user.username%></h1></div>
                <div class="fan-picture">
					<% if (app.user.image){ %>
                    <img src="/assets/<%=app.user.image%>"/>
					<%} else {%>
						<button class="js-UploadPhoto">Upload Photo</button>
					<%}%>
                </div>

            </div>
            <div class="fan-profile-right">
            </div>

            <div class="scroll-container">
				<%_.each(contacts,function(value) { %>
                	<div class="fan-block">
                    	<div class="fan-info js-ReleaseToMe" data-id="<%=value.id%>">
                        	<div class="fan-mini-picture">
                            	<img src="<%=value.image%><"/>
                            </div>
                            <h5 class="fan-name"><%=value.name%></h5>
                            <div class="fan-crumb">
                            </div>
                        </div>
                    </div>
				<% }); %>
            </div>


        <div class="browser_width colelem" id="u148-5-bw">
            <div class="clearfix" id="u148-5"><!-- content -->
                <p>&nbsp;</p>
                <div class="copyright-container">
                    <p><span id="u148-2">Beatcrumb Inc 2014</span></p>
                </div>

            </div>
        </div>
     </div>
  </div>
</script>
