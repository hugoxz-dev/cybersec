<?php

/**
 * Validação encadeável. Guarda só o primeiro erro de cada campo.
 *
 *   $v = (new Validator($_POST))
 *       ->required('email', 'E-mail')
 *       ->email('email', 'E-mail');
 *
 *   if ($v->fails()) { Session::set('error', $v->firstError()); ... }
 */
class Validator
{
    private array $errors = [];

    public function __construct(private array $data)
    {
    }

    public function value(string $field): string
    {
        $value = $this->data[$field] ?? '';

        return is_string($value) ? trim($value) : '';
    }

    public function required(string $field, string $label): static
    {
        if ($this->value($field) === '') {
            $this->add($field, "Preencha o campo {$label}.");
        }

        return $this;
    }

    public function email(string $field, string $label): static
    {
        $value = $this->value($field);

        if ($value !== '' && !filter_var($value, FILTER_VALIDATE_EMAIL)) {
            $this->add($field, "{$label} inválido.");
        }

        return $this;
    }

    public function min(string $field, int $length, string $label): static
    {
        $value = $this->data[$field] ?? '';

        if (is_string($value) && $value !== '' && mb_strlen($value) < $length) {
            $this->add($field, "{$label} deve ter no mínimo {$length} caracteres.");
        }

        return $this;
    }

    public function max(string $field, int $length, string $label): static
    {
        $value = $this->data[$field] ?? '';

        if (is_string($value) && mb_strlen($value) > $length) {
            $this->add($field, "{$label} deve ter no máximo {$length} caracteres.");
        }

        return $this;
    }

    public function integer(string $field, int $min, int $max, string $label): static
    {
        $value = filter_var(
            $this->value($field),
            FILTER_VALIDATE_INT,
            ['options' => ['min_range' => $min, 'max_range' => $max]]
        );

        if ($value === false) {
            $this->add($field, "{$label} deve ser um número entre {$min} e {$max}.");
        }

        return $this;
    }

    public function in(string $field, array $allowed, string $label): static
    {
        if (!in_array($this->value($field), $allowed, true)) {
            $this->add($field, "{$label} inválido.");
        }

        return $this;
    }

    public function matches(string $field, string $other, string $message): static
    {
        if (($this->data[$field] ?? null) !== ($this->data[$other] ?? null)) {
            $this->add($field, $message);
        }

        return $this;
    }

    public function fails(): bool
    {
        return $this->errors !== [];
    }

    public function firstError(): ?string
    {
        return $this->errors === [] ? null : reset($this->errors);
    }

    private function add(string $field, string $message): void
    {
        $this->errors[$field] ??= $message;
    }
}
