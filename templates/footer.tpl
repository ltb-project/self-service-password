</div>
{if $display_footer}
<div id="footer">LDAP Tool Box Self Service Password - version {$version}</div>
{/if}
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<script src="js/self-service-password.js"></script>
<script>
         // Get ssp local policy from json object.
         // Stored in window.policy.[parameter]
         json_policy = "{$json_policy}";
         policy = JSON.parse(atob(json_policy));
</script>
<script src="js/ppolicy.js"></script>
{if ($questions_count > 1)}
<script src="js/jquery.selectunique.js"></script>
<script>$(document).ready(function() { $('.question').selectunique(); })</script>
{/if}
</body>
</html>
