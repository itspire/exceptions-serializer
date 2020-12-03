<?php

/*
 * Copyright (c) 2016 - 2020 Itspire.
 * This software is licensed under the BSD-3-Clause license. (see LICENSE.md for full license)
 * All Right Reserved.
 */

declare(strict_types=1);

namespace Itspire\Exception\Serializer\Model\Api;

interface ApiExceptionInterface
{
    public function getCode(): string;

    public function setCode(string $code): ApiExceptionInterface;

    public function getMessage(): ?string;

    public function setMessage(string $message): ApiExceptionInterface;
}
