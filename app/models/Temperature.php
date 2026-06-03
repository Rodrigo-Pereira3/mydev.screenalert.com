<?php

class Temperature
{
    private int $id;
    private int $idUser;
    private float $temperature;
    private string $temperatureTime;

    public function __construct(
        int $id,
        int $idUser,
        float $temperature,
        string $temperatureTime
    ) {
        $this->id = $id;
        $this->idUser = $idUser;
        $this->temperature = $temperature;
        $this->temperatureTime = $temperatureTime;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getIdUser(): int
    {
        return $this->idUser;
    }

    public function setIdUser(int $idUser): void
    {
        $this->idUser = $idUser;
    }

    public function getTemperature(): float
    {
        return $this->temperature;
    }

    public function setTemperature(float $temperature): void
    {
        $this->temperature = $temperature;
    }

    public function getTemperatureTime(): string
    {
        return $this->temperatureTime;
    }

    public function setTemperatureTime(string $temperatureTime): void
    {
        $this->temperatureTime = $temperatureTime;
    }
}