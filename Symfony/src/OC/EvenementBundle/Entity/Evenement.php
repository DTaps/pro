<?php

namespace OC\EvenementBundle\Entity;

use OC\UserBundle\Entity\User;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Evenement
 *
 * @ORM\Table(name="evenement")
 * @ORM\Entity(repositoryClass="OC\EvenementBundle\Repository\EvenementRepository")
 */
class Evenement
{
    
    public function _construct(){
        $this->participants = new ArrayCollection();
        $this->non_participants = new ArrayCollection();
    }
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
     * @ORM\Column(name="type", type="string", length=255)
     */
    private $type;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;

    /**
     * @var string
     *
     * @ORM\Column(name="lieu", type="string", length=255, nullable=true)
     */
    private $lieu;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     */
    private $description;
    
     /**
   * @ORM\ManyToMany(targetEntity="OC\UserBundle\Entity\User", cascade={"persist"})
   * @ORM\JoinTable(name="evenement_participants")
   */
    private $participants;
    
     /**
   * @ORM\ManyToMany(targetEntity="OC\UserBundle\Entity\User", cascade={"persist"})
   * @ORM\JoinTable(name="evenement_nonparticipants")
   */
    private $non_participants;
    
     public function addParticipant(User $user)
  {
    $this->participants[] = $user;
  }

  public function removeParticipant(User $user)
  {
    $this->participants->removeElement($user);
  }

  public function getParticipants()
  {
    return $this->participants;
  }
  
    public function addNon_Participant(User $user)
  {
    $this->non_participants[] = $user;
  }

  public function removeNon_Participant(User $user)
  {
    $this->non_participants->removeElement($user);
  }

  public function getNonParticipants()
  {
    return $this->non_participants;
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
     * Set type
     *
     * @param string $type
     *
     * @return Evenement
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return Evenement
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set lieu
     *
     * @param string $lieu
     *
     * @return Evenement
     */
    public function setLieu($lieu)
    {
        $this->lieu = $lieu;

        return $this;
    }

    /**
     * Get lieu
     *
     * @return string
     */
    public function getLieu()
    {
        return $this->lieu;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Evenement
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }
}

