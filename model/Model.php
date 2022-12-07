<?php 
	
	class Model {

		private $server = 'localhost';
	    private $user = 'root';
	    private $pass = '';
	    private $db = 'dps';
	    private $conn;

	    public function __construct(){
	    	try{
	    		$this->conn = new PDO('mysql:dbname='.$this->db.';host='.$this->server, $this->user, $this->pass);
	    	}catch(Exception $e){
	    		echo 'Echec de connexion '.$e->getMessage();
	    	}
	    }


	    /*
	    Les méthodes pour la gestion de la partie école 
	    Insertion, Modification, Affichage, Suoppression
	    */

	    //Méthode pour Affichages des toutes les écoles 
	    public function getAllEcoles(){

	    	$data = null;

	      	$query = "SELECT * FROM ecole ORDER BY designationEcole ASC";

	      	$sql = $this->conn->prepare($query);

	      	$sql->execute();

	      	while($res = $sql->fetch(PDO::FETCH_ASSOC)){

	        	$data[] = $res;
	      	}

	      	return $data;
	    }

	    //Methode pour tester si l'école n'existe pas encore dans le système
	    public function ecoleExists($designation,$login){

	    	$query = "SELECT * FROM ecole WHERE designationEcole = ? AND login = ? ";

	      	$sql = $this->conn->prepare($query);

	      	$req = $sql->execute(array($designation,$login));

	      	$res = $sql->fetch(PDO::FETCH_ASSOC);

	      	return $res;

	    }

	    //Méthode pour ajouter une école dans la base de données
	    public function insertEcole($designation,$adresse,$typeEcole,$login,$password){

	    	$query = "INSERT INTO ecole (designationEcole,adresseEcole,type,login,password) VALUES (?,?,?,?,?)";

	        $sql = $this->conn->prepare($query);

	        if ($sql->execute(array($designation,$adresse,$typeEcole,$login,$password))) {          
	        	return 1;

	        }else {

	        	return 2;
	        }
	    	
		}

		//Méthode pour séléctionner une seule école
	    public function getEcoleSingle($id){

	    	$data = null;

	      	$query = "SELECT * FROM ecole WHERE idEcole = ?";

	      	$sql = $this->conn->prepare($query);

	      	$sql->execute(array($id));

	      	while($res = $sql->fetch(PDO::FETCH_ASSOC)){

	        	$data[] = $res;
	      	}

	      	return $data;
	    }

	    //Méthode pour modifier une école dans ala base de données
	    public function editEcole($designationM,$adresseEcoleM,$loginM,$passwordM,$typeEcole,$idM){

	    	$query = "UPDATE ecole SET designationEcole = ?,adresseEcole = ?, login = ?, password = ?, type = ? WHERE idEcole = ?";

	        $sql = $this->conn->prepare($query);

	        if ($sql->execute(array($designationM,$adresseEcoleM,$loginM,$passwordM,$typeEcole,$idM))) {          

	        	return 1;

	        }else {

	        	return 2;
	        }
	    	
		}


	    //Méthode pour supprimer une école dans ala base de données
	    public function deleteEcole($id){

	    	$query = "DELETE FROM ecole WHERE idEcole = ?";

	        $sql = $this->conn->prepare($query);

	        if ($sql->execute(array($id))) {          

	        	return 1;

	        }else {

	        	return 2;
	        }
	    	
		}


	    /*
	    Les méthodes pour la gestion de la partie édition 
	    Insertion, Modification, Affichage, Suoppression
	    */

	    //Méthode pour Affichages des toutes les éditions 
	    public function getAllEditions(){

	    	$data = null;

	      	$query = "SELECT * FROM edition ORDER BY idEdition DESC";

	      	$sql = $this->conn->prepare($query);

	      	$sql->execute();

	      	while($res = $sql->fetch(PDO::FETCH_ASSOC)){

	        	$data[] = $res;
	      	}

	      	return $data;
	    }

	    //Methode pour tester si l'édition n'existe pas encore dans le système
	    public function editionExists($libelle){

	    	$query = "SELECT * FROM edition WHERE 	libelle = ? ";

	      	$sql = $this->conn->prepare($query);

	      	$req = $sql->execute(array($libelle));

	      	$res = $sql->fetch(PDO::FETCH_ASSOC);

	      	return $res;

	    }

	    //Méthode pour ajouter une édition dans la base de données
	    public function insertEdition($libelle){

	    	$query = "INSERT INTO edition (libelle) VALUES (?)";

	        $sql = $this->conn->prepare($query);

	        if ($sql->execute(array($libelle))) {          
	        	return 1;

	        }else {

	        	return 2;
	        }
	    	
		}

		//Méthode pour séléctionner une seule école
	    public function getEditionSingle($id){

	    	$data = null;

	      	$query = "SELECT * FROM edition WHERE idEdition = ?";

	      	$sql = $this->conn->prepare($query);

	      	$sql->execute(array($id));

	      	while($res = $sql->fetch(PDO::FETCH_ASSOC)){

	        	$data[] = $res;
	      	}

	      	return $data;
	    }

	    //Méthode pour modifier une édition dans ala base de données
	    public function editEdition($libelle,$idM){

	    	$query = "UPDATE edition SET libelle = ? WHERE idEdition = ?";

	        $sql = $this->conn->prepare($query);

	        if ($sql->execute(array($libelle,$idM))) {          

	        	return 1;

	        }else {

	        	return 2;
	        }
	    	
		}


	    //Méthode pour supprimer une école dans ala base de données
	    public function deleteEdition($id){

	    	$query = "DELETE FROM edition WHERE idEdition = ?";

	        $sql = $this->conn->prepare($query);

	        if ($sql->execute(array($id))) {          

	        	return 1;

	        }else {

	        	return 2;
	        }
	    	
		}

	    /*
	    Les méthodes pour la gestion de la partie section 
	    Insertion, Modification, Affichage, Suoppression
	    */

	    //Méthode pour Affichages des toutes les sections 
	    public function getAllSections(){

	    	$data = null;

	      	$query = "SELECT idSection,designationSection,idEcole,designationEcole,id_ecole FROM section, ecole WHERE id_ecole = idEcole ORDER BY designationSection ASC";

	      	$sql = $this->conn->prepare($query);

	      	$sql->execute();

	      	while($res = $sql->fetch(PDO::FETCH_ASSOC)){

	        	$data[] = $res;
	      	}

	      	return $data;
	    }

	    //Méthode pour Affichages des toutes les sections selon une école
	    public function getAllSectionsByEcole($id){

	    	$data = null;

	      	$query = "SELECT idSection,designationSection,idEcole,designationEcole,id_ecole FROM section, ecole WHERE id_ecole = idEcole AND id_ecole = ? ORDER BY designationSection ASC";

	      	$sql = $this->conn->prepare($query);

	      	$sql->execute(array($id));

	      	while($res = $sql->fetch(PDO::FETCH_ASSOC)){

	        	$data[] = $res;
	      	}

	      	return $data;
	    }

	    //Methode pour tester si la section n'existe pas encore dans le système
	    public function sectionExists($libelleSection,$id_ecole){

	    	$query = "SELECT * FROM section WHERE designationSection = ? AND id_ecole = ?";

	      	$sql = $this->conn->prepare($query);

	      	$req = $sql->execute(array($libelleSection,$id_ecole));

	      	$res = $sql->fetch(PDO::FETCH_ASSOC);

	      	return $res;

	    }

	    //Méthode pour ajouter une section dans la base de données
	    public function insertSection($libelleSection,$id_ecole){

	    	$query = "INSERT INTO section (designationSection,id_ecole) VALUES (?,?)";

	        $sql = $this->conn->prepare($query);

	        if ($sql->execute(array($libelleSection,$id_ecole))) {          
	        	return 1;

	        }else {

	        	return 2;
	        }
	    	
		}

		//Méthode pour séléctionner une seule section
	    public function getSectionSingle($id){

	    	$data = null;

	      	$query = "SELECT idSection,designationSection,idEcole,designationEcole,id_ecole FROM section, ecole WHERE id_ecole = idEcole AND idSection = ?";

	      	$sql = $this->conn->prepare($query);

	      	$sql->execute(array($id));

	      	while($res = $sql->fetch(PDO::FETCH_ASSOC)){

	        	$data[] = $res;
	      	}

	      	return $data;
	    }

	    //Méthode pour modifier une section dans ala base de données
	    public function editSection($libelleSectionM,$id_ecoleM,$idM){

	    	$query = "UPDATE section SET designationSection = ?, id_ecole = ? WHERE idSection = ?";

	        $sql = $this->conn->prepare($query);

	        if ($sql->execute(array($libelleSectionM,$id_ecoleM,$idM))) {          

	        	return 1;

	        }else {

	        	return 2;
	        }
	    	
		}

	    //Méthode pour supprimer une section dans ala base de données
	    public function deleteSection($id){

	    	$query = "DELETE FROM section WHERE idSection = ?";

	        $sql = $this->conn->prepare($query);

	        if ($sql->execute(array($id))) {          

	        	return 1;

	        }else {

	        	return 2;
	        }
	    	
		}


	    /*
	    Les méthodes pour la gestion de la partie classe 
	    Insertion, Modification, Affichage, Suoppression
	    */

	    //Méthode pour Affichages des toutes les sections 
	    public function getAllClasses(){

	    	$data = null;

	      	$query = "SELECT idClasse,designationClasse,id_section,designationSection,designationEcole,idSection FROM classe, section, ecole WHERE id_section = idSection AND id_ecole = idEcole ORDER BY designationSection ASC ";

	      	$sql = $this->conn->prepare($query);

	      	$sql->execute();

	      	while($res = $sql->fetch(PDO::FETCH_ASSOC)){

	        	$data[] = $res;
	      	}

	      	return $data;
	    }

	    //Méthode pour Affichages des toutes les classes selon l'école
	    public function getAllClassesByEcole($id){

	    	$data = null;

	      	$query = "SELECT idClasse,designationClasse,id_section,designationSection,designationEcole,idSection FROM classe, section, ecole WHERE id_section = idSection AND id_ecole = idEcole AND id_ecole = ? ORDER BY designationSection ASC ";

	      	$sql = $this->conn->prepare($query);

	      	$sql->execute(array($id));

	      	while($res = $sql->fetch(PDO::FETCH_ASSOC)){

	        	$data[] = $res;
	      	}

	      	return $data;
	    }

	    //Methode pour tester si la classe n'existe pas encore dans le système
	    public function classeExists($libelleClasse,$id_section){

	    	$query = "SELECT * FROM classe WHERE designationClasse = ? AND id_section = ?";

	      	$sql = $this->conn->prepare($query);

	      	$req = $sql->execute(array($libelleClasse,$id_section));

	      	$res = $sql->fetch(PDO::FETCH_ASSOC);

	      	return $res;

	    }

	    //Méthode pour ajouter une classe dans la base de données
	    public function insertClasse($libelleClasse,$id_section){

	    	$query = "INSERT INTO classe (designationClasse,id_section) VALUES (?,?)";

	        $sql = $this->conn->prepare($query);

	        if ($sql->execute(array($libelleClasse,$id_section))) {          
	        	return 1;

	        }else {

	        	return 2;
	        }
	    	
		}

		//Méthode pour séléctionner une seule classe
	    public function getClasseSingle($id){

	    	$data = null;

	      	$query = "SELECT idClasse,designationClasse,id_section,designationSection,designationEcole,idSection FROM classe, section, ecole WHERE id_section = idSection AND id_ecole = idEcole AND idClasse = ?";

	      	$sql = $this->conn->prepare($query);

	      	$sql->execute(array($id));

	      	while($res = $sql->fetch(PDO::FETCH_ASSOC)){

	        	$data[] = $res;
	      	}

	      	return $data;
	    }

	    //Méthode pour modifier une classe dans ala base de données
	    public function editClasse($libelleClasseM,$id_sectionM,$idM){

	    	$query = "UPDATE classe SET designationClasse = ?, id_section = ? WHERE idClasse = ?";

	        $sql = $this->conn->prepare($query);

	        if ($sql->execute(array($libelleClasseM,$id_sectionM,$idM))) {          

	        	return 1;

	        }else {

	        	return 2;
	        }
	    	
		}

	    //Méthode pour supprimer une classe dans ala base de données
	    public function deleteClasse($id){

	    	$query = "DELETE FROM classe WHERE idClasse = ?";

	        $sql = $this->conn->prepare($query);

	        if ($sql->execute(array($id))) {          

	        	return 1;

	        }else {

	        	return 2;
	        }
	    	
		}


	    /*
	    Les méthodes pour la gestion de la partie bibliothèques
	    Insertion, Modification, Affichage, Suoppression
	    */

	    //Méthode pour Affichages des toutes les bibliothèques
	    public function getAllBibliotheques(){

	    	$data = null;

	      	$query = "SELECT idBibliotheque,designationBibliotheque,id_ecole,designationEcole,ideCole FROM bibiotheque, ecole WHERE id_ecole = idEcole ORDER BY designationBibliotheque ASC ";

	      	$sql = $this->conn->prepare($query);

	      	$sql->execute();

	      	while($res = $sql->fetch(PDO::FETCH_ASSOC)){

	        	$data[] = $res;
	      	}

	      	return $data;
	    }

	    //Methode pour tester si la biblioth-que n'existe pas encore dans le système
	    public function bibliothequeExists($libelleBibliotheque,$id_ecole){

	    	$query = "SELECT * FROM bibiotheque WHERE designationBibliotheque = ? AND id_ecole = ?";

	      	$sql = $this->conn->prepare($query);

	      	$req = $sql->execute(array($libelleBibliotheque,$id_ecole));

	      	$res = $sql->fetch(PDO::FETCH_ASSOC);

	      	return $res;

	    }

	    //Méthode pour ajouter une bibliothèque dans la base de données
	    public function insertBibliotheque($libelleBibliotheque,$id_ecole){

	    	$query = "INSERT INTO bibiotheque (designationBibliotheque,id_ecole) VALUES (?,?)";

	        $sql = $this->conn->prepare($query);

	        if ($sql->execute(array($libelleBibliotheque,$id_ecole))) {          
	        	return 1;

	        }else {

	        	return 2;
	        }
	    	
		}

		//Méthode pour séléctionner une seule bibliothèque
	    public function getBibliothequeSingle($id){

	    	$data = null;

	      	$query = "SELECT idBibliotheque,designationBibliotheque,id_ecole,designationEcole,idECole FROM bibiotheque, ecole WHERE id_ecole = idEcole AND idBibliotheque = ?";

	      	$sql = $this->conn->prepare($query);

	      	$sql->execute(array($id));

	      	while($res = $sql->fetch(PDO::FETCH_ASSOC)){

	        	$data[] = $res;
	      	}

	      	return $data;
	    }

	    //Méthode pour modifier une bibliothèque dans ala base de données
	    public function editBibliotheque($libelleBibliothequeM,$id_ecoleM,$idM){

	    	$query = "UPDATE bibiotheque SET designationBibliotheque = ?, id_ecole = ? WHERE idBibliotheque = ?";

	        $sql = $this->conn->prepare($query);

	        if ($sql->execute(array($libelleBibliothequeM,$id_ecoleM,$idM))){          

	        	return 1;

	        }else {

	        	return 2;
	        }
	    	
		}

	    //Méthode pour supprimer une bibliothèque dans ala base de données
	    public function deleteBibliotheque($id){

	    	$query = "DELETE FROM bibiotheque WHERE idBibliotheque = ?";

	        $sql = $this->conn->prepare($query);

	        if ($sql->execute(array($id))) {          

	        	return 1;

	        }else {

	        	return 2;
	        }
	    	
		}


	    /*
	    Les méthodes pour la gestion de la partie ouvrages
	    Insertion, Modification, Affichage, Suoppression
	    */

	    //Méthode pour Affichages des tous les ouvvrages de la base de données
	    public function getAllOuvrages(){

	    	$data = null;

	      	$query = "SELECT idOuvrage,titre,auteur,datePublication,fichier,id_bibliotheque,designationBibliotheque,idBibliotheque FROM ouvrages, bibiotheque WHERE id_bibliotheque = idBibliotheque ORDER BY titre ASC ";

	      	$sql = $this->conn->prepare($query);

	      	$sql->execute();

	      	while($res = $sql->fetch(PDO::FETCH_ASSOC)){

	        	$data[] = $res;
	      	}

	      	return $data;
	    }

	    //Methode pour tester si l'ouvrage n'existe pas encore dans le système
	    public function ouvrageExists($titre,$auteur,$datePublication,$id_bibliotheque){

	    	$query = "SELECT * FROM ouvrages WHERE titre = ? AND auteur = ? AND datePublication = ? AND id_bibliotheque = ?";

	      	$sql = $this->conn->prepare($query);

	      	$req = $sql->execute(array($titre,$auteur,$datePublication,$id_bibliotheque));

	      	$res = $sql->fetch(PDO::FETCH_ASSOC);

	      	return $res;

	    }

	    //Méthode pour ajouter un ovrage dans la base de données 
	    public function insertOuvrage($titre,$auteur,$datePublication,$fichier,$id_bibliotheque){

	    	$query = "INSERT INTO ouvrages (titre,auteur,datePublication,fichier,id_bibliotheque) VALUES (?,?,?,?,?)";

	        $sql = $this->conn->prepare($query);

	        if ($sql->execute(array($titre,$auteur,$datePublication,$fichier,$id_bibliotheque))) {          
	        	return 1;

	        }else {

	        	return 2;
	        }
	    	
		}

		//Méthode pour séléctionner un seul ouvrage 
	    public function getOuvrageSingle($id){

	    	$data = null;

	      	$query = "SELECT idOuvrage,titre,auteur,datePublication,fichier,id_bibliotheque,designationBibliotheque,idBibliotheque FROM ouvrages, bibiotheque WHERE id_bibliotheque = idBibliotheque AND idOuvrage = ?";

	      	$sql = $this->conn->prepare($query);

	      	$sql->execute(array($id));

	      	while($res = $sql->fetch(PDO::FETCH_ASSOC)){

	        	$data[] = $res;
	      	}

	      	return $data;
	    }

	    //Méthode pour modifier un ouvrage dans la base de données 
	    public function editOuvrage($titreM,$auteurM,$datePublicationM,$id_bibliothequeM,$idM){

	    	$query = "UPDATE ouvrages SET titre = ?, auteur = ?, datePublication = ?, id_bibliotheque = ? WHERE idOuvrage = ?";

	        $sql = $this->conn->prepare($query);

	        if ($sql->execute(array($titreM,$auteurM,$datePublicationM,$id_bibliothequeM,$idM))){          

	        	return 1;

	        }else {

	        	return 2;
	        }
	    	
		}

	    //Méthode pour supprimer un ouvrage dans la base de données
	    public function deleteOuvrage($id){

	    	$query = "DELETE FROM ouvrages WHERE idOuvrage = ?";

	        $sql = $this->conn->prepare($query);

	        if ($sql->execute(array($id))) {          

	        	return 1;

	        }else {

	        	return 2;
	        }
	    	
		}


	    /*
	    Les méthodes pour la gestion de la partie inscription
	    Insertion, Modification, Affichage, Suoppression
	    */

	    //Méthode pour Affichages des toutes les inscriotions de la base de données
	    public function getAllInscriptions(){

	    	$data = null;

	      	$query = "SELECT idInscription,dateInscription,statut,id_ecole_sec,id_eleve,id_lasse,id_edition,id_sesction_sec,designationSection,nomEleve,postnomEleve,designationClasse,libelle,designationEcole FROM inscription,ecole,section,classe,edition,eleve WHERE id_ecole_sec = idSection AND id_eleve = idEleve AND id_lasse = idClasse AND id_edition = idEdition AND id_sesction_sec = idSection AND id_ecole = idEcole ORDER BY dateInscription DESC ";

	      	$sql = $this->conn->prepare($query);

	      	$sql->execute();

	      	while($res = $sql->fetch(PDO::FETCH_ASSOC)){

	        	$data[] = $res;
	      	}

	      	return $data;
	    }


	    //Méthode pour Affichages des toutes les inscriotions de la base de données
	    public function getAllEleves(){

	    	$data = null;

	      	$query = "SELECT * FROM eleve ORDER BY nomEleve DESC ";

	      	$sql = $this->conn->prepare($query);

	      	$sql->execute();

	      	while($res = $sql->fetch(PDO::FETCH_ASSOC)){

	        	$data[] = $res;
	      	}

	      	return $data;
	    }

	    //Méthode pour Affichages des toutes les inscriptions d'une école
	    public function getAllInscriptionsByEcole($idEcole){

	    	$data = null;

	      	$query = "SELECT a.idInscription,a.dateInscription,a.statut,a.id_ecole_sec,a.id_eleve,a.id_lasse,a.id_edition,a.id_sesction_sec,b.designationSection,c.nomEleve,c.postnomEleve,d.designationClasse,e.libelle,f.designationEcole FROM inscription as a,ecole as f,section as b,classe as d,edition as e,eleve as c WHERE a.id_ecole_sec = f.idEcole AND a.id_eleve = c.idEleve AND a.id_lasse = d.idClasse AND a.id_edition = e.idEdition AND a.id_sesction_sec = b.idSection AND a.id_ecole_sec = ? ORDER BY a.dateInscription DESC ";

	      	$sql = $this->conn->prepare($query);

	      	$sql->execute(array($idEcole));

	      	while($res = $sql->fetch(PDO::FETCH_ASSOC)){

	        	$data[] = $res;
	      	}

	      	return $data;
	    }

	    //Méthode pour Affichages des toutes les inscriptions selon une édition 
	    public function getAllInscriptionsByEdition($idEdition){

	    	$data = null;

	      	$query = "SELECT a.idInscription,a.dateInscription,a.statut,a.id_ecole_sec,a.id_eleve,a.id_lasse,a.id_edition,a.id_sesction_sec,b.designationSection,c.nomEleve,c.postnomEleve,d.designationClasse,e.libelle,f.designationEcole FROM inscription as a,ecole as f,section as b,classe as d,edition as e,eleve as c WHERE a.id_ecole_sec = f.idEcole AND a.id_eleve = c.idEleve AND a.id_lasse = d.idClasse AND a.id_edition = e.idEdition AND a.id_sesction_sec = b.idSection AND a.id_edition = ? ORDER BY a.dateInscription DESC ";

	      	$sql = $this->conn->prepare($query);

	      	$sql->execute(array($idEdition));

	      	while($res = $sql->fetch(PDO::FETCH_ASSOC)){

	        	$data[] = $res;
	      	}

	      	return $data;
	    }


	    //Méthode pour Affichages des toutes les inscriptions selon l'école et une édition 
	    public function getAllInscriptionsByEcoleAndEdition($idEcole,$idEdition){

	    	$data = null;

	      	$query = "SELECT a.idInscription,a.dateInscription,a.statut,a.id_ecole_sec,a.id_eleve,a.id_lasse,a.id_edition,a.id_sesction_sec,b.designationSection,c.nomEleve,c.postnomEleve,d.designationClasse,e.libelle,f.designationEcole FROM inscription as a,ecole as f,section as b,classe as d,edition as e,eleve as c WHERE a.id_ecole_sec = f.idEcole AND a.id_eleve = c.idEleve AND a.id_lasse = d.idClasse AND a.id_edition = e.idEdition AND a.id_sesction_sec = b.idSection AND a.id_ecole_sec = ? AND a.id_edition = ? ORDER BY a.dateInscription DESC ";

	      	$sql = $this->conn->prepare($query);

	      	$sql->execute(array($idEcole,$idEdition));

	      	while($res = $sql->fetch(PDO::FETCH_ASSOC)){

	        	$data[] = $res;
	      	}

	      	return $data;
	    }

	    //Methode pour tester si l'inscription n'existe pas encore dans le système
	    public function inscriptionExists($id_ecole,$id_classe,$id_eleve,$id_edition,$id_section){

	    	$query = "SELECT * FROM inscription WHERE id_ecole_sec = ? AND id_lasse = ? AND id_eleve = ? AND id_edition = ? AND id_sesction_sec = ?";

	      	$sql = $this->conn->prepare($query);

	      	$req = $sql->execute(array($id_ecole,$id_classe,$id_eleve,$id_edition,$id_section));

	      	$res = $sql->fetch(PDO::FETCH_ASSOC);

	      	return $res;

	    }

	    //Méthode pour ajouter une inscrioyion dans la base de données
	    public function insertInscription($dateInscription,$statut,$id_ecole,$id_eleve,$id_classe,$id_edition,$id_section){

	    	$query = "INSERT INTO inscription (dateInscription,statut,id_ecole_sec,id_eleve,id_lasse,id_edition,id_sesction_sec) VALUES (?,?,?,?,?,?,?)";

	        $sql = $this->conn->prepare($query);

	        if ($sql->execute(array($dateInscription,$statut,$id_ecole,$id_eleve,$id_classe,$id_edition,$id_section))) {          
	        	return 1;

	        }else {

	        	return 2;
	        }
	    	
		}

		//Méthode pour séléctionner une seule inscription
	    public function getInscriptionSingle($id){

	    	$data = null;

	      	$query = "SELECT a.idInscription,a.dateInscription,a.statut,a.id_ecole_sec,a.id_eleve,a.id_lasse,a.id_edition,a.id_sesction_sec,b.designationSection,c.nomEleve,c.postnomEleve,d.designationClasse,e.libelle,f.designationEcole FROM inscription as a,ecole as f,section as b,classe as d,edition as e,eleve as c WHERE a.id_ecole_sec = f.idEcole AND a.id_eleve = c.idEleve AND a.id_lasse = d.idClasse AND a.id_edition = e.idEdition AND a.id_sesction_sec = b.idSection AND a.idInscription = ?";

	      	$sql = $this->conn->prepare($query);

	      	$sql->execute(array($id));

	      	while($res = $sql->fetch(PDO::FETCH_ASSOC)){

	        	$data[] = $res;
	      	}

	      	return $data;
	    }

	    //Méthode pour modifier une inscription dans la base de données 
	    public function editInscription($id_ecoleM,$id_eleveM,$id_classeM,$id_editionM,$id_sectionM,$statutM,$idM){

	    	$query = "UPDATE inscription SET id_ecole_sec = ?, id_eleve = ?, id_lasse = ?, id_edition = ?, id_sesction_sec = ?, statut = ? WHERE idInscription = ?";

	        $sql = $this->conn->prepare($query);

	        if ($sql->execute(array($id_ecoleM,$id_eleveM,$id_classeM,$id_editionM,$id_sectionM,$statutM,$idM))){          

	        	return 1;

	        }else {

	        	return 2;
	        }
	    	
		}

	    //Méthode pour supprimer une inscriotion dans la base de données
	    public function deleteInscription($id){

	    	$query = "DELETE FROM inscription WHERE idInscription = ?";

	        $sql = $this->conn->prepare($query);

	        if ($sql->execute(array($id))) {          

	        	return 1;

	        }else {

	        	return 2;
	        }
	    	
		}

		
		


	}


