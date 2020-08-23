<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\People;

class AddUser extends Controller
{
    public function store()
    {

    	
    	$people = new People();

    	$people->name = $_POST["name"];//$request->input('name');
    	$people->email = $_POST['email'];
    	$people->job_title = $_POST['job_title'];
    	$people->address = $_POST['address'];
    	$people->bank_acc_no = $_POST['bank_acc_no'];
    	$people->cell_no = $_POST['cell_no'];

    	$people->save();

    	echo json_encode(["error"=>null]);
    	
    }
}
