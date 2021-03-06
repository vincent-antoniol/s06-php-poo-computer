<?php

require_once './App/Models/Component.class.php';

final class GpuComponent extends Component
{
    protected $ram;

    /**
     * Create a new GpuComponent object
     * 
     * @param int $id GPU database ID
     * @param string $name GPU name
     * @param float $price GPU price
     * @param int $brandId GPU brand database ID
     * @param int $ran GPU RAM capacity
     */
    public function __construct(
        int $id = null,
        string $name = '',
        float $price = 0,
        int $brandId = null,
        int $ram = 0
    )
    {
        parent::__construct(
            $id,
            $name,
            $price,
            $brandId
        );

        $this->ram = $ram;
    }

    /**
     * Get the value of ram
     */ 
    public function getRam()
    {
        return $this->ram;
    }

    /**
     * Set the value of ram
     *
     * @return  self
     */ 
    public function setRam($ram)
    {
        $this->ram = $ram;

        return $this;
    }
}

function createGpuComponent($id, $name, $price, $brandId, $ram) {
    return new GpuComponent($id, $name, $price, $brandId, $ram);
}

function fetchAllGpuComponents() {
    global $databaseHandler;

    $statement = $databaseHandler->query('SELECT * FROM `gpus`');
    return $statement->fetchAll(PDO::FETCH_FUNC, 'createGpuComponent');
}

function fetchGpuComponentById(int $id): ?GpuComponent {
    global $databaseHandler;

    $statement = $databaseHandler->prepare('SELECT * FROM `gpus` WHERE `id` = :id');
    $statement->execute([ ':id' => $id ]);
    $result = $statement->fetchAll(PDO::FETCH_FUNC, 'createGpuComponent');
    
    if (empty($result)) {
        return null;
    }

    return $result[0];
}
