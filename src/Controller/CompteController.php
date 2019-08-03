<?php

namespace App\Controller;


use App\Entity\Compte;
use App\Entity\User;
use App\Entity\Partenaire;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/api")
 */
class CompteController extends AbstractController
{
    /**
     * @Route("/compte", name="compte", methods={"POST"})
     */
    public function register(Request $request, EntityManagerInterface $entityManager)
    {
        $values = json_decode($request->getContent());
        if(isset($values->num_compte,$values->proprio_compte)) {
            $compte = new Compte();
            $compte->setNumCompte($values->num_compte);
            $compte->setProprioCompte($values->proprio_compte);
            $compte->setDepot($values->depot);
            //relation partenaire et compte
            $repo=$this->getDoctrine()->getRepository(Partenaire::class);
            $partenair=$repo->find($values->partenaire);
            var_dump($partenair); die();
           
            $compte->setPartenaire($partenair);
            $entityManager->persist($compte);
            $entityManager->flush();

            $data = [
                'status' => 201,
                'message' => 'L\'utilisateur a été créé'
            ];

            return new JsonResponse($data, 201);
        }
        $data = [
            'status' => 500,
            'message' => 'Vous devez renseigner les clés username et password'
        ];
        return new JsonResponse($data, 500);
    }
}

