<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="AppBundle\Entity\ParticipantRepository")
 * @ORM\Table(name="participant")
 * @UniqueEntity("firstname", message="Ce prénom est déjà enregistré.")
 * @UniqueEntity("lastname", message="Ce nom est déjà enregistré.")
 * @UniqueEntity("phoneNumber", message="Ce numéro de téléphone est déjà enregistré.")
 */
class Participant
{
    const TOTAL = 80;
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string")
     * @Assert\NotBlank(message="Déclinez votre identité! Quel est votre prénom ?")
     */
    public $firstname;

    /**
     * @ORM\Column(type="string")
     * @Assert\NotBlank(message="Déclinez votre identité! Quel est votre nom de famille ?")
     */
    public $lastname;

    /**
     * @ORM\Column(type="string")
     * @Assert\Regex("/33(6|7)[0-9]{8}/", message="Tu dois respecter le format 33(6|7)xxxxxxxx. Exemple: 33782922697")
     * @Assert\NotBlank(message="Nous devons pouvoir vous contacter ! Quel est votre numéro de téléphone.")
     */
    public $phoneNumber;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    public $alcoholOptin;
}