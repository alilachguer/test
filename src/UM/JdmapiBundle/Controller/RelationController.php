<?php

namespace UM\JdmapiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class RelationController extends Controller
{

    public function getRelations(Int $nodeId)
    {
        $em = $this->getDoctrine()->getManager();
        $relin = $em->getRepository("Relation")->getRelin($nodeId);
        $relout = $em->getRepository("Relation")->getRelout($nodeId);
        return array("relin" => $relin, "relout" => $relout);
    }

    public function getRelin(Int $nodeId)
    {
        $em = $this->getDoctrine()->getManager();
        $relin = $em->getRepository("Relation")->getRelin($nodeId);
        return array("relin" => $relin, "relout" => null);
    }

    public function getRelout(Int $nodeId)
    {
        $em = $this->getDoctrine()->getManager();
        $relout = $em->getRepository("Relation")->getRelout($nodeId);
        return array("relin" => null, "relout" => $relout);
    }

}
