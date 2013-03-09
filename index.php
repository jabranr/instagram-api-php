<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Instagram API PHP class &ndash; Making life easier!</title>
<meta property="og:type" content="article">
<meta property="og:url" content="http://jabran.me/sandbox/igapi/">
<meta property="og:image" content="http://jabran.me/wp-content/themes/jabrandotme/images/jabrandotme_logo_og.jpg">
<meta property="og:title" content="Instagram API PHP class &ndash; Jabran Rafique">
<meta property="og:description" content="This PHP class provides an easy access to Instagram API RESTful web services.">
<meta name="image_url" content="http://jabran.me/wp-content/themes/jabrandotme/images/jabrandotme_logo_og.jpg">
<meta name="googlebot" content="all, index, follow" />
<meta name="robots" content="all, index, follow" />
<meta name="msnbot" content="all, index, follow" />
<link rel="canonical" href="http://jabran.me/sandbox/igapi/">
<meta name="robots" content="noodp">
<link rel="shortcut icon" href="http://jabran.me/wp-content/themes/jabrandotme/images/favicon.ico">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<link href="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.1/css/bootstrap-combined.min.css" rel="stylesheet">
<script src="../socialmediadotjs/socialmedia.min.js"></script>
<script>
facebook.init('142530249248955');
</script>
<style>
.wrapper    {
    margin:2em auto;
}
[class^="icon-"]    {
    vertical-align: baseline;
}
hr.footer   {
    margin:25px 0;
}
.hero-unit > code,
.hero-unit > pre    {
    background:#fff;
}
.logo   {
    margin-bottom:48px !important;
    color:#999 !important;
    text-shadow:0 1px 1px #fff;
}
.center {
    text-align:center;
}
.user-data img  {
    float: left;
    margin: 10px;
    text-align: text-top;
}
.user-data h2   {
    font-size: 48px;
    line-height: 1.5;
}
.socialbutton   {
    margin:20px 0 0 20px;
    height: 22px;
    line-height: 22px !important;
    vertical-align: middle;
}
</style>
<script>
  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-9809111-15']);
  _gaq.push(['_setDomainName', 'jabran.me']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();
</script>
</head>
<body>
<?php

// Include required configuration
require_once( 'ig-config.php' );

// Include required instagram class
require_once( 'instagram.class.php' );

// Create a new instance
$ig = new JRIG();

?>
<div class="container wrapper">

    <div class="hero-unit clearfix row center">
        <h1 class="logo">Instagram API PHP Class</h1>
        <p class="lead">This PHP class provides clean and helpful methods to access the Instagram's RESTful web services (API).</p>
        <p>This is an example of use of this PHP class. The <a href="https://github.com/jabranr/instagram-api-php" target="_blank">project can be accessed at GitHub</a> for use and contribution.</p>

        	<?php
            
        	if ( isset($_GET['code']) && $_GET['code'] ) :
        	
        		$data = $ig->get_access_token(htmlentities($_GET['code']));
        	?>
            
            <p><img src="<?php echo $data['avatar']; ?>" class="img-polaroid">
            <h2><?php echo $data['name']; ?></h2>
            <a href="http://instagram.com/<?php echo $data['username']; ?>">Visit Instagram profile</a></p>
            
            <?php else : ?>

                <p>
                    <form action="<?php echo $ig->get_oauth_uri(); ?>" method="get">
                    	<input type="hidden" name="client_id" value="<?php echo $ig->get_client_id(); ?>">
                        <input type="hidden" name="redirect_uri" value="<?php echo $ig->get_redirect_uri(); ?>">
                        <input type="hidden" name="scope" value="<?php echo $ig->get_scope(); ?>">
                        <input type="hidden" name="response_type" value="code">
                        <input type="submit" value="Login with Instagram" class="btn btn-info btn-large">
                    </form>
                </p>

            <?php endif; ?>

                <p>
                    <a href="https://github.com/jabranr/instagram-api-php" class="btn btn-large btn-success">Download from GitHub</a>
                </p>
                <p>
                    <ul class="unstyled inline">
                        <li class="socialbutton"><div class="fb-like" data-href="http://jabran.me/sandbox/igapi/" data-send="false" data-layout="button_count" data-width="450" data-show-faces="false"></div></li>
                        <li class="socialbutton"><a href="https://twitter.com/share" class="twitter-share-button" data-via="jabranr">Tweet</a>
                        <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script></li>
                   </ul>
                </p>
    </div>
        
    <hr class="footer">
    <div class="footer">
        <p><small>&copy; <a href="http://jabran.me" target="_top">Jabran Rafique</a> 2013 &ndash; <a href="http://opensource.org/licenses/MIT" target="_blank">MIT License</a></small></p>
    </div>

</div>

</body>
</html>