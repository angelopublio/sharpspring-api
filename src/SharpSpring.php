<?php

namespace AngeloPublio;
/**
 * Super-simple SharpSpring API v1 wrapper, in PHP.
 * 
 * @author Angelo Públio <angelopublio.com> 
 * @version 0.1
 */


class SharpSpring
{

	private $accountID;
	private $secretKey;
    
    
    public function __construct($accountID, $secretKey)
    {
        $this->accountID = $accountID;
        $this->secretKey = $secretKey;
    }
    
    public function call($method, $args=array())
    {
        return $this->makeRequest($method, $args);
    }

    private function makeRequest($method, $args=array())
    {      


		$queryString = http_build_query(array('accountID' => $this->accountID, 'secretKey' => $this->secretKey)); 
		$url = "http://api.sharpspring.com/pubapi/v1/?$queryString"; 
		$requestID = uniqid();
		
		$data = array(                                                                                
		   'method' => $method,                                                                      
		   'params' => $args,                                                                      
		   'id' => $requestID,                                                                       
		);                                                                                            


        if (function_exists('curl_init') && function_exists('curl_setopt')){
			                                                                                             
			$data = json_encode($data);                                                                   
			$ch = curl_init($url);                                                                        
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");                                              
			curl_setopt($ch, CURLOPT_POSTFIELDS, $data);                                                  
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                               
			curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                   
			   'Content-Type: application/json',                                                         
			   'Content-Length: ' . strlen($data)                                                        
			));                                                                                           

			$result = curl_exec($ch);                                                                     
			curl_close($ch);                                                                              

			print_r($result);
			exit;
            
        } else {
            $json_data = json_encode($args);
            $result    = file_get_contents($url, null, stream_context_create(array(
                'http' => array(
                    'protocol_version' => 1.1,
                    'user_agent'       => 'PHP-MCAPI/2.0',
                    'method'           => 'POST',
                    'header'           => "Content-type: application/json\r\n".
                                          "Connection: close\r\n" .
                                          "Content-length: " . strlen($json_data) . "\r\n",
                    'content'          => $json_data,
                ),
            )));
        }

        return $result ? json_decode($result, true) : false;
    }

}
?>