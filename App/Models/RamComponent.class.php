<?php

require_once './App/Models/Component.class.php';

final class RamComponent extends Component
{
    protected $chipsetSize;
    protected $chipsetCount;

    /**
     * Create a new RamComponent object
     * 
     * @param int $id RAM database ID
     * @param string $name RAM name
     * @param float $price RAM price
     * @param int $brandId RAM brand database ID
     * @param int $chipsetSize RAM individual chipset capacity
     * @param int $chipsetCount RAM chipset count
     */
    public function __construct(
        int $id = null,
        string $name = '',
        float $price = 0,
        int $brandId = null,
        int $chipsetSize = 0,
        int $chipsetCount = 0
    )
    {
        parent::__construct(
            $id,
            $name,
            $price,
            $brandId
        );

        $this->chipsetSize = $chipsetSize;
        $this->chipsetCount = $chipsetCount;
    }

    /**
     * Get the value of chipsetSize
     */ 
    public function getChipsetSize()
    {
        return $this->chipsetSize;
    }

    /**
     * Set the value of chipsetSize
     *
     * @return  self
     */ 
    public function setChipsetSize($chipsetSize)
    {
        $this->chipsetSize = $chipsetSize;

        return $this;
    }

    /**
     * Get the value of chipsetCount
     */ 
    public function getChipsetCount()
    {
        return $this->chipsetCount;
    }

    /**
     * Set the value of chipsetCount
     *
     * @return  self
     */ 
    public function setChipsetCount($chipsetCount)
    {
        $this->chipsetCount = $chipsetCount;

        return $this;
    }
}

function createRamComponent($id, $name, $price, $brandId, $chipsetSize, $chipsetCount) {
    return new RamComponent($id, $name, $price, $brandId, $chipsetSize, $chipsetCount);
}

function fetchAllRamComponents() {
    global $databaseHandler;

    $statement = $databaseHandler->query('SELECT * FROM `rams`');
    return $statement->fetchAll(PDO::FETCH_FUNC, 'createRamComponent');
}
