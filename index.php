<?php


$inputPokemon = $_GET['pokemon'];
$mainJson = file_get_contents('https://pokeapi.co/api/v2/pokemon/' . strtolower($inputPokemon));
$mainData = json_decode($mainJson, true);
$inputName = $mainData["name"];
$inputWeight = $mainData["weight"];
$inputId = $mainData["id"];
$shinySprite = $mainData["sprites"]["front_shiny"];

function pokeImages($pokemonRequired)
{
    $json = file_get_contents('https://pokeapi.co/api/v2/pokemon/' . strtolower($pokemonRequired));
    $data = json_decode($json, true);
    $sprite = $data["sprites"]["front_default"];
    if ($pokemonRequired == "deoxys") {
        $sprite = "https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/386.png";
    }
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



if ($inputName == $firstEvolution) {
    $setBorder1 = "border: 5px solid green";
    $previousForm = "none";
    $nextForm = $secondEvolution;


} else {
    $setBorder1 = "";
}

if ($inputName == $secondEvolution) {
    $setBorder2 = "border: 5px solid green";
    $previousForm = $firstEvolution;
    $nextForm = $thirdEvolution;
} else {
    $setBorder2 = "";
}

if ($inputName == $thirdEvolution) {
    $setBorder3 = "border: 5px solid green";
    $previousForm = $secondEvolution;
    $nextForm = "";
} else {
    $setBorder3 = "";
}


if ($nextForm == NULL) {
    $nextForm = "no next";
}



$abilitiesNewArray = array();
for ($i = 0; $i < count($mainData["abilities"]); $i++) { // to get all elements from the array
    array_push($abilitiesNewArray, $mainData["abilities"][$i]["ability"]["name"]); // to add new array + to select abilities specifically from the array
    $randIndex = array_rand($abilitiesNewArray);
}
$randomAbility = $abilitiesNewArray[$randIndex];

$movesArray = array();
for ($i = 0; $i < count($mainData["moves"]); $i++) { // to get all elements from the array
    array_push($movesArray, $mainData["moves"][$i]["move"]["name"]); // to add new array + to select abilities specifically from the array
    $randMoveIndex = array_rand($movesArray, 4);
}

$randomMove1 = $movesArray[$randMoveIndex[0]];
$randomMove2 = $movesArray[$randMoveIndex[1]];
$randomMove3 = $movesArray[$randMoveIndex[2]];
$randomMove4 = $movesArray[$randMoveIndex[3]];

$type1= $mainData["types"][0]["type"]["name"];
$type2 = $mainData["types"][1]["type"]["name"];

if ($type2 == NULL ) {
    $type2 = "";
}

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
<img src="<?php pokeImages($firstEvolution); ?>" alt="" id="evoImg" style = "<?php echo $setBorder1 ?>">
<img src=" <?php pokeImages($secondEvolution); ?>" alt="" id="pokeImg" style = "<?php echo $setBorder2 ?>">
<img src="<?php pokeImages($thirdEvolution); ?>" alt="" id="nextImg"/ style = "<?php echo $setBorder3 ?>">
<img src="<?php echo $shinySprite; ?>" alt="" id="shinyImg"/>
<div id="forPhone">
    <p id="pokeName"><?php echo $inputName ?></p>
    <p id="weightPoke">Weight: <?php echo $inputWeight ?></p>
    <p id="abilitiesPoke">Ability: <?php echo $randomAbility ?></p>
    <p id="pokeTypes1"><?php echo $type1 ?></p>
    <p id="pokeTypes2"><?php echo $type2 ?></p>
    <p id="prevEvolution">Prev Form: <?php echo $previousForm ?></p>
    <p id="nextEvolution">Next Form: <?php echo $nextForm ?></p>
    <p id="pokeMove1"><?php echo $randomMove1 ?></p>
    <p id="pokeMove2"><?php echo $randomMove2 ?></p>
    <p id="pokeMove3"><?php echo $randomMove3 ?></p>
    <p id="pokeMove4"><?php echo $randomMove4 ?></p>
    <p id="pokeId"><?php echo $inputId ?></p>
</div>
</body>
</html>

