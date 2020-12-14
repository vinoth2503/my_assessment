<?php
declare(strict_types=1);

namespace App\Domain\Pet;

interface PetRepository
{
    /**
     * @return Pet[]
     */
    public function findAll(): array;

    /**
     * @param int $id
     * @return array
     * @throws PetNotFoundException
     */
    public function findPetOfId(int $id): array;
    
    /**
     * findBySearchAndFilter
     *
     * @param  mixed $options
     * @return array
     */
    public function findBySearchAndFilter(array $options): array;
}
