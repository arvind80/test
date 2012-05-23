<?php
// Include required library files.
require_once('includes/config.php');
require_once('includes/paypal.class.php');

// Create PayPal object.
$PayPalConfig = array('Sandbox' => $sandbox, 'DeveloperAccountEmail' => $developer_account_email, 'ApplicationID' => $application_id, 'DeviceID' => $device_id, 
						'IPAddress' => $device_ip_address, 'APIUsername' => $api_username, 'APIPassword' => $api_password, 'APISignature' => $api_signature, 'APISubject' => $api_subject);
$PayPal = new PayPal_Adaptive($PayPalConfig);

// Prepare request arrays
$CreateAccountFields = array(
							 'AccountType' => '',  										// Required.  The type of account to be created.  Personal or Premier
							 'CitizenshipCountryCode' => '',  							// Required.  The code of the country to be associated with the business account.  This field does not apply to personal or premier accounts.
							 'ContactPhoneNumber' => '', 								// Required.  The phone number associated with the new account.
							 'ReturnURL' => '', 										// Required.  URL to redirect the user to after leaving PayPal pages.
							 'CurrencyCode' => '', 										// Required.  Currency code associated with the new account.  
							 'DateOfBirth' => '', 										// Date of birth of the account holder.  YYYY-MM-DDZ format.  For example, 1970-01-01Z
							 'EmailAddress' => '', 										// Required.  Email address.
							 'Saluation' => '', 										// A saluation for the account holder.
							 'FirstName' => '', 										// Required.  First name of the account holder.
							 'MiddleName' => '', 										// Middle name of the account holder.
							 'LastName' => '', 											// Required.  Last name of the account holder.
							 'Suffix' => '',  											// Suffix name for the account holder.
							 'NotificationURL' => '', 									// URL for IPN
							 'PreferredLanguageCode' => '', 							// Required.  The code indicating the language to be associated with the new account.
							 'RegistrationType' => '' 									// Required.  Whether the PayPal user will use a mobile device or the web to complete registration.  This determins whether a key or a URL is returned for the redirect URL.  Allowable values are:  Web
							);

$Address = array(
			   'Line1' => '', 															// Required.  Street address.
			   'Line2' => '', 															// Street address 2.
			   'City' => '', 															// Required.  City
			   'State' => '', 															// State or Province
			   'PostalCode' => '', 														// Postal code
			   'CountryCode' => ''														// Required.  The country code.
			   );

$PartnerFields = array(
					   'Field1' => '', 											// Custom field for use however needed
					   'Field2' => '', 											
					   'Field3' => '', 
					   'Field4' => '', 
					   'Field5' => ''
					   );

$PayPalRequestData = array(
						   'CreateAccountFields' => $CreateAccountFields, 
						   'Address' => $Address, 
						   'PartnerFields' => $PartnerFields
						   );


// Pass data into class for processing with PayPal and load the response array into $PayPalResult
$PayPalResult = $PayPal->CreateAccount($PayPalRequestData);

// Write the contents of the response array to the screen for demo purposes.
echo '<pre />';
print_r($PayPalResult);
?>