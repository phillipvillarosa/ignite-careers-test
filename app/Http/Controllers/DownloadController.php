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

    	$result = json_encode($result);

    	return view('download.index', compact('result'));
    }
}
