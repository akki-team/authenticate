<?php
require_once 'vendor/autoload.php';
require_once 'AuthenticateSSO.php';

$key = 'MySampleKey123465791011121314151'; // 32 char

// init
$authenticate = new AuthenticateSSO($key);

// encrypt
$login = 'john@example.com';
$loginEncrypted = $authenticate->encrypt($login);
echo sprintf("Encrypt:\n%s => %s\n\n",$login, $loginEncrypted);

// decode
$login = $authenticate->decrypt($loginEncrypted);
echo sprintf("Decrypt:\n%s => %s\n\n",$loginEncrypted, $login);
