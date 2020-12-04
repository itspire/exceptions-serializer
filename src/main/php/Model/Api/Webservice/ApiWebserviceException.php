<?php

/*
 * Copyright (c) 2016 - 2020 Itspire.
 * This software is licensed under the BSD-3-Clause license. (see LICENSE.md for full license)
 * All Right Reserved.
 */

declare(strict_types=1);

namespace Itspire\Exception\Serializer\Model\Api\Webservice;

use Itspire\Exception\Serializer\Model\Api\ApiException;
use JMS\Serializer\Annotation as Serializer;

/** @Serializer\XmlRoot("webservice_exception") */
class ApiWebserviceException extends ApiException implements ApiWebserviceExceptionInterface
{
    /**
     * @Serializer\XmlList(inline = false, entry = "detail")
     * @Serializer\SerializedName("details")
     * @Serializer\Type("array<string>")
     */
    protected array $details = [];

    public function addDetail(string $detail): ApiWebserviceExceptionInterface
    {
        $this->details[] = $detail;

        return $this;
    }

    public function removeDetail(string $detail): ApiWebserviceExceptionInterface
    {
        $key = array_search($detail, $this->details, true);

        if (false !== $key) {
            unset($this->details[$key]);
        }

        return $this;
    }

    public function getDetails(): array
    {
        return $this->details;
    }
}
