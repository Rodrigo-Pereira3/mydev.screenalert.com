<?php

class User {
    // Colunas da tabela
    private int $id;
    private ?int $id_cuidador;
    private bool $is_admin;
    private string $name_user;
    private string $birth_date;
    private string $email;
    private string $password;
    private string $status; 
    private string $verified_at;
    private string $created_at;
    private string $deleted_at;

    // Constructor
    public function __construct(
        int $id = 0,
        ?int $id_cuidador = null,
        bool $is_admin = false,
        string $name_user = '',
        string $birth_date = '',
        string $email = '',
        string $password = '',
        string $status = 'Active',
        string $verified_at = '',
        string $created_at = '',
        string $deleted_at = ''
    ) {
        $this->id = $id;
        $this->id_cuidador = $id_cuidador;
        $this->is_admin = $is_admin;
        $this->name_user = $name_user;
        $this->birth_date = $birth_date;
        $this->email = $email;
        $this->password = $password;    
        $this->status = $status;
        $this->verified_at = $verified_at;
        $this->created_at = $created_at;
        $this->deleted_at = $deleted_at;
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

    public function getPassword(): string {
        return $this->password;
    }

    public function getStatus(): string {
        return $this->status;
    }

    public function getVerifiedAt(): string {
        return $this->verified_at;
    }

    public function getCreatedAt(): string {
        return $this->created_at;
    }

    public function getDeletedAt(): string {
        return $this->deleted_at;
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

    public function setPassword(string $password): void {
        $this->password = $password;
    }

    public function setStatus(string $status): void {
        $this->status = $status;
    }

    public function setVerifiedAt(string $verified_at): void {
        $this->verified_at = $verified_at;
    }

    public function setCreatedAt(string $created_at): void {
        $this->created_at = $created_at;
    }

    public function setLastUpdated(string $deleted_at): void {
        $this->deleted_at = $deleted_at;
    }

    //vou implementar um toArray
    public function toArray(): array {
        return [
            'id' => $this->id,
            'id_cuidador' => $this->id_cuidador,
            'is_admin' => $this->is_admin,
            'name_user' => $this->name_user,
            'birth_date' => $this->birth_date,
            'email' => $this->email,
            'password' => $this->password,
            'status' => $this->status,
            'verified_at' => $this->verified_at,
            'created_at' => $this->created_at,
            'deleted_at' => $this->deleted_at
        ];
    }
}