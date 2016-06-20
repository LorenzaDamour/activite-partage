<?php
namespace Partage\PartageBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class Association
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
     * @ORM\ManyToMany(targetEntity="Objets", inversedBy="Association")
     * @ORM\JoinTable(
     *     name="objets_Has_association",
     *     joinColumns={@ORM\JoinColumn(name="association_id", referencedColumnName="id", nullable=false)},
     *     inverseJoinColumns={@ORM\JoinColumn(name="objets_id", referencedColumnName="id", nullable=false)}
     * )
     */
    private $objets;

    /**
     * @ORM\OneToOne(targetEntity="User", inversedBy="id")
     */
    private $user_id;
}
