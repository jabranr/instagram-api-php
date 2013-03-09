<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Instagram API test</title>
<link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">
</head>
<style>
.container	{
	margin:20px auto;
}
</style>
<body>
<?php

// Include required configuration
require_once( 'ig-config.php' );

// Include required instagram class
require_once( 'instagram.class.php' );

// Create a new instance
$ig = new JRIG();

?>
<div class="container">

    <div class="span9">

	<?php
    
	if ( isset($_GET['code']) && $_GET['code'] ) :
	
		$data = $ig->get_access_token(htmlentities($_GET['code']));
	?>
    
    <h1>Welcome <?php echo $data['name']; ?></h1>
    <p><img src="<?php echo $data['avatar']; ?>"></p>
    
    <?php else : ?>

        <form action="<?php echo $ig->get_oauth_uri(); ?>" method="get">
        	<input type="hidden" name="client_id" value="<?php echo $ig->get_client_id(); ?>">
            <input type="hidden" name="redirect_uri" value="<?php echo $ig->get_client_secret(); ?>">
            <input type="hidden" name="scope" value="<?php echo $ig->get_scope(); ?>">
            <input type="hidden" name="response_type" value="code">
            <input type="submit" value="Login with Instagram" class="btn btn-info">
        </form>

	<?php endif; ?>
    
    </div>

</div>

</body>
</html>