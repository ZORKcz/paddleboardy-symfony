<?php

namespace App\Service;

use App\Entity\PolozkaRezervace;
use App\Entity\Rezervace;
use App\Repository\RezervaceRepository;
use App\Repository\SkladovaPolozkaRepository;
use App\Repository\StavRezervaceRepository;
use App\Repository\ZakaznikRepository;
use Doctrine\ORM\EntityManagerInterface;
use Exception;

class RezervaceManager
{

    public function __construct(
        private EntityManagerInterface $em,
        private SkladovaPolozkaRepository $skladRepository,
        private ZakaznikRepository $zakaznikRepository,
        private StavRezervaceRepository $stavRezervaceRepository
    )
    {}


    public function vytvorRezervaci(array $data, int $zakaznikId): Rezervace
    {
        //Nactu uzivatele
        $zakaznik = $this->zakaznikRepository->find($zakaznikId);

        if(!$zakaznik){
            throw new Exception('Zakaznik nenalezen');
        }

        $stavNova = $this->stavRezervaceRepository->find(1);
        //Zactu vytvaret rezervaci
        $rezervace = new Rezervace();
        $rezervace->setZakaznik($zakaznik);
        $rezervace->setStavRezervace($stavNova);
        $rezervace->setDatumVytvoreni(new \DateTime());

        $datumOd = new \DateTime($data['datum'] . ' ' . $data['cas']);
        $datumDo = clone $datumOd;
        $datumDo->modify('+' . $data['hodiny'] . ' hours');

        $rezervace->setDatumOd($datumOd);
        $rezervace->setDatumDo($datumDo);

        $celkovaCena = 0;

        if(!empty($data['skladova_polozka_ids'])){
            foreach ($data['skladova_polozka_ids'] as $skladovaPolozkaId){
                $skladovaPolozka = $this->skladRepository->find($skladovaPolozkaId);

                if($skladovaPolozka){
                    $polozkaRezervace = new PolozkaRezervace();
                    $polozkaRezervace->setSkladovaPolozka($skladovaPolozka);
                    $polozkaRezervace->setRezervace($rezervace);
                    $polozkaRezervace->setMnozstvi(1);

                    $cenaZaPolozku = $skladovaPolozka->getProdukt()->getDoporucenaCena() * $data['hodiny'];
                    $polozkaRezervace->setSkutecnaCena($cenaZaPolozku);

                    $celkovaCena += $cenaZaPolozku;

                    $this->em->persist($polozkaRezervace);
                }
            }
        } else {
            throw new Exception('Nebyl nalezen zadny produkt');
        }

        $rezervace->setCelkovaCena($celkovaCena);

        $this->em->persist($rezervace);
        $this->em->flush();

        return $rezervace;
    }

}
