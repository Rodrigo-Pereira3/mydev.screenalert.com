<?php

class Message {
    // Colunas da tabela
    private int $id;
    private int $id_paciente;
    private string $status; // 'Seen' | 'Unseen'
    private string $sent_at;
    private string $text_message;
    private string $nome_paciente; // Nome do paciente (para exibição)

    // Constructor
    public function __construct(
        int $id = 0,
        int $id_paciente = 0,
        string $status = 'Unseen',
        string $sent_at = '',
        string $text_message = '',
        string $nome_paciente = ''
    ) {
        $this->id           = $id;
        $this->id_paciente  = $id_paciente;
        $this->status       = $status;
        $this->sent_at      = $sent_at;
        $this->text_message = $text_message;
        $this->nome_paciente = $nome_paciente;
    }

    // --- Getters ---

    public function getId(): int {
        return $this->id;
    }

    public function getIdPaciente(): int {
        return $this->id_paciente;
    }

    public function getStatus(): string {
        return $this->status;
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

    public function setIdPaciente(int $id_paciente): void {
        $this->id_paciente = $id_paciente;
    }

    public function setStatus(string $status): void {
        $this->status = $status;
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
}