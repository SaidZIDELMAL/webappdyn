<?php 
/*Code php écrit le 23 avril 2021 à N'djaména au Tchad par
   TARGOTO Christian
   Contact: ct@chrislink.net / 23560316682
 */
?>
<?php 
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "facture_db";
// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
die("Connection failed: " . mysqli_connect_error());
} 

?>
<?php 
$contact=@$_POST["contact"];
$contact2=@$_POST["contact2"];
$nom=@$_POST["nom"];
$id=@$_POST["id"];
$type=@$_POST["type"];
$description=addslashes(@$_POST['description']);
$montant=@$_POST["montant"];
$mess1='';
$mess2='';

?>
<?php 
//enregistrement des factures
if(isset($_POST['benrg2'])&&!empty($type)&&!empty($description)&&!empty($montant)&&!empty($contact2)){
$sql=mysqli_query($conn,"insert into tb_service(type_service,description_srv,montant_srv,date_srv,client_num) values('$type','$description','$montant',now(),'$contact2')");
 
if($sql){
 $mess2="<b>Enregistrement éffectué avec succès !</b>";
}
else{
 $mess2="<b>Erreur !</b>";
}
}

?>
<?php 
//enregistrement des clients
if(isset($_POST['bsupp'])&&!empty($nom)&&!empty($contact)){
$sql=mysqli_query($conn,"insert into tb_client(contact_client,nom_client) values('$contact','$nom')");
 
if($sql){
 $mess1="<b>Enregistrement éffectué avec succès !</b>";
}
else{
 $mess1="<b>Erreur !</b>";
}
}

?>
<?php 
//suppréssion des clients
if(isset($_POST['bsupp'])&&!empty($contact)){
$sql=mysqli_query($conn,"delete from tb_client where contact_client='$contact'");
 
if($sql){
 $mess1="<b>Suppréssion éffectuée avec succès !</b>";
}
else{
 $mess1="<b>Erreur !</b>";
}

}

?>
<?php 
//suppréssion des factures
if(isset($_POST['bsupp2'])&&!empty($id)){
$sql=mysqli_query($conn,"delete from tb_service where id_service='$id'");
 
if($sql){
 $mess2="<b>Suppréssion éffectuée avec succès !</b>";
}
else{
 $mess2="<b>Erreur !</b>";
}

}

?>
<!-- Created by TopStyle Trial - www.topstyle4.com -->
<!DOCTYPE html>
<html>
<head>
	<title>chcode_appli</title>
	<link rel="stylesheet" type="text/css" href="mystyle.css">
	<meta charset="utf8">
</head>

<body>
	<div align="center">
	<h2>Formulaire d'enregistrement des clients</h2>
	<form action="" method="POST">
	<fieldset >
      <legend ><b>CLIENT</b></legend>
      <table>
      <tr><td><b>Contact client</b></td><td><input type="text" name="contact" value=""></td></tr>
      <tr><td><b>Nom client</b></td><td><input type="text" name="nom" value=""></td></tr>
      <tr><td></td><td><input type="submit" name="benrg" value="ENREGISTRER" class="bouton"></td></tr>
       <tr><td></td><td><input type="submit" name="bsupp" value="SUPPRIMER" class="bouton"></td></tr>
     <tr><td></td><td><?php print $mess1;?></td></tr>
       </table>
      </fieldset >
	</form>
	<?php 
//affichage de la liste des clients de l'hotel
print"<h3>Liste des clients</h3>";
	$rq1=mysqli_query($conn,"select * from tb_client ");
	print'<table border="1" class="tab"><tr><th>Contact client</th><th>Nom client</th></tr>';
	
	while($rst=mysqli_fetch_assoc($rq1)){
	         print"<tr>";
	         echo"<td>".$rst['contact_client']."</td>";
	         echo"<td>".$rst['nom_client']."</td>";
	         print"</tr>";
	}
	print'</table>';

?>
<h2>Formulaire d'enregistrement des factures</h2>
	<form action="" method="POST">
	<fieldset >
      <legend ><b>FACTURE</b></legend>
      <table>
      <tr><td><b>Type service</b></td><td><select name="type" id="type">
	<option  value="<?php echo $type; ?>"><?php echo $type; ?></option>
	      <option  value="CHAMBRE">CHAMBRE</option>
         <option  value="PISCINE">PISCINE</option>
        <option  value="RESTAURANT">RESTAURANT</option>
        <option  value="GUIDE">GUIDE</option>
     </select></td></tr>
      <tr><td><b>Description service</b></td><td><textarea name="description" rows="6" cols="28" placeholder="décrire le service "></textarea></td></tr>
      <tr><td><b>Montant service</b></td><td><input type="number" min="0" name="montant" value=""></td></tr>
     <tr><td><b>Contact client</b></td><td><input type="text" min="0" name="contact2" value=""></td></tr>
      <tr><td></td><td><input type="submit" name="benrg2" value="ENREGISTRER" class="bouton"></td></tr>
       <tr><td><input type="number" min="1" name="id" value="" placeholder="ID facture"></td><td><input type="submit" name="bsupp2" value="SUPPRIMER" class="bouton"></td></tr>
     <tr><td></td><td><input type="submit" name="bfact" value="FACTURE" class="bouton"></td></tr>
     <tr><td></td><td><?php print $mess2;?></td></tr>
       </table>
      </fieldset >
	</form>
	<?php 
//affichage du contenu de la facture d'un client et le montant total de la facture
if(isset($_POST['bfact'])&&!empty($contact2)){
print"<h3>Contenu de la facture du client ayant le contact : $contact2</h3>";
//montant total de la facture
 $rq4=mysqli_query($conn,"select sum(montant_srv) as montant from tb_service where client_num='$contact2'");
  if($rst4=mysqli_fetch_assoc($rq4)){
  $mtotal=$rst4['montant'];
    echo "<b>Montant total de la facture : $mtotal FCFA</b><br><br>";
  }
	$rq3=mysqli_query($conn,"select description_srv,montant_srv,date_srv,client_num,nom_client  from tb_client inner join tb_service on tb_client.contact_client=tb_service.client_num where client_num='$contact2' ");
	print'<table border="1" class="tab"><tr><th>Description service</th><th>Montant service (fcfa)</th><th>Date service</th><th>Contact client</th><th>Nom client</th></tr>';
	
	while($rst3=mysqli_fetch_assoc($rq3)){
	         print"<tr>";
	         echo"<td>".$rst3['description_srv']."</td>";
	         echo"<td>".$rst3['montant_srv']."</td>";
	         echo"<td>".$rst3['date_srv']."</td>";
	         echo"<td>".$rst3['client_num']."</td>";
	          echo"<td>".$rst3['nom_client']."</td>";
	         print"</tr>";
	}
	print'</table>';
}
 
?>
		<?php 
//affichage de la liste des factures
print"<h3>Liste des factures</h3>";
	$rq2=mysqli_query($conn,"select * from tb_service ");
	print'<table border="1" class="tab"><tr><th>Type service</th><th>Description service</th><th>Montant service (fcfa)</th><th>Date service</th><th>Contact client</th><th>ID facture</th></tr>';
	
	while($rst2=mysqli_fetch_assoc($rq2)){
	         print"<tr>";
	         echo"<td>".$rst2['type_service']."</td>";
	         echo"<td>".$rst2['description_srv']."</td>";
	         echo"<td>".$rst2['montant_srv']."</td>";
	         echo"<td>".$rst2['date_srv']."</td>";
	         echo"<td>".$rst2['client_num']."</td>";
	         echo"<td>".$rst2['id_service']."</td>";
	         print"</tr>";
	}
	print'</table>';

?>

	</div>
</body>
</html>