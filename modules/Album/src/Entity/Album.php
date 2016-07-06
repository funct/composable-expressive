<?php

namespace Album\Entity;

use Doctrine\ORM\Mapping as ORM;
use src\Album\Exception\InvalidArgumentException;

/**
 * @ORM\Entity
 */
class Album
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue()
     * @ORM\Column
     *
     * @var integer
     */
    private $id;

    /**
     * @ORM\Column
     *
     * @var string
     */
    private $title;

    /**
     * @ORM\Column
     *
     * @var integer
     */
    private $year;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle($title)
    {
        if (!is_string($title)) {
            throw InvalidArgumentException::wrongType($title, 'title', 'string');
        }
        $this->title = $title;
    }

    /**
     * @return int
     */
    public function getYear()
    {
        return $this->year;
    }

    /**
     * @param int $year
     */
    public function setYear($year)
    {
        if (!is_int($year)) {
            throw InvalidArgumentException::wrongType($year, 'year', 'int');
        }
        $this->year = $year;
    }
}