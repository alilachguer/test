<?php

namespace um\jdmapi\jdmapiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Relation_type
 *
 * @ORM\Table(name="relation_type")
 * @ORM\Entity(repositoryClass="um\jdmapi\jdmapiBundle\Repository\Relation_typeRepository")
 */
class Relation_type
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
     * @var string
     *
     * @ORM\Column(name="formatted_name", type="string", length=255, unique=true , nullable=true)
     */
    private $formattedName;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255 , nullable=true)
     */
    private $description;


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
     * @return Relation_type
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
     * Set formattedName
     *
     * @param string $formattedName
     *
     * @return Relation_type
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

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Relation_type
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

