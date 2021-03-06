<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Student1
 *
 * @ORM\Table(name="student1")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\Student1Repository")
 */
class Student1 implements UserInterface, \Serializable
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="username", type="string", length=50, unique=true)
     * @Assert\Length(min=5,max=20,
     *     minMessage="Your username must be at least {{ limit }} characters long",
     *     maxMessage="Your username mustn't be longer than {{ limit }} characters")
     */
    private $username;

    /**
     *
     * @Assert\Length(max=4096,min=6)
     */
    private $plainPassword;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=200)
     */
    private $password;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=50, unique=true)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="firstname", type="string", length=50, nullable=true)
     */
    private $firstname;

    /**
     * @var string
     *
     * @ORM\Column(name="lastname", type="string", length=50, nullable=true)
     */
    private $lastname;

    /**
     * @var \Date
     *
     * @ORM\Column(name="dateOfBirth", type="date", nullable=true)
     */
    private $dateOfBirth;

    /**
     * @var int
     *
     * @ORM\Column(name="year_of_study", type="integer", nullable=true)
     */
    private $yearOfStudy;

    /**
     * @var int
     *
     * @ORM\Column(name="semestar",type="integer", nullable=true)
     */
    private $semestar;

    /**
     * @var boolean
     *
     * @ORM\Column(name="isProfessor", type="boolean",nullable=true)
     */
    private $isProfessor=0;

    /** @ORM\OneToMany(targetEntity="Grade", mappedBy="student1") */
    protected $grades;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set username
     *
     * @param string $username
     * @return Student1
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Get username
     *
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set password
     *
     * @param string $password
     * @return Student1
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return Student1
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set firstname
     *
     * @param string $firstname
     * @return Student1
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;

        return $this;
    }

    /**
     * Get firstname
     *
     * @return string
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * Set lastname
     *
     * @param string $lastname
     * @return Student1
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;

        return $this;
    }

    /**
     * Get lastname
     *
     * @return string
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * Set dateOfBirth
     *
     * @param \Date $dateOfBirth
     * @return Student1
     */
    public function setDateOfBirth($dateOfBirth)
    {
        $this->dateOfBirth = $dateOfBirth;

        return $this;
    }

    /**
     * Get dateOfBirth
     *
     * @return \Date
     */
    public function getDateOfBirth()
    {
        return $this->dateOfBirth;
    }

    public function getRoles()
    {
        return array('ROLE_USER');
    }

    public function eraseCredentials()
    {
    }

    /** @see \Serializable::serialize() */
    public function serialize()
    {
        return serialize(array(
            $this->id,
            $this->username,
            $this->password,
            // see section on salt below
            // $this->salt,
        ));
    }

    /** @see \Serializable::unserialize() */
    public function unserialize($serialized)
    {
        list (
            $this->id,
            $this->username,
            $this->password,
            // see section on salt below
            // $this->salt
            ) = unserialize($serialized);
    }

    /**
     * Returns the salt that was originally used to encode the password.
     *
     * This can return null if the password was not encoded using a salt.
     *
     * @return string|null The salt
     */
    public function getSalt()
    {
        // TODO: Implement getSalt() method.
        return null;
    }
    public function getPlainPassword()
    {
        return $this->plainPassword;
    }

    public function setPlainPassword($password)
    {
        $this->plainPassword = $password;
    }

    /**
     * @ORM\ManyToMany(targetEntity="Subjects", inversedBy="student1")
     * @ORM\JoinTable(name="students_and_subjects")
     */
    private $subjects;
    public function __construct()
    {
        $this->subjects = new \Doctrine\Common\Collections\ArrayCollection();

    }
    public function getSubjects(){
        return $this->subjects;
    }

    /**
     * Add subjects
     *
     * @param \AppBundle\Entity\Subjects $subjects
     * @return Student1
     */
    public function addSubject(\AppBundle\Entity\Subjects $subjects)
    {
        $this->subjects[] = $subjects;

        return $this;
    }

    /**
     * Remove subjects
     *
     * @param \AppBundle\Entity\Subjects $subjects
     */
    public function removeSubject(\AppBundle\Entity\Subjects $subjects)
    {
        $this->subjects->removeElement($subjects);
    }


    /**
     * Set isProfessor
     *
     * @param boolean $isProfessor
     * @return Student1
     */
    public function setIsProfessor($isProfessor)
    {
        $this->isProfessor = $isProfessor;

        return $this;
    }

    /**
     * Get isProfessor
     *
     * @return boolean 
     */
    public function getIsProfessor()
    {
        return $this->isProfessor;
    }



    /**
     * Set yearOfStudy
     *
     * @param integer $yearOfStudy
     * @return Student1
     */
    public function setYearOfStudy($yearOfStudy)
    {
        $this->yearOfStudy = $yearOfStudy;

        return $this;
    }

    /**
     * Get yearOfStudy
     *
     * @return integer 
     */
    public function getYearOfStudy()
    {
        return $this->yearOfStudy;
    }

    /**
     * Set semestar
     *
     * @param integer $semestar
     * @return Student1
     */
    public function setSemestar($semestar)
    {
        $this->semestar = $semestar;

        return $this;
    }

    /**
     * Get semestar
     *
     * @return integer 
     */
    public function getSemestar()
    {
        return $this->semestar;
    }
}
