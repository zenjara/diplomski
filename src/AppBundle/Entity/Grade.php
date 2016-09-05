<?php
/**
 * Created by PhpStorm.
 * User: IvanMatas
 * Date: 13-Jun-16
 * Time: 2:58 PM
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;



/**
 * Grade
 *
 * @ORM\Table(name="grade")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\GradeRepository")
 */
class Grade{

    /**
     * @var int
     *
     * @ORM\Column(name="kolokvij1", type="integer", nullable=true)
     */
    private $kolokvij1;

    /**
     * @var int
     *
     * @ORM\Column(name="kolokvij2", type="integer", nullable=true)
     */
    private $kolokvij2;

    /**
     * @var int
     *
     * @ORM\Column(name="ispit1", type="integer", nullable=true)
     */
    private $ispit1;

    /**
     * @var int
     *
     * @ORM\Column(name="ispit2", type="integer", nullable=true)
     */
    private $ispit2;

    /**
     * @var int
     *
     * @ORM\Column(name="final_grade", type="integer", nullable=true)
     */
    private $finalGrade;

    /**
     * @ORM\Id()
     * @ORM\ManyToOne(targetEntity="Subjects", inversedBy="grade")
     * @ORM\JoinColumn(name="subject_id", referencedColumnName="id", nullable=false)
     */
    protected $subject;

    /**
     * @ORM\Id()
     * @ORM\ManyToOne(targetEntity="Student1", inversedBy="grade")
     * @ORM\JoinColumn(name="student_id", referencedColumnName="id", nullable=false)
     */
    protected $student;


    /**
     * Set kolokvij1
     *
     * @param integer $kolokvij1
     * @return Grade
     */
    public function setKolokvij1($kolokvij1)
    {
        $this->kolokvij1 = $kolokvij1;

        return $this;
    }

    /**
     * Get kolokvij1
     *
     * @return integer 
     */
    public function getKolokvij1()
    {
        return $this->kolokvij1;
    }

    /**
     * Set kolokvij2
     *
     * @param integer $kolokvij2
     * @return Grade
     */
    public function setKolokvij2($kolokvij2)
    {
        $this->kolokvij2 = $kolokvij2;

        return $this;
    }

    /**
     * Get kolokvij2
     *
     * @return integer 
     */
    public function getKolokvij2()
    {
        return $this->kolokvij2;
    }

    /**
     * Set ispit1
     *
     * @param integer $ispit1
     * @return Grade
     */
    public function setIspit1($ispit1)
    {
        $this->ispit1 = $ispit1;

        return $this;
    }

    /**
     * Get ispit1
     *
     * @return integer 
     */
    public function getIspit1()
    {
        return $this->ispit1;
    }

    /**
     * Set ispit2
     *
     * @param integer $ispit2
     * @return Grade
     */
    public function setIspit2($ispit2)
    {
        $this->ispit2 = $ispit2;

        return $this;
    }

    /**
     * Get ispit2
     *
     * @return integer 
     */
    public function getIspit2()
    {
        return $this->ispit2;
    }

    /**
     * Set subject
     *
     * @param \AppBundle\Entity\Subjects $subject
     * @return Grade
     */
    public function setSubject(\AppBundle\Entity\Subjects $subject)
    {
        $this->subject = $subject;

        return $this;
    }

    /**
     * Get subject
     *
     * @return \AppBundle\Entity\Subjects 
     */
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * Set student
     *
     * @param \AppBundle\Entity\Student1 $student
     * @return Grade
     */
    public function setStudent(\AppBundle\Entity\Student1 $student)
    {
        $this->student = $student;

        return $this;
    }

    /**
     * Get student
     *
     * @return \AppBundle\Entity\Student1 
     */
    public function getStudent()
    {
        return $this->student;
    }

    /**
     * Set finalGrade
     *
     * @param integer $finalGrade
     * @return Grade
     */
    public function setFinalGrade($finalGrade)
    {
        $this->finalGrade = $finalGrade;

        return $this;
    }

    /**
     * Get finalGrade
     *
     * @return integer 
     */
    public function getFinalGrade()
    {
        return $this->finalGrade;
    }
}
