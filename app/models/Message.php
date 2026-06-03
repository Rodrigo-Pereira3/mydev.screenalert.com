<?php

class Message {
    // Colunas da tabela
    private int $id;
    private int $id_user;
    private string $sent_at;
    private string $text_message;
    private string $nome_paciente; // Nome do paciente (para exibição)

    // Constructor
    public function __construct(
        int $id = 0,
        int $id_user = 0,
        string $sent_at = '',
        string $text_message = '',
        string $nome_paciente = ''
    ) {
        $this->id           = $id;
        $this->id_user      = $id_user;
        $this->sent_at      = $sent_at;
        $this->text_message = $text_message;
        $this->nome_paciente = $nome_paciente;
    }

    // --- Getters ---

    public function getId(): int {
        return $this->id;
    }

    public function getIdUser(): int {
        return $this->id_user;
    }


    public function getSentAt(): string {
        return $this->sent_at;
    }

    public function getTextMessage(): string {
        return $this->text_message;
    }

    public function getNomePaciente(): string {
        return $this->nome_paciente;
    }

    // --- Setters ---

    public function setId(int $id): void {
        $this->id = $id;
    }

    public function setIdUser(int $id_user): void {
        $this->id_user = $id_user;
    }


    public function setSentAt(string $sent_at): void {
        $this->sent_at = $sent_at;
    }

    public function setTextMessage(string $text_message): void {
        $this->text_message = $text_message;
    }

    public function setNomePaciente(string $nome_paciente): void {
        $this->nome_paciente = $nome_paciente;
    }

    public function toArray(): array {
        return [
            'id' => $this->id,
            'id_user' => $this->id_user,
            'sent_at' => $this->sent_at,
            'text_message' => $this->text_message,
            'nome_paciente' => $this->nome_paciente
        ];
    }
}