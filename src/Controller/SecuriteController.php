<?php

namespace App\Controller;
use App\Entity\User;
use App\Entity\Partenaire;
use App\Repository\PartenaireRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\partenairePasswordEncoderInterface;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;



/**
 * @Route("/api")
 */
class SecuriteController extends AbstractController
{
     /**
     * @Route("/register", name="register", methods={"POST"})
     */
    public function register(Request $request, partenairePasswordEncoderInterface $passwordEncoder, EntityManagerInterface $entityManager)
    {
        $values = json_decode($request->getContent());
        if(isset($values->partenairename,$values->password)) {
            $partenaire = new partenaire();
            $partenaire->setpartenairename($values->partenairename);
            $partenaire->setRoles(array('ROLE_partenaire'));
            $partenaire->setPassword($passwordEncoder->encodePassword($partenaire, $values->password));
            $partenaire->setNom($values->nom);
            $partenaire->setPrenom($values->prenom);
            $partenaire->setAdresse($values->adresse);
            $partenaire->setEtatU($values->etat_u);
            $entityManager->persist($partenaire);
            $entityManager->flush();

            $data = [
                'statut' => 201,
                'mess' => 'L\'utilisateur a été créé'
            ];

            return new JsonResponse($data, 201);
        }
        $data = [
            'statut' => 500,
            'mess' => 'Vous devez renseigner les clés partenairename et password'
        ];
        return new JsonResponse($data, 500);
    }
            

    /**
     * @Route("/addP", name="partenaire", methods={"POST"})
     */
    public function addP(Request $request, EntityManagerInterface $entityManager, SerializerInterface $serializer, ValidatorInterface $validator)
    {
        $values = json_decode($request->getContent());
        if(isset($values->nompartenaire,$values->numComptP)) {
            $partenaire = new Partenaire();
            $partenaire->setNompartenaire($values->nompartenaire);
            $partenaire->setAdresse($values->adresse);
            $partenaire->setSoldeP($values->solde_p);
            $partenaire->setRaisonSociale($values->raison_sociale);
            $partenaire->setNinea($values->ninea);
            $partenaire->setEtatP($values->etat_p);
            $partenaire->setnumComptP($values->numComptP);

            $entityManager->persist($partenaire);
            $entityManager->flush();

            $data = [
                'statut' => 201,
                'mess' => 'L\'utilisateur a été créé'
            ];

            return new JsonResponse($data, 201);
        }
        $data = [
            'statut' => 500,
            'mess' => 'Vous devez renseigner les clés nompartenaire et num_compt_p'
        ];
        return new JsonResponse($data, 500);
    }
    /**
     * @Route("/login", name="login", methods={"POST"})
     */
    public function login(Request $request)
    {
        $partenaire = $this->getpartenaire();
        return $this->json([
            'partenairename' => $partenaire->getpartenairename(),
            'roles' => $partenaire->getRoles()
        ]);

        if($partenaire-getEtat_U()=="bloqué"){
            return $this->json([
                'message' => 'ACCÈS REFUSÉ'
            ]);
        }
    }
}
