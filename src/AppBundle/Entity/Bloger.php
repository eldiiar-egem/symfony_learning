<?php
/**
 * Created by PhpStorm.
 * User: eldiyar
 * Date: 2/9/17
 * Time: 11:55 AM
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

class Bloger
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string")
     */
    protected $user_name;

    /**
     * @ORM\Column(type="integer")
     */
    protected $button_number;

    /**
     * @ORM\Column(type="integer")
     */
    protected $click_number;

    /**
     * @ORM\Column(type="date")
     */
    protected $scored_time;

}