<?php

namespace App\LogicLayer\Contracts;

final class LogicResult
{
    /**
     * construct a logic result instance
     *
     * @param string|null $message message from a logic function result, often used for errors
     * @param int|string $statusCode a traceable and meaningful status code
     * @param mixed|null $data data that returned from login function
     */
    public function __construct(protected ?string    $message = null,
                                protected int|string $statusCode = 200,
                                protected mixed      $data = null)
    {
    }

    /**
     * static constructor
     *
     * @param string|null $message message from a logic function result, often used for errors
     * @param int|string $statusCode a traceable and meaningful status code
     * @param mixed|null $data data that returned from login function
     * @return LogicResult
     */
    public static function factory(?string    $message = null,
                                   int|string $statusCode = 200,
                                   mixed      $data = null): LogicResult
    {
        return new LogicResult($message, $statusCode, $data);
    }

    /**
     * return result message
     *
     * @return string|null
     */
    public function getMessage(): ?string
    {
        return $this->message;
    }

    /**
     * return result status code
     *
     * @return int|string
     */
    public function getStatusCode(): int|string
    {
        return $this->statusCode;
    }

    /**
     * return appended data to result
     *
     * @return mixed
     */
    public function getData(): mixed
    {
        return $this->data;
    }

    /**
     * a chain-method for setting message
     *
     * @param string $message
     * @return $this
     */
    public function setMessage(string $message): LogicResult
    {
        $this->message = $message;
        return $this;
    }

    /**
     * a chain-method for setting data
     *
     * @param mixed $data
     * @return $this
     */
    public function setData(mixed $data): LogicResult
    {
        $this->data = $data;
        return $this;
    }

    /**
     * a chain-method for setting meaningful status code
     *
     * @param string|int $statusCode
     * @return $this
     */
    public function setStatusCode(string|int $statusCode = 200): LogicResult
    {
        $this->statusCode = intval($statusCode);
        return $this;
    }

    /**
     * checks that result has error || successful
     *
     * @return bool
     */
    public function hasSomethingWrong(): bool
    {
        return $this->statusCode !== 200;
    }
}
