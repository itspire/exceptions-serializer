<?php

/*
 * Copyright (c) 2016 - 2020 Itspire.
 * This software is licensed under the BSD-3-Clause license. (see LICENSE.md for full license)
 * All Right Reserved.
 */

declare(strict_types=1);

namespace Itspire\Exception\Serializer\Test\Fixtures\Model\Api\Webservice;

use Itspire\Exception\Serializer\Model\Api\Webservice\AbstractApiWebserviceException;
use JMS\Serializer\Annotation as Serializer;

/** @Serializer\XmlRoot("api_ws_exception") */
class ApiWebserviceException extends AbstractApiWebserviceException
{
}