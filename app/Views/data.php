<html>

<head>
	<link rel="stylesheet" href="<?php echo base_url() ?>/public/assets/css/bootstrap.min.css"/>
	<link rel="stylesheet" href="<?php echo base_url() ?>/public/assets/css/jquery.dataTables.min.css"/>
	<link rel="stylesheet" href="<?php echo base_url() ?>/public/assets/css/font-awesome.min.css"/>
</head>

<body>
	<div class="container" style="margin-top:40px;">

	    <divc class="row">

	        <div class="panel panel-primary">
		   <div class="panel-heading">Server Side Listing (Using SSP Library)</div>
		   <div class="panel-body">

		       <table id="server-side-table-ssp" class="display" style="width:100%">
		           <thead>
		               <tr>
		                   <th>User ID</th>
		                   <th>Name</th>
		                   <th>Email</th>
		                   <th>Mobile</th>
		                   <th>Designation</th>
		                   <th>Gender</th>
		                   <th>Status</th>
		               </tr>
		           </thead>

		       </table>

		   </div>
	        </div>
	</div>
	</div>

	<script src="<?php echo base_url() ?>/public/assets/js/jquery.min.js"></script>
	<script src="<?php echo base_url() ?>/public/assets/js/bootstrap.min.js"></script>
	<script src="<?php echo base_url() ?>/public/assets/js/jquery.dataTables.min.js"></script>
	<script src="https://cdn.datatables.net/buttons/1.5.6/js/dataTables.buttons.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
	<script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.html5.min.js"></script>
	<script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.print.min.js"></script>

	<script>
	$(function() {
	    if ($("#server-side-table-ssp").length > 0) {

	        $("#server-side-table-ssp").DataTable({
		   "processing": true,
		   "serverSide": true,
		   "ajax": "<?php echo site_url('list-data') ?>",
		   dom: 'Bfrtip',
		   buttons: [{
		           extend: "copy",
		           exportOptions: {
		               columns: []
		           }
		       },
		       {
		           extend: "excel",
		           title: "client_side_data"
		       },
		       {
		           extend: "csv",
		           title: "client_side_table_data"
		       },
		       {
		           extend: "pdf",
		           exportOptions: {
		               columns: ":visible"
		           }
		       },
		       'print'
		   ]
	        });
	    }
	});
	</script>

</body>

</html>