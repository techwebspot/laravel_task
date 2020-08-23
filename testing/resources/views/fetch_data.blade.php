
<!DOCTYPE html>
<html>
 <head>
  <title>Live search in laravel using AJAX</title>


	 <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script> 


  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />

  <style>
  	.selected {
  		background-color: blue !important;
  	}
  </style>

 </head>
 <body>
  <div class="container box">
   <h3 align="center">Live Search and Add User in laravel using AJAX</h3><br />
      <div class="row">
        <div class="col-sm-3">
         <div class="panel panel-default">
            <div class="panel-heading">User Data</div>
            <div class="panel-body">
                <h6>Name :<span id="print_name"></span></h6>
                <h6>Email :<span id="print_email"></span></h6>
                <h6>Job Title :<span id="print_job_title"></span></h6>
                <h6>Address :<span id="print_address"></span></h6>
                <h6>Bank Account Number :<span id="print_bank_acc_no"></span></h6>
                <h6>Cell Phone Number :<span id="print_cell_no"></span></h6>
            </div>
        </div>
        </div>
        <div class="col-sm-9">
        <div class="panel panel-default">
            <div class="panel-heading">Search User Data</div>
            <div class="panel-body">
                <div class="form-group">
                    @csrf
                    <input type="text" name="search" id="search" class="form-control" placeholder="Search User Data" />
                </div>
            <div class="table-responsive">
            <h3 align="center">Total Data : <span id="total_records"></span></h3>
            <table class="table table-striped table-bordered">

		<!-- Button trigger modal -->
		<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#useraddmodal">
		  Add User
		</button>
		<br>
		
		<button id="previousbutton">Previous</button>
		<div id="pagestack"></div>
		<button id="nextbutton">Next</button>


		<!-- Modal -->
		<div class="modal fade" id="useraddmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		  <div class="modal-dialog" role="document">
		    <div class="modal-content">
		      <div class="modal-header">
		        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span>
		        </button>
		      </div>
		      <div class="modal-body">
		        <form id="addform">
		        	{{ csrf_field() }}
				<div class="form-group">
                    <label for="exampleInputName">Name</label>
                    <input type="text" class="form-control" name="name" aria-describedby="NameHelp" placeholder="Enter Name">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Email address</label>
                    <input type="email" class="form-control" name="email" aria-describedby="emailHelp" placeholder="Enter E-mail">
                </div>
                <div class="form-group">
                    <label for="exampleInputJobTitle">Job Title</label>
                    <input type="text" class="form-control" name="job_title" aria-describedby="JobTitleHelp" placeholder="Enter Job Title">
                </div>
                <div class="form-group">
                    <label for="exampleInputAddress">Address</label>
                    <input type="text" class="form-control" name="address" aria-describedby="AddressHelp" placeholder="Enter Address">
                </div>
                <div class="form-group">
                    <label for="exampleInputBankAccNo">Bank Account Number</label>
                    <input type="text" class="form-control" name="bank_acc_no" aria-describedby="BankAccNoHelp" placeholder="Enter Bank Account Number">
                </div>
                <div class="form-group">
                    <label for="exampleInputCellPhone">Cell Phone Number</label>
                    <input type="text" class="form-control" name="cell_no" aria-describedby="cellphoneHelp" placeholder="Enter Cell Phone Number">
                </div>
                <div class="modal-footer">
                <button id="submodalclose" type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Add Data</button>
              </div>
            </form>
		      </div>
		    </div>
		  </div>
		</div>

       <thead>
        <tr>
         <th>Name</th>
         <th>E-mail</th>
         <th>Job Title</th>
        </tr>
       </thead>
       <tbody>

       </tbody>

       <div >
       </div>

      </table>
     </div>
    </div>  
   </div>
  </div>
  </div>
 </div>

      </table>
     </div>
    </div>    
   </div>
  </div>
 </body>
</html>

<script>

	function nextPage(){
		window.pagingoffset += 1000;
		if(window.pagingoffset>=window.pagingbuffer.length){
			window.pagingoffset = window.pagingbuffer.length - 1000;
		}
		if(window.pagingoffset<0){
			window.pagingoffset = 0;
		}
		applyPaging();
	}

	function previousPage(){
		window.pagingoffset -= 1000;
		if(window.pagingoffset<0){
			window.pagingoffset = 0;
		}
		applyPaging();
	}

	function applyPaging(){
		$('tbody').html("");
		var fetchlimit = window.pagingbuffer.length - window.pagingoffset;
		if(fetchlimit>1000){
			fetchlimit = 1000;
		}
		for(var i = 0 ; i < fetchlimit ; i++){
			var item = window.pagingbuffer[window.pagingoffset+i];
			$("tbody")[0].appendChild(item);
		}
	}

	function fetch_user_data(query = '')
	{
		//alert("Damn 2");

  		$.ajax({
			url: "{{ route('fetch_data.action') }}",
			method: 'GET',
		    data: {query: query},
	    	dataType: 'json',
			success: function(data)
			{
				window.pagingbuffer = [];
				window.pagingoffset = 0;
				$('tbody').html(data.table_data);
				window.pagingbuffer = $("tbody tr");
				
				for(var i = 0; i < window.pagingbuffer.length; i++) 
				{
					window.pagingbuffer[i].onclick = function () 
					{
						$("tbody tr").removeClass("selected");
						$(this).addClass("selected");
						var selected_data = $(this).find("td");
						var samplebuffer = [];
						for (var t = 0; t < selected_data.length; t++) 
						{
							samplebuffer.push($(selected_data[t]).html());

						}
						console.log("The following properties are selected: ", samplebuffer);

						document.getElementById("print_name").innerHTML = " " + samplebuffer[0];
						document.getElementById("print_email").innerHTML = " " + samplebuffer[1];
						document.getElementById("print_job_title").innerHTML = " " + samplebuffer[2];
						document.getElementById("print_address").innerHTML = " " + samplebuffer[3];
						document.getElementById("print_bank_acc_no").innerHTML = " " + samplebuffer[4];
						document.getElementById("print_cell_no").innerHTML = " " + samplebuffer[5];
					};
				}
				
				if(window.pagingbuffer.length!=0){
					window.pagingcount = Math.ceil(window.pagingbuffer.length/1000);
				}else{
					window.pagingcount = 1;
				}
				// add previous button
				var previousbutton = document.getElementById("previousbutton");
				var nextbutton = document.getElementById("nextbutton");
				var pagestack = document.getElementById("pagestack");
				previousbutton.onclick = function(){previousPage();};
				pagestack.innerHTML = "";
				for(var i = 0 ; i < window.pagingcount ; i++){
					// add paging button
					var button = document.createElement("button");
					button.innerHTML = i + "";
					button.dcount = i;
					button.onclick = function(){
						window.pagingoffset = $(this)[0].dcount*1000;
						applyPaging();
					};
					pagestack.appendChild(button);
				}
				// add next button
				nextbutton.onclick = function(){nextPage();};
			    $('#total_records').text(data.total_data);
			    applyPaging();
			},
			error: function(jqxhr, status, exception) 
			{
        		console.log(exception);
        	}
  		})
 	}

	$(document).ready(function(){

		//alert("Damn");

		fetch_user_data();

		$(document).on('keyup', '#search', function(){
			var query = $(this).val();
			//alert(query);
			fetch_user_data(query);
		});
	});

	
	$(document).ready(function() {

		$('#addform').on('submit', function(e) {
			e.preventDefault();

			$.ajax({
				type: "POST",
				url: "/adduser",
				data: $("#addform").serialize(),//JSON.stringify(data),
				success: function (respond) {
					console.log(respond)
					//$('#useraddmodal').hide();
					//$(".modal-backdrop").hide();
					//$("[data-dismiss=modal]").triggr({type:"click"});
					$("#submodalclose").click();
					alert("Data Saved");
					fetch_user_data();
				},
				error: function(error) {
					console.log(error)
					alert("Data Not Saved");
				}
			});
		});
	});
	



</script>

