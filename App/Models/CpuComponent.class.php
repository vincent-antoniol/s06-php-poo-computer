<?php

// Le mot-clé 'require' permet de demander à PHP de produire une erreur fatale
// si jamais le fichier demandé n'est pas trouvé (par opposition à 'include' qui
// se contente de produire un avertissement, et qui essaie d'exécuter le reste
// du code)
// 'require_once' permet d'éviter que PHP tente de charger le même fichier 2 fois,
// sinon on peut rencontrer une erreur nous disant que le nom de classe est déjà
// utilisé
require_once './App/Models/Component.class.php';

// Le mot-clé 'extends' permet de spécifier qu'une classe hérite d'une autre
// Une classe-fille hérite de toutes les propriétés et toutes les méthodes
// 'public' ou 'protected' de sa classe-mère, comme si elles étaient les siennes
// Une instance d'une classe-fille est aussi considérée comme une instance de
// sa classe-mère (ici, un objet de type CpuComponent est aussi considéré comme
// un objet de type Component)

// Le mot-clé 'final' permet de spécifier qu'une classe n'a pas vocation à être
// dérivée
// En l'occurrence, si on essaie de créer une nouvelle classe pour laquelle on
// précise 'extends CpuComponent', PHP renverra un message d'erreur
final class CpuComponent extends Component
{
    protected $clock;
    protected $cores;

    // Si une méthode de la classe-fille porte le même nom qu'une méthode de la
    // classe-mère, alors cette méthode "écrase" celle de la classe-mère
    // Ici, si CpuComponent n'avait pas de constructeur, elle réutiliserait celui
    // de Component tel quel; mais en l'occurrence, elle a son propre constructeur
    // qui remplace celui de sa classe-mère

    /**
     * Create a new CpuComponent object
     * 
     * @param int $id CPU database ID
     * @param string $name CPU name
     * @param float $price CPU price
     * @param int $brandId CPU brand database ID
     * @param int $clock CPU frequency
     * @param int $cores CPU cores count
     */
    public function __construct(
        int $id = null,
        string $name = '',
        float $price = 0,
        int $brandId = null,
        int $clock = 0,
        int $cores = 0
    )
    {
        // Il est possible pour une classe-fille de réutiliser la logique définie
        // dans sa classe-mère
        // Ici, le constructeur de CpuComponent appelle le constructeur de Component
        // avant de rajouter sa propre logique
        // Au final, c'est bien le constructeur de CpuComponent qui est appelé,
        // mais celui-ci *inclut* explicitement un appel au constructeur de Component,
        // ce qui fait que les deux constructeurs sont appelés successivement
        parent::__construct(
            $id,
            $name,
            $price,
            $brandId
        );

        $this->clock = $clock;
        $this->cores = $cores;
    }

    /**
     * Get the value of clock
     */ 
    public function getClock()
    {
        return $this->clock;
    }

    /**
     * Set the value of clock
     *
     * @return  self
     */ 
    public function setClock($clock)
    {
        $this->clock = $clock;

        return $this;
    }

    /**
     * Get the value of cores
     */ 
    public function getCores()
    {
        return $this->cores;
    }

    /**
     * Set the value of cores
     *
     * @return  self
     */ 
    public function setCores($cores)
    {
        $this->cores = $cores;

        return $this;
    }
}

function createCpuComponent($id, $name, $price, $brandId, $clock, $cores) {
    return new CpuComponent($id, $name, $price, $brandId, $clock, $cores);
}

function fetchAllCpuComponents() {
    // Le mot-clé 'global' permet d'indiquer à PHP que le nom de variable donné
    // correspond à une variable déclarée en-dehors de la portée de la fonction
    // actuelle
    // Sinon, par défaut, $databaseHandler serait une variable qui serait détruite
    // dès que la fonction se termine
    global $databaseHandler;

    // Exécute la requête permettant de récupérer l'ensemble des processeurs
    // dans la base de données
    $statement = $databaseHandler->query('SELECT * FROM `cpus`');
    // Récupère tous les éléments de la réponse à la requête, en passant chaque
    // enregistrement comme série d'arguments à la fonction désignée
    // En l'occurrence, pour chaque enregistrement issue de la table 'cpus',
    // PHP va exécuter:
    // createCpuComponent(<id>, <name>, <price>, ...)
    return $statement->fetchAll(PDO::FETCH_FUNC, 'createCpuComponent');
}

function fetchCpuComponentById(int $id): ?CpuComponent {
    global $databaseHandler;

    $statement = $databaseHandler->prepare('SELECT * FROM `cpus` WHERE `id` = :id');
    $statement->execute([ ':id' => $id ]);
    $result = $statement->fetchAll(PDO::FETCH_FUNC, 'createCpuComponent');
    
    if (empty($result)) {
        return null;
    }

    return $result[0];
}
