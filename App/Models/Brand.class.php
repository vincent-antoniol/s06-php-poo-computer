<?php

final class Brand
{
    protected $id;
    protected $name;
    protected $country;

    /**
     * Create new Brand object
     * 
     * @param int $id Brand database ID
     * @param string $name Brand name
     * @param string $country Brand country
     */
    public function __construct(
        int $id = null,
        string $name = '',
        string $country = ''
    )
    {
        $this->id = $id;
        $this->name = $name;
        $this->country = $country;
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
     * Get the value of country
     */ 
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * Set the value of country
     *
     * @return  self
     */ 
    public function setCountry($country)
    {
        $this->country = $country;

        return $this;
    }
}

function createBrand($id, $name, $country) {
    return new Brand($id, $name, $country);
}

function fetchAllBrands() {
    global $databaseHandler;

    $statement = $databaseHandler->query('SELECT * FROM `brands`');
    return $statement->fetchAll(PDO::FETCH_FUNC, 'createBrand');
}
