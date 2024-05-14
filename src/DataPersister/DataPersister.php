<?php
namespace App\DataPersister;

use ApiPlatform\Core\DataPersister\ContextAwareDataPersisterInterface; // Make sure the correct namespace is used
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface; // Import the new interface

class UserDataPersister implements ContextAwareDataPersisterInterface
{
    private $entityManager;
    private $passwordHasher; // Update the property

    public function __construct(EntityManagerInterface $entityManager, UserPasswordHasherInterface $passwordHasher) // Update the typehint
    {
        $this->entityManager = $entityManager;
        $this->passwordHasher = $passwordHasher; // Update the property name
    }

    public function supports($data, array $context = []): bool
    {
        return $data instanceof User;
    }

    public function persist($data, array $context = [])
    {
        if ($data->getPlainPassword()) {
            $hashedPassword = $this->passwordHasher->hashPassword($data, $data->getPlainPassword()); // Use hashPassword method
            $data->setPassword($hashedPassword);
            $data->eraseCredentials();
        }

        $this->entityManager->persist($data);
        $this->entityManager->flush();
    }

    public function remove($data, array $context = [])
    {
        $this->entityManager->remove($data);
        $this->entityManager->flush();
    }
}
