<?php

namespace UM\JdmapiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Relation
 *
 * @ORM\Table(name="relation")
 * @ORM\Entity(repositoryClass="UM\JdmapiBundle\Repository\RelationRepository")
 */
class Relation
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
     * @var int
     *
     * @ORM\Column(name=" id_node", type="integer")
     * @ORM\ManyToOne(targetEntity="node", inversedBy="id")
     */
    private $node1;

    /**
     * @var int
     *
     * @ORM\Column(name=" id_node2", type="integer")
     * @ORM\ManyToOne(targetEntity="node", inversedBy="id")
     */
    private $node2;

    /**
     * @var int
     *
     * @ORM\Column(name=" id_type", type="integer")
     * @ORM\ManyToOne(targetEntity="Relation_type", inversedBy="id")
     */
    private $typeRelation;

    /**
     * @var int
     *
     * @ORM\Column(name="weight", type="integer")
     */
    private $weight;


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
     * Set node1
     *
     * @param integer $node1
     *
     * @return Relation
     */
    public function setNode1($node1)
    {
        $this->node1 = $node1;

        return $this;
    }

    /**
     * Get node1
     *
     * @return int
     */
    public function getNode1()
    {
        return $this->node1;
    }

    /**
     * Set node2
     *
     * @param integer $node2
     *
     * @return Relation
     */
    public function setNode2($node2)
    {
        $this->node2 = $node2;

        return $this;
    }

    /**
     * Get node2
     *
     * @return int
     */
    public function getNode2()
    {
        return $this->node2;
    }

    /**
     * Set typeRelation
     *
     * @param integer $typeRelation
     *
     * @return Relation
     */
    public function setTypeRelation($typeRelation)
    {
        $this->typeRelation = $typeRelation;

        return $this;
    }

    /**
     * Get typeRelation
     *
     * @return int
     */
    public function getTypeRelation()
    {
        return $this->typeRelation;
    }

    /**
     * Set weight
     *
     * @param integer $weight
     *
     * @return Relation
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
}
