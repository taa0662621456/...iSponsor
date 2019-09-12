<?php
declare(strict_types=1);

namespace App\Entity\Category;

use App\Entity\Project\Projects;
use Exception;
use Symfony\Component\Validator\Constraints\DateTime;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * @ORM\Table(name="categories")
 * @ORM\Entity(repositoryClass="App\Repository\CategoriesRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Categories
{
    /**
     * @var integer
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(name="id", type="integer", nullable=false)
     */
    private $id;

    /**
     * @var boolean
     *
     * @ORM\Column(name="published", type="boolean", nullable=false)
     */
    private $published = true;

    /**
     * @var DateTime
     *
     * @Assert\DateTime
     * @ORM\Column(name="created_on", type="datetime", nullable=false)
     */
    private $createdOn;

    /**
     * @var integer
     *
     * @ORM\Column(name="created_by", type="integer", nullable=false)
     */
    private $createdBy = 0;

    /**
     * @var DateTime
     *
     * @Assert\DateTime
     * @ORM\Column(name="modified_on", type="datetime", nullable=false)
     */
    private $modifiedOn;

    /**
     * @var integer
     *
     * @ORM\Column(name="modified_by", type="integer", nullable=false)
     */
    private $modifiedBy = 0;

    /**
     * @var DateTime
     *
     * @Assert\DateTime
     * @ORM\Column(name="locked_on", type="datetime", nullable=false)
     */
    private $lockedOn;

    /**
     * @var int
     *
     * @ORM\Column(name="locked_by", type="integer", nullable=false)
     */
    private $lockedBy = 0;

    /**
     * @var int
     *
     * @ORM\Column(name="ordering", type="integer", nullable=false, unique=true)
	 * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $ordering = 0;


    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Category\Categories", mappedBy="parent")
     */
    private $children;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Category\Categories", inversedBy="children")
     * @ORM\JoinColumn(name="parent_id", referencedColumnName="id")
     */
    private $parent;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Project\Projects", cascade={"persist"}, mappedBy="projectCategory")
     */
    private $projectCategory;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Category\CategoriesEnGb", cascade={"persist", "remove"}, mappedBy="categoriesEnGb")
     * @Assert\Type(type="App\Entity\Category\CategoriesEnGb")
     * @Assert\Valid()
     */
    private $categoryEnGb;


    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Category\CategoriesAttachments", mappedBy="category")
     */
    private $categoryAttachments;









    /**
     * Categories constructor.
     * @throws Exception
     */
    public function __construct()
    {

        $this->createdOn = new \DateTime();
        $this->modifiedOn = new \DateTime();
        $this->lockedOn = new \DateTime();
        $this->children = new ArrayCollection();
        $this->projectCategory = new ArrayCollection();
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
     * @return \DateTime
     */
    public function getCreatedOn(): \DateTime
    {
        return $this->createdOn;
    }

    /**
     * @ORM\PrePersist
     * @throws Exception
     */
    public function setCreatedOn(): void
    {
        $this->createdOn = new \DateTime();
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
     * @return \DateTime
     */
    public function getModifiedOn(): \DateTime
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
        $this->modifiedOn = new \DateTime();
    }

    /**
     * @return integer
     */
    public function getModifiedBy(): int
    {
        return $this->modifiedBy;
    }

    /**
     *
     * @param integer $modifiedBy
     */
    public function setModifiedBy(int $modifiedBy): void
    {
        $this->modifiedBy = $modifiedBy;
    }

    /**
     * @return \DateTime
     */
    public function getLockedOn(): \DateTime
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
     * @return Collection|Projects[]
     */
    public function getProjectCategory(): Collection
    {
        return $this->projectCategory;
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
     * Get children
     * @return mixed
     */
    public function getChildren()
    {
        return $this->children;
    }

    /**
     * @return mixed
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * @param Categories $parent
     */
    public function setParent(Categories $parent = null): void
    {
        $this->parent = $parent;
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
