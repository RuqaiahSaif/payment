<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class payment extends Controller

{
  public function index(){
    // $curl = curl_init();

    // curl_setopt_array($curl, array(
    //   CURLOPT_URL => 'http://127.0.0.1:8000/api/payments',
    //   CURLOPT_RETURNTRANSFER => true,
    //   CURLOPT_ENCODING => '',
    //   CURLOPT_MAXREDIRS => 10,
    //   CURLOPT_TIMEOUT => 0,
    //   CURLOPT_FOLLOWLOCATION => true,
    //   CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    //   CURLOPT_CUSTOMREQUEST => 'GET',
    //   CURLOPT_POSTFIELDS => array('callback_url' => 'http://127.0.0.1:8000/api/callback','publishable_api_key' => 'pk_test_6y4BnV2BKn5C2BtEpEKmZhczVDQMRBTju1jrPpRB','amount' => '1000','source[type]' => 'creditcard','description' => 'Order id 1234 by guest','source[name]' => 'visa','source[number]' => '4111111111111111','source[month]' => '5','source[year]' => '23','source[cvc]' => '123'),
    //   CURLOPT_HTTPHEADER => array(
    //     'Authorization: Basic TkNSS1NkVnNBQVJWdHVhbW9XSkpFMzRtZEFvODRXdVk6MHRMVmEwbkVHZFh6MWM5SQ=='
    //   ),
    // ));
    
    // $response = curl_exec($curl);
    
    // curl_close($curl);
    // echo $response;
// return redirect($response->transaction->url);
// return view('payment');
// echo "hi";
return view('applepay');
  }
//   
 
    
    
    public function callback(Request $request)
    {          
        $id=request()->query('id');
        $token=base64_encode('sk_test_QGoeGF8eXZPQkoQRADw7nyzhRyWWpg61ppxuS2x3:');
        // $paymentt=Http::baseUrl('https://api.moyasar.com/v1')
        // ->withHeaders([
        //   'Authorization'=>"Basic {$token}",
        // ])
        // ->get("payments/{$id}")
        // ->json();
        //  dd($paymentt['status'] );
        // if($paymentt['status'] == 'paid'){
          $capture=Http::baseUrl('https://api.moyasar.com/v1')
          ->withHeaders([
            'Authorization'=>"Basic {$token}",
          ])
          ->get("payments/{$id}")
          ->json();
        dd($capture);
        // }
        // if($capture['status']== 'captured'){
      
        // }

      
}

function updateCharge(Request $request,$id){
  $input = $request->all();
  $validator =  Validator::make($input ,[
    'description' => 'String',
    'email' => 'boolean',
    'sms' => 'boolean',
    'udf2' => 'String',
   
]); 
if ($validator->fails())
{
    return $this->sendError(null,$validator->errors());
}

    $data['description']=$request['description'];
    $data['receipt']['email']=$request['email'];
    $data['receipt']['sms']=$request['sms'];
    $data['metadata']['udf2']=$request['udf2'];
 
$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "https://api.tap.company/v2/charges/".$id,
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "PUT",
  CURLOPT_POSTFIELDS => json_encode($data),
  CURLOPT_HTTPHEADER => array(
    "authorization: Bearer sk_test_jmXOB9J5foCdHli2G0zPAq1T",
    "content-type: application/json"
  ),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
  echo "cURL Error #:" . $err;
} else {
  echo $response;
}

}




function list(){
    
    $data['type']=1;

$curl = curl_init();

curl_setopt_array($curl, array(
CURLOPT_URL => "https://api.tap.company/v2/charges/list",
CURLOPT_RETURNTRANSFER => true,
CURLOPT_ENCODING => "",
CURLOPT_MAXREDIRS => 10,
CURLOPT_TIMEOUT => 30,
CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
CURLOPT_CUSTOMREQUEST => "POST",
CURLOPT_POSTFIELDS => json_encode($data),
CURLOPT_HTTPHEADER => array(
  "authorization: Bearer sk_test_jmXOB9J5foCdHli2G0zPAq1T",
  "content-type: application/json"
),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
echo "cURL Error #:" . $err;
} else {
echo $response;
}
  }


}
?>

