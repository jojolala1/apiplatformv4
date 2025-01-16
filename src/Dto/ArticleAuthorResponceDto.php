<?php
namespace App\Dto;

class ArticleAuthorResponceDto
{
    private ?string $title = null;

    private ?string $author = null;

    public function __construct()
    {}

    public function getTitle()
    {
        return $this->title;
    }

    public function setTitle($title)
    {
        $this->title = $title;
        return $this;
    }

    public function getAuthor()
    {
        return $this->author;
    }

    public function setAuthor($author)
    {
        $this->author = $author;
        return $this;
    }

}