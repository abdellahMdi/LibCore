<?php
namespace LibCore\Entities;
class Book 
{
    private string  $isbn ;
    private string  $titre ;
    private string  $auteur ;
    private  string $etat ;
public function  __construct( string $isbn , string  $titre ,string  $auteur , string $etat)
{
    $this->isbn = $isbn;
    $this->titre=$titre;
    $this->auteur=$auteur;
    $this->etat=$etat;
}
    public function getAuteur()
    {
        return $this->auteur;
    }
    public function setAuteur($auteur)
    {
        $this->auteur = $auteur;
    }


    public function getTitre()
    {
        return $this->titre;
    }


    public function setTitre($titre)
    {
        $this->titre = $titre;
    }


    public function getEtat()
    {
        return $this->etat;
    }
    public function setEtat($etat){
    $this->etat = $etat;
    }
    public function getIsbn(){
    return $this->isbn;
    }
    public function setIsbn($isbn){
    $this->isbn = $isbn;
    }
}
