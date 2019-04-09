<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ClassRoomRepository")
 */
class ClassRoom
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $user_id;

    /**
     * @ORM\Column(type="integer")
     */
    private $step;

    /**
     * @ORM\Column(type="boolean")
     */
    private $is_completed;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $score;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date_started;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $date_completed;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUserId(): ?int
    {
        return $this->user_id;
    }

    public function setUserId(int $user_id): self
    {
        $this->user_id = $user_id;

        return $this;
    }

    public function getStep(): ?int
    {
        return $this->step;
    }

    public function setStep(int $step): self
    {
        $this->step = $step;

        return $this;
    }

    public function getIsCompleted(): ?bool
    {
        return $this->is_completed;
    }

    public function setIsCompleted(bool $is_completed): self
    {
        $this->is_completed = $is_completed;

        return $this;
    }

    public function getScore(): ?int
    {
        return $this->score;
    }

    public function setScore(?int $score): self
    {
        $this->score = $score;

        return $this;
    }

    public function getDateStarted(): ?\DateTimeInterface
    {
        return $this->date_started;
    }

    public function setDateStarted(\DateTimeInterface $date_started): self
    {
        $this->date_started = $date_started;

        return $this;
    }

    public function getDateCompleted(): ?\DateTimeInterface
    {
        return $this->date_completed;
    }

    public function setDateCompleted(?\DateTimeInterface $date_completed): self
    {
        $this->date_completed = $date_completed;

        return $this;
    }
}
