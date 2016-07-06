<?php

namespace src\Album\Exception;

class InvalidArgumentException extends \InvalidArgumentException
{
    /**
     * @param $value
     * @param string $variableName
     * @param string $expectedType
     * @return InvalidArgumentException
     */
    public static function wrongType($value, $variableName, $expectedType)
    {
        return new self(sprintf(
            '\'$%s\' must be of type \'%s\', got \'%s\'',
            $variableName,
            $expectedType,
            is_object($value) ? get_class($value) : gettype($value)
        ));
    }
}