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
     * Save current object's properties in database
     */
    public function save()
    {
        // Si la configuration n'existe pas encore dans la base de données
        if (is_null($this->id)) {
            // Enregistre une nouvelle configuration en base de données
            $this->create();
        } else {
            // Modifie la configuration déjà existante en base de données
            $this->update();
        }
    }

    /**
     * Create a new record in database based on this object's properties
     */
    protected function create()
    {
        global $databaseHandler;

        $statement = $databaseHandler->prepare('
            INSERT INTO `config` (
                `name`,
                `cpu_id`,
                `gpu_id`,
                `hdd_id`,
                `ram_id`,
                `os_id`
            )
            VALUES (
                :name,
                :cpu_id,
                :gpu_id,
                :hdd_id,
                :ram_id,
                :os_id
            )
        ');
        $statement->execute([
            ':name' => $this->name,
            ':cpu_id' => $this->cpuId,
            ':gpu_id' => $this->gpuId,
            ':hdd_id' => $this->hddId,
            ':ram_id' => $this->ramId,
            ':os_id' => $this->osId,
        ]);
    }

    /**
     * Update existing record in database based on this object's properties
     */
    protected function update()
    {
        global $databaseHandler;

        $statement = $databaseHandler->prepare('
            UPDATE `config`
            SET
                `name` = :name,
                `cpu_id` = :cpu_id,
                `gpu_id` = :gpu_id,
                `hdd_id` = :hdd_id,
                `ram_id` = :ram_id,
                `os_id` = :os_id
            WHERE `id` = :id;
        ');
        $statement->execute([
            ':id' => $this->id,
            ':name' => $this->name,
            ':cpu_id' => $this->cpuId,
            ':gpu_id' => $this->gpuId,
            ':hdd_id' => $this->hddId,
            ':ram_id' => $this->ramId,
            ':os_id' => $this->osId,
        ]);
    }

    /**
     * Delete matching database record
     */
    public function delete()
    {
        global $databaseHandler;

        $databaseHandler->exec('DELETE FROM `config` WHERE `id` = ' . $this->id);
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
        if (is_null($this->osId)) {
            return null;
        }

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
        $totalPrice = 
            $this->getCpu()->getPrice()
            + $this->getGpu()->getPrice()
            + $this->getHdd()->getPrice()
            + $this->getRam()->getPrice()
        ;

        $os = $this->getOs();
        if (!is_null($os)) {
            $totalPrice += $os->getPrice();
        }

        return $totalPrice;
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
