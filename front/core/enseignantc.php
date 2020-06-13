<?PHP
include "config.php";
include "entities/enseignant.php";

class enseignantc {

	function afficherenseignants(){
		$sql="SELECT * from `enseignants`";
		$db = config::getConnexion();
		try{
			$liste=$db->query($sql);
			return $liste;
		}
	    catch (Exception $e){
	        die('Erreur: '.$e->getMessage());
	    }	
	}

	function getenseignant($id_enseignant){
		$sql="SELECT * from `enseignants` WHERE id=?";
		try{
			$db = config::getConnexion();
			$req=$db->prepare($sql);
			$req->bindParam(1, $id_enseignant);
			$req->execute();
			$result = $req->fetch();
			return $result;
		}
		catch (Exception $e){
	        echo " Erreur : ".$e->getMessage();
	    }
	}

	function verifstatusconges($id_enseignant){
		$status = FALSE;
		$sql="SELECT * from `conges` WHERE id_enseignant=? ORDER BY date DESC LIMIT 1";
		try{
			$db = config::getConnexion();
			$req=$db->prepare($sql);
			$req->bindParam(1, $id_enseignant);
			$req->execute();
			$result = $req->fetch();
			if ($result != NULL){
				$date1 = date($result['date']);
				$jour = $result['duree']-1;
				$newDate = date('Y-m-d', strtotime($date1. " + {$jour} days"));
				$status = (($newDate >= date("Y-m-d") and date("Y-m-d")>=$date1));
			}
			return $status;
		}
		catch (Exception $e){
	        echo " Erreur : ".$e->getMessage();
	    }
	}

	function formatdisponibilite($disponibilite){
		$output = "";
		$string = explode(",",$disponibilite);
		foreach($string as $jour){
			$output = $output.'<span class="badge bg-info">'.$jour.'</span>';
		}
		return $output;
	}
}
?>