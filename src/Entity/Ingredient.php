<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * Ingredient
 *
 * @ORM\Table(name="ingredient")
 * @ORM\Entity
 */
class Ingredient
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @Groups("ingredient:read")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="category", type="string", length=255, nullable=false)
     * @Assert\NotBlank
     * @Groups("ingredient:read")
     */
    private $category='';

    /**
     * @var string
     *
     * @ORM\Column(name="calories_category", type="string", length=255, nullable=false)
     * @Assert\NotBlank
     * @Groups("ingredient:read")
     */
    private $caloriesCategory='';

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=false)
     * @Assert\NotBlank
     * @Groups("ingredient:read")
     */
    private $name='';

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
    public function getCategory(): string
    {
        return $this->category;
    }

    /**
     * @param string $category
     */
    public function setCategory(string $category): void
    {
        $this->category = $category;
    }

    /**
     * @return string
     */
    public function getCaloriesCategory(): string
    {
        return $this->caloriesCategory;
    }

    /**
     * @param string $caloriesCategory
     */
    public function setCaloriesCategory(string $caloriesCategory): void
    {
        $this->caloriesCategory = $caloriesCategory;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function findByCategory($category){
        return $this->createQueryBuilder('ingredient')
            ->where('ingredient.category LIKE :category')
            ->setParameter('category', '%'.$category.'%')
            ->getQuery()
            ->getResult();
    }

}
