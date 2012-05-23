<?php
class eBay
{
	var $APIEndpoint = "";
	var $DevID = "";
	var $AppID = "";
	var $CertID = "";
	var $AuthToken = "";
	var $CompatLevel = "";
	var $SiteID = "";
	var $Sandbox = "";
	
	function __construct($DataArray)
	{
		/*echo '<pre />';
		print_r($DataArray);
		exit();*/
		
		$this -> Sandbox = isset($DataArray['Sandbox']) && $DataArray['Sandbox'] == true ? true : false;
		$this -> CompatLevel = isset($DataArray['CompatLevel'])  && $DataArray['CompatLevel'] != '' ? $DataArray['CompatLevel'] : 745; // current API version class accepts.
		$this -> SiteID = 0;
		
		if(!$this->Sandbox)
		{
			$this -> APIEndpoint = "https://api.ebay.com/ws/api.dll";
			$this -> DevID = isset($DataArray['DevID']) && $DataArray['DevID'] != '' ? $DataArray['DevID'] : '';
			$this -> AppID = isset($DataArray['AppID']) && $DataArray['AppID'] != '' ? $DataArray['AppID'] : '';
			$this -> CertID = isset($DataArray['CertID']) && $DataArray['CertID'] != '' ? $DataArray['CertID'] : '';
			$this -> AuthToken = isset($DataArray['AuthToken']) && $DataArray['AuthToken'] != '' ? $DataArray['AuthToken'] : '';
		
		}
		else
		{ 
			$this -> APIEndpoint = "https://api.sandbox.ebay.com/ws/api.dll";
			$this -> DevID = isset($DataArray['DevID']) && $DataArray['DevID'] != '' ? $DataArray['DevID'] : '';
			$this -> AppID = isset($DataArray['AppID']) && $DataArray['AppID'] != '' ? $DataArray['AppID'] : '';
			$this -> CertID = isset($DataArray['CertID']) && $DataArray['CertID'] != '' ? $DataArray['CertID'] : '';
			$this -> AuthToken = isset($DataArray['AuthToken']) && $DataArray['AuthToken'] != '' ? $DataArray['AuthToken'] : '';
		}
		
	} // End eBay() function
	
	function BuildHeaders($CallName)
	{
		$headers = array 
		(
		
			'X-EBAY-API-COMPATIBILITY-LEVEL: ' . $this -> CompatLevel,
			'X-EBAY-API-DEV-NAME: ' . $this -> DevID,
			'X-EBAY-API-APP-NAME: ' . $this -> AppID,
			'X-EBAY-API-CERT-NAME: ' . $this -> CertID,
			'X-EBAY-API-CALL-NAME: ' . $CallName,			
			'X-EBAY-API-SITEID: ' . $this -> SiteID,
		
		); // End $headers array
		
		return $headers;
	}
	
	function SendHTTPRequest($XMLRequest, $CallName)
	{		
		$connection = curl_init();
		curl_setopt($connection, CURLOPT_URL, $this -> APIEndpoint);
		curl_setopt($connection, CURLOPT_SSL_VERIFYPEER, 0);
		curl_setopt($connection, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($connection, CURLOPT_HTTPHEADER, $this -> BuildHeaders($CallName));
		curl_setopt($connection, CURLOPT_POST, 1);
		curl_setopt($connection, CURLOPT_POSTFIELDS, $XMLRequest);
		curl_setopt($connection, CURLOPT_RETURNTRANSFER, 1);
		$response = curl_exec($connection);
		curl_close($connection);
		
		return $response;
		
	} // End SendHTTPRequest function
	
	
	function GetErrors($XMLResponse)
	{
		$DOM = new DOMDocument();
		$DOM -> loadXML($XMLResponse);
		
		$ErrorsArray = array();
		$Errors = $DOM -> getElementsByTagName("Errors");
		foreach($Errors as $Error)
		{
			$ErrorClassification = $Error -> getElementsByTagName('ErrorClassification') -> length > 0 ? $Error -> getElementsByTagName('ErrorClassification') -> item(0) -> nodeValue : '';
			$ErrorCode = $Error -> getElementsByTagName('ErrorCode') -> length > 0 ? $Error -> getElementsByTagName('ErrorCode') -> item(0) -> nodeValue : '';
			$ShortMessage = $Error -> getElementsByTagName('ShortMessage') -> length > 0 ? $Error -> getElementsByTagName('ShortMessage') -> item(0) -> nodeValue : '';
			$LongMessage = $Error -> getElementsByTagName('LongMessage') -> length > 0 ? $Error -> getElementsByTagName('LongMessage') -> item(0) -> nodeValue : '';
			$SeverityCode = $Error -> getElementsByTagName('SeverityCode') -> length > 0 ? $Error -> getElementsByTagName('SeverityCode') -> item(0) -> nodeValue : '';
			$UserDisplayHint = $Error -> getElementsByTagName('UserDisplayHint') -> length > 0 ? $Error -> getElementsByTagName('UserDisplayHint') -> item(0) -> nodeValue : '';
			
			$CurrentError = array(
								  'ErrorClassification' => $ErrorClassification, 
								  'ErrorCode' => $ErrorCode, 
								  'ShortMessage' => $ShortMessage, 
								  'LongMessage' => $LongMessage, 
								  'SeverityCode' => $SeverityCode, 
								  'UserDisplayHint' => $UserDisplayHint
								  );
			
			array_push($ErrorsArray, $CurrentError);
		}
		
		$ExtraMessage = $DOM -> getElementsByTagName('Message') -> length > 0 ? $DOM -> getElementsByTagName('Message') -> item(0) -> nodeValue : '';
		
		$ResponseArray['Errors'] = $ErrorsArray;
		$ResponseArray['ExtraMessage'] = $ExtraMessage;
		
		return $ResponseArray;
	}
	
	function DisplayErrors($ErrorsArray)
	{
		$Errors = $ErrorsArray['Errors'];
		$ExtraMessage = $ErrorsArray['ExtraMessage'];
		
		echo '<table width="50%" border="0" align="center" cellpadding="2" cellspacing="2">';
				
		foreach($Errors as $Error)
		{
			echo '<tr>
					<td width="20%"><strong>Error Code</strong></td>
					<td width="80%">' . $Error['ErrorCode'] . '</td>
				  </tr>
				  <tr>
					<td><strong>Short Message</strong></td>
					<td>' . $Error['ShortMessage'] . '</td>
				  </tr>
				  <tr>
					<td><strong>Long Message</strong></td>
					<td>' . $Error['LongMessage'] . '</td>
				  </tr>';
				  
			if($ExtraMessage != '')
			{
				echo '<tr>
					  <td><strong>Extra Message</strong></td>
					  <td>' . $ExtraMessage . '</td>
					 </tr>';
			}
				  
				  
			echo '<tr>
				  	<td>&nbsp;</td>
					<td>&nbsp;</td>
				  </tr>';
		}
		
		echo '</table>';
	}
	
	
	function Logger($filename, $string_data)
	{	
		$timestamp = strtotime('now');
		$timestamp = date('mdY_giA_',$timestamp);
		
		if($this->Sandbox)
		{
			$file = $_SERVER['DOCUMENT_ROOT'].'/log/eBay/'.$timestamp.$filename.'xml';	
		}
		else
		{
			$file = "/home/harvest/public_html/log/eBay/".$timestamp.$filename.".xml";
		}
		$fh = fopen($file, 'w');
		fwrite($fh, $string_data);
		fclose($fh);
		
		return true;	
	}
	
	
	function GetSessionID($RuName, $AcceptURL, $RejectURL)
	{
		$XMLRequest = "<?xml version=\"1.0\" encoding=\"utf-8\" ?>
					   <GetSessionIDRequest xmlns=\"urn:ebay:apis:eBLBaseComponents\">
						   <RequesterCredentials>
							   <eBayAuthToken>" . $this -> AuthToken . "</eBayAuthToken>
						   </RequesterCredentials>
						   <RuName>".$RuName."</RuName>
					   </GetSessionIDRequest>";	
		
		$XMLResponse = $this -> SendHTTPRequest($XMLRequest, 'GetSessionID');
			   
		$DOM = new DOMDocument();
		$DOM -> loadXML($XMLResponse);
		$DOMXPath = new DOMXPath($DOM);
		$DOMXPath -> registerNamespace("ns","urn:ebay:apis:eBLBaseComponents");
		
		$Ack = $DOM -> getElementsByTagName('Ack') -> length > 0 ? $DOM -> getElementsByTagName('Ack') -> item(0) -> nodeValue : '';
		$Errors = strtoupper($Ack) != 'SUCCESS' && strtoupper($Ack) != 'SUCCESSWITHWARNING' ? $this -> GetErrors($XMLResponse) : array();
		$SessionID = $DOM -> getElementsByTagName('SessionID') -> length > 0 ? $DOM -> getElementsByTagName('SessionID') -> item(0) -> nodeValue : '';
		
		if(strtoupper($Ack) != 'SUCCESS' && strtoupper($Ack) != 'SUCCESSWITHWARNING')
		{
			$RedirectURL = '';
		}
		else
		{
			$RedirectURL = $this->Sandbox ? 'https://signin.sandbox.ebay.com/ws/eBayISAPI.dll?SignIn&RuName='.$RuName.'&SessID='.urlencode($SessionID) : 'https://signin.ebay.com/ws/eBayISAPI.dll?SignIn&RuName='.$RuName.'&SessID='.urlencode($SessionID);			
		}
		
		$ResponseArray = array(
							  'Ack' => $Ack, 
							  'SessionID' => $SessionID, 
							  'RedirectURL' => $RedirectURL, 
							  'Errors' => $Errors, 
							  'RawRequest' => $XMLRequest, 
							  'RawResponse' => $XMLResponse
							  );
		
		return $ResponseArray;

	}
	
	
	function FetchToken($SessionID)
	{
		$XMLRequest = "<?xml version=\"1.0\" encoding=\"utf-8\" ?>
					   <FetchToken xmlns=\"urn:ebay:apis:eBLBaseComponents\">
						   <RequesterCredentials>
							   <eBayAuthToken>" . $this -> AuthToken . "</eBayAuthToken>
						   </RequesterCredentials>
						   <SessionID>".$SessionID."</SessionID>
					   </FetchToken>";	
					   
		$XMLResponse = $this -> SendHTTPRequest($XMLRequest, 'FetchToken');
		
		$DOM = new DOMDocument();
		$DOM -> loadXML($XMLResponse);
		$DOMXPath = new DOMXPath($DOM);
		$DOMXPath -> registerNamespace("ns","urn:ebay:apis:eBLBaseComponents");
		
		//Get the value of Ack, which is the status of the call: Failure or Success
		$Ack = $DOM -> getElementsByTagName('Ack') -> length > 0 ? $DOM -> getElementsByTagName('Ack') -> item(0) -> nodeValue : '';
		$Errors = strtoupper($Ack) != 'SUCCESS' && strtoupper($Ack) != 'SUCCESSWITHWARNING' ? $this -> GetErrors($XMLResponse) : array();
		$eBayAuthToken = $DOM -> getElementsByTagName('eBayAuthToken') -> length > 0 ? $DOM -> getElementsByTagName('eBayAuthToken') -> item(0) -> nodeValue : '';
		$HardExpirationTime = $DOM -> getElementsByTagName('HardExpirationTime') -> length > 0 ? $DOM -> getElementsByTagName('HardExpirationTime') -> item(0) -> nodeValue : '';
		$RESTToken = $DOM -> getElementsByTagName('RESTToken') -> length > 0 ? $DOM -> getElementsByTagName('RESTToken') -> item(0) -> nodeValue : '';

		$ResponseArray = array(
							  'Ack' => $Ack, 
							  'eBayAuthToken' => $eBayAuthToken, 
							  'HardExpirationTime' => $HardExpirationTime, 
							  'RESTToken' => $RESTToken, 
							  'Errors' => $Errors, 
							  'RawRequest' => $XMLRequest, 
							  'RawResponse' => $XMLResponse
							  );
		
		return $ResponseArray;
	}
	
	
	function GeteBayOfficialTime()
	{
		$XMLRequest = "<?xml version=\"1.0\" encoding=\"utf-8\" ?>
					   <GeteBayOfficialTimeRequest xmlns=\"urn:ebay:apis:eBLBaseComponents\">
						   <RequesterCredentials>
							   <eBayAuthToken>" . $this -> AuthToken . "</eBayAuthToken>
						   </RequesterCredentials>
					   </GeteBayOfficialTimeRequest>";
					   
		$XMLResponse = $this -> SendHTTPRequest($XMLRequest, 'GeteBayOfficialTime');
		
		$DOM = new DOMDocument();
		$DOM -> loadXML($XMLResponse);
		$DOMXPath = new DOMXPath($DOM);
		$DOMXPath -> registerNamespace("ns","urn:ebay:apis:eBLBaseComponents");
		
		//Get the value of Ack, which is the status of the call: Failure or Success
		$Ack = $DOM -> getElementsByTagName('Ack') -> length > 0 ? $DOM -> getElementsByTagName('Ack') -> item(0) -> nodeValue : '';
		$Errors = strtoupper($Ack) != 'SUCCESS' && strtoupper($Ack) != 'SUCCESSWITHWARNING' ? $this -> GetErrors($XMLResponse) : array();
		$eBayOfficialTime = $DOM -> getElementsByTagName('Timestamp') -> length > 0 ? $DOM -> getElementsByTagName('Timestamp') -> item(0) -> nodeValue : '';
		
		$ResponseArray = array(
							  'Ack' => $Ack, 
							  'eBayOfficialTime' => $eBayOfficialTime, 
							  'Errors' => $Errors, 
							  'RawRequest' => $XMLRequest, 
							  'RawResponse' => $XMLResponse
							  );
		
		return $ResponseArray;
	
	} // End function GeteBayOfficialTime()
	
	
	function GetMyeBaySelling($lists = array())
	{
		$XMLRequest = '<?xml version="1.0" encoding="utf-8"?>
						<GetMyeBaySellingRequest xmlns="urn:ebay:apis:eBLBaseComponents">
							<RequesterCredentials>
							   <eBayAuthToken>' . $this -> AuthToken . '</eBayAuthToken>
						   	</RequesterCredentials>
							<DetailLevel>ReturnAll</DetailLevel>';
		
		foreach($lists as $list)
		{
			if(strtoupper($list) == 'ACTIVELIST')
			{
				$XMLRequest .= '<ActiveList>
									<Include>true</Include>
									<IncludeNotes>true</IncludeNotes>
								</ActiveList>';
			}
			else if(strtoupper($list) == 'BIDLIST')
			{
				$XMLRequest .= '<BidList>
									<Include>true</Include>
									<IncludeNotes>true</IncludeNotes>
								</BidList>';
			}
			else if(strtoupper($list) == 'DELETEDFROMSOLDLIST')
			{
				$XMLRequest .= '<DeletedFromSoldList>
									<Include>true</Include>
									<IncludeNotes>true</IncludeNotes>
								</DeletedFromSoldList>';
			}
			else if(strtoupper($list) == 'DELETEDFROMUNSOLDLIST')
			{
				$XMLRequest .= '<DeletedFromUnsoldList>
									<Include>true</Include>
									<IncludeNotes>true</IncludeNotes>
								</DeletedFromUnsoldList>';
			}
			else if(strtoupper($list) == 'SCHEDULEDLIST')
			{
				$XMLRequest .= '<ScheduledList>
									<Include>true</Include>
									<IncludeNotes>true</IncludeNotes>
								</ScheduledList>';
			}	
			else if(strtoupper($list) == 'SOLDLIST')
			{
				$XMLRequest .= '<SoldList>
									<Include>true</Include>
									<IncludeNotes>true</IncludeNotes>
								</SoldList>';
			}
			else if(strtoupper($list) == 'UNSOLDLIST')
			{
				$XMLRequest .= '<UnsoldList>
									<Include>true</Include>
									<IncludeNotes>true</IncludeNotes>
								</UnsoldList>';
			}
		}
			 
		$XMLRequest .= '</GetMyeBaySellingRequest>';
		
		$XMLResponse = $this -> SendHTTPRequest($XMLRequest, 'GetMyeBaySelling');
		
		$DOM = new DOMDocument();
		$DOM -> loadXML($XMLResponse);
		$DOMXPath = new DOMXPath($DOM);
		$DOMXPath -> registerNamespace("ns","urn:ebay:apis:eBLBaseComponents");
		
		$Ack = $DOM -> getElementsByTagName('Ack') -> length > 0 ? $DOM -> getElementsByTagName('Ack') -> item(0) -> nodeValue : '';
		$Errors = strtoupper($Ack) != 'SUCCESS' && strtoupper($Ack) != 'SUCCESSWITHWARNING' ? $this -> GetErrors($XMLResponse) : array();
		
		$ResponseArray = array(
							  'Ack' => $Ack, 
							  'Errors' => $Errors, 
							  'RawRequest' => $XMLRequest, 
							  'RawResponse' => $XMLResponse
							  );
		
		return $ResponseArray;
	}
	
	
	function GetItemTransactions($eBayItemID, $DaysBack)
	{
	
		$ModTimeFromTimestamp = mktime(0,0,0,date("m"),date("d") - $DaysBack,date("Y"));
		$ModTimeFromDate = date("Y-m-d",$ModTimeFromTimestamp);
		$ModTimeFromTime = date("H:i:s",$ModTimeFromTimestamp);
		$ModTimeFrom = $ModTimeFromDate . ' ' . $ModTimeFromTime;
		
		$ModTimeToTimestamp = mktime(0,0,0,date("m"),date("d") + 1,date("Y"));
		$ModTimeToDate = date("Y-m-d",$ModTimeToTimestamp);
		$ModTimeToTime = date("H:i:s",$ModTimeToTimestamp);
		$ModTimeTo = $ModTimeToDate . ' ' . $ModTimeToTime;
		
		$XMLRequest = "<?xml version=\"1.0\" encoding=\"utf-8\" ?>
					   <GetItemTransactionsRequest xmlns=\"urn:ebay:apis:eBLBaseComponents\">
						   <RequesterCredentials>
							   <eBayAuthToken>" . $this -> AuthToken . "</eBayAuthToken>
						   </RequesterCredentials>
						   <DetailLevel>ReturnAll</DetailLevel>
						   <IncludeFinalValueFee>1</IncludeFinalValueFee>
						   <ItemID>".$eBayItemID."</ItemID>
						   <ModTimeFrom>" . $ModTimeFrom . "</ModTimeFrom>
						   <ModTimeTo>" . $ModTimeTo . "</ModTimeTo>
					   </GetItemTransactionsRequest>";
					   
		$XMLResponse = $this -> SendHTTPRequest($XMLRequest, "GetItemTransactions");
		
		$DOM = new DOMDocument();
		$DOM -> loadXML($XMLResponse);
		$DOMXPath = new DOMXPath($DOM);
		$DOMXPath -> registerNamespace("ns","urn:ebay:apis:eBLBaseComponents");
		
		$Ack = $DOM -> getElementsByTagName('Ack') -> length > 0 ? $DOM -> getElementsByTagName('Ack') -> item(0) -> nodeValue : '';
		$Errors = strtoupper($Ack) != 'SUCCESS' && strtoupper($Ack) != 'SUCCESSWITHWARNING' ? $this -> GetErrors($XMLResponse) : array();
		
		$ResponseArray = array(
							  'Ack' => $Ack, 
							  'Errors' => $Errors, 
							  'RawRequest' => $XMLRequest, 
							  'RawResponse' => $XMLResponse
							  );
		
		return $ResponseArray;
	}
	
	
	function GetItem($eBayItemID)
	{
	
		$XMLRequest = "<?xml version=\"1.0\" encoding=\"utf-8\" ?>
						<GetItemRequest xmlns=\"urn:ebay:apis:eBLBaseComponents\">
							<RequesterCredentials>
							   <eBayAuthToken>" . $this -> AuthToken . "</eBayAuthToken>
						   </RequesterCredentials>
						   <DetailLevel>ReturnAll</DetailLevel>
						   <IncludeWatchCount>true</IncludeWatchCount>
						   <ItemID>" . $eBayItemID . "</ItemID>
						</GetItemRequest>";
						
		$XMLResponse = $this -> SendHTTPRequest($XMLRequest, "GetItem");
		
		$DOM = new DOMDocument();
		$DOM -> loadXML($XMLResponse);
		$DOMXPath = new DOMXPath($DOM);
		$DOMXPath -> registerNamespace("ns","urn:ebay:apis:eBLBaseComponents");
		
		$Ack = $DOM -> getElementsByTagName('Ack') -> length > 0 ? $DOM -> getElementsByTagName('Ack') -> item(0) -> nodeValue : '';
		$Errors = strtoupper($Ack) != 'SUCCESS' && strtoupper($Ack) != 'SUCCESSWITHWARNING' ? $this -> GetErrors($XMLResponse) : array();
		$Title = $DOMXPath -> query("/ns:GetItemResponse/ns:Item/ns:Title/text()") -> length > 0 ? $DOMXPath -> query("/ns:GetItemResponse/ns:Item/ns:Title/text()") -> item(0) -> data : '';
		$SubTitle = $DOMXPath -> query("/ns:GetItemResponse/ns:Item/ns:SubTitle/text()") -> length > 0 ? $DOMXPath -> query("/ns:GetItemResponse/ns:Item/ns:SubTitle/text()") -> item(0) -> data : '';
		$Location = $DOMXPath -> query("/ns:GetItemResponse/ns:Item/ns:Location/text()") -> length > 0 ? $DOMXPath -> query("/ns:GetItemResponse/ns:Item/ns:Location/text()") -> item(0) -> data : '';
		$ConditionDisplayName = $DOMXPath -> query("/ns:GetItemResponse/ns:Item/ns:ConditionDisplayName/text()") -> length > 0 ? $DOMXPath -> query("/ns:GetItemResponse/ns:Item/ns:ConditionDisplayName/text()") -> item(0) -> data : '';
		$Description = $DOMXPath -> query("/ns:GetItemResponse/ns:Item/ns:Description/text()") -> length > 0 ? $DOMXPath -> query("/ns:GetItemResponse/ns:Item/ns:Description/text()") -> item(0) -> data : '';
		$ViewItemURL = $DOMXPath -> query("/ns:GetItemResponse/ns:Item/ns:ListingDetails/ns:ViewItemURL/text()") -> length > 0 ? $DOMXPath -> query("/ns:GetItemResponse/ns:Item/ns:ListingDetails/ns:ViewItemURL/text()") -> item(0) -> data : '';
		$EndTime = $DOMXPath -> query("/ns:GetItemResponse/ns:Item/ns:ListingDetails/ns:EndTime/text()") -> length > 0 ? $DOMXPath -> query("/ns:GetItemResponse/ns:Item/ns:ListingDetails/ns:EndTime/text()") -> item(0) -> data : '';
		$ExternalPictureURL = $DOMXPath -> query("/ns:GetItemResponse/ns:Item/ns:PictureDetails/ns:ExternalPictureURL/text()") -> length > 0 ? $DOMXPath -> query("/ns:GetItemResponse/ns:Item/ns:PictureDetails/ns:ExternalPictureURL/text()") -> item(0) -> data : '';
		$GalleryURL = $DOMXPath -> query("/ns:GetItemResponse/ns:Item/ns:PictureDetails/ns:GalleryURL/text()") -> length > 0 ? $DOMXPath -> query("/ns:GetItemResponse/ns:Item/ns:PictureDetails/ns:GalleryURL/text()") -> item(0) -> data : '';
		$PictureURL = $DOMXPath -> query("/ns:GetItemResponse/ns:Item/ns:PictureDetails/ns:PictureURL/text()") -> length > 0 ? $DOMXPath -> query("/ns:GetItemResponse/ns:Item/ns:PictureDetails/ns:PictureURL/text()") -> item(0) -> data : '';
		$ReturnPolicyDescription = $DOMXPath -> query("/ns:GetItemResponse/ns:Item/ns:ReturnPolicy/ns:Description/text()") -> length > 0 ? $DOMXPath -> query("/ns:GetItemResponse/ns:Item/ns:ReturnPolicy/ns:Description/text()") -> item(0) -> data : '';
		$Refund = $DOMXPath -> query("/ns:GetItemResponse/ns:Item/ns:ReturnPolicy/ns:Refund/text()") -> length > 0 ? $DOMXPath -> query("/ns:GetItemResponse/ns:Item/ns:ReturnPolicy/ns:Refund/text()") -> item(0) -> data : '';
		$RefundOption = $DOMXPath -> query("/ns:GetItemResponse/ns:Item/ns:ReturnPolicy/ns:RefundOption/text()") -> length > 0 ? $DOMXPath -> query("/ns:GetItemResponse/ns:Item/ns:ReturnPolicy/ns:RefundOption/text()") -> item(0) -> data : '';
		$ReturnsAccepted = $DOMXPath -> query("/ns:GetItemResponse/ns:Item/ns:ReturnPolicy/ns:ReturnsAccepted/text()") -> length > 0 ? $DOMXPath -> query("/ns:GetItemResponse/ns:Item/ns:ReturnPolicy/ns:ReturnsAccepted/text()") -> item(0) -> data : '';
		$ReturnsAcceptedOption = $DOMXPath -> query("/ns:GetItemResponse/ns:Item/ns:ReturnPolicy/ns:ReturnsAcceptedOption/text()") -> length > 0 ? $DOMXPath -> query("/ns:GetItemResponse/ns:Item/ns:ReturnPolicy/ns:ReturnsAcceptedOption/text()") -> item(0) -> data : '';
		$ReturnsWithin = $DOMXPath -> query("/ns:GetItemResponse/ns:Item/ns:ReturnPolicy/ns:ReturnsWithin/text()") -> length > 0 ? $DOMXPath -> query("/ns:GetItemResponse/ns:Item/ns:ReturnPolicy/ns:ReturnsWithin/text()") -> item(0) -> data : '';
		$ReturnsWithinOption = $DOMXPath -> query("/ns:GetItemResponse/ns:Item/ns:ReturnPolicy/ns:ReturnsWithinOption/text()") -> length > 0 ? $DOMXPath -> query("/ns:GetItemResponse/ns:Item/ns:ReturnPolicy/ns:ReturnsWithinOption/text()") -> item(0) -> data : '';
		$ShippingCostPaidBy = $DOMXPath -> query("/ns:GetItemResponse/ns:Item/ns:ReturnPolicy/ns:ShippingCostPaidBy/text()") -> length > 0 ? $DOMXPath -> query("/ns:GetItemResponse/ns:Item/ns:ReturnPolicy/ns:ShippingCostPaidBy/text()") -> item(0) -> data : '';
		$ShippingCostPaidByOption = $DOMXPath -> query("/ns:GetItemResponse/ns:Item/ns:ReturnPolicy/ns:ShippingCostPaidByOption/text()") -> length > 0 ? $DOMXPath -> query("/ns:GetItemResponse/ns:Item/ns:ReturnPolicy/ns:ShippingCostPaidByOption/text()") -> item(0) -> data : '';
		$WarrantyDuration = $DOMXPath -> query("/ns:GetItemResponse/ns:Item/ns:ReturnPolicy/ns:WarrantyDuration/text()") -> length > 0 ? $DOMXPath -> query("/ns:GetItemResponse/ns:Item/ns:ReturnPolicy/ns:WarrantyDuration/text()") -> item(0) -> data : '';
		$WarrantyDurationOption = $DOMXPath -> query("/ns:GetItemResponse/ns:Item/ns:ReturnPolicy/ns:WarrantyDurationOption/text()") -> length > 0 ? $DOMXPath -> query("/ns:GetItemResponse/ns:Item/ns:ReturnPolicy/ns:WarrantyDurationOption/text()") -> item(0) -> data : '';
		$WarrantyOffered = $DOMXPath -> query("/ns:GetItemResponse/ns:Item/ns:ReturnPolicy/ns:WarrantyOffered/text()") -> length > 0 ? $DOMXPath -> query("/ns:GetItemResponse/ns:Item/ns:ReturnPolicy/ns:WarrantyOffered/text()") -> item(0) -> data : '';
		$WarrantyOfferedOption = $DOMXPath -> query("/ns:GetItemResponse/ns:Item/ns:ReturnPolicy/ns:WarrantyOfferedOption/text()") -> length > 0 ? $DOMXPath -> query("/ns:GetItemResponse/ns:Item/ns:ReturnPolicy/ns:WarrantyOfferedOption/text()") -> item(0) -> data : '';
		$WarrantyType = $DOMXPath -> query("/ns:GetItemResponse/ns:Item/ns:ReturnPolicy/ns:WarrantyType/text()") -> length > 0 ? $DOMXPath -> query("/ns:GetItemResponse/ns:Item/ns:ReturnPolicy/ns:WarrantyType/text()") -> item(0) -> data : '';
		$WarrantyTypeOption = $DOMXPath -> query("/ns:GetItemResponse/ns:Item/ns:ReturnPolicy/ns:WarrantyTypeOption/text()") -> length > 0 ? $DOMXPath -> query("/ns:GetItemResponse/ns:Item/ns:ReturnPolicy/ns:WarrantyTypeOption/text()") -> item(0) -> data : '';		
		
		$ResponseArray = array(
							  'Ack' => $Ack, 
							  'Errors' => $Errors, 
							  'Title' => $Title, 
							  'SubTitle' => $SubTitle, 
							  'Location' => $Location, 
							  'ConditionDisplayName' => $ConditionDisplayName,   
							  'Description' => $Description, 
							  'ViewItemURL' => $ViewItemURL, 
							  'EndTime' => $EndTime, 
							  'ExternalPictureURL' => $ExternalPictureURL, 
							  'GalleryURL' => $GalleryURL, 
							  'PictureURL' => $PictureURL, 
							  'ReturnPolicyDescription' => $ReturnPolicyDescription, 
							  'Refund' => $Refund, 
							  'RefundOption' => $RefundOption, 
							  'ReturnsAccepted' => $ReturnsAccepted, 
							  'ReturnsAcceptedOption' => $ReturnsAcceptedOption, 
							  'ReturnsWithin' => $ReturnsWithin, 
							  'ReturnsWithinOption' => $ReturnsWithinOption, 
							  'ShippingCostPaidBy' => $ShippingCostPaidBy, 
							  'ShippingCostPaidByOption' => $ShippingCostPaidByOption, 
							  'WarrantyDuration' => $WarrantyDuration, 
							  'WarrantyDurationOption' => $WarrantyDurationOption, 
							  'WarrantyOffered' => $WarrantyOffered, 
							  'WarrantyOfferedOption' => $WarrantyOfferedOption, 
							  'WarrantyType' => $WarrantyType, 
							  'WarrantyTypeOption' => $WarrantyTypeOption,  
							  'RawRequest' => $XMLRequest, 
							  'RawResponse' => $XMLResponse
							  );
		
		return $ResponseArray;
	} 
	
	
	function CompleteSale($DataArray)
	{
		$FeedbackCommentText = isset($DataArray['FeedbackCommentText']) && $DataArray['FeedbackCommentText'] != '' ? $DataArray['FeedbackCommentText'] : '';
		$FeedbackCommentType = isset($DataArray['FeedbackCommentType']) && $DataArray['FeedbackCommentType'] != '' ? $DataArray['FeedbackCommentType'] : '';
		$FeedbackTargetUser = isset($DataArray['FeedbackTargetUser']) && $DataArray['FeedbackTargetUser'] != '' ? $DataArray['FeedbackTargetUser'] : '';
		$ItemID = isset($DataArray['ItemID']) && $DataArray['ItemID'] != '' ? $DataArray['ItemID'] : '';
		$OrderID = isset($DataArray['OrderID']) && $DataArray['OrderID'] != '' ? $DataArray['OrderID'] : '';
		$OrderLineItemID = isset($DataArray['OrderLineItemID']) && $DataArray['OrderLineItemID'] != '' ? $DataArray['OrderLineItemID'] : '';
		$Paid = isset($DataArray['Paid']) && $DataArray['Paid'] != '' ? $DataArray['Paid'] : '';
		$Shipped = isset($DataArray['Shipped']) && $DataArray['Shipped'] != '' ? $DataArray['Shipped'] : '';
		$TransactionID = isset($DataArray['TransactionID']) && $DataArray['TransactionID'] != '' ? $DataArray['TransactionID'] : '';
		$ShipmentNotes = isset($DataArray['ShipmentNotes']) && $DataArray['ShipmentNotes'] != '' ? $DataArray['ShipmentNotes'] : '';
		$ShippedTime = isset($DataArray['ShippedTime']) && $DataArray['ShippedTime'] != '' ? $DataArray['ShippedTime'] : '';
		$TrackingNumbers = isset($DataArray['TrackingNumbers']) && $DataArray['TrackingNumbers'] != '' ? $DataArray['TrackingNumbers'] : array();
		
		$XMLRequest = "<?xml version=\"1.0\" encoding=\"utf-8\" ?>
						<CompleteSaleRequest xmlns=\"urn:ebay:apis:eBLBaseComponents\">
							<RequesterCredentials>
							   <eBayAuthToken>" . $this -> AuthToken . "</eBayAuthToken>
						   </RequesterCredentials>";
		if($FeedbackCommentText != '')
		{
			$XMLRequest .= "<FeedbackInfo>
								<CommentText>".$FeedbackCommentText."</CommentText>
								<CommentType>".$FeedbackCommentType."</CommentType>
								<TargetUser>".$FeedbackTargetUser."</TargetUser>
						   </FeedbackInfo>";	
		}
						   
		$XMLRequest .= $eBayItemID != '' ? "<ItemID>" . $eBayItemID . "</ItemID>" : '';				   
		$XMLRequest .= $OrderID != '' ? "<OrderID>".$OrderID."</OrderID>" : '';
		$XMLRequest .= $OrderLineItemID != '' ? "<OrderLineItemID>".$OrderLineItemID."</OrderLineItemID>" : '';
		$XMLRequest .= $Paid != '' ? "<Paid>".$Paid."</Paid>" : '';
		
		$XMLRequest .= "<Shipment>
							<Notes>".$ShipmentNotes."</Notes>";
		
		foreach($TrackingNumbers as $TrackingNumber)
		{
			$XMLRequest .= "<ShipmentTrackingDetails>
								<ShipmentTrackingNumber>".$TrackingNumber['TrackingNumber']."</ShipmentTrackingNumber>
								<ShippingCarrierUsed>".$TrackingNumber['ShippingCarrierUsed']."</ShippingCarrierUsed>
							</ShipmentTrackingDetails>";	
		}
		
		$XMLRequest .= $ShippedTime != "" ? "<ShippedTime>".$ShippedTime."</ShippedTime>" : "";
		$XMLRequest .= "</Shipment>";
					   
		$XMLRequest .= $Shipped != '' ? "<Shipped>".$Shipped."</Shipped>" : '';
		$XMLRequest .= $TransactionID != '' ? "<TransactionID>".$TransactionID."</TransactionID>" : '';
		$XMLRequest .= "</CompleteSaleRequest>";
						
		$XMLResponse = $this -> SendHTTPRequest($XMLRequest, "CompleteSale");
		
		$DOM = new DOMDocument();
		$DOM -> loadXML($XMLResponse);
		$DOMXPath = new DOMXPath($DOM);
		$DOMXPath -> registerNamespace("ns","urn:ebay:apis:eBLBaseComponents");
		
		$Ack = $DOM -> getElementsByTagName('Ack') -> length > 0 ? $DOM -> getElementsByTagName('Ack') -> item(0) -> nodeValue : '';
		$Errors = strtoupper($Ack) != 'SUCCESS' && strtoupper($Ack) != 'SUCCESSWITHWARNING' ? $this -> GetErrors($XMLResponse) : array();
		
		$ResponseArray = array(
							  'Errors' => $Errors, 
							  'RawRequest' => $XMLRequest, 
							  'RawResponse' => $XMLResponse
							  );
		
		return $ResponseArray;	
	}
	
}
?>