<?php

namespace App\Controller;

use App\Entity\Cafetiere;
use App\Form\CafetiereType;
use App\Repository\CafetiereRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/cafetiere')]
class CafetiereController extends AbstractController
{
    #[Route('/', name: 'app_cafetiere_index', methods: ['GET'])]
    public function index(CafetiereRepository $cafetiereRepository): Response
    {
        return $this->render('cafetiere/index.html.twig', [
            'cafetieres' => $cafetiereRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_cafetiere_new', methods: ['GET', 'POST'])]
    public function new(Request $request, CafetiereRepository $cafetiereRepository): Response
    {
        $cafetiere = new Cafetiere();
        $form = $this->createForm(CafetiereType::class, $cafetiere);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $cafetiereRepository->save($cafetiere, true);

            return $this->redirectToRoute('app_cafetiere_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('cafetiere/new.html.twig', [
            'cafetiere' => $cafetiere,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_cafetiere_show', methods: ['GET'])]
    public function show(Cafetiere $cafetiere): Response
    {
        return $this->render('cafetiere/show.html.twig', [
            'cafetiere' => $cafetiere,
        ]);
    }

    
    #[Route('/light/{id}', name: 'app_cafetiere_light')]
    public function lightAction(Cafetiere $cafetiere, CafetiereRepository $cafetiereRepository): Response
    {
       $cafetiere->setIsOn($cafetiere->getIsOn() == false ? true : false);

       $cafetiereRepository->save($cafetiere, true);
       return $this->redirectToRoute('app_cafetiere_index');
    }

    #[Route('/dosette/{id}', name: 'app_cafetiere_dosette')]
    public function dosetteAction(Cafetiere $cafetiere, CafetiereRepository $cafetiereRepository): Response
    {
       $cafetiere->setDosettes($cafetiere->getDosettes() == 0 ? 1 : 0);
       

       $cafetiereRepository->save($cafetiere, 1);
       return $this->redirectToRoute('app_cafetiere_index');
    }

    #[Route('/{id}/edit', name: 'app_cafetiere_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Cafetiere $cafetiere, CafetiereRepository $cafetiereRepository): Response
    {
        $form = $this->createForm(CafetiereType::class, $cafetiere);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $cafetiereRepository->save($cafetiere, true);

            return $this->redirectToRoute('app_cafetiere_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('cafetiere/edit.html.twig', [
            'cafetiere' => $cafetiere,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_cafetiere_delete', methods: ['POST'])]
    public function delete(Request $request, Cafetiere $cafetiere, CafetiereRepository $cafetiereRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$cafetiere->getId(), $request->request->get('_token'))) {
            $cafetiereRepository->remove($cafetiere, true);
        }

        return $this->redirectToRoute('app_cafetiere_index', [], Response::HTTP_SEE_OTHER);
    }
}