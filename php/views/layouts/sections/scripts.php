<script type="text/javascript" src="https://milligram.github.io/scripts/main.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"
        integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

<script type="text/javascript" src="<?=url('/assets/vendors/js/jquery.mobile.custom.min.js')?>"></script>
<script type="text/javascript" src="<?=url('/assets/js/main.js')?>"></script>

<?php if(Authentication::isLoggedIn()): ?>
	<script type="text/javascript" src="<?=url('/assets/js/admin.js')?>"></script>
<?php endif; ?>

<script>
	Web.Url = function(path) {
		// Base Path
		var $base_url = '<?=url('/')?>';
		// Remove leading slashes
		path = path.replace(/^\//, '');
		// Return new url
		return $base_url + path;
	};
</script>