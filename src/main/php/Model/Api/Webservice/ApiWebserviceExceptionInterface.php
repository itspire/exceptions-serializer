<?php

/*
 * Copyright (c) 2016 - 2020 Itspire.
 * This software is licensed under the BSD-3-Clause license. (see LICENSE.md for full license)
 * All Right Reserved.
 */

declare(strict_types=1);

namespace Itspire\Exception\Serializer\Model\Api\Webservice;

use Itspire\Exception\Serializer\Model\Api\ApiExceptionInterface;

interface ApiWebserviceExceptionInterface extends ApiExceptionInterface
{
    public function addDetail(string $detail): ApiWebserviceExceptionInterface;

    public function removeDetail(string $detail): ApiWebserviceExceptionInterface;

    public function getDetails(): array;
}
