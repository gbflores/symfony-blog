<?php

namespace App\Controller;
use App\Repository\NewsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class NewController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(NewsRepository $newRepository): Response
    {
        $lastNews = $newRepository->findBy([], ['datepublished' => 'DESC']);

        $newDetail = null;
        $otherNews = [];

        if (!empty($lastNews)) {
            $newDetail = array_shift($lastNews);
            $otherNews = $lastNews;
        }

        return $this->render('new/index.html.twig', [
            'newDetail' => $newDetail,
            'otherNews' => $otherNews,
        ]);
    }

    #[Route('/new/{id}', name: 'app_new_detail')]
    public function detail(int $id, NewsRepository $newRepository): Response
    {
        $new = $newRepository->find($id);
        $otherNews = $newRepository->createQueryBuilder('n')
            ->where('n.id != :id')
            ->setParameter('id', $id)
            ->orderBy('n.datepublished', 'DESC')
            ->getQuery()
            ->getResult();

        if (!$new) {
            throw $this->createNotFoundException('Notícia não encontrada');
        }

        return $this->render('new/detail.html.twig', [
            'new' => $new,
            'otherNews' => $otherNews,
        ]);
    }
}
