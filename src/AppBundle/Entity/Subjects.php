<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Subjects
 *
 * @ORM\Table(name="subjects")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\SubjectsRepository")
 */
class Subjects
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
     * @ORM\Column(name="subject_name", type="string", length=50, unique=true)
     */
    private $subjectName;

    /**
     * @var int
     *
     * @ORM\Column(name="ects_points", type="integer")
     */
    private $ectsPoints;

    /**
     * @var int
     *
     * @ORM\Column(name="year_of_study", type="integer")
     */
    private $yearOfStudy;

    /**
     * @var int
     *
     * @ORM\Column(name="semestar", type="integer")
     */
    private $semestar;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255)
     */
    private $description;

    /** @ORM\OneToMany(targetEntity="Grade", mappedBy="subjects") */
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
     * Set subjectName
     *
     * @param string $subjectName
     * @return Subjects
     */
    public function setSubjectName($subjectName)
    {
        $this->subjectName = $subjectName;

        return $this;
    }

    /**
     * Get subjectName
     *
     * @return string 
     */
    public function getSubjectName()
    {
        return $this->subjectName;
    }

    /**
     * Set ectsPoints
     *
     * @param integer $ectsPoints
     * @return Subjects
     */
    public function setEctsPoints($ectsPoints)
    {
        $this->ectsPoints = $ectsPoints;

        return $this;
    }

    /**
     * Get ectsPoints
     *
     * @return integer 
     */
    public function getEctsPoints()
    {
        return $this->ectsPoints;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Subjects
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @ORM\ManyToMany(targetEntity="Student1", mappedBy="subjects")
     */
    private $students;

    public function __construct() {
        $this->students = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function getStudents()
    {
        return $this->students;
    }

    /**
     * Add students
     *
     * @param \AppBundle\Entity\Student1 $students
     * @return Subjects
     */
    public function addStudent(\AppBundle\Entity\Student1 $students)
    {
        $this->students[] = $students;

        return $this;
    }

    /**
     * Remove students
     *
     * @param \AppBundle\Entity\Student1 $students
     */
    public function removeStudent(\AppBundle\Entity\Student1 $students)
    {
        $this->students->removeElement($students);
    }

    /**
     * @ORM\ManyToOne(targetEntity="Professors", inversedBy="subjects")
     * @ORM\JoinColumn(name="professors_id", referencedColumnName="id")
     */
    private $professors;








    /**
     * Set professors
     *
     * @param \AppBundle\Entity\Professors $professors
     * @return Subjects
     */
    public function setProfessors(\AppBundle\Entity\Professors $professors = null)
    {
        $this->professors = $professors;

        return $this;
    }

    /**
     * Get professors
     *
     * @return \AppBundle\Entity\Professors 
     */
    public function getProfessors()
    {
        return $this->professors;
    }

    /**
     * Set yearOfStudy
     *
     * @param integer $yearOfStudy
     * @return Subjects
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
     * @return Subjects
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
