<?php

namespace App\State;

use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProcessorInterface;
use App\Dto\ArticleAuthorResponceDto;
use App\Entity\Article;
use App\Entity\Author;
use Doctrine\ORM\EntityManagerInterface;

class ArticleAuthorStateProcessor implements ProcessorInterface
{
    public function __construct(private EntityManagerInterface $em) {}
    public function process(mixed $data, Operation $operation, array $uriVariables = [], array $context = []): object
    {
        $author = new Author();
        $author->setFirstName($data->getFirstName());
        $author->setLastName($data->getLastName());

        $article = new Article();
        $article->setTitle($data->getTitle());
        $article->setContent($data->getContent());
        $article->setPublishedAt(new \DateTimeImmutable());
        $article->setAuthor($author);

        $this->em->persist($article);
        $this->em->persist($author);

        $this->em->flush();

        $articleDto = new ArticleAuthorResponceDto();
        $articleDto->setTitle($data->getTitle());
        $articleDto->setAuthor($data->getFirstName().' '.$data->getLastName());

        return $articleDto;
    }
}
