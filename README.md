# SharpSpring API
Super-simple SharpSpring API v1 wrapper, in PHP.

Let's improve your website with Marketing Automation and Inbound Marketing.

by [Angelo Públio](https://angelopublio.com)



### Declare your accountID and secretKEY

```
if ( !defined('SHARPSPRING_ACCOUNTID') )
	define('SHARPSPRING_ACCOUNTID', 'YOUR-ACCOUNT-ID');
		
if ( !defined('SHARPSPRING_SECRETKEY') )
	define('SHARPSPRING_SECRETKEY', 'YOUR-SECRET-KEY');

```

### Include the lib

Example using the folder '/lib/sharpspring-api/src/' inside the WordPress' theme folder

```
if (!class_exists('AngeloPublio\SharpSpring'))
	require_once(get_template_directory().'/lib/sharpspring-api/src/SharpSpring.php');
```


### Calling the API

Example calling getLeads

```
$SharpSpring = new \AngeloPublio\SharpSpring(SHARPSPRING_ACCOUNTID, SHARPSPRING_SECRETKEY);

$limit = 500;                                                                         
$offset = 0;    
   
$result = $SharpSpring->call('getLeads', 
				array('where' => array('emailAddress' => 'email-to-filter@test.com'), 'limit' => $limit, 'offset' => $offset)
			);
print_r($result);

```

Example calling getFields

```
$SharpSpring = new \AngeloPublio\SharpSpring(SHARPSPRING_ACCOUNTID, SHARPSPRING_SECRETKEY);

$limit = 500;                                                                         
$offset = 0;    
   
$result = $SharpSpring->call('getFields', 
				array('where' => array(), 'limit' => $limit, 'offset' => $offset)
			);
print_r($result);

```
