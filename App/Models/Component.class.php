<?php

// Le mot-clé 'abstract' permet de déclarer une classe comme "abstraite"
// Une classe abstraite ne peut pas être instanciée (il n'est pas possible
// de créer des objets à partir de cette classe en écrivant, en l'occurrence
// new Component)
// Une classe abstraite a simplement vocation à définir une interface pour
// d'autres classes qui hériteront d'elle (à l'aide du mot-clé 'extends')
abstract class Component
{
    protected $id;
    protected $name;
    protected $price;
    protected $brandId;

    /**
     * Create new Component object
     * 
     * @param int $id Component database ID
     * @param string $name Component name
     * @param float $price Component price
     * @param int $brandId Component brand database ID
     */
    public function __construct(
        int $id = null,
        string $name = '',
        float $price = 0,
        int $brandId = null
    )
    {
        $this->id = $id;
        $this->name = $name;
        $this->price = $price;
        $this->brandId = $brandId;
    }

    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get the value of name
     */ 
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the value of name
     *
     * @return  self
     */ 
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get the value of price
     */ 
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set the value of price
     *
     * @return  self
     */ 
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get the value of brandId
     */ 
    public function getBrandId()
    {
        return $this->brandId;
    }

    /**
     * Set the value of brandId
     *
     * @return  self
     */ 
    public function setBrandId($brandId)
    {
        $this->brandId = $brandId;

        return $this;
    }

    public function getBrand()
    {
        return fetchBrandById($this->brandId);
    }
}
