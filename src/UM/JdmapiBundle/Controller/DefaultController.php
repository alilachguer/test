<?php

namespace UM\JdmapiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use UM\JdmapiBundle\Entity\Node_type;
use UM\JdmapiBundle\Entity\Relation;
use UM\JdmapiBundle\Entity\Relation_type;

class DefaultController extends Controller
{
    /**
    * @Route("/jdmapi/nodeid/{nodeid}")
    */
    public function indexAction()
    {
        return $this->render('@Jdmapi/default/index.html.twig');
    }

    public function getNodeByNameAction($nodename){
        $repository = $this->getDoctrine()->getRepository("JdmapiBundle:Node");
        $node = $repository->findOneByName($nodename);

        return $this->render('@Jdmapi/default/index.html.twig',
            array(
                'nodeName' => $node->getName(),
                'nodeId' => $node->getId()
            )
        );
    }

    public function showNodeByIdAction($nodeid){
        $repository = $this->getDoctrine()->getRepository("JdmapiBundle:Node");
        $node = $repository->find($nodeid);

        return $this->render('@Jdmapi/default/index.html.twig',
            array(
                'nodeName' => $node->getName(),
                'nodeId' => $node->getId()
            )
        );
    }
}
