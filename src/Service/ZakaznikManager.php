<?php

namespace App\Service;

use App\Entity\Zakaznik;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Log\LoggerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class ZakaznikManager
{
    private EntityManagerInterface $em;
    private ValidatorInterface $validator;

    public function __construct(EntityManagerInterface $em, ValidatorInterface $validator, LoggerInterface $logger){
        $this->em = $em;
        $this->validator = $validator;
    }

    public function aktualizujProfil(Zakaznik $zakaznik, array $data): array
    {
        $zakaznik->setJmeno($data['jmeno'] ?? $zakaznik->getJmeno());
        $zakaznik->setPrijmeni($data['prijmeni'] ?? $zakaznik->getPrijmeni());
        $zakaznik->setTelefon($data['telefon'] ?? $zakaznik->getTelefon());
        $zakaznik->setPoznamka($data['poznamka'] ?? $zakaznik->getPoznamka());
        $zakaznik->setEmail($data['email'] ?? $zakaznik->getEmail());

        $chyby = $this->validator->validate($zakaznik);

        if($chyby->count() > 0){
            $chyboveHlasky = [];
            foreach($chyby as $chyba){
                $chyboveHlasky[] = $chyba->getMessage();
            }
            return $chyboveHlasky;
        }

        $this->em->flush();

        return [];
    }

}
