<?php
// src/AppBundle/Controller/BlogController.php
namespace AppBundle\Controller;

use AppBundle\Entity\Blog;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class BlogController extends Controller
{
    /**
     * Matches /blog exactly
     *
     * @Route("/blog", name="blog_list")
     */
    public function listAction($page = 1)
    {
        // ...
        return $this->get_params();
    }
    public function showAction($slug)
    {
        // $slug will equal the dynamic part of the URL
        // e.g. at /blog/yay-routing, then $slug='yay-routing'

//        $form = $this->createFormBuilder()
//            ->add('task', TextType::class)
//            ->add('dueDate', DateType::class)
//            ->add('save', SubmitType::class, array('label' => 'Create Post'))
//            ->getForm();
//        $my_template = this.get_params($slug);
        return $this->get_params($slug);


//        return $my_template;
    }
    function get_params($slug=null){
        $post = Request::createFromGlobals();
        if ($post->request->has('submit')) {
            $name = $post->request->get('name');
            $exp = $post->request->get('exp');
            $phone = $post->request->get('phone_number');
        } else {
            $name = 'Siegfried';
            $exp =0;
            $phone = "+996550054807";
        }
        $salary = $exp * 1000;
        $tempValue = $this->createAction();
        return $this->render('lucky/number.html.twig', array(
            'number' => $slug,
            'name' => $name,
            "exp" => $exp,
            "phone" => $phone,
            "salary" => $salary,
        ));
    }

    public function createAction()
    {
        $blog = new Blog();
        $blog->setFullName('Keyboard');
        $blog->setExperience(19);
        $blog->setSalary(19000);
        $blog->setPhoneNumber("+996550054807");

        $em = $this->getDoctrine()->getManager();

        // tells Doctrine you want to (eventually) save the Product (no queries yet)
        $em->persist($blog);

        // actually executes the queries (i.e. the INSERT query)
        $em->flush();

        return new Response('Saved new blog with id '.$blog->getId());
    }
}
