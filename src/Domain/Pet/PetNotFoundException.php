<?php
declare(strict_types=1);

namespace App\Domain\Pet;

use App\Domain\DomainException\DomainRecordNotFoundException;

class PetNotFoundException extends DomainRecordNotFoundException
{
    public $message = 'The pet you wanted does not exist.';
}
