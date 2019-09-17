<?php
declare(strict_types=1);

namespace App\Entity\Category;

use \DateTime;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;
use Exception;

/**
 * @ORM\Table(name="categories_attachments")
 * @ORM\Entity(repositoryClass="App\Repository\CategoriesRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class CategoriesAttachments
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
     * //пока только картинки, а вообще поле для разных типов (сохраняет имена файлов)
     * @var string
     *
     * @ORM\Column(name="file", type="string", nullable=false, options={"default"="no image"})
     * @Assert\NotBlank(message="Please, upload the category's pictures as a jpeg/jpg file.")
     * @Assert\File(mimeTypes={"image/jpeg", "image/jpg"}, mimeTypesMessage="Please, upload the jpeg/jpg files only")
     */
    protected $file = 'no image';

    /**
     * @var string
     *
     * @ORM\Column(name="file_title", type="string", nullable=false, options={"default"="file_title"})
     */
    private $fileTitle = 'file_title';

    /**
     * @var string
     *
     * @ORM\Column(name="file_description", type="string", nullable=false, options={"default"="file_description"})
     */
    private $fileDescription = 'file_description';

    /**
     * @var string
     *
     * @ORM\Column(name="file_meta", type="string", nullable=false, options={"default"="file_meta"})
     */
    private $fileMeta = 'file_meta';

    /**
     * @var string
     *
     * @ORM\Column(name="file_class", type="string", nullable=false, options={"default"="file_class"})
     */
    private $fileClass = 'file_class';

    /**
     * @var string
     * @Assert\NotBlank(message="Please, upload a file.")
     * @ORM\Column(name="file_mime_type", type="string", nullable=false, options={"default"="file_mime_type"})
     */
    private $fileMimeType = '';

    /**
     * @var string
     *
     * @ORM\Column(name="file_type", type="string", nullable=false, options={"default"=""})
     */
    private $fileType = '';

    /**
     * @var string
     *
     * @ORM\Column(name="file_url", type="string", nullable=false, options={"default"=""})
     */
    private $fileUrl = '';

    /**
     * @var string
     *
     * @ORM\Column(name="file_url_thumb", type="string", nullable=false, options={"default"=""})
     */
    private $fileUrlThumb = '';

    /**
     * @var boolean|true
     *
     * @ORM\Column(name="file_is_product_image", type="boolean", nullable=false)
     */
    private $fileIsProductImage = true;

    /**
     * @var boolean|false
     *
     * @ORM\Column(name="file_is_downloadable", type="boolean", nullable=false)
     */
    private $fileIsDownloadable = false;

    /**
     * @var boolean|false
     *
     * @ORM\Column(name="file_is_for_sale", type="boolean", nullable=false)
     */
    private $fileIsForSale = false;

    /**
     * @var string
     *
     * @ORM\Column(name="file_params", type="string", nullable=false, options={"default"="file_params"})
     */
    private $fileParams = 'file_params';

    /**
     * @var string
     *
     * @ORM\Column(name="file_lang", type="string", nullable=false, options={"default"="file_lang"})
     */
    private $fileLang = 'file_lang';

    /**
     * @var boolean|false
     *
     * @ORM\Column(name="is_shared", type="boolean", nullable=false)
     */
    private $isShared = false;

    /**
     * @var boolean|true
     *
     * @ORM\Column(name="published", type="boolean", nullable=false, options={"default"="1"})
     */
    private $published = true;

    /**
     * @var DateTime
     *
     * @ORM\Column(name="created_on", type="datetime", nullable=false)
     */
    private $createdOn;

    /**
     * @var int
     *
     * @ORM\Column(name="created_by", type="integer", nullable=false)
     */
    private $createdBy = 0;

    /**
     * @var DateTime
     *
     * @ORM\Column(name="modified_on", type="datetime", nullable=false)
     */
    private $modifiedOn;

    /**
     * @var int
     *
     * @ORM\Column(name="modified_by", type="integer", nullable=false)
     */
    private $modifiedBy = 0;

    /**
     * @var datetime
     *
     * @ORM\Column(name="locked_on", type="datetime", nullable=false, options={"default":"CURRENT_TIMESTAMP"})
     */
    private $lockedOn;

    /**
     * @var int
     *
     * @ORM\Column(name="locked_by", type="integer", nullable=false)
     */
    private $lockedBy = 0;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Category\Categories", inversedBy="categoryAttachments")
	 * @ORM\JoinColumn(name="categoryAttachments_id", referencedColumnName="id")
     */
    private $categoryAttachments;









    /**
     * CategoriesAttachments constructor.
     * @throws Exception
     */
    public function __construct()
    {
        $this->lockedOn = new DateTime();
        $this->modifiedOn = new DateTime();
        $this->createdOn = new DateTime();
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getFile(): string
    {
        return $this->file;
    }

    /**
     * @param string $file
     */
    public function setFile(string $file): void
    {
        $this->file = $file;
    }

    /**
     * @return string
     */
    public function getFileTitle(): string
    {
        return $this->fileTitle;
    }

    /**
     * @param string $fileTitle
     * @return CategoriesAttachments
     */
    public function setFileTitle(string $fileTitle): self
    {
        $this->fileTitle = $fileTitle;
        return $this;
    }

    /**
     * @return string
     */
    public function getFileDescription(): string
    {
        return $this->fileDescription;
    }

    /**
     * @param string $fileDescription
     * @return CategoriesAttachments
     */
    public function setFileDescription(string $fileDescription): self
    {
        $this->fileDescription = $fileDescription;
        return $this;
    }

    /**
     * @return string
     */
    public function getFileMeta(): string
    {
        return $this->fileMeta;
    }

    /**
     * @param string $fileMeta
     * @return CategoriesAttachments
     */
    public function setFileMeta(string $fileMeta): self
    {
        $this->fileMeta = $fileMeta;
        return $this;
    }

    /**
     * @return string
     */
    public function getFileClass(): string
    {
        return $this->fileClass;
    }

    /**
     * @param string $fileClass
     * @return CategoriesAttachments
     */
    public function setFileClass(string $fileClass): self
    {
        $this->fileClass = $fileClass;
        return $this;
    }

    /**
     * @return string
     */
    public function getFileMimeType(): string
    {
        return $this->fileMimeType;
    }

    /**
     * @param string $fileMimeType
     * @return CategoriesAttachments
     */
    public function setFileMimeType(string $fileMimeType): self
    {
        $this->fileMimeType = $fileMimeType;
        return $this;
    }

    /**
     * @return string
     */
    public function getFileType(): string
    {
        return $this->fileType;
    }

    /**
     * @param string $fileType
     * @return CategoriesAttachments
     */
    public function setFileType(string $fileType): self
    {
        $this->fileType = $fileType;
        return $this;
    }

    /**
     * @return string
     */
    public function getFileUrl(): string
    {
        return $this->fileUrl;
    }

    /**
     * @param string $fileUrl
     * @return CategoriesAttachments
     */
    public function setFileUrl(string $fileUrl): self
    {
        $this->fileUrl = $fileUrl;
        return $this;
    }

    /**
     * @return string
     */
    public function getFileUrlThumb(): string
    {
        return $this->fileUrlThumb;
    }

    /**
     * @param string $fileUrlThumb
     * @return CategoriesAttachments
     */
    public function setFileUrlThumb(string $fileUrlThumb): self
    {
        $this->fileUrlThumb = $fileUrlThumb;
        return $this;
    }

	/**
	 * @return mixed
	 */
	public function getCategoryAttachments()
	{
		return $this->categoryAttachments;
	}

	/**
	 * @param mixed $categoryAttachments
	 */
	public function setCategoryAttachments($categoryAttachments): void
	{
		$this->categoryAttachments = $categoryAttachments;
	}



    /**
     * @return bool
     */
    public function isFileIsProductImage(): bool
    {
        return $this->fileIsProductImage;
    }

    /**
     * @param bool $fileIsProductImage
     * @return CategoriesAttachments
     */
    public function setFileIsProductImage(bool $fileIsProductImage): self
    {
        $this->fileIsProductImage = $fileIsProductImage;
        return $this;
    }

    /**
     * @return bool
     */
    public function fileIsDownloadable(): bool
    {
        return $this->fileIsDownloadable;
    }

    /**
     * @param bool $fileIsDownloadable
     * @return CategoriesAttachments
     */
    public function setFileIsDownloadable(bool $fileIsDownloadable): self
    {
        $this->fileIsDownloadable = $fileIsDownloadable;
        return $this;
    }

    /**
     * @return bool
     */
    public function fileIsForSale(): bool
    {
        return $this->fileIsForSale;
    }

    /**
     * @param bool $fileIsForSale
     * @return CategoriesAttachments
     */
    public function setFileIsForSale(bool $fileIsForSale): self
    {
        $this->fileIsForSale = $fileIsForSale;
        return $this;
    }

    /**
     * @return string
     */
    public function getFileParams(): string
    {
        return $this->fileParams;
    }

    /**
     * @param string $fileParams
     * @return CategoriesAttachments
     */
    public function setFileParams(string $fileParams): self
    {
        $this->fileParams = $fileParams;
        return $this;
    }

    /**
     * @return string
     */
    public function getFileLang(): string
    {
        return $this->fileLang;
    }

    /**
     * @param string $fileLang
     * @return CategoriesAttachments
     */
    public function setFileLang(string $fileLang): self
    {
        $this->fileLang = $fileLang;
        return $this;
    }

    /**
     * @return bool
     */
    public function isShared(): bool
    {
        return $this->isShared;
    }

    /**
     * @param bool $isShared
     * @return CategoriesAttachments
     */
    public function setIsShared(bool $isShared): self
    {
        $this->isShared = $isShared;
        return $this;
    }

    /**
     * @return bool
     */
    public function isPublished(): bool
    {
        return $this->published;
    }

    /**
     * @param bool $published
     * @return CategoriesAttachments
     */
    public function setPublished(bool $published): self
    {
        $this->published = $published;
        return $this;
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
     * @return int
     */
    public function getCreatedBy(): int
    {
        return $this->createdBy;
    }

    /**
     * @param int $createdBy
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
     * @return int
     */
    public function getModifiedBy(): int
    {
        return $this->modifiedBy;
    }

    /**
     * @param int $modifiedBy
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
     * @ORM\PreFlush
     * @ORM\PreUpdate
     * @throws Exception

     */
    public function setLockedOn(): void
    {
        $this->lockedOn = new DateTime();
    }

    /**
     * @return int
     */
    public function getLockedBy(): int
    {
        return $this->lockedBy;
    }

    /**
     * @param int $lockedBy
     */
    public function setLockedBy(int $lockedBy): void
    {
        $this->lockedBy = $lockedBy;
    }
}
