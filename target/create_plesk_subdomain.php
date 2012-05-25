<?php
 // echo "I'm running under ".shell_exec("whoami")." user";
	ini_set('errors_reporting',E_ALL);
	ini_set('display_errors','On');
/**
* Reports error during API RPC request
*/
class ApiRequestException extends Exception {}
/**
* Returns DOM object representing request for information about all available domains
* @return DOMDocument
*/
function domainsInfoRequest(){
      $xmldoc = new DomDocument('1.0', 'UTF-8');
      $xmldoc->formatOutput = true;

      $packet = $xmldoc->createElement('packet');
      $packet->setAttribute('version', '1.5.2.0');
      $xmldoc->appendChild($packet);
   
      $subdomain = $xmldoc->createElement('subdomain');
      $packet->appendChild($subdomain);

      $add = $xmldoc->createElement('add');
      $subdomain->appendChild($add);

    
      $add->appendChild($xmldoc->createElement('parent','waterforlifeusa.com'));

      $newDomainName = $xmldoc->createElement('name','anil');
      $add->appendChild($newDomainName);
      
      $home = $xmldoc->createElement('home','/var/www/vhosts/waterforlifeusa.com/subdomains/anil');
      $add->appendChild($home);

      $property = $xmldoc->createElement('property');
      $add->appendChild($property);

      $property->appendChild($xmldoc->createElement('name','perl'));
      $property->appendChild($xmldoc->createElement('value','true'));

      $property = $xmldoc->createElement('property');
      $add->appendChild($property);

      $property->appendChild($xmldoc->createElement('name','cgi'));
      $property->appendChild($xmldoc->createElement('value','true'));

      $property = $xmldoc->createElement('property');
      $add->appendChild($property);
      $property->appendChild($xmldoc->createElement('name','ssi'));
      $property->appendChild($xmldoc->createElement('value','true'));
      
      



      $property = $xmldoc->createElement('property');
      $add->appendChild($property);
      $property->appendChild($xmldoc->createElement('name','php'));
      $property->appendChild($xmldoc->createElement('value','true'));
      //make the output pretty
      return $xmldoc;
}

/**

* Prepares CURL to perform Plesk API request

* @return resource

*/

function curlInit($host, $login, $password){
	
      $curl = curl_init();
      curl_setopt($curl, CURLOPT_URL, "https://{$host}:8443/enterprise/control/agent.php");
      curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($curl, CURLOPT_POST, true);
      curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
      curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
      curl_setopt($curl, CURLOPT_HTTPHEADER,
             array("HTTP_AUTH_LOGIN: {$login}",
                    "HTTP_AUTH_PASSWD: {$password}",

                    "HTTP_PRETTY_PRINT: TRUE",

                    "Content-Type: text/xml")

      );

 

      return $curl;

}

/**

* Performs a Plesk API request, returns raw API response text

*

* @return string

* @throws ApiRequestException

*/

function sendRequest($curl, $packet){
      curl_setopt($curl, CURLOPT_POSTFIELDS, $packet);
      $result = curl_exec($curl);
      if (curl_errno($curl)) {
             $errmsg = curl_error($curl);
             $errcode = curl_errno($curl);
             curl_close($curl);
             throw new ApiRequestException($errmsg, $errcode);
      }
      curl_close($curl);
      return $result;
}

 

/**

* Looks if API responded with correct data

*

* @return SimpleXMLElement

* @throws ApiRequestException

*/

function parseResponse($response_string){

      $xml = new SimpleXMLElement($response_string);

      if (!is_a($xml, 'SimpleXMLElement'))
             throw new ApiRequestException("Can not parse server response: {$response_string}");
      return $xml;
}

/**

* Check data in API response

* @return void

* @throws ApiRequestException

*/

function checkResponse(SimpleXMLElement $response){
	print_r($response);die;
      $resultNode = $response->domain->get->result;
      // check if request was successful
      if ('error' == (string)$resultNode->status)
             throw new ApiRequestException("Plesk API returned error: " . (string)$resultNode->result->errtext);

}

//

// int main()

//
$host = 'waterforlifeusa.com';
$login = 'admin';
$password = 'ghosts1013';
$curl = curlInit($host, $login, $password);
try {
      $response = sendRequest($curl, domainsInfoRequest()->saveXML());
      $responseXml = parseResponse($response);
      checkResponse($responseXml);
} catch (ApiRequestException $e) {
      echo $e;
      die();
}

// Explore the result
foreach ($responseXml->xpath('/packet/domain/get/result') as $resultNode) {
      echo "Domain id: " . (string)$resultNode->id . " ";
      echo (string)$resultNode->data->gen_info->name . " (" . (string)$resultNode->data->gen_info->dns_ip_address . ")\n";
}
?>
