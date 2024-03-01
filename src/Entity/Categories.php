<?php

namespace App\Entity;

use App\Repository\CategoriesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CategoriesRepository::class)]
class Categories
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nameCategorie = null;

    #[ORM\OneToMany(targetEntity: Produit::class, mappedBy: 'categories')]
    private Collection $listProduit;

    public function __construct()
    {
        $this->listProduit = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNameCategorie(): ?string
    {
        return $this->nameCategorie;
    }

    public function setNameCategorie(string $nameCategorie): static
    {
        $this->nameCategorie = $nameCategorie;

        return $this;
    }

    /**
     * @return Collection<int, Produit>
     */
    public function getListProduit(): Collection
    {
        return $this->listProduit;
    }

    public function addListProduit(Produit $listProduit): static
    {
        if (!$this->listProduit->contains($listProduit)) {
            $this->listProduit->add($listProduit);
            $listProduit->setCategories($this);
        }

        return $this;
    }

    public function removeListProduit(Produit $listProduit): static
    {
        if ($this->listProduit->removeElement($listProduit)) {
            // set the owning side to null (unless already changed)
            if ($listProduit->getCategories() === $this) {
                $listProduit->setCategories(null);
            }
        }

        return $this;
    }
    public function __toString(){
        return $this->getnameCategorie();
    }
}
