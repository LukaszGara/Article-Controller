<?php
    namespace App\Controller;

    use App\Entity\Articles;
    use Symfony\Component\HttpFoundation\Response;
    use Symfony\Component\Routing\Annotation\Route;
    use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
    use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
    use Symfony\Component\HttpFoundation\Request;
    use Symfony\Component\Form\Extension\Core\Type\TextType;
    use Symfony\Component\Form\Extension\Core\Type\TextareaType;
    use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class AppController extends AbstractController {
        /**
         * @Route("/", name="home")
         * @Method({"GET"})
         */
        public function index(){
            $articles= $this-> getDoctrine()->getRepository(Articles::class)->findAll();
            
           return $this->render("/view/index.html.twig", ['article' => $articles]);
        }
        /**
         * @Route("view/admin.html.twig", name="admin")
         * @Method({"GET", "POST"})
         */
        public function admin(Request $request){
            $article = new Articles();

            $form = $this->createFormBuilder($article)
            ->add('title', TextType::class, array('attr' =>
            array('class' => 'form-control')))
            ->add('body', TextareaType::class, array('attr' =>
            array('class' => 'form-control')))
            ->add('author', TextType::class, array('attr'
            =>array('class' => 'form-control')))
            ->add('save', SubmitType::class, array(
                 'label' => 'Create',
                 'attr' => array('class' => 'btn btn-primary mt-3')
            ))
            ->getForm();

            $form->handleRequest($request);

            if($form->isSubmitted() && $form->isValid()){

                $entityManager= $this->getDoctrine()->getManager();
                $entityManager->persist($article);
                $entityManager->flush();

                return $this->redirectToRoute('home');
            }

             $Articles= $this->getDoctrine()->getRepository(Articles::class)->findAll();

             return $this->render('view/admin.html.twig', ['Articles' => $Articles, 'form' => $form->createView()]);
        }

        /**
         * @Route("/Articles/edit{id}", name="edit")
         * @Method({"GET", "POST"})
         */
        public function edit(Request $request, $id){
            $article = new Articles();

            $article = $this->getDoctrine()->getRepository(Articles::class)->find($id);
            $form = $this->createFormBuilder($article)
            ->add('title', TextType::class, array('attr' =>
            array('class' => 'form-control')))
            ->add('body', TextareaType::class, array('attr' =>
            array('class' => 'form-control')))
            ->add('author', TextType::class, array('attr'
            =>array('class' => 'form-control')))
            ->add('save', SubmitType::class, array(
                 'label' => 'update',
                 'attr' => array('class' => 'btn btn-primary mt-3')
            ))
            ->getForm();

            $form->handleRequest($request);

            if($form->isSubmitted() && $form->isValid()){

                $entityManager= $this->getDoctrine()->getManager();
                $entityManager->flush();

                return $this->redirectToRoute('home');
            }

             $Articles= $this->getDoctrine()->getRepository(Articles::class)->findAll();

             return $this->render('view/edit.html.twig', ['Articles' => $Articles, 'form' => $form->createView()]);
        }
        /**
         * @Route("/Articles/delete/{id}")
         * @Method({"DELETE"})
         */
        public function delete(Request $request, $id){
            $article = $this->getDoctrine()->getRepository(Articles::class)->find($id);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($article);
            $entityManager->flush();
            
            $response = new Response();
            $response->send();
        }
        /**
         * @Route("/Articles/show/{id}", name="show")
         * @Method({"GET"})
         */
        public function show($id){
            $article = $this->getDoctrine()->getRepository(Articles::class)->find($id);

            return $this->render('view/article.html.twig', ['article' => $article]);
        }
    }
