<?php
include('index.html');

// Données du formulaire
$data = array(
    'first-name' => $_POST['first-name'],
    'lastName' => $_POST['last-name'],
    'email' => $_POST['email'],
    'profession' => $_POST['profession'],
    'interests' => isset($_POST['interests']) ? $_POST['interests'] : array()
);

// Convertir les données en JSON
$json_data = json_encode($data);

// Initialiser Curl
$curl = curl_init('http://51.91.108.32/registrations'); // Remplacez cette URL par l'URL de votre API

// Configuration de Curl pour envoyer les données en tant que POST JSON
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_POSTFIELDS, $json_data);
curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));

// Si vous souhaitez récupérer la réponse de l'API, décommentez cette ligne
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

// Exécution de la requête Curl
$response = curl_exec($curl);

// Affichage de la réponse
echo $response;
// // // Vérification des erreurs
if ($response === false) {
      echo 'Erreur Curl : ' . curl_error($curl);
 } else {
// //     // Si vous souhaitez afficher la réponse de l'API
     echo 'Réponse de l\'API : ' . $response;
    echo 'Données envoyées avec succès à l\'API.';
     echo curl_error($curl);
}

// // Fermeture de la session Curl
// curl_close($curl);
?>