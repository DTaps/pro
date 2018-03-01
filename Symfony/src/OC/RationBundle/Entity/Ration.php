<?php

namespace OC\RationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Ration
 *
 * @ORM\Table(name="ration")
 * @ORM\Entity(repositoryClass="OC\RationBundle\Repository\RationRepository")
 */
class Ration
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
     * @ORM\Column(name="nom", type="text")
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="matin", type="string", length=255)
     */
    private $matin;

    /**
     * @var string
     *
     * @ORM\Column(name="midi", type="string", length=255)
     */
    private $midi;

    /**
     * @var string
     *
     * @ORM\Column(name="soir", type="string", length=255)
     */
    private $soir;


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
     * @return Ration
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
     * Set matin
     *
     * @param string $matin
     *
     * @return Ration
     */
    public function setMatin($matin)
    {
        $this->matin = $matin;

        return $this;
    }

    /**
     * Get matin
     *
     * @return string
     */
    public function getMatin()
    {
        return $this->matin;
    }

    /**
     * Set midi
     *
     * @param string $midi
     *
     * @return Ration
     */
    public function setMidi($midi)
    {
        $this->midi = $midi;

        return $this;
    }

    /**
     * Get midi
     *
     * @return string
     */
    public function getMidi()
    {
        return $this->midi;
    }

    /**
     * Set soir
     *
     * @param string $soir
     *
     * @return Ration
     */
    public function setSoir($soir)
    {
        $this->soir = $soir;

        return $this;
    }

    /**
     * Get soir
     *
     * @return string
     */
    public function getSoir()
    {
        return $this->soir;
    }
}

