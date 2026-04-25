<?php

namespace App\Controller;

use App\Entity\Zakaznik;
use App\Repository\ZakaznikRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Mime\Email;

class AuthController extends AbstractController
{
    #[Route('/registrace', name: 'registrace', methods: ['POST'])]
    public function registrace(
        Request $request,
        EntityManagerInterface $em,
        MailerInterface $mailer,
        ZakaznikRepository $zakaznikRepository,
    ): Response
    {
        $email = $request->request->get('email');
        $souhlas = $request->request->get('souhlas');

        if (!$souhlas)
        {
           $this->addFlash('error', 'Musíš souhlasit s podmínkami!');
           return $this->redirectToRoute('prihlaseni');
        }

        $existujiciZakaznik = $zakaznikRepository->findOneBy(['email'=>$email]);

        if ($existujiciZakaznik)
        {
            $this->addFlash('error', 'Tento e-mail je již zaregistrovaný');
            return $this->redirectToRoute('prihlaseni');
        }

        $kod = strtoupper(substr(md5(random_bytes(10)), 0, 6));

        $zakaznik = new Zakaznik();
        $zakaznik->setEmail($email);
        $zakaznik->setJmeno('');
        $zakaznik->setPrijmeni('');
        $zakaznik->setTelefon('');
        $zakaznik->setSouhlasSpodminkami(true);
        $zakaznik->setHeslo($kod);

        $em->persist($zakaznik);
        $em->flush();

        $emailZprava = (new Email())
            ->from('info@paddleboardy.cz')
            ->to($email)
            ->subject('Tvoje registrace a přihlašovací kód')
            ->html('
                <h2>Vítej na palubě!</h2>
                <p>Tvoje registrace proběhla úspěšně.</p>
                <p>Tvoje přihlašovací heslo je: <strong style="font-size: 24px; color: #4f9cf9;">' . $kod . '</strong></p>
                <p>Můžeš se rovnou přihlásit na našem webu.</p>
            ');

        $mailer->send($emailZprava);

        $this->addFlash('success', 'Registrace úspěšná! Heslo jsme ti poslali na e-mail.');
        return $this->redirectToRoute('prihlaseni');
    }

    #[Route('/prihlasit', name: 'prihlasit', methods: ['POST'])]
    public function prihlasit(
        Request $request,
        ZakaznikRepository $zakaznikRepository
    ): Response
    {
        $email = $request->request->get('email');
        $heslo = $request->request->get('heslo');

        $zakaznik = $zakaznikRepository->findOneBy([
            'email'=>$email,
            'heslo'=>$heslo
        ]);

        if (!$zakaznik)
        {
            $this->addFlash('error', 'Špatný e-mail nebo heslo!');
            return $this->redirectToRoute('prihlaseni');
        }

        $session = $request->getSession();
        $session->set('zakaznik_id', $zakaznik->getId());
        $session->set('zakaznik_email', $zakaznik->getEmail());

        $this->addFlash('success', 'Úspěšně jste se přihlásil');
        return $this->redirectToRoute('profil');
    }

    #[Route('/odhlasit', name: 'odhlasit')]
    public function odhlasit(Request $request): Response
    {
        $request->getSession()->clear();

        $this->addFlash('success', 'Byl jste úspěšně odhlášen');

        return $this->redirectToRoute('prihlaseni');
    }

    #[Route('/profil', name: 'profil')]
    public function profil(
        Request $request,
        ZakaznikRepository $zakaznikRepository
    ): Response
    {
        $zakaznikId = $request->getSession()->get('zakaznik_id');

        if(!$zakaznikId)
        {
            $this->addFlash('error', 'Pro zobrazení profilu se musíte nejdřív přihlásit');
            return $this->redirectToRoute('prihlaseni');
        }

        $zakaznik = $zakaznikRepository->find($zakaznikId);

        return $this->render('auth/profil.html.twig', [
            'zakaznik' => $zakaznik
        ]);
    }
}
