<?php

class Device {
    // Colunas da tabela
    private int $id;
    private ?int $id_user;
    private string $token_device;

    // Constructor
    public function __construct(
        int $id = 0,
        ?int $id_user = null,
        string $token_device = ''
    ) {
        $this->id           = $id;
        $this->id_user      = $id_user;
        $this->token_device = $token_device;
    }

    // --- Getters ---

    public function getId(): int {
        return $this->id;
    }

    public function getIdUser(): ?int {
        return $this->id_user;
    }

    public function getTokenDevice(): string {
        return $this->token_device;
    }

    // --- Setters ---

    public function setId(int $id): void {
        $this->id = $id;
    }

    public function setIdUser(?int $id_user): void {
        $this->id_user = $id_user;
    }

    public function setTokenDevice(string $token_device): void {
        $this->token_device = $token_device;
    }
}