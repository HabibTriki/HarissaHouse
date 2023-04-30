<?php
require_once 'Repository.php';
class BookmarkRepository extends Repository
{
    public function __construct($tableName)
    {
        parent::__construct('bookmarks');
    }
    public function findByRecipeAndUser($email,$id){
        $requete = "select recipeID from $this->tableName where userEmail = ? and  recipeID = ? ";
        $reponse = $this->cnxPDO->prepare($requete);
        $reponse->execute([$email,$id]);
        return $reponse->fetch(PDO::FETCH_OBJ);
    }
    public function DeleteByRecipeIDAndEmail($email,$id){
        $requete = "delete from $this->tableName where userEmail = ?  and recipeID = ? ";
        $reponse = $this->cnxPDO->prepare($requete);
        $reponse->execute([$email,$id]);
    }
    public function findRecipeByEmail($email){
        $requete = "select recipeID from $this->tableName where userEmail = ? ";
        $reponse = $this->cnxPDO->prepare($requete);
        $reponse->execute([$email]);
        return $reponse->fetchAll(PDO::FETCH_OBJ);
    }
}