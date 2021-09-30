<?php

namespace App\Entity;

use App\Repository\ArticlesRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ArticlesRepository::class)
 */
class Articles
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="text", length=100)
     */

    private $title;

    /**
     * @ORM\Column(type="text", length=99999)
     */
    
     private $body;

    /**
     * @ORM\Column(type="text", length=50)
     */
    
     private $author;

    //GETTERS AND SETTERS

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle() {

        return $this->title;
    }

    public function setTitle($title) {
        $this->title = $title;
    }

    public function getBody() {

        return $this->body;
    }

    public function setBody($body) {
        $this->body = $body;
    }

    public function getAuthor() {

        return $this->author;
    }

    public function setAuthor($author) {
        $this->author = $author;
    }
}


