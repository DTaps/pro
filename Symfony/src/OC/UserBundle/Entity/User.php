<?php

namespace OC\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\User as FosUser;
use Doctrine\ORM\Mapping\AttributeOverrides;
use Doctrine\ORM\Mapping\AttributeOverride;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * User
 *
 * @ORM\Table(name="user")
 * @ORM\Entity
 * 
 */
class User extends FosUser
{
    public function __construct(){
      parent::__construct();
    }
/**
   * @ORM\Column(name="id", type="integer")
   * @ORM\Id
   * @ORM\GeneratedValue(strategy="AUTO")
   */
  protected $id;
 /**
   * @ORM\Column(name="nom", type="string", length=255, nullable=true)
   */
  protected $nom;
  
  /**
   * @ORM\Column(name="prénom", type="string", length=255, nullable=true)
   */
  protected $prénom;
  
  /**
   * @ORM\Column(name="date_de_naissance", type="date", nullable=true)
   */
  protected $date_de_naissance;
  
  /**
   * @ORM\Column(name="num_téléphone", type="integer",  nullable=true)
   */
  protected $num_téléphone;
  
  /**
   * @ORM\Column(name="CU_nom", type="string", length=255, nullable=true)
   */
  protected $CU_nom;
  
  /**
   * @ORM\Column(name="Cu_prénom", type="string", length=255, nullable=true)
   */
  protected $CU_prénom;
  
  /**
   * @ORM\Column(name="CU_num_téléphone", type="integer", nullable=true)
   */
  protected $CU_num_téléphone;
  
  /**
   * @ORM\Column(name="CU_profession", type="string", length=255, nullable=true)
   */
  protected $CU_profession;
  
  /**
   * @ORM\Column(name="CU_addr_postale", type="string", length=255, nullable=true)
   */
  protected $CU_addr_postale;
  
  
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
  

  public function getNom(){
      return $this->nom;
  }
  public function setNom($nom){
      $this->nom = $nom;
      return $this;
  }
  public function getPrenom(){
      return $this->prénom;
  }
  public function setPrenom($prenom){
      $this->prénom = $prenom;
      return $this;
  }
  public function getDateDeNaissance() {
      return $this->date_de_naissance;      
  }
  public function setDateDeNaissance($DDN){
      $this->date_de_naissance = $DDN;
      return $this;
  }
  public function getNumTelephone(){
  return $this->num_téléphone;
  }
  public function setNumTelephone($nTel){
      $this->num_téléphone = $nTel;
      return $this;
  }
  public function getCUNom(){
      return $this->CU_nom;
  }
  public function setCUNom($CUnom){
      $this->CU_nom = $CUnom;
      return $this;
  }
  public function getCUPrenom(){
      return $this->CU_prénom;
  }
  public function setCUPrenom($CUprenom){
      $this->CU_prénom = $CUprenom;
      return $this;
  }
  public function getCUNumTelephone(){
  return $this->CU_num_téléphone;
  }
  public function setCUNumTelephone($CUnumTel){
      $this->CU_num_téléphone = $CUnumTel;
      return $this;
  }
  public function getCUProfession(){
      return $this->CU_profession;
  }
  public function setCUProfession($CUprofession){
      $this->CU_profession = $CUprofession;
      return $this;
  }
  public function getCUAddrPostale(){
      return $this->CU_addr_postale;
  }
  public function setCUAddrPostale($CUaddrpostale){
      $this->CU_addr_postale = $CUaddrpostale;
      return $this;
  }
  
}
?>
