<form method="get" action="index.php">
    <fieldset>
        <legend>Se connecter :</legend>
        <label for="modele">E-mail</label> :
        <input type="text" value"<?php echo htmlspecialchars($data['login']);?>" name="login" id="login" required/>
        <label for="marque">Mot de passse</label> :
        <input type="password" value"<?php echo htmlspecialchars($data['password']);?>" name="password" id="password" required/>
        </p>
        <p>
            <input type="hidden" name="action" value="connected" />
            <input type="hidden" name="controller" value="client"/>
            <input type="submit" value="Envoyer" />
        </p>
        <?php echo $erreur;?>
    </fieldset>

</form>

