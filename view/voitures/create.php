	<form method="get" action="index.php">
  <fieldset>
    <legend>Mon formulaire :</legend>
    <p>
        <label for="immat_id">Immatriculation</label> :
         <input type="text" placeholder="Ex : 256AB34" name="immatriculation" id="immatriculation" required/>
        <label for="modele">Modele</label> :
        <input type="text" placeholder="Ex : 106" name="modele" id="modele" required/>
        <label for="marque">Marque</label> :
        <input type="text" placeholder="Ex : Peugeot" name="marque" id="marque" required/>
        <label for="annee">Annee</label> :
        <input type="text" placeholder="Ex : 2000" name="annee" id="annee" required/>
        <label for="prix">Prix</label> :
        <input type="text" placeholder="Ex : 12000" name="prix" id="prix" required/>
        <label for="imagelink">Lien d'image</label> :
        <input type="text" placeholder="Ex : voiture.png" name="imagelink" id="imagelink" required/>
    </p>
    <p>
      <input type="hidden" name="action" value="created" />
      <input type="submit" value="Envoyer" />
    </p>
  </fieldset>
</form>


