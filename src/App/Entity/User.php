<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class User
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue()
     * @ORM\Column
     *
     * @var integer
     */
    private $id;
}