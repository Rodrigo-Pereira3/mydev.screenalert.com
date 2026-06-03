<?php

class ScheduleMedication
{
    private int $id;
    private int $id_user;
    private string $name_medication;
    private string $description_medication;

    public function __construct(
        int $id = 0,
        int $id_user = 0,
        string $name_medication = '',
        string $description_medication = ''
    ) {
        $this->id = $id;
        $this->id_user = $id_user;
        $this->name_medication = $name_medication;
        $this->description_medication = $description_medication;
    }

    public function getId(): int
    {
        return $this->id;
    }
    public function getIdUser(): int
    {
        return $this->id_user;
    }
    public function getNameMedication(): string
    {
        return $this->name_medication;
    }
    public function getDescriptionMedication(): string
    {
        return $this->description_medication;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }
    public function setIdUser(int $id_user): void
    {
        $this->id_user = $id_user;
    }
    public function setNameMedication(string $name_medication): void
    {
        $this->name_medication = $name_medication;
    }
    public function setDescriptionMedication(string $description_medication): void
    {
        $this->description_medication = $description_medication;
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'id_user' => $this->id_user,
            'name_medication' => $this->name_medication,
            'description_medication' => $this->description_medication
        ];
    }
}