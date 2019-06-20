<?php


namespace App\Application\DTO;


use App\Domain\Model\Salon\Salon;

/**
 * Class SalonAssembler
 * @package App\Application\DTO
 */
final class SalonAssembler
{

    /**
     * @param SalonDTO $salonDTO
     * @param Salon|null $salon
     * @return Salon
     */
    public function readDTO(SalonDTO $salonDTO, ?Salon $salon = null): Salon
    {
        if (!$salon) {
            $salon = new Salon();
        }

        $salon->setContent($salonDTO->getContent());
        $salon->setTitle($salonDTO->getTitle());

        return $salon;
    }

    /**
     * @param Salon $salon
     * @param SalonDTO $salonDTO
     * @return Salon
     */
    public function updateSalon(Salon $salon, SalonDTO $salonDTO): Salon
    {
        return $this->readDTO($salonDTO, $salon);
    }

    /**
     * @param SalonDTO $salonDTO
     * @return Salon
     */
    public function createSalon(SalonDTO $salonDTO): Salon
    {
        return $this->readDTO($salonDTO);
    }

    /**
     * @param Salon $salon
     * @return SalonDTO
     */
    public function writeDTO(Salon $salon)
    {
        return new SalonDTO(
            $salon->getTitle(),
            $salon->getContent()
        );
    }

}
