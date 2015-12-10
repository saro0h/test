<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity
 * @ORM\Table(name="participant")
 * @UniqueEntity("firstname", message="Ce prénom est déjà enregistré.")
 * @UniqueEntity("lastname", message="Ce nom est déjà enregistré.")
 * @UniqueEntity("phoneNumber", message="Ce numéro de téléphone est déjà enregistré.")
 */
class Participant
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string")
     */
    public $firstname;

    /**
     * @ORM\Column(type="string")
     */
    public $lastname;

    /**
     * @ORM\Column(type="string")
     */
    public $phoneNumber;

    /**
     * @ORM\Column(type="boolean")
     */
    public $alcoholOptin;
}