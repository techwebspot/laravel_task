<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class FetchData extends Controller
{
    function index()
    {
    	return view('fetch_data');
    }

    function action(Request $request)
    {
    	
    	if($request->ajax())
    	{
    		$output = '';
    		$query = $request->get('query');
    		
    		if($query != '')
    		{
    			$data = DB::table('users')
         		->where('name', 'like', '%'.$query.'%')
    			->get();
			}
    		else
    		{
    			$data = DB::table('users')
        		->orderBy('id', 'desc')
        		->get();
        	}

    		$total_row = $data->count();

    		if($total_row > 0)
        	{
		    	foreach($data as $row)
		    	{
		    		$output .= '
			    		<tr>
			    			<td>'.$row->name.'</td>
			        		<td>'.$row->email.'</td>
			        		<td>'.$row->job_title.'</td>
			        		<td style="display:none;">'.$row->address.'</td>
			        		<td style="display:none;">'.$row->bank_acc_no.'</td>
			        		<td style="display:none;">'.$row->cell_no.'</td>
			        	</tr>
		        	';
		        }
		    }
		    else
		    {
		    	$output = '
        			<tr>
        				<td align="center" colspan="5">No Data Found</td>
        			</tr>
       			';
		    }
        }
    	else
    	{
        	$output = '
       			<tr>
        			<td align="center" colspan="5">No Data Found</td>
       			</tr>
       		';
      	}
	
      	$data = array(
       		'table_data'  => $output,
       		'total_data'  => $total_row
      	);
		
    	echo json_encode($data);
    	
    }
}
