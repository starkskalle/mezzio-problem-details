<?php

/**
 * @see       https://github.com/mezzio/mezzio-problem-details for the canonical source repository
 * @copyright https://github.com/mezzio/mezzio-problem-details/blob/master/COPYRIGHT.md
 * @license   https://github.com/mezzio/mezzio-problem-details/blob/master/LICENSE.md New BSD License
 */

namespace Mezzio\ProblemDetails\Exception;

/**
 * Common functionality for ProblemDetailsExceptionInterface implementations.
 *
 * Requires setting the following properties in the composing class:
 *
 * - status (int)
 * - detail (string)
 * - title (string)
 * - type (string)
 * - additional (array)
 */
trait CommonProblemDetailsExceptionTrait
{
    /**
     * @var int
     */
    private $status;

    /**
     * @var string
     */
    private $detail;

    /**
     * @var string
     */
    private $title;

    /**
     * @var string
     */
    private $type;

    /**
     * @var array
     */
    private $additional = [];

    public function getStatus() : int
    {
        return $this->status;
    }

    public function getType() : string
    {
        return $this->type;
    }

    public function getTitle() : string
    {
        return $this->title;
    }

    public function getDetail() : string
    {
        return $this->detail;
    }

    public function getAdditionalData() : array
    {
        return $this->additional;
    }

    /**
     * Serialize the exception to an array of problem details.
     *
     * Likely useful for the JsonSerializable implementation, but also
     * for cases where the XML variant is desired.
     */
    public function toArray() : array
    {
        $problem = [
            'status' => $this->status,
            'detail' => $this->detail,
            'title'  => $this->title,
            'type'   => $this->type,
        ];

        if ($this->additional) {
            $problem = array_merge($this->additional, $problem);
        }

        return $problem;
    }

    /**
     * Allow serialization via json_encode().
     *
     * @return array
     */
    public function jsonSerialize()
    {
        return $this->toArray();
    }
}
