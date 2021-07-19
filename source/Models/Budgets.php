<?php

namespace Source\Models;

use Source\Core\Model;

/**
 * Class Jobs
 * @package Source\Models
 */
class Budgets extends Model
{
    /**
     * Post constructor.
     */
    public function __construct()
    {
        parent::__construct("budget", ["id"], ["juridic", "first_name", "email", "telephone", "phone", "state", "city", "address", "zipcode", "msg"]);
    }


/**
     * @param string|null $juridic
     * @param string $firstName
     * @param string $email
     * @param string|null $telephone
     * @param string $phone
     * @param string|null $state
     * @param string|null $city
     * @param string|null $address
     * @param string|null $zipcode
     * @param string $msg
     * @return Contact
     */
    public function bootstrap(
        string $juridic,
        string $firstName,
        string $email,
        string $telephone,
        string $phone,
        string $state,
        string $city,
        string $address,
        string $zipcode,
        string $msg
    ): Budgets {
        $this->juridic = $juridic;
        $this->first_name = $firstName;
        $this->email = $email;
        $this->telephone = $telephone;
        $this->phone = $phone;
        $this->state = $state;
        $this->city = $city;
        $this->address = $address;
        $this->zipcode = $zipcode;
        $this->msg = $msg;
        return $this;
    }

    /**
     * @return bool
     */
    public function save(): bool

    {
         if (!$this->required()) {
        $this->message->warning("Nome, email e telefone são obrigatórios");
        return false;
    }

    if (!is_email($this->email)) {
        $this->message->warning("O e-mail informado não tem um formato válido");
        return false;
    }
           if (empty($this->id)) {

        $userId = $this->create($this->safe());
        if ($this->fail()) {
            $this->message->error("Erro ao enviar, verifique os dados");
            return false;
        }
    }
    $this->data = ($this->findById($userId))->data();
    return true;
    }
}