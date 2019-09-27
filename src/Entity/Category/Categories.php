<?php
declare(strict_types=1);

namespace App\Entity\Category;

use App\Entity\EntitySystemTrait;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Exception;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * @ORM\Table(name="categories", uniqueConstraints={
 * @ORM\UniqueConstraint(name="slug", columns={"slug"})})
 * @UniqueEntity("slug"),
 *        errorPath="slug",
 *		message="This slug is already in use!"
 * @ORM\Entity(repositoryClass="App\Repository\CategoriesRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Categories
{
	use EntitySystemTrait;

    /**
     * @var boolean
     *
     * @ORM\Column(name="published", type="boolean", nullable=false)
     */
    private $published = true;

    /**
     * @var int
     *
	 * @ORM\GeneratedValue()
     * @ORM\Column(name="ordering", type="integer", nullable=false, unique=true, options={"default" : 1})
     */
    private $ordering = 1;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Category\Categories", mappedBy="parent", fetch="EXTRA_LAZY")
     */
    private $children;

	/**
	 * @ORM\ManyToOne(targetEntity="App\Entity\Category\Categories",
	 *      cascade={"persist"},
	 *      inversedBy="children"
	 * )
	 * @ORM\JoinColumn(name="parent_id", referencedColumnName="id")
	 */
    private $parent;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Project\Projects",
	 *      cascade={"persist"},
	 *      mappedBy="projectCategory",
	 *      fetch="EXTRA_LAZY"
	 * )
     */
    private $categoryProjects;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Category\CategoriesEnGb",
	 *     cascade={"persist", "remove"},
	 *     mappedBy="categoriesEnGb",
	 *     orphanRemoval=true
	 *	 )
     * @Assert\Type(type="App\Entity\Category\CategoriesEnGb")
     * @Assert\Valid()
     */
    private $categoryEnGb;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Category\CategoriesAttachments", cascade={"persist", "remove"}, mappedBy="categoryAttachments", orphanRemoval=true)
	 * @Assert\Type(type="App\Entity\Vendor\VendorsDocAttachments")
	 * @Assert\Valid()
     */
    private $categoryAttachments;









    /**
     * Categories constructor.
     * @throws Exception
     */
    public function __construct()
    {
        $this->children = new ArrayCollection();
		$this->categoryProjects = new ArrayCollection();
		$this->categoryAttachments = new ArrayCollection();
    }

    /**
     * @return bool|false
     */
    public function isPublished(): bool
    {
        return $this->published;
    }

    /**
     * @param bool $published
     */
    public function setPublished(bool $published): void
    {
        $this->published = $published;
    }

	/**
	 * @return ArrayCollection
	 */
	public function getCategoryProjects(): ArrayCollection
	{
		return $this->categoryProjects;
	}

	/**
	 * @param ArrayCollection $categoryProjects
	 */
	public function setCategoryProjects(ArrayCollection $categoryProjects): void
	{
		$this->categoryProjects = $categoryProjects;
	}


    /**
     * @return mixed
     */
    public function getCategoryEnGb()
    {
        return $this->categoryEnGb;
    }

    /**
     * @param mixed $categoryEnGb
     */
    public function setCategoryEnGb($categoryEnGb): void
    {
        $this->categoryEnGb = $categoryEnGb;
    }

	/**
	 * @return int
	 */
	public function getOrdering(): int
	{
		return $this->ordering;
	}

	/**
	 * @param int $ordering
	 */
	public function setOrdering(int $ordering): void
	{
		$this->ordering = $ordering;
	}




    /**
     * @param Categories $children
     * @return Categories
     */
    public function addChild(Categories $children): Categories
    {
        $this->children[] = $children;

        return $this;
    }

    /**
     * @param Categories $children
     */
    public function removeChild(Categories $children): void
    {
        $this->children->removeElement($children);
    }

    /**
	 * @return Collection
     */
    public function getChildren()
    {
        return $this->children;
    }

	/**
	 * @return Categories
	 */
	public function getParent()
	{
		return $this->parent;
	}

	/**
	 * @param Categories $parent
	 *
	 * @return Categories
	 */
	public function setParent(Categories $parent = null): Categories
	{
		$this->parent = $parent;

		return $this;
	}


	/**
	 * @param CategoriesAttachments $attachments
	 */
    public function addCategoryAttachment(CategoriesAttachments $attachments): void
    {
        foreach ($attachments as $attachment) {
            if (!$this->categoryAttachments->contains($attachment)) {
                $this->categoryAttachments->add($attachment);
            }
        }
    }


    /**
     * @param CategoriesAttachments $attachment
     */
    public function removeCategoryAttachment(CategoriesAttachments $attachment): void
    {
        $this->categoryAttachments->removeElement($attachment);
    }

    /**
     * @return Collection|CategoriesAttachments[]
     */
    public function getCategoryAttachments(): Collection
    {
        return $this->categoryAttachments;
    }

}
