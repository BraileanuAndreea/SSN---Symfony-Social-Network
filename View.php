<?php
// src/Blogger/BlogBundle/Entity/Blog.php

namespace Blogger\BlogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints\DateTime;

/**
 * @ORM\Entity
 * @ORM\Table(name="view")
 * @ORM\HasLifecycleCallbacks
 */
class View
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     */
    protected $id;

    /**
     * @ORM\Column(type="integer")
     */
    protected $views;

    /**
     * @ORM\Column(type="datetime")
     */
    protected $lastAccess;


    public static function loadByView($view) {
        $returnObject = new View();
        $returnObject->views = $view->views;
        $returnObject->lastAccess = $view->lastAccess;
        return $returnObject;
    }

    public static function loadByValues($id, $views, \DateTime $datetime) {
        $returnObject = new View();
        $returnObject->id = $id;
        $returnObject->views = $views;
        $returnObject->lastAccess = $datetime;
        return $returnObject;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getViews()
    {
        return $this->views;
    }

    /**
     * @param mixed $views
     */
    public function setViews($views)
    {
        $this->views = $views;
    }

    /**
     * @return mixed
     */
    public function getLastAccess()
    {
        return $this->lastAccess;
    }

    /**
     * @param mixed $lastAccess
     */
    public function setLastAccess($lastAccess)
    {
        $this->lastAccess = $lastAccess;
    }

    /**
     * @ORM\PreUpdate
     */
    public function setUpdatedValue()
    {
        $this->setLastAccess(new \DateTime('now'));
    }

}
