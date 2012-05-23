<?php
// Include required library files.
require_once('includes/config.php');
require_once('includes/paypal.class.php');

// Create PayPal object.
$PayPalConfig = array('Sandbox' => $sandbox, 'APIUsername' => $api_username, 'APIPassword' => $api_password, 'APISignature' => $api_signature);
$PayPal = new PayPal($PayPalConfig);

// Prepare request arrays
$DECPFields = array(
					'token' => '', 								// Required.  A timestamped token, the value of which was returned by a previous SetExpressCheckout call.
					'payerid' => '', 							// Required.  Unique PayPal customer id of the payer.  Returned by GetExpressCheckoutDetails, or if you used SKIPDETAILS it's returned in the URL back to your RETURNURL.
					'returnfmfdetails' => '', 					// Flag to indiciate whether you want the results returned by Fraud Management Filters or not.  1 or 0.
					'giftmessage' => '', 						// The gift message entered by the buyer on the PayPal Review page.  150 char max.
					'giftreceiptenable' => '', 					// Pass true if a gift receipt was selected by the buyer on the PayPal Review page. Otherwise pass false.
					'giftwrapname' => '', 						// The gift wrap name only if the gift option on the PayPal Review page was selected by the buyer.
					'giftwrapamount' => '', 					// The amount only if the gift option on the PayPal Review page was selected by the buyer.
					'buyermarketingemail' => '', 				// The buyer email address opted in by the buyer on the PayPal Review page.
					'surveyquestion' => '', 					// The survey question on the PayPal Review page.  50 char max.
					'surveychoiceselected' => '',  				// The survey response selected by the buyer on the PayPal Review page.  15 char max.
					'allowedpaymentmethod' => '' 				// The payment method type. Specify the value InstantPaymentOnly.
				);
						
$Payments = array();
$Payment = array(
				'amt' => '', 							// Required.  The total cost of the transaction to the customer.  If shipping cost and tax charges are known, include them in this value.  If not, this value should be the current sub-total of the order.
				'currencycode' => '', 					// A three-character currency code.  Default is USD.
				'itemamt' => '', 						// Required if you specify itemized L_AMT fields. Sum of cost of all items in this order.  
				'shippingamt' => '', 					// Total shipping costs for this order.  If you specify SHIPPINGAMT you mut also specify a value for ITEMAMT.
				'shippingdiscamt' => '', 				// Total shipping discount for this order, specified as a negative number.
				'insuranceoptionoffered' => '', 		// If true, the insurance drop-down on the PayPal review page displays the string 'Yes' and the insurance amount.  If true, the total shipping insurance for this order must be a positive number.
				'handlingamt' => '', 					// Total handling costs for this order.  If you specify HANDLINGAMT you mut also specify a value for ITEMAMT.
				'taxamt' => '', 						// Required if you specify itemized L_TAXAMT fields.  Sum of all tax items in this order. 
				'desc' => '', 							// Description of items on the order.  127 char max.
				'custom' => '', 						// Free-form field for your own use.  256 char max.
				'invnum' => '', 						// Your own invoice or tracking number.  127 char max.
				'notifyurl' => '', 						// URL for receiving Instant Payment Notifications
				'shiptoname' => '', 					// Required if shipping is included.  Person's name associated with this address.  32 char max.
				'shiptostreet' => '', 					// Required if shipping is included.  First street address.  100 char max.
				'shiptostreet2' => '', 					// Second street address.  100 char max.
				'shiptocity' => '', 					// Required if shipping is included.  Name of city.  40 char max.
				'shiptostate' => '', 					// Required if shipping is included.  Name of state or province.  40 char max.
				'shiptozip' => '', 						// Required if shipping is included.  Postal code of shipping address.  20 char max.
				'shiptocountrycode' => '', 				// Required if shipping is included.  Country code of shipping address.  2 char max.
				'shiptophonenum' => '',  				// Phone number for shipping address.  20 char max.
				'notetext' => '', 						// Note to the merchant.  255 char max.  
				'allowedpaymentmethod' => '', 			// The payment method type.  Specify the value InstantPaymentOnly.
				'paymentaction' => '', 					// How you want to obtain the payment.  When implementing parallel payments, this field is required and must be set to Order. 
				'paymentrequestid' => '',  				// A unique identifier of the specific payment request, which is required for parallel payments. 
				'sellerpaypalaccountid' => '', 			// A unique identifier for the merchant.  For parallel payments, this field is required and must contain the Payer ID or the email address of the merchant.
				'sellerid' => '', 						// The unique non-changing identifer for the seller at the marketplace site.  This ID is not displayed.
				'sellerusername' => '', 				// The current name of the seller or business at the marketplace site.  This name may be shown to the buyer.
				'sellerregistrationdate' => '', 		// Date when the seller registered at the marketplace site.
				'softdescriptor' => ''					// A per transaction description of the payment that is passed to the buyer's credit card statement.
				);
				
$PaymentOrderItems = array();
$Item = array(
			'name' => '', 								// Item name. 127 char max.
			'desc' => '', 								// Item description. 127 char max.
			'amt' => '', 								// Cost of item.
			'number' => '', 							// Item number.  127 char max.
			'qty' => '', 								// Item qty on order.  Any positive integer.
			'taxamt' => '', 							// Item sales tax
			'itemurl' => '', 							// URL for the item.
			'itemcategory' => '', 						// One of the following values:  Digital, Physical
			'itemweightvalue' => '', 					// The weight value of the item.
			'itemweightunit' => '', 					// The weight unit of the item.
			'itemheightvalue' => '', 					// The height value of the item.
			'itemheightunit' => '', 					// The height unit of the item.
			'itemwidthvalue' => '', 					// The width value of the item.
			'itemwidthunit' => '', 						// The width unit of the item.
			'itemlengthvalue' => '', 					// The length value of the item.
			'itemlengthunit' => '',  					// The length unit of the item.
			'ebayitemnumber' => '', 					// Auction item number.  
			'ebayitemauctiontxnid' => '', 				// Auction transaction ID number.  
			'ebayitemorderid' => '',  					// Auction order ID number.
			'ebayitemcartid' => ''						// The unique identifier provided by eBay for this order from the buyer. These parameters must be ordered sequentially beginning with 0 (for example L_EBAYITEMCARTID0, L_EBAYITEMCARTID1). Character length: 255 single-byte characters
			);
array_push($PaymentOrderItems, $Item);
$Payment['order_items'] = $PaymentOrderItems;				
array_push($Payments, $Payment);

$UserSelectedOptions = array(
							 'shippingcalculationmode' => '', 	// Describes how the options that were presented to the user were determined.  values are:  API - Callback   or   API - Flatrate.
							 'insuranceoptionselected' => '', 	// The Yes/No option that you chose for insurance.
							 'shippingoptionisdefault' => '', 	// Is true if the buyer chose the default shipping option.  
							 'shippingoptionamount' => '', 		// The shipping amount that was chosen by the buyer.
							 'shippingoptionname' => '', 		// Is true if the buyer chose the default shipping option...??  Maybe this is supposed to show the name..??
							 );
							 
$PayPalRequest = array(
					   'DECPFields' => $DECPFields, 
					   'Payments' => $Payments, 
					   'UserSelectedOptions' => $UserSelectedOptions
					   );

// Pass data into class for processing with PayPal and load the response array into $PayPalResult
$PayPalResult = $PayPal->DoExpressCheckoutPayment($PayPalRequestData);

// Write the contents of the response array to the screen for demo purposes.
echo '<pre />';
print_r($PayPalResult);
?>