<?php
	// include('functions/session_data.php');
	include('functions/connection.php');
	// $loggedInUser = $_SESSION['user']['id'];
	// $loggedInUserEmail = $_SESSION['user']['email'];
?>
<!DOCTYPE html>
<html>
<head>
	<title>Leave Management Systems - Leave Number</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="vendor/css/bootstrap.min.css">
	<script src="vendor/js/jquery.min.js"></script>
	<script src="vendor/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="vendor/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/style.css?<?php echo time(); ?>">
	<link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
	<link rel="icon" href="images/favicon.ico" type="image/x-icon">
	<link rel="stylesheet" href="vendor/css/jquery-confirm.min.css">
	<script src="vendor/js/jquery-confirm.min.js"></script>
	<link rel="stylesheet" href="vendor/css/jquery-ui.css">
	<script type="text/javascript" src="vendor/js/datatables.min.js"></script>
	<link rel="stylesheet" href="vendor/css/dataTables.jqueryui.min.css">
	<script type="text/javascript" src="vendor/js/dataTables.jqueryui.min.js"></script>
	<link rel="stylesheet" type="text/css" href="vendor/css/jquery.dataTables.min.css"/>
	<link rel="stylesheet" type="text/css" href="vendor/css/buttons.dataTables.min.css"/>
	<link rel="stylesheet" type="text/css" href="vendor/js/jquery.dataTables.min.js"/>
	<script type="text/javascript" src="vendor/js/dataTables.select.min.js"></script>
	<script type="text/javascript" src="vendor/js/dataTables.buttons.min.js"></script>
	<script type="text/javascript" src="vendor/js/jszip.min.js"></script>
	<script type="text/javascript" src="vendor/js/pdfmake.min.js"></script>
	<script type="text/javascript" src="vendor/js/vfs_fonts.js"></script>
	<script type="text/javascript" src="vendor/js/buttons.html5.min.js"></script>
	<script type="text/javascript" src="vendor/js/buttons.print.min.js"></script>

</head>
<body class="container">
	<!-- header starts here -->
    <?php 
	
	// include('admin-header.php'); 
	
	?>
	<!-- header ends here -->
	<!-- page content starts here -->
	<section id="page-container">
		<div id="content-wrap">
		

		</div>
	<!-- page content ends here -->
	</section>
	<!-- footer starts here -->
	<?php include('footer.php') ?>
	<!-- footer ends here -->	
	<script type="text/javascript">
		$(document).ready(function() {
			// var full.order_notes = 'true';
			var userTable = $('#leave').DataTable( {
				"serverSide": true,
				//"processing": true,
				"pagingType": "full_numbers",
				// "lengthMenu":[[25,50,100],[25,50,100]],
				"order": [[ 1, "desc" ]],
				"ajax": {
					"url": 'functions/tables/leave.php',
					"type": "POST",
				},
				"initComplete": function (settings, json) {
					$('tr.tableLoader').fadeOut('slow');
					$('tr.triggerActions').fadeIn('slow');
				},
					"dom": 'RfBrtlip',//Bfrtip
					"buttons": ['excel'],

				"columns":[
					{ "data": "name", "name": "name", "searchable": true},
					{ "data": "email", "name": "email", "searchable": false},
					{ "data": "leave_type", "name": "leave_type", "searchable": false},
					{ "data": "user_comments", "name": "user_comments", "searchable": false},
					{ "data": "manager_comments", "name": "manager_comments", "searchable": false},
					{ "data": "status", "name": "status", "searchable": false},
					{ "data": "created", "name": "created", "searchable": true},
					{ "data": "updated", "name": "updated", "searchable": false},
					{ "data": "no_of_days", "name": "no_of_days", "searchable": false},
					{ "data": "actions", "name": "actions", "searchable": false},
					// {render: function( data, type, full ){if(full.order_notes != null){return full.order_notes+' <button style="cursor:pointer;" class="btn btn-satgreen editComments"><small>Edit</small></button>'}else{return '<button style="cursor:pointer;" class="btn btn-satgreen editComments"><small>Edit</small></button>'}}, "name": "order_notes", "searchable": false, "orderable": false}
				],
				"createdRow": function( row, data){
					$(row).attr("id", data.rowID);
					$(row).attr("rec", data.rec);
					$(row).attr("class", "triggerActions");
				},
			});

			$('.dataTables_filter').addClass('pull-left');
			$('.dataTables_length').addClass('pull-right');

			//move buttons to container
			$('.buttonsContainer').append(userTable.buttons().containers());

		});
	</script>

	<script>
		$(document).on('click', '.exampleModal2 ', function (){
			let rec = $(this).attr("rec");
			$('#rec').val(rec);

			let name = $(this).attr("name");
			$('#name').val(name);

			let surname = $(this).attr("surname");
			$('#surname').val(surname);

			let user_comment_convert = $(this).attr("user_comment_convert");
			$('#user_comment_convert').val(user_comment_convert);

			let status = $(this).attr("status");
			$('#status').val(status);

			let start_date = $(this).attr("start_date");
			$('#start_date').val(start_date);

			let end_date = $(this).attr("end_date");
			$('#end_date').val(end_date);

			let no_of_days = $(this).attr("no_of_days");
			$('#no_of_days').val(no_of_days);


			let leave_status_name = $(this).attr("leave_status_name");
			$('#leave_status_name').val(leave_status_name);
			

			let manager_comments_convert = $(this).attr("manager_comments_convert");
			$('#manager_comments_convert').val(manager_comments_convert);
		
		});

	</script>

	<script>

		$(document).on('click', '.exampleModal3', function (){

			let rec = $(this).attr("rec");
			$('#rec1').val(rec);

			let name = $(this).attr("name");
			$('#name1').val(name);

			let surname = $(this).attr("surname");
			$('#surname1').val(surname);

			let user_comment_convert = $(this).attr("user_comment_convert");
			$('#user_comment_convert1').val(user_comment_convert);

			let status = $(this).attr("status");
			$('#status1').val(status);

			let start_date = $(this).attr("start_date");
			$('#start_date1').val(start_date);

			let end_date = $(this).attr("end_date");
			$('#end_date1').val(end_date);

			let no_of_days = $(this).attr("no_of_days");
			$('#no_of_days1').val(no_of_days);


			let leave_status_name = $(this).attr("leave_status_name");
			$('#leave_status_name1').val(leave_status_name);

			let manager_comments_convert = $(this).attr("manager_comments_convert");
			$('#manager_comments_convert1').val(manager_comments_convert);
		
		});

	</script>        
</body>
</html>