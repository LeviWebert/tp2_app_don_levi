<?php

namespace App\Controller;

use App\Entity\Campagne;
use App\Entity\PromesseDeDon;
use App\Form\CampagneType;
use App\Form\PromesseDeDonType;
use App\Repository\CampagneRepository;
use App\Repository\DonateurRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/campagne')]
class CampagneController extends AbstractController
{
    #[Route('/', name: 'app_campagne_index', methods: ['GET'])]
    public function index(CampagneRepository $campagneRepository): Response
    {
        return $this->render('front/campagne/index.html.twig', [
            'campagnes' => $campagneRepository->findAll(),
        ]);
    }

    #[Route('/profile/new', name: 'app_campagne_new', methods: ['GET', 'POST'])]
    public function new(Request $request, CampagneRepository $campagneRepository): Response
    {
        $campagne = new Campagne();
        $form = $this->createForm(CampagneType::class, $campagne);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $campagneRepository->save($campagne, true);

            return $this->redirectToRoute('app_campagne_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('front/campagne/new.html.twig', [
            'campagne' => $campagne,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_campagne_show', methods: ['GET'])]
    public function show(Campagne $campagne,CampagneRepository $campagneRepository,Request $request): Response
    {
        return $this->render('front/campagne/show.html.twig', [
            'campagne' => $campagne,
            'promesse_de_dons' => $campagneRepository->find($campagne->getId())->getPromesseDeDons()
        ]);
    }

    #[Route('/profile/{id}/edit', name: 'app_campagne_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Campagne $campagne, CampagneRepository $campagneRepository): Response
    {
        $form = $this->createForm(CampagneType::class, $campagne);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $campagneRepository->save($campagne, true);

            return $this->redirectToRoute('app_campagne_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('front/campagne/edit.html.twig', [
            'campagne' => $campagne,
            'form' => $form,
        ]);
    }

    #[Route('/profile/{id}', name: 'app_campagne_delete', methods: ['POST'])]
    public function delete(Request $request, Campagne $campagne, CampagneRepository $campagneRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$campagne->getId(), $request->request->get('_token'))) {
            $campagneRepository->remove($campagne, true);
        }

        return $this->redirectToRoute('app_campagne_index', [], Response::HTTP_SEE_OTHER);
    }
    #[Route('/{id}/promesse', name: 'campagne_promesse', methods: ['GET'])]
    public function promesse(CampagneRepository $campagneRepository, Campagne $campagne): Response
    {
        return $this->render('front/campagne/promesseCampagne.html.twig', [
            'promesse_de_dons' => $campagneRepository->find($campagne->getId())->getPromesseDeDons(),
            'campagne' => $campagne
        ]);
    }
    #[Route('/{id}/newPromesse', name: 'app_promesse_de_don_campagne_new', methods: ['GET', 'POST'])]
    public function newPromesse(Request $request, DonateurRepository $donateurRepository, Campagne $campagne,UserRepository $userRepository): Response
    {
        $form = $this->createForm(PromesseDeDonType::class);
        $promesseDeDon = new PromesseDeDon();
        $promesseDeDon->setCampagne($campagne);
        //if($this->getUser()!=null)
        //{
        //    $promesseDeDon->setFirstName($userRepository->find($this->getUser()->getUserIdentifier()))->setLastName($userRepository->find($this->getUser()->getUserIdentifier())->getLastName());
        //}

        $form->handleRequest($request);
        $form->setData($promesseDeDon);
        if ($form->isSubmitted() && $form->isValid()) {
            $donateurRepository->save();

            return $this->redirectToRoute('campagne_promesse', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('front/promesse_de_don/new.html.twig', [
            'form' => $form,
            'campagne' => $campagne
        ]);
    }
}
