<h1>Instagram API easy access with PHP</h1> 
@version: 0.0.1 (Beta)

<ul>
  <li>Summary</li>
  <li>Installation</li>
  <li>Configuration</li>
  <li>User authorization from Instagram
    <ul>
      <li>Method 1 (Using JavaScript)</li>
      <li>Method 2 (Using HTML forms)      </li>
    </ul>
  </li>
  <li>Retrieving access token from Instagram</li>
  <li>Scheduled updates</li>
</ul>

<h3>Summary</h3>

<p>This package is collection of PHP class, configuration file for easy access and manipulation of Instagram API and consists of following files:</p>

<ul>
<li><code>ig-config.php</code></li>
<li><code>instagram.class.php</code></li>
</ul>

<p>Example output file:</p>
<ul>
<li><code>index.php</code></li>
</ul>

<p>The idea is to make easy access, configuration and reusable code for Instagram API. A very simple working outcome of this package can be accessed at <a href="http://jabran.me/sandbox/igapi/" target="_blank">http://jabran.me/sandbox/igapi/</a></p>

<h3>Installation</h3>

<p>Download and keep both files in same directory. Include/require these both files with following order.</p>

<ul>
<li><code>ig-config.php</code></li>
<li><code>instagram.class.php</code></li>
</ul>

<p>You must register a client at <a href="https://developer.instagram.com" target="_blank">https://developer.instagram.com</a> to get a unique and personalized <code>CLIENT ID</code>, <code>CLIENT SECRET</code>, <code>WEBSITE URL</code>, and <code>REDIRECT URI</code>.</p>

<h3>Configuration</h3>

<p>Create a new instance of class object as shown in following example code. The object takes the default values as configured in <code>ig-config.php</code> unless a secondary object is required on the go then custom values can also be provided.</p>

<code>$ig = new JRIG();</code>

<h3>User authorization from Instagram</h3>
<p>Instagram requires users to authorize the application access. An OAuth URI/OAuth redirection can be provided to user by following two methods when using this package.</p>

<h4>Method 1</h4>
<p>Using JavaScript <code>window.open('&lt;?php echo $ig-&gt;get_oauth_uri(); ?&gt;', '_top');</code> will redirect user to Instagram's OAuth authorization screen.</p>
<h4>Method 2</h4>
<p>Using HTML forms, each of the require parameters can be added as hidden input fields with a submit button which results in form submission to Instagram's OAuth authorization screen. Here is an example:</p>
<pre>
&lt;form action=&quot;&lt;?php echo $ig-&gt;get_oauth_url(); ?&gt;&quot; method=&quot;get&quot;&gt;
&lt;input type=&quot;hidden&quot; name=&quot;client_id&quot; value=&quot;&lt;?php echo $ig-&gt;get_client_id(); ?&gt;&quot;&gt;
&lt;input type=&quot;hidden&quot; name=&quot;redirect_uri&quot; value=&quot;&lt;?php echo $ig-&gt;get_redirect_uri(); ?&gt;&quot;&gt;
&lt;input type=&quot;hidden&quot; name=&quot;scope&quot; value=&quot;&lt;?php echo $ig-&gt;get_scope(); ?&gt;&quot;&gt;
&lt;input type=&quot;hidden&quot; name=&quot;response_type&quot; value=&quot;code&quot;&gt;
&lt;input type=&quot;submit&quot; value=&quot;Login with Instagram&quot; class=&quot;btn btn-info&quot;&gt;
&lt;/form&gt;
</pre>

<h3>Retrieving <code>access_token</code> from Instagram</h3>
<p>After a successful login and authorization, user will be redirected back to the configured <code>redirected URI</code> with an issued <code>&quot;response_code&quot;</code> as query string. This <code>response_code</code> can be used to retrieve the <code>access token</code> for user authenticated access to their data. Following example takes in the <code>response_code</code> value as parameter to retrieve the <code>access token</code>.</p>
<pre>
if ( isset($_GET['code']) &amp;&amp; $_GET['code'] ) {
  $data =  $ig-&gt;get_access_token(htmlentities($_GET['code']));
  $user_id = $data['user_id'];
  $username = $data['username'];
  $name = $data[name'];
  $avatar = $data['avatar];
  $access_token = $data['access_token'];
}
</pre>
<p>It is important to know that <code>response_code</code> value is only valid for one time and if user navigates away from current page then a new <code>response_code</code> will be  required for user authentication and access token. Therefore, it is recommended to save  the access token in SESSION, COOKIE or Database (whichever is convenient) for  users to keep uninterrupted actions.</p>

<h3>License</h3>
<p>This library is available under <a href="http://opensource.org/licenses/MIT" target="_blank">MIT License</a> for use and contributions.</p>
<hr>
<p>Happy coding. Happy Instagraming!</p>
