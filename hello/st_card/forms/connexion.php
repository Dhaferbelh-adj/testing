<?php
// Informations de connexion à la base de données
$cin = $_POST['cin'];
$pas = $_POST['pass'];
$host = "localhost"; // Adresse du serveur MySQL
$username = "root"; // Nom d'utilisateur MySQL
$database = "project"; // Nom de la base de données

// Tentative de connexion à la base de données
$conn = mysql_connect($host, $username);

// Vérification de la connexion
if (!$conn) {
    die("La connexion à la base de données a échoué : ");
} 
// Sélection de la base de données
mysql_select_db($database, $conn);
// Requête SQL pour vérifier les informations de connexion dans la base de données
$sql="SELECT * FROM `etudiant` WHERE cin='$cin' AND pwd='$pas'";
$result=mysql_query($sql,$conn);
$sql1="SELECT * FROM `entrepreneur` WHERE cin='$cin' AND pwd='$pas'";
$result1=mysql_query($sql1,$conn);

if (!$result) {
    echo("Erreur lors de l'exécution de la requête : " );
    ?>
    <!DOCTYPE html>
    <html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="refresh" content="5;url=connexion (1).html">
        <title>Redirection en cours...</title>
 
    </head>
    <body><p>Si la redirection ne fonctionne pas, veuillez cliquer sur ce <a href="connexion (1).html">lien</a>.</p></body>
    </html>
    <?php
 
}
if (mysql_num_rows($result)==1) {
    
    ?>
    <!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link rel="icon" type="image/x-icon" href="22 (1).png">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenue étudiant</title>
    <link rel="stylesheet" href="accueil.css">
</head>
<body>
<video autoplay muted loop id="bgVideo">
            <source src="video1.mp4" type="video/mp4">
        </video>
    <div id="form1">
    <div id="form"><h1>Liste des informations</h1>
    <ul>
        <?php $ligne = mysql_fetch_assoc($result) ?>
            <li>
                <?php echo "Cin : " . $ligne["cin"]  ?> 
            </li>
            <li>
                <?php echo "Nom : " . $ligne["Nom"]  ?> 
            </li>
            <li>
                <?php echo "Prenom : " . $ligne["Prenom"]  ?> 
            </li>
            <li>
                <?php echo "Email : " . $ligne["Email"]  ?> 
            </li>
            <li>
                <?php echo "Télèphone : " . $ligne["tel"]  ?> 
            </li>
    </ul>
</div>
</div>
<?php 
$sqlOffres = "select * FROM offresemploi ,entrepreneur WHERE offresemploi.cin=entrepreneur.cin;";
$resultOffres = mysql_query($sqlOffres, $conn);?>
<div id="form2" ><h1>Travail disponible </h1>
<?php while($offre=mysql_fetch_array($resultOffres)){ ?>    
        <div id="form0">
        <ul class="ul">
                <li>
                    <?php echo "Nom de l'entreprise : " . $offre["nomEntreprise"]  ?> 
                </li>
                <li>
                    <?php echo "Titre du poste : " . $offre["titrePoste"]  ?> 
                </li>
                <li>
                    <?php echo "Description du poste : " . $offre["descriptionPoste"]  ?> 
                </li>
                <li>
                    <?php echo "Salaire proposé : " . $offre["salairePropose"]  ?> 
                </li>
                <li>
                    <?php echo "Adresse e-mail de contact : " . $offre["adresseEmailContact"]  ?> 
                </li>
                <li>
                    <?php echo "Télèphone de contact : " . $offre["tel"]  ?> 
                </li>
                <li>
                    <?php echo "Lieu : " . $offre["Lieu"]  ?> 
                </li>
            </ul>
        </div>   
        <?php }?>
</div>

</body>
</html>
<?php
 
    
}else if(mysql_num_rows($result1)==1){
    ?>
    <!DOCTYPE html>
<html lang="fr">
<head>
<link rel="icon" type="image/x-icon" href="22 (1).png">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenue entrepreneur</title>
    <link rel="stylesheet" href="accueil.css">
</head>
<body><form action="work.html" method="post" name="f">
<video autoplay muted loop id="bgVideo">
        <source src="video1.mp4" type="video/mp4">
    </video><div id="form1">
    <div id="form"><h1>Liste des informations </h1>
    <ul>
        <?php $ligne = mysql_fetch_assoc($result1) ?>
            <li>
                <?php echo "Cin : " . $ligne["cin"]  ?> 
            </li>   
            <li>
                <?php echo "Nom : " . $ligne["Nom"]  ?> 
            </li>
            <li>
                <?php echo "Prenom : " . $ligne["Prenom"]  ?> 
            </li>
            <li>
                <?php echo "Email : " . $ligne["Email"]  ?> 
            </li>
            <li>
                <?php echo "Télèphone : " . $ligne["tel"]  ?> 
            </li>
    </ul>
    <div class="button-container"><input type="submit" value="Ajouter un Travail" ></div>
</div>

</div>


<?php 
$sqlOffres = "select * FROM offresemploi,entrepreneur WHERE entrepreneur.cin='$cin' and offresemploi.cin=entrepreneur.cin;";
$resultOffres = mysql_query($sqlOffres, $conn);
if(mysql_num_rows($resultOffres)==0){ ?>
    <div id="form2" ><h1>Vos demandes </h1>
        <div id="form0">
        <h2 style="color:red;text-align:center;">Aucun travail trouver!! ,il faut Ajouter un travail </h2>
        </div>   
        
</div>
</form>
</body>
</html>
<?php
}
else{?>
    <div id="form2" ><h1>Vos demandes </h1>
<?php while($offre=mysql_fetch_assoc($resultOffres)){ ?>    
        <div id="form0">
        <ul class="ul">
                <li>
                    <?php echo "Nom de l'entreprise : " . $offre["nomEntreprise"]  ?> 
                </li>
                <li>
                    <?php echo "Titre du poste : " . $offre["titrePoste"]  ?> 
                </li>
                <li>
                    <?php echo "Description du poste : " . $offre["descriptionPoste"]  ?> 
                </li>
                <li>
                    <?php echo "Salaire proposé : " . $offre["salairePropose"]  ?> 
                </li>
                <li>
                    <?php echo "Adresse e-mail de contact : " . $offre["adresseEmailContact"]  ?> 
                </li>
                <li>
                    <?php echo "Télèphone de contact : " . $offre["tel"]  ?> 
                </li>
            </ul>
        </div>   
        <?php } 
?>
</div>
</form>
</body>
</html>
<?php

}
} 

else {
    // Les informations de connexion sont correctes
    echo "Identifiants introuvable. Veuillez réessayer.";
    ?>
    <!DOCTYPE html>
    <html lang="fr">
    <head>
    <link rel="icon" type="image/x-icon" href="22 (1).png">
        <meta charset="UTF-8">
        <meta http-equiv="refresh" content="5;url=connexion (1).html">
        <title>Redirection en cours...</title>
 
    </head>
    <body><p>Si la redirection ne fonctionne pas, veuillez cliquer sur ce <a href="connexion (1).html">lien</a>.</p></body>
    </html>
    <?php
 }
    




// Fermer la connexion
mysql_close($conn);
?>
