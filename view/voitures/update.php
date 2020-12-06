<form method="get" action="index.php">
    <fieldset>
        <legend>Mon formulaire :</legend>
        <p>
            <label for="immat_id">Immatriculation</label> :
            <input type="text" readonly value="<?php echo htmlspecialchars($v->getimmatriculation());?>" name="immatriculation" id="immatriculation" required/>
            <label for="modele">Modele</label> :
            <input type="text" value="<?php echo htmlspecialchars($v->getModele());?>" name="modele" id="modele" required/>
            <label for="marque">Marque</label> :
            <input type="text" value="<?php echo htmlspecialchars($v->getMarque());?>" name="marque" id="marque" required/>
            <label for="annee">Annee</label> :
            <input type="text" value="<?php echo htmlspecialchars($v->getAnnee());?>" name="annee" id="annee" required/>
            <label for="prix">Prix</label> :
            <input type="text" value="<?php echo htmlspecialchars($v->getPrix());?>" name="prix" id="prix" required/>
            <label for="imagelink">Lien d'image</label> :
            <input type="text" value="<?php echo htmlspecialchars($v->getImagelink());?>" name="imagelink" id="imagelink" required/>
            <label for="statut">Statut</label> :
            <input type="text" value="<?php echo htmlspecialchars($v->getStatut());?>" name="statut" id="statut" required/>
        </p>
        <p>
            <input type="hidden" name="action" value="updated" />
            <input type="submit" value="Envoyer" />
        </p>
    </fieldset>
</form>

