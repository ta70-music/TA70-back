<?php

namespace App\Domain\Model\Salon;

/**
 * Interface SalonRepositoryInterface
 * @package App\Domain\Model\Salon
 */
interface SalonRepositoryInterface
{

    /**
     * @param int $salonId
     * @return Salon
     */
    public function findById(int $salonId): ?Salon;

    /**
     * @return array
     */
    public function findAll(): array;

    /**
     * @param Salon $salon
     */
    public function save(Salon $salon): void;

    /**
     * @param Salon $salon
     */
    public function delete(Salon $salon): void;

}
