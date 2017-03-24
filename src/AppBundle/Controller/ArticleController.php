<?php
/**
 * Created by PhpStorm.
 * User: eldiyar
 * Date: 2/6/17
 * Time: 1:16 AM
 */

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;


class ArticleController extends Controller
{
    /**
     * @Route(
     *     "/articles/{_locale}/{year}/{slug}.{_format}",
     *     defaults={"_format": "html"},
     *     requirements={
     *         "_locale": "en|fr",
     *         "_format": "html|rss",
     *         "year": "\d+"
     *     }
     * )
     */
    public function showAction($_locale, $year, $slug)
    {
        $this->render('lucky/article.html.twig', array(
            'number' => $slug,
        ));;

        for ($i=0; $i<$year; $i++){
//            echo "<tr><td>Сатыбалдыев Тилек Рысбаевич</td><td>{$year}год</td><td>{$i}</td><td>+996000000</td></tr>";

//            echo $_locale, "<br>";
        }
        return $this->render('lucky/article.html.twig', array(
            'number' => $year,
        ));;
    }
}