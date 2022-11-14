<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>PHP Crud Practice</title>
	<style>
		.crud {
			width: 30%;
			margin: 0 auto;
		}
		.crud form input {
			width: 100%;
			margin: 10px 0;
		}
		.crud_table {
			width: 30%;
			margin: 0 auto;
		}
		.crud_table table {
			width: 100%;
			text-align:  center;
		}
		.searchBox {
			display: flex;
    		justify-content: space-between;
    		margin-bottom: 20px;
		}
		#message {
			display: none;
			background: rgba(20,250,25,0.8);
		    color: #fff;
		    padding: 5px;
		    position: absolute;
		    top: 15px;
		    right: 35%;
		    width: 300px;
		}
	</style>
</head>
<body>
	<div class="crud">
		<h1> Add Data </h1>
		<form method="post" action="">
			<div class="form-group">
				<label for="name"> Full Name </label>
				<input type="text" name="name" id="name" placeholder="Enter your name..." value="" required>
			</div>
			<div class="form-group">
				<label for="email"> Email </label>
				<input type="email" name="email" id="email" placeholder="Enter your email..." value="" required>
			</div>
			<p id="message"></p>
			<input type="hidden" id="id" name="id">
			<input type="submit" id="submit" onclick="addData()" value="Save Data">
		</form>
	</div>
	<div class="crud_table">
		<h1> List of Data </h1>
		<div class="searchBox">
			<div class="search">
				<input type="search" id="search" name="search" placeholder="Start typing name/email" onkeyup="populateData()">
				<!-- <button type="button" onclick="populateData()"> Search </button> -->
			</div>
			<div style="display: flex;">
				<div class="sorting">
					<select name="sort" id="sort" onchange="populateData()">
						<option value="ID-ASC">ID ASCENDING</option>
						<option value="ID-DESC">ID DESCENDING</option>
						<option value="CREATED_AT-ASC">DATE ASCENDING</option>
						<option value="CREATED_AT-DESC">DATE DESCENDING</option>
					</select>
				</div>
				<div class="limiting">
					<select name="limit" id="limit" onchange="populateData()">
						<option value=""> Limit </option>
						<option value="5"> 5 </option>
						<option value="10"> 10 </option>
						<option value="15"> 15 </option>
					</select>
				</div>
			</div>
		</div>
		<table>
			<thead>
				<tr>
					<th>ID</th>
					<th>NAME</th>
					<th>EMAIL</th>
					<th>CREATED DATE</th>
					<th>EDIT#</th>
					<th>DELETE#</th>
				</tr>
			</thead>
			<tbody>
			</tbody>
		</table>
	</div>

	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
	<script>
		function populateData() {
			search = $('#search').val();
			sort = $('#sort').val();
			limit = $("#limit").val();
			$.ajax({
				type: "POST",
				url: "AjaxOperations.php?action=populateData",
				data: "table=test&search="+search+"&sort="+sort+"&limit="+limit,
				success: function(data) {
					$('.crud_table table tbody').html(data);
				}
			});
		}
		populateData();

		function editThis(id) {
			event.preventDefault();
			$('#id').val(id);
			$('#submit').attr('onclick', '');
			$.ajax({
				type: "POST",
				url: "AjaxOperations.php?action=edit",
				data: "id="+id,
				success: function(data) {
					data = JSON.parse(data);
					$('.crud h1').html("Edit Data");
					$('#submit').val("Update Data");
					$('#name').val(data.name);
					$('#email').val(data.email);
				}
			});

			$('.crud form').on('submit', function(e) {
				e.preventDefault();
				$.ajax({
					type: "POST",
					url: "AjaxOperations.php?action=update",
					data: $(this).serialize(),
					success: function(data) {
						$('#message').show(200).html(data);
						setTimeout(function() {
							$('#message').hide(200);
						}, 2000);
						$('.crud form').trigger("reset");
						$('.crud h1').html("Add Data");
						$('#submit').val("Save Data");
						$('#id').val('');
						$('#submit').attr('onclick', 'addData()');
						populateData();
					}
				});
			});
		}

		function addData() {
			event.preventDefault();
			$.ajax({
				type: "POST",
				url: "AjaxOperations.php?action=insert",
				data: $('.crud form').serialize(),
				success: function(data) {
					$('#message').show(200).html(data);
					setTimeout(function() {
						$('#message').hide(200);
					}, 2000);
					$('.crud form').trigger("reset");
					populateData();
				}
			});
		}

		function deleteThis(id) {
			event.preventDefault();

			if(confirm("Are you sure you want to delete?")) {
				$.ajax({
					type: "POST",
					url: "AjaxOperations.php?action=delete",
					data: "id="+id,
					success: function(data) {
						$('#message').show(200).html(data);
						setTimeout(function() {
							$('#message').hide(200);
						}, 2000);
						populateData();
					}
				});
			}
		}
	</script>
</body>
</html>