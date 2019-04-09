<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\QuizQuestionsRepository")
 */
class QuizQuestions
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
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
    private $option_1;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $option_2;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $option_3;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $option_4;

    /**
     * @ORM\Column(type="integer")
     */
    private $correct_answer;

    /**
     * @ORM\Column(type="datetime")
     */
    private $last_updated;

    /**
     * @ORM\Column(type="datetime")
     */
    private $created_on;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQuestion(): ?string
    {
        return $this->question;
    }

    public function setQuestion(string $question): self
    {
        $this->question = $question;

        return $this;
    }

    public function getOption1(): ?string
    {
        return $this->option_1;
    }

    public function setOption1(string $option_1): self
    {
        $this->option_1 = $option_1;

        return $this;
    }

    public function getOption2(): ?string
    {
        return $this->option_2;
    }

    public function setOption2(string $option_2): self
    {
        $this->option_2 = $option_2;

        return $this;
    }

    public function getOption3(): ?string
    {
        return $this->option_3;
    }

    public function setOption3(string $option_3): self
    {
        $this->option_3 = $option_3;

        return $this;
    }

    public function getOption4(): ?string
    {
        return $this->option_4;
    }

    public function setOption4(string $option_4): self
    {
        $this->option_4 = $option_4;

        return $this;
    }

    public function getCorrectAnswer(): ?int
    {
        return $this->correct_answer;
    }

    public function setCorrectAnswer(int $correct_answer): self
    {
        $this->correct_answer = $correct_answer;

        return $this;
    }

    public function getLastUpdated(): ?\DateTimeInterface
    {
        return $this->last_updated;
    }

    public function setLastUpdated(\DateTimeInterface $last_updated): self
    {
        $this->last_updated = $last_updated;

        return $this;
    }

    public function getCreatedOn(): ?\DateTimeInterface
    {
        return $this->created_on;
    }

    public function setCreatedOn(\DateTimeInterface $created_on): self
    {
        $this->created_on = $created_on;

        return $this;
    }
}
