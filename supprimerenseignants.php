<?PHP
include "../core/enseignantc.php";
if (isset($_POST["id"])){
    $enseignantc = new enseignantc();
	$enseignantc->supprimerenseignant($_POST["id"]);
	header('Location: afficherenseignants.php');
}

?>