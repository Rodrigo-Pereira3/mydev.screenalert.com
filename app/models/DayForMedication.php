<?php

class DayForMedication
{
    private int $id;
    private int $id_schedule_medication;
    private int $day_of_doce;
    private int $doce;

    public function __construct(
        int $id = 0,
        int $id_schedule_medication = 0,
        int $day_of_doce = 0,
        int $doce = 0
    ) {
        $this->id = $id;
        $this->id_schedule_medication = $id_schedule_medication;
        $this->day_of_doce = $day_of_doce;
        $this->doce = $doce;
    }

    public function getId(): int
    {
        return $this->id;
    }
    public function getIdScheduleMedication(): int
    {
        return $this->id_schedule_medication;
    }
    public function getDayOfDoce(): int
    {
        return $this->day_of_doce;
    }
    public function getDoce(): int
    {
        return $this->doce;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }
    public function setIdScheduleMedication(int $id_schedule_medication): void
    {
        $this->id_schedule_medication = $id_schedule_medication;
    }
    public function setDayOfDoce(int $day_of_doce): void
    {
        $this->day_of_doce = $day_of_doce;
    }
    public function setDoce(int $doce): void
    {
        $this->doce = $doce;
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'id_schedule_medication' => $this->id_schedule_medication,
            'day_of_doce' => $this->day_of_doce,
            'doce' => $this->doce
        ];
    }
}