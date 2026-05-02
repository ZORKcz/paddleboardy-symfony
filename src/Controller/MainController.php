<?php

    namespace App\Controller;

    use App\Repository\ProduktRepository;
    use App\Repository\StaniceRepository;
    use App\Repository\SkladovaPolozkaRepository;
    use App\Service\RezervaceManager;
    use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
    use Symfony\Component\HttpFoundation\JsonResponse;
    use Symfony\Component\HttpFoundation\Request;
    use Symfony\Component\HttpFoundation\Response;
    use Symfony\Component\Routing\Attribute\Route;
    use Symfony\Component\Mailer\MailerInterface;
    use Symfony\Component\Mime\Email;

    final class MainController extends AbstractController
    {
        #[Route('/', name: 'homepage')]
        public function index(StaniceRepository $staniceRepository): Response
        {
            $stanice = $staniceRepository->findAll();

            return $this->render('main/index.html.twig', [
                'stanice' => $stanice,
            ]);
        }

        #[Route('/rezervace', name: 'rezervace')]
        public function rezervace(StaniceRepository $staniceRepository): Response
        {
            return $this->render('main/rezervace.html.twig', [
                'stanice' => $staniceRepository->findAll(),
            ]);
        }

        #[Route('/prihlaseni', name: 'prihlaseni')]
        public function prihlaseni(): Response
        {
            return $this->render('main/prihlaseni.html.twig');
        }

        #[Route('/kontakt', name: 'kontakt')]
        public function kontakt(): Response
        {
            return $this->render('main/kontakt.html.twig');
        }

        #[Route('/api/lokality', name: 'api_lokality')]
        public  function apiLokality(StaniceRepository $staniceRepository): JsonResponse
        {
            $stanice = $staniceRepository->findAll();

            //Arraymap funguje jako foreach
            $data = array_map(fn($s) => [
                'id' => $s->getId(),
                'nazev' => $s->getNazev(),
                'gps' => $s->getGpsPozice(),
                'servisni_telefon' => $s->getServisniTelefon(),

                'adresa' =>[
                    'ulice' => $s->getAdresa()?->getUlice(),
                    'mesto' => $s->getAdresa()?->getMesto(),
                    'psc' => $s->getAdresa()?->getPsc(),
                ],

                'region' => $s->getRegion()?->getNazev(),
            ], $stanice);

            return $this->json($data);
        }

        #[Route('/api/stanice/{id}/dostupne-vybaveni', name: 'api_stanice_vybaveni')]
        public function dostupneVybaveni(int $id, SkladovaPolozkaRepository $skladovaPolozkaRepository): JsonResponse
        {
            $polozky = $skladovaPolozkaRepository->najdiDostupneProStanici($id);

            $data = array_map(function($polozka){
                $produkt = $polozka->getProdukt();

                return [
                    'skladova_polozka_id' => $polozka->getId(),
                    'nazev' => $produkt->getNazev(),
                    'popis' => $produkt->getPopis(),
                    'cena' => $produkt->getDoporucenaCena(),
                    'mnozstvi' => $polozka->getMnozstviSkladem(),
                ];

            }, $polozky);

            return $this->json($data);
        }

        #[Route('/rezervace/zpracovat', name: 'zpracovat_rezervaci', methods: ['POST'])]
        public function zpracovatRezervaci(Request $request, RezervaceManager $rezervaceManager): Response
        {
            $zakaznikId = $request->getSession()->get('zakaznik_id');

            if(!$zakaznikId){
                $this->addFlash('error', 'Pro dokonceni rezervace se musis nejprve prihlasit');
                return $this->redirectToRoute('prihlaseni');
            }

            $data = $request->request->all();

            try {
                $rezervace = $rezervaceManager->vytvorRezervaci($data, $zakaznikId);

                //TODO: Do budoucna musim sem pridat presmerovani na platebni branu

                $this->addFlash('success', 'Rezervace byla uspesne vytvorena');
                return $this->redirectToRoute('profil');
            } catch (\Exception $e) {
                $this->addFlash('error', 'Chyba pro vytvoreni rezervace: ' . $e->getMessage());
                return $this->redirectToRoute('rezervace');
            }
        }
    }
