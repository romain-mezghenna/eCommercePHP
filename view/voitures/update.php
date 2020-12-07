<form method="get" action="index.php">
    <fieldset>
        <legend>Mon formulaire :</legend>
        <p>
            <label for="immat_id">Immatriculation</label> :
            <input type="text"  value="<?php echo htmlspecialchars($data['immatriculation']);?>" name="immatriculation" id="immatriculation" <?php if($type=='create'){echo 'required';} else {echo 'readonly';}?>/>
            <label for="modele">Modele</label> :
            <input type="text" value="<?php echo htmlspecialchars($data['modele']);?>" name="modele" id="modele" required/>
            <label for="marque">Marque</label> :
            <input type="text" value="<?php echo htmlspecialchars($data['marque']);?>" name="marque" id="marque" required/>
            <label for="annee">Annee</label> :
            <input type="text" value="<?php echo htmlspecialchars($data['annee']);?>" name="annee" id="annee" required/>
            <label for="prix">Prix</label> :
            <input type="text" value="<?php echo htmlspecialchars($data['prix']);?>" name="prix" id="prix" required/>
            <label for="imagelink">Lien d'image</label> :
            <input type="text" value="<?php echo htmlspecialchars($data['imagelink']);?>" name="imagelink" id="imagelink" required/>
            <label for="statut">Statut</label> :
            <input type="text" value="<?php echo htmlspecialchars($data['statut']);?>" name="statut" id="statut" required/>
        </p>
        <p>
            <input type="hidden" name="action" value="<?php if($type=='create'){echo 'created';} else {echo 'updated';}?>" />
            <input type="hidden" name="controller" value="voiture"/>
            <input type="submit" value="Envoyer" />
        </p>
    </fieldset>
</form>

