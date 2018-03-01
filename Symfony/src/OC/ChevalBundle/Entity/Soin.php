<?php

namespace OC\ChevalBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Soin
 *
 * @ORM\Table(name="soin")
 * @ORM\Entity(repositoryClass="OC\ChevalBundle\Repository\SoinRepository")
 */
class Soin
{
    
     public function __construct($cheval_id)
  {
    $this->cheval = $cheval_id;
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
     * @ORM\Column(name="type", type="string", length=255, nullable=true)
     */
    private $type;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime", nullable=true)
     */
    private $date;

    /**
   * @ORM\ManyToOne(targetEntity="OC\ChevalBundle\Entity\Cheval")
   * @ORM\JoinColumn(nullable=false)
   */
    private $cheval;
    
     public function setCheval(Cheval $cheval)
  {
    $this->cheval = $cheval;

    return $this;
  }

  public function getCheval()
  {
    return $this->cheval;
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
     * @return Soin
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
     * @return Soin
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
}

