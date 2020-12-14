<?php
declare(strict_types=1);

namespace App\Domain\Location;

use JsonSerializable;

class Location implements JsonSerializable
{
    /**
     * @var int
     */
    private $locationId;

    /**
     * @var string
     */
    private $locationName;

    /**
     * @var string
     */
    private $address;

    /**
     * @var string
     */
    private $city;

    /**
     * @var string
     */
    private $state;

    /**
     * @var string
     */
    private $zip;

    /**
     * @var string
     */
    private $phone;

    /**
     * @var string
     */
    private $county;

    /**
     * @var string
     */
    private $latitude;

    /**
     * @var string
     */
    private $longitude;
    
    /**
     * __construct
     *
     * @param  mixed $locationId
     * @param  mixed $locationName
     * @param  mixed $address
     * @param  mixed $city
     * @param  mixed $state
     * @param  mixed $zip
     * @param  mixed $phone
     * @param  mixed $county
     * @param  mixed $latitude
     * @param  mixed $longitude
     * @return void
     */
    public function __construct(int $locationId, string $locationName, string $address, string $city, string $state, string $zip, string $phone, string $county, string $latitude, string $longitude)
    {
        $this->locationId = $locationId;
        $this->locationName = $locationName;
        $this->address = $address;
        $this->city = $city;
        $this->state = $state;
        $this->zip = $zip;
        $this->phone = $phone;
        $this->county = $county;
        $this->latitude = $latitude;
        $this->longitude = $longitude;
    }

    /**
     * @return int
     */
    public function getLocationId(): int
    {
        return $this->locationId;
    }

    /**
     * @return string
     */
    public function getLocationName(): string
    {
        return $this->locationName;
    }

    /**
     * @return string
     */
    public function getAddress(): string
    {
        return $this->address;
    }

    /**
     * @return string
     */
    public function getCity(): string
    {
        return $this->city;
    }

    /**
     * @return int
     */
    public function getState(): string
    {
        return $this->state;
    }

    /**
     * @return string
     */
    public function getZip(): string
    {
        return $this->zip;
    }

    /**
     * @return string
     */
    public function getPhone(): string
    {
        return $this->phone;
    }

    /**
     * @return string
     */
    public function getCounty(): string
    {
        return $this->county;
    }

    /**
     * @return string
     */
    public function getLatitude(): string
    {
        return $this->latitude;
    }

    /**
     * @return string
     */
    public function getLongitude(): string
    {
        return $this->longitude;
    }

    /**
     * @return array
     */
    public function jsonSerialize()
    {
        return [
            'locationId' => $this->locationId,
            'locationName' => $this->locationName,
            'address' => $this->address,
            'city' => $this->city,
            'state' => $this->state,
            'zip' => $this->zip,
            'phone' => $this->phone,
            'county' => $this->county,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
        ];
    }
}
