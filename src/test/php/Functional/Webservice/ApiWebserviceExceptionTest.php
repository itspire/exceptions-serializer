<?php

/*
 * Copyright (c) 2016 - 2020 Itspire.
 * This software is licensed under the BSD-3-Clause license. (see LICENSE.md for full license)
 * All Right Reserved.
 */

declare(strict_types=1);

namespace Itspire\Exception\Serializer\Test\Functional;

use Itspire\Exception\Serializer\Model\Api\Webservice\ApiWebserviceExceptionInterface;
use Itspire\Exception\Serializer\Model\Api\Webservice\ApiWebserviceException;
use JMS\Serializer\SerializerBuilder;
use JMS\Serializer\SerializerInterface;
use PHPUnit\Framework\TestCase;

class ApiWebserviceExceptionTest extends TestCase
{
    private static ?SerializerInterface $serializer = null;
    private ?ApiWebserviceExceptionInterface $apiWebserviceException = null;

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

        $this->apiWebserviceException = (new ApiWebserviceException())
            ->setCode('TEST')
            ->setMessage('test')
            ->addDetail('Detail1')
            ->addDetail('Detail2');
    }

    protected function tearDown(): void
    {
        unset($this->apiWebserviceException);

        parent::tearDown();
    }

    /** @test */
    public function serializeExceptionTest(): void
    {
        static::assertXmlStringEqualsXmlFile(
            realpath('src/test/resources/test_webservice_exception.xml'),
            static::$serializer->serialize($this->apiWebserviceException, 'xml')
        );
    }

    /** @test */
    public function serializeExceptionWithRemovedDetailTest(): void
    {
        $this->apiWebserviceException->removeDetail('Detail2');

        static::assertXmlStringEqualsXmlFile(
            realpath('src/test/resources/test_webservice_exception_single_detail.xml'),
            static::$serializer->serialize($this->apiWebserviceException, 'xml')
        );
    }

    /** @test */
    public function deserializeExceptionTest(): void
    {
        /** @var \SimpleXMLElement $apiWebserviceExceptionXml */
        $apiWebserviceExceptionXml = simplexml_load_string(
            file_get_contents(realpath('src/test/resources/test_webservice_exception.xml'))
        );

        /** @var ApiWebserviceException $deserializedResult */
        $deserializedResult = static::$serializer->deserialize(
            $apiWebserviceExceptionXml->asXML(),
            ApiWebserviceException::class,
            'xml'
        );

        static::assertEquals($this->apiWebserviceException->getCode(), $deserializedResult->getCode());
        static::assertEquals($this->apiWebserviceException->getMessage(), $deserializedResult->getMessage());
        static::assertEquals($this->apiWebserviceException->getDetails(), $deserializedResult->getDetails());
    }
}
