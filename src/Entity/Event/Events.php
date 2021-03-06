<?php

namespace App\Entity\Event;

use App\Entity\BaseTrait;
use DateTime;
use Doctrine\ORM\Mapping as ORM;

/**
 * Events
 *
 * @ORM\Table(name="events", indexes={
 *     @ORM\Index(name="event_idx_period", columns={"start_date", "end_date"}),
 *     @ORM\Index(name="event_idx_type", columns={"type"}),
 *     @ORM\Index(name="event_idx_published", columns={"published"}),
 *     @ORM\Index(name="event_idx_creator", columns={"creator_by"}),
 *     @ORM\Index(name="event_idx_cat_id", columns={"cat_id"})})
 * @ORM\Entity
 */
class Events
{
    use BaseTrait;

    /**
     * @var int
     *
     * @ORM\Column(name="parent", type="integer", nullable=false, options={"comment"="parent for recurring event"})
     */
    private $parent;

    /**
     * @var int
     *
     * @ORM\Column(name="cat_id", type="integer", nullable=false, options={"unsigned"=true})
     */
    private $catId;

    /**
     * @var int|null
     *
     * @ORM\Column(name="content_id", type="integer", nullable=true, options={"unsigned"=true,"comment"="0 - if type == profile, else it hold the group id"})
     */
    private $contentId = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=255, nullable=false, options={"default"="profile","comment"="profile, group"})
     */
    private $type = 'profile';


    /**
     * @var string
     *
     * @ORM\Column(name="location", type="text", length=65535, nullable=false)
     */
    private $location;

    /**
     * @var bool
     *
     * @ORM\Column(name="unlisted", type="boolean", nullable=false)
     */
    private $unlisted;

    /**
     * @var DateTime
     *
     * @ORM\Column(name="start_date", type="datetime", nullable=false)
     */
    private $startDate;

    /**
     * @var DateTime
     *
     * @ORM\Column(name="end_date", type="datetime", nullable=false)
     */
    private $endDate;

    /**
     * @var bool
     *
     * @ORM\Column(name="permission", type="boolean", nullable=false, options={"comment"="0 - Open (Anyone can mark attendence), 1 - Private (Only invited can mark attendence)"})
     */
    private $permission = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="cover", type="text", length=65535, nullable=false)
     */
    private $cover;

    /**
     * @var int|null
     *
     * @ORM\Column(name="invited_count", type="integer", nullable=true, options={"unsigned"=true})
     */
    private $invitedCount = '0';

    /**
     * @var int|null
     *
     * @ORM\Column(name="confirmed_count", type="integer", nullable=true, options={"unsigned"=true,"comment"="treat this as member count as well"})
     */
    private $confirmedCount = '0';

    /**
     * @var int|null
     *
     * @ORM\Column(name="declined_count", type="integer", nullable=true, options={"unsigned"=true})
     */
    private $declinedCount = '0';

    /**
     * @var int|null
     *
     * @ORM\Column(name="maybe_count", type="integer", nullable=true, options={"unsigned"=true})
     */
    private $maybeCount = '0';

    /**
     * @var int|null
     *
     * @ORM\Column(name="wall_count", type="integer", nullable=true, options={"unsigned"=true})
     */
    private $wallCount = '0';

    /**
     * @var int|null
     *
     * @ORM\Column(name="ticket", type="integer", nullable=true, options={"unsigned"=true,"comment"="Represent how many guest can be joined or invited."})
     */
    private $ticket = '0';

    /**
     * @var bool|null
     *
     * @ORM\Column(name="allow_invite", type="boolean", nullable=true, options={"default"="1","comment"="0 - guest member cannot invite thier friends to join. 1 - yes, guest member can invite any of thier friends to join."})
     */
    private $allowInvite = true;

    /**
     * @var int|null
     *
     * @ORM\Column(name="hits", type="integer", nullable=true, options={"unsigned"=true})
     */
    private $hits = '0';

    /**
     * @var float
     *
     * @ORM\Column(name="latitude", type="float", precision=10, scale=6, nullable=false, options={"default"="255.000000"})
     */
    private $latitude = '255.000000';

    /**
     * @var float
     *
     * @ORM\Column(name="longitude", type="float", precision=10, scale=6, nullable=false, options={"default"="255.000000"})
     */
    private $longitude = '255.000000';

    /**
     * @var string|null
     *
     * @ORM\Column(name="offset", type="string", length=5, nullable=true)
     */
    private $offset;

    /**
     * @var bool
     *
     * @ORM\Column(name="all_day", type="boolean", nullable=false)
     */
    private $allDay = '0';

    /**
     * @var string|null
     *
     * @ORM\Column(name="repeat", type="string", length=50, nullable=true, options={"comment"="null,daily,weekly,monthly"})
     */
    private $repeat;

    /**
     * @var DateTime
     *
     * @ORM\Column(name="repeat_end", type="date", nullable=false)
     */
    private $repeatEnd;

}
