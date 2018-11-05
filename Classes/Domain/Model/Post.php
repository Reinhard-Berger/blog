<?php
declare(strict_types = 1);

/*
 * This file is part of the package t3g/blog.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace T3G\AgencyPack\Blog\Domain\Model;

/*
 * This file is part of the TYPO3 CMS project.
 *
 * It is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License, either version 2
 * of the License, or any later version.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * The TYPO3 project - inspiring people to share!
 */
use T3G\AgencyPack\Blog\Domain\Repository\CommentRepository;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;
use TYPO3\CMS\Extbase\Mvc\Web\Routing\UriBuilder;
use TYPO3\CMS\Extbase\Object\ObjectManager;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;

/**
 * Class Post.
 */
class Post extends AbstractEntity
{
    /**
     * The blog post title.
     *
     * @var string
     */
    protected $title;

    /**
     * The blog post subtitle.
     *
     * @var string
     */
    protected $subtitle;

    /**
     * The blog post abstract (SEO, list if not empty).
     *
     * @var string
     */
    protected $abstract;

    /**
     * The blog post description (SEO, list if not empty).
     *
     * @var string
     */
    protected $description;

    /**
     * The blog post creation date.
     *
     * @var \DateTime
     */
    protected $crdate;

    /**
     * The blog post categories.
     *
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\T3G\AgencyPack\Blog\Domain\Model\Category>
     */
    protected $categories;

    /**
     * Comments active flag for this blog post.
     *
     * @var bool
     */
    protected $commentsActive = false;

    /**
     * Comments of the blog post.
     *
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\T3G\AgencyPack\Blog\Domain\Model\Comment>
     */
    protected $comments;

    /**
     * Tags of the blog post.
     *
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\T3G\AgencyPack\Blog\Domain\Model\Tag>
     */
    protected $tags;

    /**
     * Sharing enabled flag for this blog post. This flag can be used in views to enable sharing tools.
     *
     * @var bool
     */
    protected $sharingEnabled;

    /**
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\CMS\Extbase\Domain\Model\FileReference>
     */
    protected $media;

    /**
     * @var int
     */
    protected $archiveDate;

    /**
     * @var int
     */
    protected $publishDate;

    /**
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\T3G\AgencyPack\Blog\Domain\Model\Author>
     */
    protected $authors;

    /**
     * Post constructor.
     */
    public function __construct()
    {
        $this->initializeObject();
    }

    /**
     * initializeObject
     */
    public function initializeObject(): void
    {
        $this->categories = new ObjectStorage();
        $this->comments = new ObjectStorage();
        $this->tags = new ObjectStorage();
        $this->authors = new ObjectStorage();
        $this->media = new ObjectStorage();
    }

    /**
     * @param Author $author
     * @return Post
     */
    public function addAuthor(Author $author): self
    {
        $this->authors->attach($author);
        return $this;
    }

    /**
     * @param Author $author
     * @return Post
     */
    public function removeAuthor(Author $author): self
    {
        $this->authors->detach($author);
        return $this;
    }

    /**
     * @return ObjectStorage
     */
    public function getAuthors(): ObjectStorage
    {
        return $this->authors;
    }

    /**
     * @param ObjectStorage $authors
     * @return Post
     */
    public function setAuthors(ObjectStorage $authors): self
    {
        $this->authors = $authors;
        return $this;
    }

    /**
     * @return string
     */
    public function getTitle(): ?string
    {
        return $this->title;
    }

    /**
     * @param string $title
     * @return Post
     */
    public function setTitle($title): self
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @return string
     */
    public function getSubtitle(): ?string
    {
        return $this->subtitle;
    }

    /**
     * @param $subtitle
     * @return Post
     */
    public function setSubtitle($subtitle): self
    {
        $this->subtitle = $subtitle;
        return $this;
    }

    /**
     * @return string
     */
    public function getAbstract(): ?string
    {
        return $this->abstract;
    }

    /**
     * @param string $abstract
     * @return Post
     */
    public function setAbstract($abstract): self
    {
        $this->abstract = $abstract;
        return $this;
    }

    /**
     * @return string
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @param string $description
     * @return Post
     */
    public function setDescription($description): self
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @return ObjectStorage
     */
    public function getCategories(): ObjectStorage
    {
        return $this->categories;
    }

    /**
     * @param ObjectStorage $categories
     * @return Post
     */
    public function setCategories($categories): self
    {
        $this->categories = $categories;
        return $this;
    }

    /**
     * @param Category $category
     * @return Post
     */
    public function addCategory(Category $category): self
    {
        $this->categories->attach($category);
        return $this;
    }

    /**
     * @param Category $category
     *
     * @return Post
     */
    public function removeCategory(Category $category): self
    {
        $this->categories->detach($category);
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getCrdate(): \DateTime
    {
        return $this->crdate;
    }

    /**
     * @param \DateTime $crdate
     * @return Post
     */
    public function setCrdate($crdate): self
    {
        $this->crdate = $crdate;
        return $this;
    }

    /**
     * @return bool
     */
    public function getCommentsActive(): bool
    {
        return $this->commentsActive;
    }

    /**
     * @param bool $commentsActive
     * @return Post
     */
    public function setCommentsActive($commentsActive): self
    {
        $this->commentsActive = $commentsActive;
        return $this;
    }

    /**
     * @return ObjectStorage
     */
    public function getComments(): ObjectStorage
    {
        return $this->comments;
    }

    /**
     * @return array|\TYPO3\CMS\Extbase\Persistence\QueryResultInterface
     * @throws \TYPO3\CMS\Core\Context\Exception\AspectNotFoundException
     * @throws \TYPO3\CMS\Extbase\Persistence\Exception\InvalidQueryException
     */
    public function getActiveComments()
    {
        return GeneralUtility::makeInstance(ObjectManager::class)
            ->get(CommentRepository::class)
            ->findAllByPost($this);
    }

    /**
     * @param ObjectStorage $comments
     *
     * @return Post
     */
    public function setComments($comments): self
    {
        $this->comments = $comments;
        return $this;
    }

    /**
     * @param Comment $comment
     * @return Post
     */
    public function addComment(Comment $comment): self
    {
        $this->comments->attach($comment);
        return $this;
    }

    /**
     * @param Comment $comment
     * @return Post
     */
    public function removeComment(Comment $comment): self
    {
        $this->comments->detach($comment);
        return $this;
    }

    /**
     * @return bool
     */
    public function isSharingEnabled(): bool
    {
        return $this->sharingEnabled;
    }

    /**
     * @param bool $sharingEnabled
     * @return Post
     */
    public function setSharingEnabled(bool $sharingEnabled): self
    {
        $this->sharingEnabled = $sharingEnabled;
        return $this;
    }

    /**
     * @return ObjectStorage
     */
    public function getTags(): ObjectStorage
    {
        return $this->tags;
    }

    /**
     * @param ObjectStorage $tags
     *
     * @return Post
     */
    public function setTags(ObjectStorage $tags): self
    {
        $this->tags = $tags;
        return $this;
    }

    /**
     * @param Tag $tag
     * @return Post
     */
    public function addTag(Tag $tag): self
    {
        $this->tags->attach($tag);
        return $this;
    }

    /**
     * @param Tag $tag
     * @return Post
     */
    public function removeTag(Tag $tag): self
    {
        $this->tags->detach($tag);
        return $this;
    }

    /**
     * @return ObjectStorage
     */
    public function getMedia(): ObjectStorage
    {
        return $this->media;
    }

    /**
     * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\CMS\Extbase\Domain\Model\FileReference> $media
     * @return Post
     */
    public function setMedia(ObjectStorage $media): self
    {
        $this->media = $media;
        return $this;
    }

    /**
     * @return int
     */
    public function getArchiveDate(): ?int
    {
        return $this->archiveDate;
    }

    /**
     * @param int $archiveDate
     * @return Post
     */
    public function setArchiveDate(int $archiveDate): self
    {
        $this->archiveDate = $archiveDate;
        return $this;
    }

    /**
     * @return int
     */
    public function getPublishDate(): ?int
    {
        return $this->publishDate;
    }

    /**
     * @param int $publishDate
     * @return Post
     */
    public function setPublishDate(int $publishDate): self
    {
        $this->publishDate = $publishDate;
        return $this;
    }

    /**
     * @return string
     * @throws \InvalidArgumentException
     */
    public function getUri(): string
    {
        return GeneralUtility::makeInstance(ObjectManager::class)
            ->get(UriBuilder::class)
                ->setCreateAbsoluteUri(true)
                ->setTargetPageUid($this->getUid())
                ->build();
    }
}
