<form method="get" action="index.php">
    <fieldset>
        <legend>Mon formulaire :</legend>
            <label for="modele">Nom</label> :
            <input type="text" value="<?php echo htmlspecialchars($data['nom']);?>" name="nom" id="nom" required/>
            <label for="marque">Prenom</label> :
            <input type="text" value="<?php echo htmlspecialchars($data['prenom']);?>" name="prenom" id="prenom" required/>
            <label for="annee">Mail</label> :
            <input type="text" value="<?php echo htmlspecialchars($data['mail']);?>" name="mail" id="mail" required/>
            <label for="prix">Mot de passe</label> :
            <input type="password" value="<?php echo htmlspecialchars($data['password']);?>" name="password" id="password" required/>
        <label for="prix">Confirmer le mot de passe</label> :
        <input type="password" value="<?php echo htmlspecialchars($data['password']);?>" name="passwordconf" id="passwordconf" required/>

        </p>
        <p>

            <input type="hidden" name="action" value="<?php if($type=='create'){echo 'created';} else {echo 'updated';}?>" />
            <input type="hidden" name="controller" value="client"/>
            <input type="hidden"  name="idClient" value="<?php echo $data['idClient'];?>" />
            <input type="submit" value="Envoyer" />

        </p>
        <?php echo $erreur;?>
    </fieldset>

</form>

