<?php

namespace um\jdmapi\jdmapiBundle\Controller;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use um\jdmapi\jdmapiBundle\Entity\node;
use um\jdmapi\jdmapiBundle\Entity\Type_node;
use um\jdmapi\jdmapiBundle\Entity\Relation;
use um\jdmapi\jdmapiBundle\Entity\Relation_type;

class NodeController extends Controller
{

    public function indexAction()
    {
    	$em = $this->getDoctrine()->getManager();

        /*$node = new node();
        $em->persist($node);
        $node->setType(1);
        $node->setName("chien");
        $node->setWeight(50);
        $node->setFormattedName("chientformated");
		*/

		/*$type_node = new Type_node();
		$em->persist($type_node);
		$type_node->setName("terme");
		*/

		$relation = new Relation();
		$em->persist($relation);
		$relation->setNode1(1);
		$relation->setNode2(2);
		$relation->setTypeRelation(1);
		$relation->setWeight(10);

		$type_relation = new Relation_type();
		$em->persist($type_relation);
		$type_relation->setName("isa");
		
        
        $em->flush();

 
      return $this->render('jdmapiBundle:Node:index.html.twig');
    }
}