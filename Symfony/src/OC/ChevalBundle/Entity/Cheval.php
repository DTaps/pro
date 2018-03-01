<?php

namespace OC\ChevalBundle\Entity;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;

/**
 * Cheval
 *
 * @ORM\Table(name="cheval")
 * @ORM\Entity(repositoryClass="OC\ChevalBundle\Repository\ChevalRepository")
 */
class Cheval
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=255)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="race", type="string", length=255)
     */
    private $race;

    /**
     * @var string
     *
     * @ORM\Column(name="robe", type="string", length=255)
     */
    private $robe;

    /**
     * @var string
     *
     * @ORM\Column(name="pere", type="string", length=255)
     */
    private $pere;

    /**
     * @var string
     *
     * @ORM\Column(name="mere", type="string", length=255)
     */
    private $mere;

    /**
     * @var string
     *
     * @ORM\Column(name="sexe", type="string", length=255)
     */
    private $sexe;

    /**
     * @var string
     *
     * @ORM\Column(name="proprietaire", type="string", length=255)
     */
    private $proprietaire;

    /**
     * @var string
     *
     * @ORM\Column(name="naisseur", type="string", length=255)
     */
    private $naisseur;

    /**
     * @var int
     *
     * @ORM\Column(name="taille", type="integer")
     */
    private $taille;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateDeNaissance", type="datetime")
     */
    private $dateDeNaissance;
    
    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    private $description;
    
      /**
* @ORM\Column(type="string", length=255, nullable=true)
*/
public $pictureName;

/**
* @Assert\File(maxSize="2M")
*/
public $file;

public function getWebPath()
{
return null === $this->pictureName ? null : $this->getUploadDir().'/'.$this->pictureName;
}
public function getSupPath()
{
return null === $this->pictureName ? null : $this->getUploadRootDir().'/'.$this->pictureName;
}
protected function getUploadRootDir()
{
// le chemin absolu du répertoire dans lequel sauvegarder les photos de profil
return __DIR__.'/../../../../web/'.$this->getUploadDir();
}


protected function getUploadDir()
{
// get rid of the __DIR__ so it doesn't screw when displaying uploaded doc/image in the view.
return 'uploads/pictures';
}
public function uploadProfilePictureModif()
{
    $file = $this->getSupPath();
    unlink($file);
// Nous utilisons le nom de fichier original, donc il est dans la pratique
// nécessaire de le nettoyer pour éviter les problèmes de sécurité

// move copie le fichier présent chez le client dans le répertoire indiqué.
$this->file->move($this->getUploadRootDir(), $this->file->getClientOriginalName());

// On sauvegarde le nom de fichier
$this->pictureName = $this->file->getClientOriginalName();

$this->file = null;
}

public function uploadProfilePicture()
{
// Nous utilisons le nom de fichier original, donc il est dans la pratique
// nécessaire de le nettoyer pour éviter les problèmes de sécurité

// move copie le fichier présent chez le client dans le répertoire indiqué.
$this->file->move($this->getUploadRootDir(), $this->file->getClientOriginalName());

// On sauvegarde le nom de fichier
$this->pictureName = $this->file->getClientOriginalName();

// La propriété file ne servira plus
$this->file = null;
}
public function getPictureName(){
      return $this->pictureName;
  }
    public function setPictureName($PN){
      $this->pictureName = $PN;
      return $this;
  }
    
    public function getDescription(){
        return $this->description;
    }
    
    public function setDescription($description){
        $this->description = $description;
        return $this;
    }

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set nom
     *
     * @param string $nom
     *
     * @return Cheval
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set race
     *
     * @param string $race
     *
     * @return Cheval
     */
    public function setRace($race)
    {
        $this->race = $race;

        return $this;
    }

    /**
     * Get race
     *
     * @return string
     */
    public function getRace()
    {
        return $this->race;
    }

    /**
     * Set robe
     *
     * @param string $robe
     *
     * @return Cheval
     */
    public function setRobe($robe)
    {
        $this->robe = $robe;

        return $this;
    }

    /**
     * Get robe
     *
     * @return string
     */
    public function getRobe()
    {
        return $this->robe;
    }

    /**
     * Set pere
     *
     * @param string $pere
     *
     * @return Cheval
     */
    public function setPere($pere)
    {
        $this->pere = $pere;

        return $this;
    }

    /**
     * Get pere
     *
     * @return string
     */
    public function getPere()
    {
        return $this->pere;
    }

    /**
     * Set mere
     *
     * @param string $mere
     *
     * @return Cheval
     */
    public function setMere($mere)
    {
        $this->mere = $mere;

        return $this;
    }

    /**
     * Get mere
     *
     * @return string
     */
    public function getMere()
    {
        return $this->mere;
    }

    /**
     * Set sexe
     *
     * @param string $sexe
     *
     * @return Cheval
     */
    public function setSexe($sexe)
    {
        $this->sexe = $sexe;

        return $this;
    }

    /**
     * Get sexe
     *
     * @return string
     */
    public function getSexe()
    {
        return $this->sexe;
    }

    /**
     * Set proprietaire
     *
     * @param string $proprietaire
     *
     * @return Cheval
     */
    public function setProprietaire($proprietaire)
    {
        $this->proprietaire = $proprietaire;

        return $this;
    }

    /**
     * Get proprietaire
     *
     * @return string
     */
    public function getProprietaire()
    {
        return $this->proprietaire;
    }

    /**
     * Set naisseur
     *
     * @param string $naisseur
     *
     * @return Cheval
     */
    public function setNaisseur($naisseur)
    {
        $this->naisseur = $naisseur;

        return $this;
    }

    /**
     * Get naisseur
     *
     * @return string
     */
    public function getNaisseur()
    {
        return $this->naisseur;
    }

    /**
     * Set taille
     *
     * @param integer $taille
     *
     * @return Cheval
     */
    public function setTaille($taille)
    {
        $this->taille = $taille;

        return $this;
    }

    /**
     * Get taille
     *
     * @return int
     */
    public function getTaille()
    {
        return $this->taille;
    }

    /**
     * Set dateDeNaissance
     *
     * @param \DateTime $dateDeNaissance
     *
     * @return Cheval
     */
    public function setDateDeNaissance($dateDeNaissance)
    {
        $this->dateDeNaissance = $dateDeNaissance;

        return $this;
    }

    /**
     * Get dateDeNaissance
     *
     * @return \DateTime
     */
    public function getDateDeNaissance()
    {
        return $this->dateDeNaissance;
    }
}

