<?php

require_once './App/Models/CpuComponent.class.php';
require_once './App/Models/GpuComponent.class.php';
require_once './App/Models/HddComponent.class.php';
require_once './App/Models/RamComponent.class.php';
require_once './App/Models/OsComponent.class.php';

final class Config
{
    protected $id;
    protected $name;
    protected $cpuId;
    protected $gpuId;
    protected $hddId;
    protected $ramId;
    protected $osId;

    public function __construct(
        int $id = null,
        string $name = '',
        int $cpuId = null,
        int $gpuId = null,
        int $hddId = null,
        int $ramId = null,
        int $osId = null
    )
    {
        $this->id = $id;
        $this->name = $name;
        $this->cpuId = $cpuId;
        $this->gpuId = $gpuId;
        $this->hddId = $hddId;
        $this->ramId = $ramId;
        $this->osId = $osId;
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

    public function getCpu(): ?CpuComponent
    {
        return fetchCpuComponentById($this->cpuId);
    }

    public function setCpu(?CpuComponent $cpu): self
    {
        $this->cpuId = $cpu->getId();

        return $this;
    }

    public function getGpu(): ?GpuComponent
    {
        return fetchGpuComponentById($this->gpuId);
    }

    public function setGpu(?GpuComponent $gpu): self
    {
        $this->gpuId = $gpu->getId();

        return $this;
    }

    public function getHdd(): ?HddComponent
    {
        return fetchHddComponentById($this->hddId);
    }

    public function setHdd(?HddComponent $hdd): self
    {
        $this->hddId = $hdd->getId();

        return $this;
    }

    public function getOs(): ?OsComponent
    {
        return fetchOsComponentById($this->osId);
    }

    public function setOs(?OsComponent $os): self
    {
        $this->osId = $os->getId();

        return $this;
    }

    public function getRam(): ?RamComponent
    {
        return fetchRamComponentById($this->ramId);
    }

    public function setRam(?RamComponent $ram): self
    {
        $this->ramId = $ram->getId();

        return $this;
    }

    public function getTotalPrice()
    {
        return
            $this->getCpu()->getPrice()
            + $this->getGpu()->getPrice()
            + $this->getHdd()->getPrice()
            + $this->getOs()->getPrice()
            + $this->getRam()->getPrice()
        ;
    }
}

function createConfig($id, $name, $cpuId, $gpuId, $hddId, $ramId, $osId) {
    return new Config($id, $name, $cpuId, $gpuId, $hddId, $ramId, $osId);
}

function fetchAllConfigs() {
    global $databaseHandler;

    $statement = $databaseHandler->query('SELECT * FROM `config`');
    return $statement->fetchAll(PDO::FETCH_FUNC, 'createConfig');
}

function fetchConfigById(int $id): ?Config {
    global $databaseHandler;

    $statement = $databaseHandler->prepare('SELECT * FROM `config` WHERE `id` = :id');
    $statement->execute([ ':id' => $id ]);
    $result = $statement->fetchAll(PDO::FETCH_FUNC, 'createConfig');
    
    if (empty($result)) {
        return null;
    }

    return $result[0];
}
