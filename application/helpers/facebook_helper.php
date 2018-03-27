<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');
include('system/helpers/file_helper.php');
require(APPPATH.'third_party/fb/vendor/autoload.php');

function get_facebook_object(){
	return new \Facebook\Facebook([
	  'app_id' => '594710907544099',
	  'app_secret' => '6291afe92450912cdb6ca32a73a5f2c7',
	  'default_graph_version' => 'v2.10',
	  //'default_access_token' => '{access-token}', // optional
	]);
}

function get_fb_login_url($permissions=NULL){
	$fb = get_facebook_object();
	$helper = $fb->getRedirectLoginHelper();
	$permissions = ['email']; // Optional permissions
	$loginUrl = $helper->getLoginUrl(base_url('login-via-facebook'), $permissions);
	echo $loginUrl;
}

function try_fb_login(){
	$fb = get_facebook_object();
	$helper = $fb->getRedirectLoginHelper();
	try {
	  $accessToken = $helper->getAccessToken();
	} catch(Facebook\Exceptions\FacebookResponseException $e) {
	  // When Graph returns an error
	  echo 'Graph returned an error: ' . $e->getMessage();
	  exit;
	} catch(Facebook\Exceptions\FacebookSDKException $e) {
	  // When validation fails or other local issues
	  echo 'Facebook SDK returned an error: ' . $e->getMessage();
	  exit;
	}

	if (! isset($accessToken)) {
	  if ($helper->getError()) {
	    header('HTTP/1.0 401 Unauthorized');
	    echo "Error: " . $helper->getError() . "\n";
	    echo "Error Code: " . $helper->getErrorCode() . "\n";
	    echo "Error Reason: " . $helper->getErrorReason() . "\n";
	    echo "Error Description: " . $helper->getErrorDescription() . "\n";
	  } else {
	    header('HTTP/1.0 400 Bad Request');
	    echo 'Bad request';
	  }
	  exit;
	}

	// Logged in
	echo '<h3>Access Token</h3>';
	var_dump($accessToken->getValue());

	// The OAuth 2.0 client handler helps us manage access tokens
	$oAuth2Client = $fb->getOAuth2Client();

	// Get the access token metadata from /debug_token
	$tokenMetadata = $oAuth2Client->debugToken($accessToken);
	echo '<h3>Metadata</h3>';
	var_dump($tokenMetadata);

	// Validation (these will throw FacebookSDKException's when they fail)
	$tokenMetadata->validateAppId($config['app_id']);
	// If you know the user ID this access token belongs to, you can validate it here
	//$tokenMetadata->validateUserId('123');
	$tokenMetadata->validateExpiration();

	if (! $accessToken->isLongLived()) {
	  // Exchanges a short-lived access token for a long-lived one
	  try {
	    $accessToken = $oAuth2Client->getLongLivedAccessToken($accessToken);
	  } catch (Facebook\Exceptions\FacebookSDKException $e) {
	    echo "<p>Error getting long-lived access token: " . $e->getMessage() . "</p>\n\n";
	    exit;
	  }

	  echo '<h3>Long-lived</h3>';
	  var_dump($accessToken->getValue());
	}

	$_SESSION['fb_access_token'] = (string) $accessToken;

}

