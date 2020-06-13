<?PHP
class enseignant{
	private $id;
	private $nom;
	private $prenom;
	private $image;
	private $numerotel;
	private $disponibilite;

	function __construct($nom,$prenom,$image,$numerotel,$disponibilite){
		
		$this->nom=$nom;
		$this->prenom=$prenom;
		$this->image=$image;
		$this->numerotel=$numerotel;
		$this->disponibilite=$disponibilite;

	}
	
	function getid(){
		return $this->id;
	}
	function getnom(){
		return $this->nom;
	}
	function getprenom(){
		return $this->prenom;
	}
	function getimage(){
		return $this->image;
	}
	function getnumerotel(){
		return $this->numerotel;
	}
	function getdisponibilite(){
		return $this->disponibilite;
	}


	function setnom($nom){
		$this->nom=$nom;
	}
	function setprenom($prenom){
		$this->prenom=$prenom;
	}
	function setnumerotel($numerotel){
		$this->numerotel=$numerotel;
	}
	function setimage($image){
		$this->image=$image;
	}
	function setdisponibilite($disponibilite){
		$this->disponibilite=$disponibilite;
	}
	
}

?>