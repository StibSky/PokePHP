<?php

$inputPokemon = $_GET['pokemon'];

function pokeImages($pokemonRequired) {
$json = file_get_contents('https://pokeapi.co/api/v2/pokemon/' . strtolower($pokemonRequired));
$data = json_decode($json, true);
$sprite = $data["sprites"]["front_default"];
echo $sprite;
}




$inputPokemon = $_GET['pokemon'];
$speciesApi = file_get_contents('https://pokeapi.co/api/v2/pokemon-species/' . strtolower($inputPokemon));
$evolutionData = json_decode($speciesApi, true);
$chain = $evolutionData["evolution_chain"]["url"];

$chainApi = file_get_contents($chain);
$chainData = json_decode($chainApi, true);
$firstEvolution = $chainData['chain']['species']['name'];
$secondEvolution = $chainData['chain']['evolves_to'][0]['species']['name'];
$thirdEvolution = $chainData['chain']['evolves_to'][0]['evolves_to'][0]['species']['name'];



?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <link href="style.css" rel="stylesheet">
    <title>Document</title>
</head>
<body>
<div id="ask">
    <form name="form" action="" method="get">
        <input type="text" name="pokemon" id="pokemon" placeholder="Choose your pokemon">
    </form>
</div>
<img src=" <?php pokeImages($secondEvolution); ?>" alt="" id="pokeImg">
<img src="<?php pokeImages($firstEvolution); ?>" alt="" id="evoImg"/>
<img src="<?php pokeImages($thirdEvolution); ?>" alt="" id="nextImg"/>
</body>
</html>

