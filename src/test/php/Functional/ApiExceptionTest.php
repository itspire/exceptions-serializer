<?php

/*
 * Copyright (c) 2016 - 2020 Itspire.
 * This software is licensed under the BSD-3-Clause license. (see LICENSE.md for full license)
 * All Right Reserved.
 */

declare(strict_types=1);

namespace Itspire\Exception\Serializer\Test\Functional;

use Itspire\Exception\Serializer\Model\Api\ApiExceptionInterface;
use Itspire\Exception\Serializer\Model\Api\ApiException;
use JMS\Serializer\SerializerBuilder;
use JMS\Serializer\SerializerInterface;
use PHPUnit\Framework\TestCase;

class ApiExceptionTest extends TestCase
{
    private static ?SerializerInterface $serializer = null;
    private ?ApiExceptionInterface $apiException = null;

    public static function setUpBeforeClass(): void
    {
        parent::setUpBeforeClass();
        if (null === self::$serializer) {
            // obtaining the serializer
            $serializerBuilder = SerializerBuilder::create();
            self::$serializer = $serializerBuilder->build();
        }
    }

    public static function tearDownAfterClass(): void
    {
        static::$serializer = null;
        parent::tearDownAfterClass();
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->apiException = (new ApiException())->setCode('TEST')->setMessage('test');
    }

    protected function tearDown(): void
    {
        unset($this->apiException);

        parent::tearDown();
    }

    /** @test */
    public function serializeExceptionTest(): void
    {
        static::assertXmlStringEqualsXmlFile(
            realpath('src/test/resources/test_exception.xml'),
            static::$serializer->serialize($this->apiException, 'xml')
        );
    }

    /** @test */
    public function deserializeExceptionTest(): void
    {
        /** @var \SimpleXMLElement $apiExceptionXml */
        $apiExceptionXml = simplexml_load_string(
            file_get_contents(realpath('src/test/resources/test_exception.xml'))
        );

        /** @var ApiException $deserializedResult */
        $deserializedResult = static::$serializer->deserialize($apiExceptionXml->asXML(), ApiException::class, 'xml');

        static::assertEquals($this->apiException->getCode(), $deserializedResult->getCode());
        static::assertEquals($this->apiException->getMessage(), $deserializedResult->getMessage());
        static::assertEquals($this->apiException->getUniqueIdentifier(), $deserializedResult->getCode());
    }
}
