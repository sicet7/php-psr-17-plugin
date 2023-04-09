<?php

namespace Sicet7\PSR17;
use DI\Definition\ObjectDefinition;
use DI\Definition\Reference;
use DI\Definition\Source\MutableDefinitionSource;
use Nyholm\Psr7\Factory\Psr17Factory;
use Psr\Http\Message\RequestFactoryInterface;
use Psr\Http\Message\ResponseFactoryInterface;
use Psr\Http\Message\ServerRequestFactoryInterface;
use Psr\Http\Message\StreamFactoryInterface;
use Psr\Http\Message\UploadedFileFactoryInterface;
use Psr\Http\Message\UriFactoryInterface;
use Sicet7\Plugin\Container\Interfaces\PluginInterface;

final class PSR17Plugin implements PluginInterface
{
    /**
     * @param MutableDefinitionSource $source
     * @return void
     */
    public function register(MutableDefinitionSource $source): void
    {
        $source->addDefinition(new ObjectDefinition(Psr17Factory::class, Psr17Factory::class));
        $source->addDefinition($this->makeRef(
            RequestFactoryInterface::class,
            Psr17Factory::class
        ));
        $source->addDefinition($this->makeRef(
            ResponseFactoryInterface::class,
            Psr17Factory::class
        ));
        $source->addDefinition($this->makeRef(
            ServerRequestFactoryInterface::class,
            Psr17Factory::class
        ));
        $source->addDefinition($this->makeRef(
            StreamFactoryInterface::class,
            Psr17Factory::class
        ));
        $source->addDefinition($this->makeRef(
            UploadedFileFactoryInterface::class,
            Psr17Factory::class
        ));
        $source->addDefinition($this->makeRef(
            UriFactoryInterface::class,
            Psr17Factory::class
        ));
    }

    /**
     * @param string $name
     * @param string $target
     * @return Reference
     */
    private function makeRef(string $name, string $target): Reference
    {
        $ref = new Reference($target);
        $ref->setName($name);
        return $ref;
    }
}