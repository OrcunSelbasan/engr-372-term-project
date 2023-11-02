<?php
class Test
{
    private $name;
    private $age;
    private $tableName = 'test';

    public function __construct($name, $age)
    {
        $this->name = $name;
        $this->age = $age;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName($name): void
    {
        $this->name = $name;
    }

    public function getAge(): int
    {
        return $this->age;
    }

    public function setAge($age): void
    {
        $this->age = $age;
    }
}
