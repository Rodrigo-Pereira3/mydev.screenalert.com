<?php

class User {
    // Colunas da tabela
    private int $id;
    private ?int $id_cuidador;
    private bool $is_admin;
    private string $name_user;
    private string $birth_date;
    private string $email;
    private string $password_email;
    private string $status; // 'Active' | 'Blocked'
    private string $created_at;
    private string $last_updated;

    // Constructor
    public function __construct(
        int $id = 0,
        ?int $id_cuidador = null,
        bool $is_admin = false,
        string $name_user = '',
        string $birth_date = '',
        string $email = '',
        string $password_email = '',
        string $status = 'Active',
        string $created_at = '',
        string $last_updated = ''
    ) {
        $this->id = $id;
        $this->id_cuidador = $id_cuidador;
        $this->is_admin = $is_admin;
        $this->name_user = $name_user;
        $this->birth_date = $birth_date;
        $this->email = $email;
        $this->password_email = $password_email;
        $this->status = $status;
        $this->created_at = $created_at;
        $this->last_updated = $last_updated;
    }

    // --- Getters ---

    public function getId(): int {
        return $this->id;
    }

    public function getIdCuidador(): ?int {
        return $this->id_cuidador;
    }

    public function getIsAdmin(): bool {
        return $this->is_admin;
    }

    public function getNameUser(): string {
        return $this->name_user;
    }

    public function getBirthDate(): string {
        return $this->birth_date;
    }

    public function getEmail(): string {
        return $this->email;
    }

    public function getPasswordEmail(): string {
        return $this->password_email;
    }

    public function getStatus(): string {
        return $this->status;
    }

    public function getCreatedAt(): string {
        return $this->created_at;
    }

    public function getLastUpdated(): string {
        return $this->last_updated;
    }

    // --- Setters ---

    public function setId(int $id): void {
        $this->id = $id;
    }

    public function setIdCuidador(?int $id_cuidador): void {
        $this->id_cuidador = $id_cuidador;
    }

    public function setIsAdmin(bool $is_admin): void {
        $this->is_admin = $is_admin;
    }

    public function setNameUser(string $name_user): void {
        $this->name_user = $name_user;
    }

    public function setBirthDate(string $birth_date): void {
        $this->birth_date = $birth_date;
    }

    public function setEmail(string $email): void {
        $this->email = $email;
    }

    public function setPasswordEmail(string $password_email): void {
        $this->password_email = $password_email;
    }

    public function setStatus(string $status): void {
        $this->status = $status;
    }

    public function setCreatedAt(string $created_at): void {
        $this->created_at = $created_at;
    }

    public function setLastUpdated(string $last_updated): void {
        $this->last_updated = $last_updated;
    }
}