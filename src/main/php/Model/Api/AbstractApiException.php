<?php

/*
 * Copyright (c) 2016 - 2020 Itspire.
 * This software is licensed under the BSD-3-Clause license. (see LICENSE.md for full license)
 * All Right Reserved.
 */

declare(strict_types=1);

namespace Itspire\Exception\Serializer\Model\Api;

use JMS\Serializer\Annotation as Serializer;

abstract class AbstractApiException implements ApiExceptionInterface
{
    /**
     * Code is set to string because it can contains user-defined string based codes (i.e : ws exception codes)
     *
     * @Serializer\XmlAttribute
     * @Serializer\SerializedName("code")
     * @Serializer\Type("string")
     */
    private string $code = '';

    /**
     * @Serializer\XmlAttribute
     * @Serializer\SerializedName("message")
     * @Serializer\Type("string")
     */
    private ?string $message = null;

    public function getCode(): string
    {
        return $this->code;
    }

    public function setCode(string $code): ApiExceptionInterface
    {
        $this->code = $code;

        return $this;
    }

    public function getMessage(): ?string
    {
        return $this->message;
    }

    public function setMessage(string $message): ApiExceptionInterface
    {
        $this->message = $message;

        return $this;
    }

    public function getUniqueIdentifier(): string
    {
        return $this->code;
    }
}
