<?php

namespace App\Controllers;

use App\Models\ReservationEntity;
use App\Repositories\ReservationRepository;

class ReservationController
{
    public function showReservations()
    {
        $reservationRepository = new ReservationRepository();
        return $reservationRepository->show();
    }

    public function createReservation(ReservationEntity $reservation)
    {
        $reservationRepository = new ReservationRepository();
        return $reservationRepository->create($reservation);
    }

    public function updateReservation(ReservationEntity $reservation)
    {
        $reservationRepository = new ReservationRepository();
        return $reservationRepository->update($reservation);
    }

    public function deleteReservation(ReservationEntity $reservation)
    {
        $reservationRepository = new ReservationRepository();
        return $reservationRepository->delete($reservation);
    }

    public function getOneReservation($reservationId)
    {
        $reservationRepository = new ReservationRepository();
        return $reservationRepository->getOne($reservationId);
    }

    public function getStatePercentage()
    {
        $reservationRepository = new ReservationRepository();
        return $reservationRepository->getStatePercentage();
    }
}