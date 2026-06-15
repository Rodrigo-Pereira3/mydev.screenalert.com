<?php

class Temperature
{
    private int $id;
    private int $idDevice;
    private float $temperature;
    private string $temperatureTime;

    public function __construct(
        int $id,
        int $idDevice,
        float $temperature,
        string $temperatureTime
    ) {
        $this->id = $id;
        $this->idDevice = $idDevice;
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

    public function getIdDevice(): int
    {
        return $this->idDevice;
    }

    public function setIdDevice(int $idDevice): void
    {
        $this->idDevice = $idDevice;
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