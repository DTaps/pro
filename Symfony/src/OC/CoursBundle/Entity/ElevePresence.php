<?php

namespace OC\CoursBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ElevePresence
 *
 * @ORM\Table(name="eleve_presence")
 * @ORM\Entity(repositoryClass="OC\CoursBundle\Repository\ElevePresenceRepository")
 */
class ElevePresence
{

  /**
   * @ORM\ManyToOne(targetEntity="OC\CoursBundle\Entity\Semaines")
   * @ORM\JoinColumn(nullable=true)
   */

    private $semaines;

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
     * @ORM\Column(name="username", type="string", length=255)
     */
    private $username;

    /**
     * @var string
     *
     * @ORM\Column(name="jour", type="string", length=255)
     */
    private $jour;

    /**
     * @var string
     *
     * @ORM\Column(name="plage", type="string", length=255)
     */
    private $plage;

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
     * @return ElevePresence
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
     * Set prenom
     *
     * @param string $prenom
     *
     * @return ElevePresence
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;

        return $this;
    }

    /**
     * Get prenom
     *
     * @return string
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * Set semaines
     *
     * @param \OC\CoursBundle\Entity\Semaines $semaines
     *
     * @return ElevePresence
     */
    public function setSemaines(\OC\CoursBundle\Entity\Semaines $semaines)
    {
        $this->semaines = $semaines;

        return $this;
    }

    /**
     * Get semaines
     *
     * @return \OC\CoursBundle\Entity\Semaines
     */
    public function getSemaines()
    {
        return $this->semaines;
    }

    /**
     * Set jour
     *
     * @param string $jour
     *
     * @return ElevePresence
     */
    public function setJour($jour)
    {
        $this->jour = $jour;

        return $this;
    }

    /**
     * Get jour
     *
     * @return string
     */
    public function getJour()
    {
        return $this->jour;
    }

    /**
     * Set plage
     *
     * @param string $plage
     *
     * @return ElevePresence
     */
    public function setPlage($plage)
    {
        $this->plage = $plage;

        return $this;
    }

    /**
     * Get plage
     *
     * @return string
     */
    public function getPlage()
    {
        return $this->plage;
    }

    /**
     * Set username
     *
     * @param string $username
     *
     * @return ElevePresence
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Get username
     *
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }
}
