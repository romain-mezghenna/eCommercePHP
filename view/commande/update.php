<form method="get" action="index.php">
    <fieldset>
        <legend>Nouvelle commande :</legend>
        <p>
            <label for="immat_id">idCommande</label> :
            <input type="text"  value="<?php echo htmlspecialchars($data['idCommande']);?>" name="idCommande" id="idCommande" <?php echo 'readonly';?>/>
            <label for="modele">Montant</label> :
            <input type="text" value="<?php echo htmlspecialchars($data['montant']);?>" name="montant" id="montant" required/>
            <label for="marque">Date</label> :
            <input type="date" value="<?php echo htmlspecialchars($data['date']);?>" name="date" id="date" required/>
        </p>
        <p>
            <input type="hidden" name="action" value="<?php if($type=='create'){echo 'created';} else {echo 'updated';}?>" />
            <input type="hidden" name="controller" value="commande"/>
            <input type="submit" value="Envoyer" />
        </p>
    </fieldset>
</form>

