<?php

namespace App\Controllers;

use App\Models\RoomEntity;
use App\Repositories\RoomRepository;

class RoomController
{
    public function showRooms()
    {
        $roomRepository = new RoomRepository();
        return $roomRepository->show();
    }

    public function createRoom(RoomEntity $room)
    {
        $roomRepository = new RoomRepository();
        return $roomRepository->create($room);
    }

    public function updateRoom(RoomEntity $room)
    {
        $roomRepository = new RoomRepository();
        return $roomRepository->update($room);
    }

    public function deleteRoom(RoomEntity $room)
    {
        $roomRepository = new RoomRepository();
        return $roomRepository->delete($room);
    }

    public function getOneRoom($roomId)
    {
        $roomRepository = new RoomRepository();
        return $roomRepository->getOne($roomId);
    }

    public function getAllRooms()
    {
        $roomRepository = new RoomRepository();
        return $roomRepository->getAll();
    }

    public function getNumChildById($roomId)
    {
        $roomRepository = new RoomRepository();
        return $roomRepository->getNumChildById($roomId);
    }

    public function activateAvailabilityRoom($roomId){
        $roomRepository = new RoomRepository();
        return $roomRepository->activateAvailability($roomId);
    }

    public function disableAvailabilityRoom($roomId){
        $roomRepository = new RoomRepository();
        return $roomRepository->disableAvailability($roomId);
    }

    public function getAvailabilityPercentage(){
        $roomRepository = new RoomRepository();
        return $roomRepository->getAvailabilityPercentage();
    }
}