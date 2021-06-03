<?php

namespace App\Entity;

use App\Repository\GameHouseRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=GameHouseRepository::class)
 */
class GameHouse
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $question;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $answera;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $answerb;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $answerc;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $answerd;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQuestion(): ?string
    {
        return $this->question;
    }

    public function getAnswera(): ?string
    {
        return $this->answera;
    }

    public function getAnswerb(): ?string
    {
        return $this->answerb;
    }

    public function getAnswerc(): ?string
    {
        return $this->answerc;
    }

    public function getAnswerd(): ?string
    {
        return $this->answerd;
    }

}
