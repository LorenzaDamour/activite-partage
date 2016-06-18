<?php
namespace Partage\PartageBundle\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class Particulier
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $nom;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $prenom;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $adresse;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $tel;

    /**
     * @ORM\OneToMany(targetEntity="Objets", mappedBy="particulier")
     */
    private $objets;

    /**
     * @ORM\OneToOne(targetEntity="User", inversedBy="groupe")
     */
    private $groupe;
}
