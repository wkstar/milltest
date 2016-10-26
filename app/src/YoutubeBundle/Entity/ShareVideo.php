<?php
namespace YoutubeBundle\Entity;


use Symfony\Component\Validator\Constraints as Assert;

class ShareVideo
{
    protected $name;
    protected $email;
    
    /**
     * Just showing I know how, I'd usually add validation for all properties.
     * @Assert\Length(
     *      max = 50,
     *      maxMessage = "Your first name cannot be longer than {{ limit }} characters"
     * )
     */
    protected $comment;
    protected $recipientName;
    protected $recipientEmail;

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getComment()
    {
        return $this->comment;
    }

    public function setComment($comment)
    {
        $this->comment = $comment;
    }

    public function getRecipientName()
    {
        return $this->recipientName;
    }

    public function setRecipientName($recipientName)
    {
        $this->recipientName = $recipientName;
    }

    public function getRecipientEmail()
    {
        return $this->recipientEmail;
    }

    public function setRecipientEmail($recipientEmail)
    {
        $this->recipientEmail = $recipientEmail;
    }
}