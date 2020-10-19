<?php

require_once './App/Models/Component.class.php';

final class HddComponent extends Component
{
    protected $size;
    protected $type;

    /**
     * Create a new HddComponent object
     * 
     * @param int $id HDD database ID
     * @param string $name HDD name
     * @param float $price CPU price
     * @param int $brandId HDD brand database ID
     * @param int $size HDD capacity
     * @param int $type HDD type (0 = HDD, 1 = SSD)
     */
    public function __construct(
        int $id = null,
        string $name = '',
        float $price = 0,
        int $brandId = null,
        int $size = 0,
        int $type = 0
    )
    {
        parent::__construct(
            $id,
            $name,
            $price,
            $brandId
        );

        $this->size = $size;
        $this->type = $type;
    }

    /**
     * Get the value of size
     */ 
    public function getSize()
    {
        return $this->size;
    }

    /**
     * Set the value of size
     *
     * @return  self
     */ 
    public function setSize($size)
    {
        $this->size = $size;

        return $this;
    }

    /**
     * Get the value of type
     */ 
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set the value of type
     *
     * @return  self
     */ 
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }
}

function createHddComponent($id, $name, $price, $brandId, $size, $type) {
    return new HddComponent($id, $name, $price, $brandId, $size, $type);
}

function fetchAllHddComponents() {
    global $databaseHandler;

    $statement = $databaseHandler->query('SELECT * FROM `hdds`');
    return $statement->fetchAll(PDO::FETCH_FUNC, 'createHddComponent');
}
