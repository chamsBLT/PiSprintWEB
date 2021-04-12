<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * Diet
 *
 * @ORM\Table(name="diet")
 * @ORM\Entity
 */
class Diet
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string|null
     *
     * @ORM\Column(name="breakfast", type="string", length=255, nullable=false)
     * @Assert\NotBlank
     */
    private $breakfast='';

    /**
     * @var string|null
     *
     * @ORM\Column(name="lunch", type="string", length=255, nullable=false)
     * @Assert\NotBlank
     */
    private $lunch='';

    /**
     * @var string|null
     *
     * @ORM\Column(name="dinner", type="string", length=255, nullable=false)
     * @Assert\NotBlank
     */
    private $dinner='';

    /**
     * @var string|null
     *
     * @ORM\Column(name="snacks", type="string", length=255, nullable=false)
     * @Assert\NotBlank
     */
    private $snacks='';

    /**
     * @var string|null
     *
     * @ORM\Column(name="calories", type="string", length=255, nullable=false)
     * @Assert\NotBlank
     */
    private $calories='';

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getBreakfast(): string
    {
        return $this->breakfast;
    }

    /**
     * @param string $breakfast
     */
    public function setBreakfast(string $breakfast): void
    {
        $this->breakfast = $breakfast;
    }

    /**
     * @return string
     */
    public function getLunch(): string
    {
        return $this->lunch;
    }

    /**
     * @param string $lunch
     */
    public function setLunch(string $lunch): void
    {
        $this->lunch = $lunch;
    }

    /**
     * @return string
     */
    public function getDinner(): string
    {
        return $this->dinner;
    }

    /**
     * @param string $dinner
     */
    public function setDinner(string $dinner): void
    {
        $this->dinner = $dinner;
    }

    /**
     * @return string
     */
    public function getSnacks(): string
    {
        return $this->snacks;
    }

    /**
     * @param string $snacks
     */
    public function setSnacks(string $snacks): void
    {
        $this->snacks = $snacks;
    }

    /**
     * @return string
     */
    public function getCalories(): string
    {
        return $this->calories;
    }

    /**
     * @param string $calories
     */
    public function setCalories(string $calories): void
    {
        $this->calories = $calories;
    }


}
