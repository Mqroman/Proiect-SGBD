<!DOCTYPE HTML>
<apex:page  applyHtmlTag="false">

<html>
<head>
	<meta charset="UTF-8">
	<title>thisbook</title>
	<link rel="stylesheet" href="../css/style.css" type="text/css">
	<?php
	if(!isset($_COOKIE['current_position']))setcookie("current_position",(int)0,time()+(86400));
	?>
</head>
<body>
	<div id="header">
		<div>
		<?php
			if($_COOKIE['is_logged']==="LOGGED"){
				echo "<form action=".'"'."logout_process.php".'"'." method=".'"'."POST".'"'." >";	
				echo "<button type=".'"'."submit".'"'."name=".'"'."logbutton".'"'.">LOGOUT</button>";
				echo "</form>";
			}
			?>
			<a href="../index.php" class="logo"><img src="../images/logo.png" alt=""></a>
			<form action="../index.php">
				<a href="../cos.php"><img  src="../images/cos.jpg" alt="" name="cos" id="cos"></a>
				
			</form>
		</div>
		<div class="navigation">
			<ul>
				<li>
					<a href="../index.php">home</a>
				</li>
				
				</li>
				<li class="selected">
					<a href="../services.php">books</a>
					<ul>
						<li>
							<a href="drama.php">Drama</a>
						</li>
						<li>
							<a href="fiction.php">Fiction</a>
						</li>
						<li>
							<a href="horror.php">Horror</a>
						</li>
						<li>
							<a href="romance.php">Romance</a>
						</li>
						<li>
							<a href="jurnal.php">Jurnal</a>
						</li>
						<li>
							<a href="poetry.php">Poetry</a>
						</li>
						<li>
							<a href="alte.php">Altele</a>
						</li>
						
					</ul>
				</li>
				<li>
					<a href="../contact.php">imprumuturi</a>
				</li>
				<li class="booking">
					<a href="../booking.php">Cauta o carte</a>
				</li>
			</ul>
		</div>
	</div>
	<div id="body">
		<div class="content">
			<div class="section">
				<div class="breadcrumb">
					<span>You are here:</span>
					<ul>
						<li>
							<a href="../index.php">home</a>
						</li>
						<li>
							<a href="../services.php">books</a>
						</li>
						<li>
								<a href="thisbook.php">thisbook</a>
							</li>
						
					</ul>
				</div>
				<div class="services">
					<h2>Books</h2>
					<?php
					
					$conn = oci_connect("student", "student", "localhost:1521/xe");
					if (!$conn) {
  					$m = oci_error();
   					echo $m['message'], "\n";
   					exit;
								}
					$enquiry="SELECT * FROM carti where ID_CARTE=".$_GET['page'];
					$stid = oci_parse($conn, $enquiry);
					oci_execute($stid);	
					$row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS);
					
					echo "<table class='tab'><tr><th><h4>Book Name"; 
					echo "</h4></th><td><h4>".$row['TITLU_CARTE'];
					$enquiry="SELECT * FROM autori where ID_AUTOR=".$row['ID_AUTOR_C'];
					$stid = oci_parse($conn, $enquiry);
					oci_execute($stid);	
					$rowAuthor = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS);				

					
					
					echo "</h4></td></tr><tr><th><h4>Book Author"; 
					echo "</h4></th><td><h4>".$rowAuthor['NUME_AUTOR']." ".$rowAuthor['PRENUME_AUTOR'];
					
					echo "</h4></td></tr><tr><th><h4>Nationality of the author";
					echo "</h4></th><td><h4>".$rowAuthor['NATIONALITATE']; 
					
					echo "</h4></td></tr><tr><th><h4>Book Year"; 
					echo "</h4></th><td><h4>".$row['AN_PUBLICATIE']; 
					
					echo "</h4></td></tr><tr><th><h4>Pret";
					echo "</h4></th><td><h4>".$row['PRET']; 
					
					echo "</h4></td></tr><tr><th><h4>Book Genre"; 
					echo "</h4></th><td><h4>".$row['GEN_CARTE'];

					echo "</h4></td></tr><tr><th><h4>Nr. of books available";
					echo "</h4></th><td><h4>".$row['NR_DISPONIBILE']; 

					echo "</h4></td></tr><tr><th><h4>Total nr. of books"; 
					echo "</h4></th><td><h4>".$row['NR_TOTALE'];
					
					if($row['NR_DISPONIBILE']>0 && $_COOKIE['is_logged']==="LOGGED")
					echo "</h4></td></tr>
					</table>
					<table>
						</tr>
						<tr>
							<th>
								<form action=".'"'."actiune_cumparare.php".'"'." method=".'"'."POST".'"'.">
								<select name=".'"'."schedule".'"'." id=".'"'."schedule".'"'.">
								<option value=".'"'."cumpara".'"'.">cumpara</option>
								<option value=".'"'."imprumuta".'"'.">imprumuta</option>	
							</select>
								<input type=".'"'."text".'"'." name=".'"'."book_ID".'"'." value=".'"'.$row['ID_CARTE'].'"'." hidden>
								<input type=".'"'."text".'"'." name=".'"'."book_name".'"'." value=".'"'.$row['TITLU_CARTE'].'"'." hidden>
								<input type=".'"'."text".'"'." name=".'"'."book_price".'"'." value=".'"'.$row['PRET'].'"'." hidden>
								<button type=".'"'."submit".'"'." name=".'"'."buy".'"'.">Add</button></form>
								
							</th>
						</tr>
				</table>";
				else if($row['NR_DISPONIBILE']<=0) echo "</h4></td></tr>
				</table>
				<table>
					</tr>
					<tr>
						<th>
							OUT OF STOCK
							
						</th>
					</tr>
			</table>";
			else echo "</h4></td></tr>
			</table>
			<table>
				</tr>
				<tr>
					<th>
						PLEASE MAKE AN ACCOUNT
						
					</th>
				</tr>
		</table>";
				?>
				</div>
			</div>
			<div class="sidebar">
				<div class="navigation">
					<h3>Books //</h3>
					<ul>
						<li class="selected">
							<a href="drama.php">drama</a>
						</li>
						<li>
							<a href="fiction.php">fiction</a>
						</li>
						<li>
							<a href="horror.php">horror</a>
						</li>
						<li>
							<a href="romance.php">romance</a>
						</li>
						<li>
							<a href="jurnal.php">jurnal</a>
						</li>
						<li>
							<a href="poetry.php">poetry</a>
						</li>
						<li>
							<a href="alte.php">altele</a>
						</li>	
					</ul>
				</div>
				<div class="contact">
					<h3>contact information</h3>
					<ul>
						<li>
							<b>address:</b> <span>426 strada repar</span>
						</li>
						<li>
							<b>phone:</b> <span>353737353</span>
						</li>
						<li>
							<b>fax:</b> <span>373753735533</span>
						</li>
						<li>
							<b>email:</b> <span><a href="">bicicleteSRL@yahoo.com</a></span>
						</li>
					</ul>
				</div>
				
			</div>
		</div>
	</div>
	<div id="footer">
		<div>
			<div class="contact">
				<h3>contact information</h3>
				<ul>
					<li>
						<b>address:</b> <span>426 strada repar</span>
					</li>
					<li>
						<b>phone:</b> <span>04433344433</span>
					</li>
					<li>
						<b>fax:</b> <span>43322324432</span>
					</li>
					<li>
						<b>email:</b> <span><a href="">biciclete@yahoo.com</a></span>
					</li>
				</ul>
			</div>
			<div class="tweets">
				<h3>recent tweets</h3>
				<ul>
					<li>
						<a href="#">blablalbalbalalvalvalvlablalbalblalblablab.<span>1 day ago</span></a>
					</li>
					<li>
						<a href="#">blablalbalbla.<span>2 days ago</span></a>
					</li>
				</ul>
			</div>
			<div class="posts">
				<h3>recent blog post</h3>
				<ul>
					<li>
						<a href="#">roti noi</a>
					</li>
					<li>
						<a href="#">repar tot</a>
					</li>
					<li>
						<a href="#">stoc epuizat</a>
					</li>
					
				</ul>
			</div>
			<div class="connect">
				<h3>stay in touch</h3>
				<p>
					pentru detalii
				</p>
				<ul>
					<li id="facebook">
						<a href="">facebook</a>
					</li>
					<li id="twitter">
						<a href="">twitter</a>
					</li>
					<li id="googleplus">
						<a href="">googleplus</a>
					</li>
				</ul>
			</div>
		</div>
		<div class="section">
			<p>
				&copy; uaic iasi
			</p>
			
		</div>
	</div>
</body>
</html>
