<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;
use App\Entity\Program;

use App\Form\RegiterType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
class UserController extends AbstractController
{
    
    public function register()
    { 
        $em = $this->getDoctrine()->getManager();
        $programs = $this->getDoctrine()->getRepository(Program::class);
        $programs = $programs->findAll();
        
        return $this->render('user/register.html.twig', [
           'programs'=>$programs,
           'registrado'=>"no"
        ]);
    }
    public function saveUser(Request $request, UserPasswordEncoderInterface $encoder){
        $programs = $this->getDoctrine()->getRepository(Program::class);
        $programs = $programs->findAll();
        $userValid = $this->getDoctrine()->getRepository(User::class);
        $userValidE = $userValid->findOneBy(["email"=>$request->request->all()["email"]]);
        $userValidP = $userValid->findOneBy(["phone"=>$request->request->all()["phone"]]);
        if($userValidE || $userValidP){
            var_dump($userValidP->getName());
            return $this->render('user/register.html.twig', [
                'programs'=>$programs,
                'registrado'=>false
             ]);
        }else{
        $user = new User();
        
        $user->setName($request->request->all()["name"]);
        $user->setSurname($request->request->all()["surname"]);
        $user->setEmail($request->request->all()["email"]);
        $user->setPhone($request->request->all()["phone"]);
        $program = $this->getDoctrine()->getRepository(Program::class);
        $program = $program->findOneBy(array("id"=>$request->request->all()["program_id"]));
        $user->setProgram($program);
        $user->setRole("ROLE_USER");
        $user->setCalls("no");
        $user->setCreatedAt(new \DateTime('now'));
        $user->setPassword($encoder->encodePassword($user,$request->request->all()["password"]));
        $em = $this->getDoctrine()->getManager();
        $em->persist($user);
        $em->flush();

        
        
        return $this->render('user/register.html.twig', [
            'programs'=>$programs,
            'registrado'=>1
         ]);
      
        }
    }
    public function login(AuthenticationUtils $authenticationUtils){
        $error = $authenticationUtils->getLastAuthenticationError();
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('user/login.html.twig',array(
            "error"=>$error,
            "last_username"=>$lastUsername
        ));
    }
    public function users(){
       
            $users = $this->getDoctrine()->getRepository(User::class);
            $users = $users->findAll();
        
        return $this->render('user/users.html.twig',array(
            "users"=>$users
        ));
    }
    public function call($id){
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository(User::class)->find($id);
        $si = "si";
        $user->setCalls($si);
       // var_dump($user);
        $em->flush();

        return $this->redirectToRoute('users');   

    }
}
