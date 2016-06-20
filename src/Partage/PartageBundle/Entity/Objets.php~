<?php
namespace Partage\PartageBundle\Entity;
use Doctrine\ORM\Mapping AS ORM;

/**
 * @ORM\Entity
 */
class Objets
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
     * @ORM\Column(type="text", nullable=true)
     */
    private $adresse;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $tel;

    /**
     * @ORM\ManyToOne(targetEntity="Particulier", inversedBy="objets")
     * @ORM\JoinColumn(name="particulier_id", referencedColumnName="id")
     */
    private $particulier;

    /**
     * @ORM\ManyToMany(targetEntity="Association", mappedBy="objets")
     */
    private $association;
}