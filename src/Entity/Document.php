<?php

namespace App\Entity;

use App\Repository\DocumentRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=DocumentRepository::class)
 */
class Document
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $src_rtf;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $src_html;

    /**
     * @ORM\ManyToOne(targetEntity=Position::class, inversedBy="documents")
     * @ORM\JoinColumn(nullable=false)
     */
    private $positionId;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSrcRtf(): ?string
    {
        return $this->src_rtf;
    }

    public function setSrcRtf(string $src_rtf): self
    {
        $this->src_rtf = $src_rtf;

        return $this;
    }

    public function getSrcHtml(): ?string
    {
        return $this->src_html;
    }

    public function setSrcHtml(string $src_html): self
    {
        $this->src_html = $src_html;

        return $this;
    }

    public function getPositionId(): ?Position
    {
        return $this->positionId;
    }

    public function setPositionId(?Position $positionId): self
    {
        $this->positionId = $positionId;

        return $this;
    }
}
