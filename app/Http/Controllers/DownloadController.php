<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DownloadController extends Controller
{
    public function index()
    {
    	$endpoint = "https://ignite-careers.com/test/endpoint.php";
    	$auth_bearer = "qwertyuiop";

    	$curl = curl_init($endpoint);
    	curl_setopt($curl, CURLOPT_HTTPHEADER, [
    		'Authorization: Bearer ' . $auth_bearer
    	]);

    	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    	curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode(['jobId' => 10]));
    	$result = curl_exec($curl);
    	curl_close($curl);

    	if (request()->has('download') && request()->download == true) {
    		$result = json_decode($result, true);

		    $filename ='Users.csv';
			header('Content-Type: text/csv; charset=utf-8');
			Header('Content-Type: application/force-download');
			header('Content-Disposition: attachment; filename='.$filename.'');
			
			$output = fopen('php://output', 'w');
			fputcsv($output, ['User ID', 'Email', 'First Name', 'Last Name', 'Mobile']);

		    foreach($result['data'] as $res){
		        fputcsv($output, [
		        	$res['uid'], 
		        	$res['email'], 
		        	$res['first_name'], 
		        	$res['last_name'], 
		        	$res['mobile']
		        ]);
		    }
		    
			fclose($output);

    	} else{
	    	$result = json_encode($result);

	    	return view('download.index', compact('result'));
    	}

    }
}
