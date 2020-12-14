<?php
declare(strict_types=1);

namespace App\Domain\Pet;

use JsonSerializable;

class Pet implements JsonSerializable
{
    /**
     * @var int
     */
    private $petId;

    /**
     * @var string
     */
    private $petName;

    /**
     * @var string
     */
    private $breed;

    /**
     * @var int
     */
    private $age;

    /**
     * @var string
     */
    private $personality;

    /**
     * @param int  $petId
     * @param string    $petName
     * @param string    $breed
     * @param int       $age
     * @param string    $personality
     */
    public function __construct(int $petId, string $petName, string $breed, int $age, string $personality)
    {
        $this->petId = $petId;
        $this->petName = $petName;
        $this->breed = $breed;
        $this->age = $age;
        $this->personality = $personality;
    }

    /**
     * @return int
     */
    public function getPetId(): int
    {
        return $this->petId;
    }

    /**
     * @return string
     */
    public function getPetName(): string
    {
        return $this->petName;
    }

    /**
     * @return string
     */
    public function getBreed(): string
    {
        return $this->breed;
    }

    /**
     * @return int
     */
    public function getAge(): int
    {
        return $this->age;
    }

    /**
     * @return string
     */
    public function getPersonality(): string
    {
        return $this->personality;
    }

    /**
     * @return array
     */
    public function jsonSerialize()
    {
        return [
            'petId' => $this->petId,
            'petName' => $this->petName,
            'breed' => $this->breed,
            'age' => $this->age,
            'personality' => $this->personality,
        ];
    }
}
