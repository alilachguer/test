<?php

namespace UM\JdmapiBundle\Entity;


class Container
{
    /**
     * Mixed
     */
    private $content;

    /**
     * @return mixed
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param mixed $content
     */
    public function setContent($content)
    {
        $this->content = $content;
    }

    public function __toString() {
        return serialize($this->getContent());
    }

}