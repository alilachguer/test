<?php

namespace UM\JdmapiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * node
 *
 * @ORM\Table(name="node")
 * @ORM\Entity(repositoryClass="UM\JdmapiBundle\Repository\nodeRepository")
 */
class node
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
     * @ORM\Column(name="name", type="string", length=255, unique=true)
     */
    private $name;

    /**
     * @var int
     *
     * @ORM\Column(name="type_id", type="integer")
     * @ORM\ManyToOne(targetEntity="Node_type", inversedBy="id")
     */
    private $type;

    /**
     * @var int
     *
     * @ORM\Column(name="weight", type="integer")
     */
    private $weight;

    /**
     * @var string
     *
     * @ORM\Column(name="formatted_name", type="string", length=255 , nullable=true)
     */
    private $formattedName;


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
     * Set name
     *
     * @param string $name
     *
     * @return node
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set type
     *
     * @param integer $type
     *
     * @return node
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return int
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set weight
     *
     * @param integer $weight
     *
     * @return node
     */
    public function setWeight($weight)
    {
        $this->weight = $weight;

        return $this;
    }

    /**
     * Get weight
     *
     * @return int
     */
    public function getWeight()
    {
        return $this->weight;
    }

    /**
     * Set formattedName
     *
     * @param string $formattedName
     *
     * @return node
     */
    public function setFormattedName($formattedName)
    {
        $this->formattedName = $formattedName;

        return $this;
    }

    /**
     * Get formattedName
     *
     * @return string
     */
    public function getFormattedName()
    {
        return $this->formattedName;
    }
}

