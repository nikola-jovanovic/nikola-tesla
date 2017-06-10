<?php
include 'includes/db_konekcija.php';	

$type=$_POST['message_type'];
$sid=$_POST['vendor_id'];
$sale_id=$_POST['sale_id'];
$vendor_order_id=$_POST['vendor_order_id'];
$invoice_status=$_POST['invoice_status'];
$fraud_status=$_POST['fraud_status'];
$id=$_POST['item_id_1'];
if($sid== "1819221"){
	if($invoice_status=="deposited"){
		if($id=="d"){														
			$pr="UPDATE donacije SET odobreno='1' WHERE donacija_id='$vendor_order_id' AND sale_id='$sale_id'";
			mysql_query($pr)
			or die(mysql_error());
			$upit = "SELECT * FROM donacije WHERE donacija_id='$vendor_order_id' "; 
			$rezultat = mysql_query($upit)
			  or die(mysql_error());	
			$zapis = mysql_fetch_assoc($rezultat);
			$iznos=$zapis['iznos'];
			$project_id=$zapis['projekat_id'];
			$pr="UPDATE projekti SET trenutna_suma=trenutna_suma+'$iznos' WHERE projekat_id='$project_id' ";
				mysql_query($pr)
				or die(mysql_error());
				
			echo '<h2>Donacije</h2><br/><br/>';
			echo '<p class="thanks">Društvo Nikola Tesla se zahvaljuje na donaciji!</p>';
		}
		if($id=="c"){
			$danas=date ("Y-m-d");
			$d= strtotime($danas);
			$final = date("Y-m-d", strtotime("+1 year", $d));
			$pr="UPDATE clanarine SET odobreno='1' WHERE clanarina_id='$vendor_order_id' AND sale_id='$sale_id' ";
				mysql_query($pr)
				or die(mysql_error());
				
			$upit = "SELECT * FROM clanarine WHERE clanarina_id='$vendor_order_id'";
			$rezultat = mysql_query($upit)
			  or die(mysql_error());
			$zapis = mysql_fetch_assoc($rezultat);
			$user=$zapis['korisnik_id'];
			$pr="UPDATE korisnici SET clanarina='$final' WHERE korisnik='$user' ";
				mysql_query($pr)
				or die(mysql_error());
				
			echo '<h2>Članarina</h2><br/><br/>';
			echo '<p class="thanks">Hvala što ste platili članarinu</p><br/>';
		
		}
	}
}
print_r($sve);
?>