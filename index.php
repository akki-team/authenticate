<?php
require_once 'vendor/autoload.php';
require_once 'AuthenticateSSO.php';

$key = 'MySampleKey123465791011121314151'; // 32 char

// init
$authenticate = new AuthenticateSSO($key);

// encrypt
$login = 'john@example.com';
$loginEncrypted = $authenticate->encrypt($login);
?>

<h2>Encrypt:  <?php echo $login;?></h2>


<pre>
<?php echo $loginEncrypted; ?>
</pre>

<hr>

<h2>Decrypt:</h2>

<?php
echo $authenticate->decrypt($loginEncrypted);
?>
