<?php

	include('connect.php');
	if(isset($_SESSION['USER']) && $_SESSION['USER']['role'] == "admin")
	{
		// a logged in Admin is accessing the page
		$query = $db->prepare("SELECT USER_ID, USER_USERNAME, USER_FIRST_NAME, USER_LAST_NAME, USER_EMAIL, USER_LOCATION, USER_CELLAR_NAME, USER_CELLAR_VISIBLE, USER_PROFILE_PICTURE FROM user WHERE USER_ROLE != 'admin';");
		$query->execute();
		$query->setFetchMode(PDO::FETCH_ASSOC);

		$result = $query->fetch();
		
	?>
<!--	put a col-lg-12 here??????-->
	<div class="table-responsive">
		<table class="table table-bordered table-hover table-striped">
			<thead>
				<tr>
					<th>User ID</th>
					<th>First Name</th>
					<th>Last Name</th>
					<th>Email</th>
					<th>Location</th>
					<th>Cellar Name</th>
					<th>Public Cellar</th>
					<th>User Image</th>					
					<th>&nbsp;</th>					
				</tr>
			</thead>
			<tbody>
	<?php
		
		while($result)
		{
			echo "<tr>";
			echo "<td>".$result['USER_ID']."</td>";
			echo "<td>".$result['USER_FIRST_NAME']."</td>";
			echo "<td>".$result['USER_LAST_NAME']."</td>";
			echo "<td>".$result['USER_EMAIL']."</td>";
			echo "<td>".$result['USER_LOCATION']."</td>";
			echo "<td>".$result['USER_CELLAR_NAME']."</td>";
			if($result['USER_CELLAR_VISIBLE'] == 1)
			{
				$visible = "Yes";
			}
			else
			{
				$visible = "No";
			}
			echo "<td>".$visible."</td>";
			echo "<td>".$result['USER_PROFILE_PICTURE']."</td>";
			echo "<td><form action='userprofile.php' method='post'><button class='btn btn-warning' name='editUser' value='".$result['USER_ID']."' type='submit'>Edit</button></td>";
			echo "</tr>";
			
			$result = $query->fetch();
		}
	?>
			</tbody>
		</table>
	</div>		
	<?php
	}
	else
	{
		// a non logged in or non admin is accessing the page

	}




?>