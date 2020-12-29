<?php

namespace App\Controllers;

use App\Models\RoomTypeEntity;
use App\Repositories\RoomTypeRepository;

class RoomTypeController
{
    public function showRoomTypes()
    {
        $roomTypeRepository = new RoomTypeRepository();
        return $roomTypeRepository->show();
    }

    public function getOneRoomType($roomTypeId)
    {
        $roomTypeRepository = new RoomTypeRepository();
        return $roomTypeRepository->getOne($roomTypeId);
    }
}