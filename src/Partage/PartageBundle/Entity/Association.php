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
     * @ORM\ManyToMany(targetEntity="Objets", inversedBy="association")
     * @ORM\JoinTable(
     *     name="objets_Has_association",
     *     joinColumns={@ORM\JoinColumn(name="association_id", referencedColumnName="id", nullable=false)},
     *     inverseJoinColumns={@ORM\JoinColumn(name="objets_id", referencedColumnName="id", nullable=false)}
     * )
     */
    private $objets;

    /**
     * @ORM\OneToOne(targetEntity="User")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $user;
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->objets = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set nom
     *
     * @param string $nom
     *
     * @return Association
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set adresse
     *
     * @param string $adresse
     *
     * @return Association
     */
    public function setAdresse($adresse)
    {
        $this->adresse = $adresse;

        return $this;
    }

    /**
     * Get adresse
     *
     * @return string
     */
    public function getAdresse()
    {
        return $this->adresse;
    }

    /**
     * Set tel
     *
     * @param string $tel
     *
     * @return Association
     */
    public function setTel($tel)
    {
        $this->tel = $tel;

        return $this;
    }

    /**
     * Get tel
     *
     * @return string
     */
    public function getTel()
    {
        return $this->tel;
    }

    /**
     * Add objet
     *
     * @param \Partage\PartageBundle\Entity\Objets $objet
     *
     * @return Association
     */
    public function addObjet(\Partage\PartageBundle\Entity\Objets $objet)
    {
        $this->objets[] = $objet;

        return $this;
    }

    /**
     * Remove objet
     *
     * @param \Partage\PartageBundle\Entity\Objets $objet
     */
    public function removeObjet(\Partage\PartageBundle\Entity\Objets $objet)
    {
        $this->objets->removeElement($objet);
    }

    /**
     * Get objets
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getObjets()
    {
        return $this->objets;
    }

    /**
     * Set user
     *
     * @param \Partage\PartageBundle\Entity\User $user
     *
     * @return Association
     */
    public function setUser(\Partage\PartageBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \Partage\PartageBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }

    public function __toString()
    {
        return $this->nom;
    }
}
