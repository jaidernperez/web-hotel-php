<?php

namespace App\Controllers;

use App\Models\PersonEntity;
use App\Repositories\PersonRepository;

class PersonController
{
    public function showPersons()
    {
        $personRepository = new PersonRepository();
        return $personRepository->show();
    }

    public function createPerson(PersonEntity $person)
    {
        $personRepository = new PersonRepository();
        return $personRepository->create($person);
    }

    public function updatePerson(PersonEntity $person)
    {
        $personRepository = new PersonRepository();
        return $personRepository->update($person);
    }

    public function deletePerson(PersonEntity $person)
    {
        $personRepository = new PersonRepository();
        return $personRepository->delete($person);
    }

    public function getOnePerson($personId)
    {
        $personRepository = new PersonRepository();
        return $personRepository->getOne($personId);
    }

    public function getAllPersons()
    {
        $personRepository = new PersonRepository();
        return $personRepository->getAll();
    }

    public function getNumChildById($personId)
    {
        $personRepository = new PersonRepository();
        return $personRepository->getNumChildById($personId);
    }

    public function getPersonNumber()
    {
        $personRepository = new PersonRepository();
        return $personRepository->getPersonNumber();
    }

    public function isUniqueDniAndEmail($dni, $email)
    {
        $personRepository = new PersonRepository();
        return $personRepository->isUniqueDniAndEmail($dni, $email);
    }
}