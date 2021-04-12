<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Workout
 *
 * @ORM\Table(name="workout")
 * @ORM\Entity
 */
class Workout
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
     * @var int
     *
     * @ORM\Column(name="nbr_series", type="integer", nullable=false, options={"default"="1"})
     * @Assert\NotEqualTo(value = 0,message = "Le nombre des series doit étre > 1")
     */
    private $nbrSeries = 1;

    /**
     * @var int
     *
     * @ORM\Column(name="duree_serie", type="integer", nullable=false, options={"default"="20"})
     * @Assert\NotEqualTo(value = 0,message = "La durée d'une serie doit étre > 1")
     */
    private $dureeSerie = 20;

    /**
     * @var string|null
     *
     * @ORM\Column(name="body_part", type="string", length=255, nullable=false)
     * @Assert\NotBlank
     */
    private $bodyPart='';

    /**
     * @var string|null
     *
     * @ORM\Column(name="description", type="string", length=255, nullable=false)
     * @Assert\NotBlank
     */
    private $description='';

    /**
     * @var string|null
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=false)
     * @Assert\NotBlank
     */
    private $name = '';

    /**
     * Workout constructor.
     * @param int $id
     * @param int $nbrSeries
     * @param int $dureeSerie
     * @param string|null $bodyPart
     * @param string|null $description
     * @param string|null $name
     */

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
     * @return int
     */
    public function getNbrSeries(): int
    {
        return $this->nbrSeries;
    }

    /**
     * @param int $nbrSeries
     */
    public function setNbrSeries(int $nbrSeries): void
    {
        $this->nbrSeries = $nbrSeries;
    }

    /**
     * @return int
     */
    public function getDureeSerie(): int
    {
        return $this->dureeSerie;
    }

    /**
     * @param int $dureeSerie
     */
    public function setDureeSerie(int $dureeSerie): void
    {
        $this->dureeSerie = $dureeSerie;
    }

    /**
     * @return string|null
     */
    public function getBodyPart(): string
    {
        return $this->bodyPart;
    }

    /**
     * @param string $bodyPart
     */
    public function setBodyPart(string $bodyPart): void
    {
        $this->bodyPart = $bodyPart;
    }

    /**
     * @return string|null
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string|null $name
     */
    public function setName(?string $name): void
    {
        $this->name = $name;
    }


}
