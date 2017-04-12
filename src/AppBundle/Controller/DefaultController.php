<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Logos;
use AppBundle\Entity\Task;
use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Filesystem\Exception\IOExceptionInterface;

//use Symfony\Bundle\FrameworkBundle\Controller\Controller;
//use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    function microtime_float()
    {
        list($usec, $sec) = explode(" ", microtime());
        return ((float)$usec + (float)$sec);
    }
    /**
     * @Route("/logs/", name="logs")
     */

    public function createAction($variable=null)
    {

        $post = Request::createFromGlobals();

        if ($post->request->has('submit')) {
            $users = $post->request->get('users');
            $buttons = $post->request->get('buttons');
            $count = $post->request->get('count');
            $name = $post->request->get('name');
        } else {
            $name = 'Not submitted yet';
            $users =0;
            $buttons = 0;
            $count = 0;
        }

        echo $variable;
        $fs = new Filesystem();
        $button_list = [];
        $databasetime = strtotime(time("now"));
//        $users = rand(1,100);
//        $buttons = rand(3,100);
//        $buttons = 5;
//        $count = rand(1,10);
        $time_start = microtime();
        for ($i=0; $i<$users; $i++){
            for ($j=0;$j<$count;$j++){
                $number = rand(1,$buttons);
//                echo "$number\r\n";
//                $arr["x"] = 42;
                if(array_key_exists($number, $button_list)) $button_list[$number]+=1;
                else $button_list[$number]=1;
//                array_push($arr, $number);
            }
        }
        if ($button_list) $button_list = to_database($button_list);
//        arsort($button_list);
// Sleep for a while
//        usleep(100);

//        try {
//            $fs->mkdir('/'.mt_rand());
//        } catch (IOExceptionInterface $e) {
//            echo "An error occurred while creating your directory at ".$e->getPath();
//        }
        $clicked_list = array();
        $logos = new Logos();
        $em = $this->getDoctrine()->getManager();
        for ($i=0; $i < rand(1,100); $i++)
        {
            for($j=0;$j<5;$j++){
                $recordedTime = new DateTime('now');
//                $button_number = $this->getRandomNumber(0,9,$clicked_list);
//                array_push($clicked_list, $button_number);
                $button_number = rand(0,9);
                $logos->setUserId($i);
                $logos->setButtonNumber($button_number);
                $logos->setClickNumber($j);
                $logos->setRecordedTime($recordedTime);


                // tells Doctrine you want to (eventually) save the Product (no queries yet)
                $em->persist($logos);

                // actually executes the queries (i.e. the INSERT query)
                $em->flush();
            }
        }

        $time_end = microtime();
        $time = $time_end - $time_start;

//        echo "finished in $time seconds\n";
        $file_time_start = microtime();

        $nextTime=(new DateTime('now'))->format("ms:mcs") - ($recordedTime->format("ms:mcs"));
        $fs->dumpFile('overhere.txt', ($logos->getUserId()));
        $file_time_end = microtime();
        $filetime = $time + $file_time_end - $file_time_start;
        return $this->render('default/logos.html.twig',
            array("context" => $logos,
                "time" => $time,
                "filetime" =>$filetime,
                "file" => "overhere",
                "users" => $users,
                "buttons"=>$buttons,
                "count" => $count,
                "button_list" =>$button_list,
                'name' => $name
            ));
//            new Response('Saved new logos with id '.$logos->getId());
    }

    function getRandomNumber($min,$max, $exeptions) {
        $button_number = rand(0,9);
        if (in_array($button_number, $exeptions)){
            return $this->getRandomNumber($min,$max,$exeptions);
        }
        return $button_number;
    }

    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.root_dir').'/..').DIRECTORY_SEPARATOR,
        ]);
    }
    /**
     * @Route("/", name="homepage")
     */
    public function newAction(Request $request)
    {
        // create a task and give it some dummy data for this example
        $task = new Task();
        $task->setTask('Write a blog post');
        $task->setDueDate(new \DateTime('today'));


        $form = $this->createFormBuilder($task)
            ->add('task', TextType::class)
            ->add('dueDate', DateType::class)
            ->add('save', SubmitType::class, array('label' => 'Create Post'))
            ->getForm();


        $form->handleRequest($request);
//        return $this->render('default/new.html.twig', array(
//            'form' => $form->createView(),
//        ));
        if ($form->isSubmitted() && $form->isValid()) {
            // $form->getData() holds the submitted values
            // but, the original `$task` variable has also been updated
            $task = $form->getData();

            // ... perform some action, such as saving the task to the database
            // for example, if Task is a Doctrine entity, save it!
             $em = $this->getDoctrine()->getManager();
             $em->persist($task);
             $em->flush();

            return $this->redirectToRoute('task_success');
        }
//        echo "i got here---------------------------------------------------";
        return $this->render('default/new.html.twig', array(
            'form' => $form->createView(),
        ));
    }
}

function myOwnSort($unsorted){
    $temp_array = [];
    arsort($unsorted);
    foreach ($unsorted as $k => $v) {
        $volume[$k] = $k;
        $temp_array["value"] =$v;

//        echo "\$a[$k] => $v.\n";
    }
    return $unsorted;

}
function to_database($dictionary){
    $new_dict = [];
    foreach ($dictionary as $key => $value){
        $new_dict[] = array("key" => $key, "value" => $value);
    }

    foreach ($new_dict as $key => $row) {
        $volume[$key]  = $row['key'];
        $edition[$key] = $row['value'];
    }
    array_multisort($edition, SORT_DESC, $volume, SORT_ASC, $new_dict);
    return back_to_dictionary($new_dict);
}
function back_to_dictionary($data){

    foreach ($data as $key => $row) {
        // print_r("$key ---- $row");
//        print_r("$key   \n");
        foreach($row as $k => $v){
//            print_r("$k ---- $v \n");
            $new_dict[$row['key']] = $row['value'];
        }

    }
    return $new_dict;
}
//
//namespace AppBundle\Controller;
//
//use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
//use Symfony\Bundle\FrameworkBundle\Controller\Controller;
//use Symfony\Component\HttpFoundation\Request;
//
//class DefaultController extends Controller
//{
//    /**
//     * @Route("/", name="homepage")
//     */
//    public function indexAction(Request $request)
//    {
//        // replace this example code with whatever you need
//        return $this->render('default/index.html.twig', [
//            'base_dir' => realpath($this->getParameter('kernel.root_dir').'/..').DIRECTORY_SEPARATOR,
//        ]);
//    }
//}
