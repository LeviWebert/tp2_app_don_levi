<?php

namespace App\Controller;

use App\Entity\PromesseDeDon;
use App\Form\PromesseDeDonType;
use App\Repository\DonateurRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/promesse/de/don')]
class PromesseDeDonController extends AbstractController
{
    #[Route('/', name: 'app_promesse_de_don_index', methods: ['GET'])]
    public function index(DonateurRepository $donateurRepository): Response
    {
        return $this->render('front/promesse_de_don/index.html.twig', [
            'promesse_de_dons' => $donateurRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_promesse_de_don_new', methods: ['GET', 'POST'])]
    public function new(Request $request, DonateurRepository $donateurRepository): Response
    {
        $promesseDeDon = new PromesseDeDon();
        $form = $this->createForm(PromesseDeDonType::class, $promesseDeDon);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $donateurRepository->save($promesseDeDon, true);

            return $this->redirectToRoute('app_promesse_de_don_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('front/promesse_de_don/new.html.twig', [
            'promesse_de_don' => $promesseDeDon,
            'form' => $form
        ]);
    }

    #[Route('/{id}', name: 'app_promesse_de_don_show', methods: ['GET'])]
    public function show(PromesseDeDon $promesseDeDon): Response
    {
        $campagne=$promesseDeDon->getCampagne();
        return $this->render('front/promesse_de_don/show.html.twig', [
            'promesse_de_don' => $promesseDeDon,
            'campagne' => $campagne
        ]);
    }

    #[Route('/{id}/edit', name: 'app_promesse_de_don_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, PromesseDeDon $promesseDeDon, DonateurRepository $donateurRepository): Response
    {
        $campagne = $promesseDeDon->getCampagne();
        $form = $this->createForm(PromesseDeDonType::class, $promesseDeDon);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $donateurRepository->save($promesseDeDon, true);

            return $this->redirectToRoute('app_promesse_de_don_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('front/promesse_de_don/edit.html.twig', [
            'promesse_de_don' => $promesseDeDon,
            'form' => $form,
            'campagne' => $campagne
        ]);
    }

    #[Route('/{id}', name: 'app_promesse_de_don_delete', methods: ['POST'])]
    public function delete(Request $request, PromesseDeDon $promesseDeDon, DonateurRepository $donateurRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$promesseDeDon->getId(), $request->request->get('_token'))) {
            $donateurRepository->remove($promesseDeDon, true);
        }

        return $this->redirectToRoute('app_promesse_de_don_index', [], Response::HTTP_SEE_OTHER);
    }

}
