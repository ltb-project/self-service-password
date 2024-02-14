</div>
{if $display_footer}
<div id="footer">LDAP Tool Box Self Service Password - version {$version}</div>
{/if}
<script src="vendor/jquery/js/jquery-3.5.1.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<script src="js/self-service-password.js"></script>
<script src="js/entropy.js"></script>
{if ($questions_count > 1)}
<script src="js/jquery.selectunique.js"></script>
<script>$(document).ready(function() { $('.question').selectunique(); })</script>
{/if}
</body>
</html>
