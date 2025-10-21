<?php

namespace App\Service;

use App\Entity\Type;
use App\Repository\TypeRepository;

class TypeService
{
    public function __construct(
        private TypeRepository $typeRepository,
    ){
    }

    public function getAllTypes()
    {
        return $this->typeRepository->findAll();
    }

    public function getTypes(): array
    {
        return $this->typeRepository->findAll();
    }

    public function createTypes(array $typesName): void
    {
        foreach($typesName as $typeName) {
            $this->createType($typeName);
        }
    }

    public function createType(string $typeName)
    {
        if($this->isExisting($typeName)) {
            throw new \Exception('Type already exists');
        }
        $type = (new Type())->setName($typeName);
        $this->registerType($type);
    }

    private function isExisting(string $typeName): bool
    {
        return !empty($this->typeRepository->findOneBy(['name' => $typeName]));
    }

    private function registerType(Type $type): void
    {
        $this->typeRepository->register($type);
    }
}