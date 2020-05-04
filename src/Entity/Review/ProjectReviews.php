<?php
declare(strict_types=1);

namespace App\Entity\Review\ProjectReviews;

use App\Entity\BaseTrait;
use App\Entity\ReviewTrait;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="project_reviews", indexes={
 * @ORM\Index(name="project_idx", columns={"slug"})})
 * UniqueEntity("slug"),
 *        errorPath="slug",
 *        message="This slug is already in use!"
 * @ORM\Entity(repositoryClass="App\Repository\Review\ProjectReviewsRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class ProjectReviews
{
    use BaseTrait;
    use ReviewTrait;
    public const NUM_ROWS = 10;

    /**
     * @var string|null
     * @ORM\Column(name="project_id", type="string", nullable=true)
     */
    private $projectId;

    /**
     * @var string|null
     * @ORM\Column(name="project_uuid", type="string", nullable=true)
     */
    private $projectUuid;

    /**
     * @var string|null
     * @ORM\Column(name="project_slug", type="string", nullable=true)
     */
    private $projectSlug;

    /**
     * @return string|null
     */
    public function getProjectId(): ?string
    {
        return $this->projectId;
    }

    /**
     * @param string|null $projectId
     */
    public function setProjectId(?string $projectId): void
    {
        $this->projectId = $projectId;
    }

    /**
     * @return string|null
     */
    public function getProjectUuid(): ?string
    {
        return $this->projectUuid;
    }

    /**
     * @param string|null $projectUuid
     */
    public function setProjectUuid(?string $projectUuid): void
    {
        $this->projectUuid = $projectUuid;
    }

    /**
     * @return string|null
     */
    public function getProjectSlug(): ?string
    {
        return $this->projectSlug;
    }

    /**
     * @param string|null $projectSlug
     */
    public function setProjectSlug(?string $projectSlug): void
    {
        $this->projectSlug = $projectSlug;
    }

}