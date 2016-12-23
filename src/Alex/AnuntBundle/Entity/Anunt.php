<?php

namespace Alex\AnuntBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Anunt
 *
 * @ORM\Table(name="anunturi")
 * @ORM\Entity(repositoryClass="Alex\AnuntBundle\Repository\AnuntRepository")
 */
class Anunt
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
     * @ORM\Column(name="judet", type="string", length=255)
     */
    private $judet;

    /**
     * @var string
     *
     * @ORM\Column(name="oras", type="string", length=255)
     */
    private $oras;

    /**
     * @var float
     *
     * @ORM\Column(name="pret", type="float")
     */
    private $pret;

    /**
     * @var string
     *
     * @ORM\Column(name="detalii", type="text")
     */
    private $detalii;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="data", type="datetime")
     */
    private $data;


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
     * Set judet
     *
     * @param string $judet
     * @return Anunt
     */
    public function setJudet($judet)
    {
        $this->judet = $judet;

        return $this;
    }

    /**
     * Get judet
     *
     * @return string
     */
    public function getJudet()
    {
        return $this->judet;
    }

    /**
     * Set oras
     *
     * @param string $oras
     * @return Anunt
     */
    public function setOras($oras)
    {
        $this->oras = $oras;

        return $this;
    }

    /**
     * Get oras
     *
     * @return string
     */
    public function getOras()
    {
        return $this->oras;
    }

    /**
     * Set pret
     *
     * @param float $pret
     * @return Anunt
     */
    public function setPret($pret)
    {
        $this->pret = $pret;

        return $this;
    }

    /**
     * Get pret
     *
     * @return float
     */
    public function getPret()
    {
        return $this->pret;
    }

    /**
     * Set detalii
     *
     * @param string $detalii
     * @return Anunt
     */
    public function setDetalii($detalii)
    {
        $this->detalii = $detalii;

        return $this;
    }

    /**
     * Get detalii
     *
     * @return string
     */
    public function getDetalii()
    {
        return $this->detalii;
    }

    /**
     * Set data
     *
     * @param \DateTime $data
     * @return Anunt
     */
    public function setData($data)
    {
        $this->data = $data;

        return $this;
    }

    /**
     * Get data
     *
     * @return \DateTime
     */
    public function getData()
    {
        return $this->data;
    }
}
