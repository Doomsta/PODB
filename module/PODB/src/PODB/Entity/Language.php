<?php

namespace PODB\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Language
 * @package PODB\Entity
 * @ORM\Entity
 */
class Language extends BaseEntity
{

    /**
     * TODO ID ins BaseEntity => Entity braucht spezielle Annotation, damit Doctrine die Entity nicht anlegt
     *
     * @var
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    protected $id;

    /**
     * @var
     * @ORM\Column(type="string")
     */
    protected $name;

    /**
     * @var
     * @ORM\Column(type="string")
     */
    protected $locale;

    /**
     * @var
     * @ORM\ManyToOne(targetEntity="User")
     */
    protected $createdBy;

    /**
     * @var
     */
    protected $createDate;

    /**
     * @var
     * @ORM\ManyToOne(targetEntity="User")
     */
    protected $lastUpdateBy;

    /**
     * @var
     */
    protected $lastUpdateDate;

    /**
     * @return array
     */
    public function asArray()
    {
        return array(
            'id' => $this->getId(),
            'name' => $this->getName(),
            'locale' => $this->getLocale(),
            'createdBy' => $this->getCreatedBy(),
            'createDate' => $this->getCreateDate(),
            'lastUpdatedBy' => $this->getLastUpdateBy(),
            'lastUpdateDate' => $this->getLastUpdateDate(),
        );
    }

    private function getName()
    {
        return $this->name;
    }

    private function getLocale()
    {
        return $this->locale;
    }

    private function getCreatedBy()
    {
        return $this->createdBy;
    }

    private function getCreateDate()
    {
        return $this->createDate;
    }

    private function getLastUpdateDate()
    {
        return $this->lastUpdateDate;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function setLocale($locale)
    {
        $this->locale = $locale;
    }

    public function setCreateDate($time)
    {
        $this->createDate = $time;
    }

    public function setLastUpdateDate($time)
    {
        $this->lastUpdateDate = $time;
    }

    /**
     * @param mixed $createdBy
     */
    public function setCreatedBy($createdBy)
    {
        $this->createdBy = $createdBy;
    }

    /**
     * @param mixed $lastUpdateBy
     */
    public function setLastUpdateBy($lastUpdateBy)
    {
        $this->lastUpdateBy = $lastUpdateBy;
    }

    /**
     * @return mixed
     */
    public function getLastUpdateBy()
    {
        return $this->lastUpdateBy;
    }
} 