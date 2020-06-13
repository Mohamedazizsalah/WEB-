<?PHP
include "../core/congec.php";

    $conge = new congec();
	$conge->supprimerconges($_GET["id"]);
	header('Location: afficherconges.php');


?>