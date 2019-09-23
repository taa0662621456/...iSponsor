<?php
declare(strict_types=1);

namespace App\Entity\Category;

use \DateTime;
use Exception;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * @ORM\Table(name="categories", uniqueConstraints={
 * @ORM\UniqueConstraint(name="category_slug", columns={"category_slug"})})
 * @UniqueEntity("category_slug"),
 *		errorPath="category_slug",
 *		message="This slug is already in use!"
 * @ORM\Entity(repositoryClass="App\Repository\CategoriesRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Categories
{
    /**
     * @var int
     *
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var boolean
     *
     * @ORM\Column(name="published", type="boolean", nullable=false)
     */
    private $published = true;

	/**
	 * @var string
	 *
	 * @ORM\Column(name="category_slug", type="string", nullable=true, options={"default"="category_slug"})
	 * @Assert\NotBlank(message="categories.blank_content")
	 * @Assert\Length(min=4, minMessage="categories.too_short_content")
	 */
	private $categorySlug = 'category_slug';

    /**
     * @var DateTime
     *
     * @Assert\DateTime
     * @ORM\Column(name="created_on", type="datetime", nullable=false, options={"default":"CURRENT_TIMESTAMP"})
     */
    private $createdOn;

    /**
     * @var integer
     *
     * @ORM\Column(name="created_by", type="integer", nullable=false, options={"default" : 1})
     */
    private $createdBy = 0;

    /**
     * @var DateTime
     *
     * @Assert\DateTime
     * @ORM\Column(name="modified_on", type="datetime", nullable=false, options={"default":"CURRENT_TIMESTAMP"})
     */
    private $modifiedOn;

    /**
     * @var integer
     *
     * @ORM\Column(name="modified_by", type="integer", nullable=false, options={"default" : 1})
     */
    private $modifiedBy = 1;

    /**
     * @var DateTime
     *
     * @Assert\DateTime
     * @ORM\Column(name="locked_on", type="datetime", nullable=false, options={"default":"CURRENT_TIMESTAMP"})
     */
    private $lockedOn;

    /**
     * @var int
     *
     * @ORM\Column(name="locked_by", type="integer", nullable=false, options={"default" : 1})
     */
    private $lockedBy = 1;

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
        $this->createdOn = new DateTime();
        $this->modifiedOn = new DateTime();
        $this->lockedOn = new DateTime();
        $this->children = new ArrayCollection();
		$this->categoryProjects = new ArrayCollection();

		$this->categoryAttachments = new ArrayCollection();
    }






    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
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
	 * @return string
	 */
	public function getCategorySlug(): string
	{
		return $this->categorySlug;
	}

	/**
	 * @param string|null $categorySlug
	 */
	public function setCategorySlug(string $categorySlug = null): void
	{
		$this->categorySlug = $categorySlug;
	}


	/**
     * @return DateTime
     */
    public function getCreatedOn(): DateTime
    {
        return $this->createdOn;
    }

    /**
     * @ORM\PrePersist
     * @throws Exception
     */
    public function setCreatedOn(): void
    {
        $this->createdOn = new DateTime();
    }

    /**
     * @return integer
     */
    public function getCreatedBy(): int
    {
        return $this->createdBy;
    }

    /**
     * @param integer $createdBy
     */
    public function setCreatedBy(int $createdBy): void
    {
        $this->createdBy = $createdBy;
    }

    /**
     * @return DateTime
     */
    public function getModifiedOn(): DateTime
    {
        return $this->modifiedOn;
    }

    /**
     * @ORM\PreFlush
     * @ORM\PreUpdate
     * @throws Exception
     */
    public function setModifiedOn(): void
    {
        $this->modifiedOn = new DateTime();
    }

    /**
     * @return integer
     */
    public function getModifiedBy(): int
    {
        return $this->modifiedBy;
    }

    /**
     * @param integer $modifiedBy
     */
    public function setModifiedBy(int $modifiedBy): void
    {
        $this->modifiedBy = $modifiedBy;
    }

    /**
     * @return DateTime
     */
    public function getLockedOn(): DateTime
    {
        return $this->lockedOn;
    }

    /**
     * @param datetime $lockedOn
     */
    public function setLockedOn(DateTime $lockedOn): void
    {
        $this->lockedOn = $lockedOn;
    }

    /**
     * @return integer
     */
    public function getLockedBy(): int
    {
        return $this->lockedBy;
    }

    /**
     * @param integer $lockedBy
     */
    public function setLockedBy(int $lockedBy): void
    {
        $this->lockedBy = $lockedBy;
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
