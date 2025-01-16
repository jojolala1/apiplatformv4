<?php

namespace App\State;

use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProcessorInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\DependencyInjection\Attribute\Autowire;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class InsertUserProcessor implements ProcessorInterface
{
    public function __construct(private UserPasswordHasherInterface $userPasswordHasherInterface,
     private EntityManagerInterface $em, 
     //#[Autowire(service:'api_platform.doctrine.orm.state.persist_processor')]
     private ProcessorInterface $processorInterface,
    ) {

    }
    public function process(mixed $data, Operation $operation, array $uriVariables = [], array $context = [])
    {
        $hashedPassword = $this->userPasswordHasherInterface->hashPassword($data,$data->getPassword());
        $data->setPassword($hashedPassword);

        return $this->processorInterface->process( $data, $operation, $uriVariables, $context);
        // $this->em->persist($data);
        // $this->em->flush();

        //return $data;
    }
}
