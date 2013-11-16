<?php
/*
	Author: Chris Eastman
	Site: Net-head.ca/mobile
	File: business.php
	Purpose: this page shows secure content to users who are logged in, or redirects them to the login page
*/
	session_start();
	
	try{
	//database credentials
	$mySQLUsername = 'my_sql_username';
	$mySQLPassword = 'my_sql_password';
	$dsn = 'mysql:host=my_sql_host.com;dbname=my_sql_dbname';
	//create connection
	$database = new PDO($dsn, $mySQLUsername, $mySQLPassword);
	}
	catch(PDOException $ex)
	{
		echo '<p>Sorry, there was a problem accessing the database.</p>
			  <a href="login.php">Try Again</a>';	
	}

	//prepare select statement to show all business contacts
	$select_statement = "SELECT * FROM business_contacts ORDER BY name;";
	
	//store results 
	$result = $database->query($select_statement);
	
	//if session exists (user is logged in) show the content
	if(isset($_SESSION["username"]))
	{ ?>
<!DOCTYPE html>
<html>
<head>
		<meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Net-Head Mobile</title>
		<link rel="stylesheet" href="themes/net-head.min.css" />
        <link rel="stylesheet" href="css/flexslider.css" type="text/css" media="screen" />
        <link rel="stylesheet" href="css/styles.css" type="text/css"/>
		<link rel="stylesheet" href="http://code.jquery.com/mobile/1.3.2/jquery.mobile.structure-1.3.2.min.css" />
		<script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
		<script src="http://code.jquery.com/mobile/1.3.2/jquery.mobile-1.3.2.min.js"></script>     
	</head>
<body>
	<!-- Begin Business page-->
    	<section id="business" data-role="page">
            <header data-role="header">
                <h1>Get the 'net</h1>
            </header>
            <article data-role="content">               
                <!-- Begin Navigation-->
                <div class="menu">
                	<a href="index.html#home" alt="home" data-icon="home" data-role="button" >Home</a>
        		</div>
                <div class="menu">
                	<a href="index.html#about" alt="about me" data-icon="info" data-role="button" >About</a>
        		</div>
                <div class="menu">
                	<a href="index.html#contact" alt="contact" data-icon="gear" data-role="button" >Contact</a>
        		</div>
                <div class="menu">
                	<a href="business.php" alt="contact" data-icon="gear" data-role="button" >Business</a>
        		</div>
                
                 <div class="menu2">
                 	<a href="index.html#projects">
                 		<div class="pic">
                 			<img src="images/net-head logo.png" alt="projects"/>
                    		<p>Projects</p>
                 		</div>
                 	</a>
                    <a href="index.html#services">
                 		<div class="pic">
                 		<img src="images/services.png" alt="services" class="service"/>
                    		<p>Services</p>
                 		</div>
                 	</a>
                 </div>
                 <!-- End Navigation-->
			</article>
            <!-- Main Content Begin-->
            <section class="main_content" id="business">
            	<h1>Business Contacts</h1>
                <p>Welcome <?php echo $_SESSION["username"]; ?>! <a href="logout.php">Logout</a></p>
                <br>
                <ul>
                	<?php
						//show each of the business contacts in a list, each with a link to their personal information
						foreach($result as $row)
						{
							
							echo "<li><a href=\"contactdata.php?name=".$row["name"]."\">".$row["name"]."</a>";
						}
					?>
                </ul>
            </section>
            <!-- Main content end-->
            
            <!-- Footer -->
            <footer data-role="footer" data-position="fixed">
            	<h3>Copyright &copy; Chris Eastman 2013</h3>
                 <!-- could not make the view full site button work properly so I removed it-->
                 <!--<a href="http://www.net-head.ca" alt="view full site" >View Full Site</a>-->
            </footer>
        </section>
        <!-- End Business page-->
</body>
</html>
<?php
	}else{
		header("Location: http://www.net-head.ca/mobile/login.php"); // redirects		
	}
?>