<html>
<body style="margin: 0; padding: 0;">
	<table cellpadding="0" cellspacing="0" width="100%">
		<tr>
			<td>
				<table align="center" cellpadding="0" cellspacing="0" width="600" style="border-collapse: collapse;border:outset #99CC00 4.5pt">
					<tr>
						<td bgcolor="#ffffff" style="padding: 40px 30px 40px 30px;">
						 <table cellpadding="0" cellspacing="0" width="100%">
						  <tr>
						  	<td>
						  		<p style='mso-margin-top-alt:auto;text-align:center'><img src="http://beta.fitzos.com/images/beatcrumblogo-u108-fr.png" /></p>
						  	</td>
						  </tr>
						  <tr>
						   <td style="padding: 20px 0 20px 0;">
						   	Dear <?php echo $data->username; ?>  
						   </td>
						  </tr>
						  <tr>
						   <td>
							<p>Thanks for signing up for an Artist account on Beatcrumb.</p>
							<p>In order to start using your new account and sharing your work with your fans you will need to activate your account by clicking on the link below. If the link does not work please copy and paste the link address in your favourite browser.</p>
							<p><a href="http://beta.fitzos.com/activation/artist/$data->uuid">Activate Me!</a></p>
							<p>Regards</p>
							</td>
						  </tr>
					</tr>
				</table>
			</td>
		</tr>
	</table>
</body>
</html>