<div class="user-section">
	<div class="user-section-inner">
<!--                               User image from database-->
	  <?php 
		if(isset($_SESSION['USER']))
		{

			echo "<img src='userImages/".$_SESSION['USER']['image']."' alt='User Profile Image'>";

		}
		?>

	</div>
	<div class="user-info">
		<div>
		<?php 
			if(isset($_SESSION['USER']))
			{
			$fullname = ucfirst($_SESSION['USER']['firstName']." ".$_SESSION['USER']['lastName']);
			echo $fullname;
			
		
			echo "</div>
			<div class='user-text-online'>
				<span class='user-circle-online btn btn-success btn-circle '></span>&nbsp;Online
			</div>";
			}
				?>
	</div>
</div>