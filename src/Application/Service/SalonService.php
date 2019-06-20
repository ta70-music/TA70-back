<?php

namespace App\Application\Service;


use App\Application\DTO\SalonAssembler;
use App\Application\DTO\SalonDTO;
use App\Domain\Model\Salon\Salon;
use App\Domain\Model\Salon\SalonRepositoryInterface;
use Doctrine\ORM\EntityNotFoundException;

/**
 * Class SalonService
 * @package App\Application\Service
 */
final class SalonService
{

    /**
     * @var SalonRepositoryInterface
     */
    private $salonRepository;

    /**
     * @var SalonAssembler
     */
    private $salonAssembler;

    /**
     * SalonService constructor.
     * @param SalonRepositoryInterface $salonRepository
     * @param SalonAssembler $salonAssembler
     */
    public function __construct(
        SalonRepositoryInterface $salonRepository,
        SalonAssembler $salonAssembler
    ) {
        $this->salonRepository = $salonRepository;
        $this->salonAssembler = $salonAssembler;
    }

    /**
     * @param int $salonId
     * @return Salon
     * @throws EntityNotFoundException
     */
    public function getSalon(int $salonId): Salon
    {
        $salon = $this->salonRepository->findById($salonId);
        if (!$salon) {
            throw new EntityNotFoundException('Salon with id '.$salonId.' does not exist!');
        }
        return $salon;
    }

    /**
     * @return array|null
     */
    public function getAllSalons(): ?array
    {
        return $this->salonRepository->findAll();
    }

    /**
     * @param SalonDTO $salonDTO
     * @return Salon
     */
    public function addSalon(SalonDTO $salonDTO): Salon
    {
        $salon = $this->salonAssembler->createSalon($salonDTO);
        $this->salonRepository->save($salon);

        return $salon;
    }

    /**
     * @param int $salonId
     * @param SalonDTO $salonDTO
     * @return Salon
     * @throws EntityNotFoundException
     */
    public function updateSalon(int $salonId, SalonDTO $salonDTO): Salon
    {
        $salon = $this->salonRepository->findById($salonId);
        if (!$salon) {
            throw new EntityNotFoundException('Salon with id '.$salonId.' does not exist!');
        }
        $salon = $this->salonAssembler->updateSalon($salon, $salonDTO);
        $this->salonRepository->save($salon);

        return $salon;
    }

    /**
     * @param int $salonId
     * @throws EntityNotFoundException
     */
    public function deleteSalon(int $salonId): void
    {
        $salon = $this->salonRepository->findById($salonId);
        if (!$salon) {
            throw new EntityNotFoundException('Salon with id '.$salonId.' does not exist!');
        }

        $this->salonRepository->delete($salon);
    }

}
