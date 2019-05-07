<?php

namespace App\Entity;

use App\Entity\Property;
use Symfony\Component\Validator\Constraints as Assert;


class Contact {

    /**
     * @var string|null
     * @Assert\NotBlank()
     * @Assert\Length(min=2, max=100)
     */
    private $firstname;

    /**
     * @var string|null
     * @Assert\NotBlank()
     * @Assert\Length(min=2, max=100)
     */
    private $lastname;

    /**
     * @var string|null
     * @Assert\NotBlank()
     * @Assert\Regex(
     *  pattern="/[0-9]{10}/"
     * )
     */
    private $phone;

    /**
     * @var string|null
     * @Assert\NotBlank()
     * @Assert\Email()
     */
    private $email;

    /**
     * @var string|null
     * @Assert\NotBlank()
     * @Assert\Length(min=10)
     */
    private $message;

    /**
     * @var Property|null
     */
    private $property;


    /**
     * @return null|string
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * @param null|string $firstname
     * @return Contact
     */
    public function setFirstname(string $firstname)
    {
        $this->firstname = $firstname;
        return $this;
    }


    /**
     * @return null|string
     */
    public function getLastname()
    {
        return$this->lastname;
    }

    /**
     * @param null|string $lastname
     * @return Contact
     */
    public function setLastname(string $lastname)
    {
        $this->lastname = $lastname;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getPhone()
    {
        return$this->phone;
    }

    /**
     * @param null|string $phone
     * @return Contact
     */
    public function setPhone(string $phone)
    {
        $this->phone = $phone;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getEmail()
    {
        return$this->email;
    }

    /**
     * @param null|string $email
     * @return Contact
     */
    public function setEmail(string $email)
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getMessage()
    {
        return$this->message;
    }

    /**
     * @param null|string $message
     * @return Contact
     */
    public function setMessage(string $message)
    {
        $this->message = $message;
        return $this;
    }

    /**
     * @return Property|null
     */
    public function getProperty()
    {
        return$this->property;
    }

    /**
     * @param null|Property $property
     * @return Contact
     */
    public function setProperty(Property $property)
    {
        $this->property = $property;
        return $this;
    }
}