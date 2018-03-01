<?php

namespace OC\CoursBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Semaine
 *
 * @ORM\Table(name="semaine")
 * @ORM\Entity(repositoryClass="OC\CoursBundle\Repository\SemaineRepository")
 */
class Semaine
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
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=255)
     */
    private $nom;


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
     * Set jour
     *
     * @param string $jour
     *
     * @return Semaine
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
     * @return Semaine
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
     * Set nom
     *
     * @param string $nom
     *
     * @return Semaine
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
}

