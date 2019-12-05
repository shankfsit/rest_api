<html>
<body>

<form action="<?php echo $_SERVER["PHP_SELF"];?>" method="post" enctype="multipart/form-data">
<input type="file" name="csv" value="" />
<input type="submit" name="submit" value="Save" />
</form>

</body>
</html>
<?php
if(isset($_POST["submit"])) {
	$csvMimes = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain');
	if(!empty($_FILES['csv']['name']) && in_array($_FILES['csv']['type'], $csvMimes)){
		 if(is_uploaded_file($_FILES['csv']['tmp_name'])){
		 echo $_FILES['csv']['tmp_name'];die;
		 function callAPI($method, $url, $data){
   $curl = curl_init();
 


   switch ($method){
      case "POST":
         curl_setopt($curl, CURLOPT_POST, 1);
         if ($data)
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
         break;
      case "PUT":
         curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");
         if ($data)
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);			 					
         break;
      default:
         if ($data)
            $url = sprintf("%s?%s", $url, http_build_query($data));
   }
   curl_setopt($curl, CURLOPT_URL, $url);
   $authorization = "Authorization: Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpZCI6NzgsImVtYWlsIjoic2FuamF5MTE5OUB5b3BtYWlsLmNvbSIsInJvbGVfaWQiOjIsImlhdCI6MTU3NTU0Mzc4MywiZXhwIjoxNTc1NTg2OTgzfQ.2lC7bspQML0jYufmlW5SEIlE-Z82sE8Y9lg91WA3M6U";
curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json' , $authorization ));
   /*curl_setopt($curl, CURLOPT_HTTPHEADER, array(
      
      'Content-Type: application/json',
      ''
   ));*/
   curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
   curl_setopt($curl, CURLOPT_SSL_VERIFYPEER,0);

   curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);

   // EXECUTE:
   $result = curl_exec($curl);
   if(!$result){die("Connection Failure");}
   curl_close($curl);

   return $result;
}

if (($handle = fopen($_FILES['csv']['tmp_name'], 'r')) !== FALSE) {
	fgetcsv($handle, 10000, ",");
  while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
    $num = count($data);
     $GivenName= $data[0];
     $Surname=$data[1];
     $EmailAddress=$data[2];

     $TelephoneNumber= $data[3];
     
   $data_array =  array(
   			"access_key"=> "9bd97617ad56",
   			 "campaign_id"=> 300,
            "first_name"         =>  $GivenName,
            "last_name"  => $Surname,       
        "phone"=>$TelephoneNumber,
        "phone_cell" => "9632587410",
    "phone_work" => "9632587410",
    "phone_ext" => "91",
    "address" => "Hyderabad",
    "address2" => "Hyderabad",
    "city" => "Hyderabad",
    "state" => "TS",
    "zip_code" => "500081",
    "county" => "",
    "country" => "",
    "email" => $EmailAddress,
    "dob" => "",
    "ip_address" => "",
    "home_ownership" => "rent" 
);

print_r($data_array);
// $make_call = callAPI('POST', 'https://api.leadswatch.com/api/v1/lead/create', json_encode($data_array));
// $response = json_decode($make_call, true);

// print_r($response);
		}
		
	}
}
}
}