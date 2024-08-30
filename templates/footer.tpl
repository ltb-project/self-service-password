</div>
{if $display_footer}
<div id="footer">LDAP Tool Box Self Service Password - version {$version}</div>
{/if}
<div id="ltb-component" hidden>ssp</div>
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<script src="js/self-service-password.js"></script>
<script src="js/ppolicy.js"></script>
{if $captcha_js}
{$captcha_js nofilter}
{/if}
{if ($questions_count > 1)}
<script src="js/jquery.selectunique.js"></script>
<script>$(document).ready(function() { $('.question').selectunique(); })</script>
{/if}
</body>
</html>
