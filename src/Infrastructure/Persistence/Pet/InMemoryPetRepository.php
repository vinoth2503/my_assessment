<?php
declare(strict_types=1);

namespace App\Infrastructure\Persistence\Pet;

use App\Domain\Pet\Pet;
use App\Domain\Pet\PetNotFoundException;
use App\Domain\Pet\PetRepository;
use App\Config\SQLiteConnection;

class InMemoryPetRepository implements PetRepository
{
    /**
     * @var Pet[]
     */
    private $pets;

    private $db;

    /**
     * InMemoryPetRepository constructor.
     *
     * @param array|null $pets
     */
    public function __construct(array $pets = null)
    {
        $this->pets = $pets ?? [];
        $this->db = (new SQLiteConnection())->connect();
    }
    
    /**
     * findAll
     *
     * @return array
     */
    public function findAll(): array
    {
        $statement = $this->db->prepare("SELECT p.id as petId, p.name as petName, p.breed, p.age, p.personality, l.id as locationId, l.name as locationName, l.address, l.city, l.state, l.zip, l.phone, l.county, l.latitude, l.longitude FROM pets p LEFT JOIN locations l ON p.shelter_id=l.id");
        $statement->execute();
        $this->pets = $statement->fetchAll(\PDO::FETCH_ASSOC);
        return $this->pets;
    }
    
    /**
     * findPetOfId
     *
     * @param  mixed $id
     * @return array
     */
    public function findPetOfId(int $id): array
    {
        // using PHP filter
        // foreach ($this->pets['data'] as $pet) {
        //     if ($pet['petId'] === $id) {
        //         return $pet;
        //     }
        // }
        // throw new PetNotFoundException();
        $statement = $this->db->prepare("SELECT p.id as petId, p.name as petName, p.breed, p.age, p.personality, l.id as locationId, l.name as locationName, l.address, l.city, l.state, l.zip, l.phone, l.county, l.latitude, l.longitude FROM pets p LEFT JOIN locations l ON p.shelter_id=l.id WHERE p.id=:id");
        $statement->execute(['id' => $id]);
        $pet = $statement->fetch(\PDO::FETCH_ASSOC);
        if ($pet) {
            return $pet;
        } else {
            throw new PetNotFoundException();
        }
    }

    public function findBySearchAndFilter(array $options): array
    {
        $execArr = [];
        // print_r($options); die;
        $sql = "SELECT p.id as petId, p.name as petName, p.breed, p.age, p.personality, l.id as locationId, l.name as locationName, l.address, l.city, l.state, l.zip, l.phone, l.county, l.latitude, l.longitude FROM pets p LEFT JOIN locations l ON p.shelter_id=l.id";
        if (isset($options['breed'])) {
            $sql .= (count($execArr) > 0) ? " AND p.breed=:breed" : " WHERE p.breed=:breed";
            $execArr['breed'] = $options['breed'];
        }
        if (isset($options['age'])) {
            $sql .= (count($execArr) > 0) ? " AND p.age=:age" : " WHERE p.age=:age";
            $execArr['age'] = $options['age'];
        }
        if (isset($options['personality'])) {
            $sql .= (count($execArr) > 0) ? " AND p.personality=:personality" : " WHERE p.personality=:personality";
            $execArr['personality'] = $options['personality'];
        }
        if (isset($options['city'])) {
            $sql .= (count($execArr) > 0) ? " AND l.city=:city" : " WHERE l.city=:city";
            $execArr['city'] = $options['city'];
        }
        if (isset($options['state'])) {
            $sql .= (count($execArr) > 0) ? " AND l.state=:state" : " WHERE l.state=:state";
            $execArr['state'] = $options['state'];
        }
        if (isset($options['county'])) {
            $sql .= (count($execArr) > 0) ? " AND l.county=:county" : " WHERE l.county=:county";
            $execArr['county'] = $options['county'];
        }
        if (isset($options['zip'])) {
            $sql .= (count($execArr) > 0) ? " AND l.zip=:zip" : " WHERE l.zip=:zip";
            $execArr['zip'] = $options['zip'];
        }
        if (isset($options['search_term'])) {
            $sql .= (count($execArr) > 0) ? " AND" : " WHERE";
            $sql .= " LOWER(p.name) like '%:term%' OR LOWER(p.breed) like '%:term%' OR LOWER(p.personality) like '%:term%', OR LOWER(l.name) like '%:term%' OR LOWER(l.address) like '%:term%' OR LOWER(l.city) like '%:term%' OR LOWER(l.state) like '%:term%' OR LOWER(l.zip) like '%:term%'";
            $execArr['search_term'] = $options['search_term'];
        }
        if (isset($options['sort_by'])) {
            $sql .= " ORDER BY";
            $sql .= ($options['sort_by'] === 'id') ? " p.id" : ($options['sort_by'] === 'name') ? " p.name" : ($options['sort_by'] === 'age') ? " p.age" : ($options['sort_by'] === 'breed') ? " p.breed" : ($options['sort_by'] === 'personality') ? " p.personality" : ($options['sort_by'] === 'city') ? " l.city" : ($options['sort_by'] === 'state') ? " l.state" : ($options['sort_by'] === 'zip') ? " l.zip" : ($options['sort_by'] === 'county') ? " l.county" : " id";
            if (isset($options['sort_method'])) {
                $sql .= ($options['sort_method'] === 'ascending') ? 'ASC' : (($options['sort_method'] === 'descending') ? ' DESC' : ' ASC');
            }
        }

        $statement = $this->db->prepare($sql);
        $statement->execute($execArr);
        $this->pets = $statement->fetchAll(\PDO::FETCH_ASSOC);
        if ($this->pets) {
            return $this->pets;
        } else {
            throw new PetNotFoundException();
        }
    }

}
