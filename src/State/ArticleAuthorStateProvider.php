<?php

namespace App\State;

use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProviderInterface;
use App\Dto\ArticleAuthorResponceDto;
use Symfony\Component\DependencyInjection\Attribute\Autowire;

class ArticleAuthorStateProvider implements ProviderInterface
{
    public function __construct(
        #[Autowire(service : 'api_platform.doctrine.orm.state.collection_provider')]
        private ProviderInterface $providerInterface) 
    {

    }
    public function provide(Operation $operation, array $uriVariables = [], array $context = []): object|array|null
    {
        $data = $this->providerInterface->provide($operation, $uriVariables , context: $context);
        $response = [];
        foreach($data as $key => $value) {
            $article = new ArticleAuthorResponceDto();
            $article->setTitle($value->getTitle());
            $author = $value->getAuthor();
            $article->setAuthor(isset($author) ? $author->getFirstName().' '.$author->getLastName() : null);
            $response[] = $article;
        }
        return $response;
    }
}
