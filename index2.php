<?php

spl_autoload_register(function ($class_name) {
    require 'classes/' . $class_name . '.php';
});

require "./classes/Personnage.php";

echo $_POST['fighters'];

$force;
$resistance;

if($_POST['fighters'] == "Mage"){
    $force = Personnage::FORCE_PETITE;
    $resistance = Personnage::RESISTANCE_PETITE;
}else if($_POST['fighters'] == "Voleur"){
    $force = Personnage::FORCE_GRANDE;
    $resistance = Personnage::RESISTANCE_PETITE;
}else if($_POST['fighters'] == "Warrior"){
    $force = Personnage::FORCE_GRANDE;
    $resistance = Personnage::RESISTANCE_MOYENNE;
}else{
    $force = Personnage::FORCE_MOYENNE;
    $resistance = Personnage::RESISTANCE_GRANDE;
}

$player1 = new $_POST['fighters'] ($_POST['name'], $force, 100, $resistance);

$player3 = new Mage ('Mago', Personnage::FORCE_PETITE, 100, Personnage::RESISTANCE_PETITE);
$player5 = new Paladin ('Palouf', Personnage::FORCE_PETITE, 100, Personnage::RESISTANCE_GRANDE);
$player2 = new Warrior ('Barbouze', Personnage::FORCE_GRANDE, 100, Personnage::RESISTANCE_MOYENNE);
$player4 = new Voleur ('Fufu', Personnage::FORCE_GRANDE, 100, Personnage::RESISTANCE_PETITE);

function combat($p1, $p2){
    
    $p1->action($p2);
}

$playerName = $player1->nom();
$player2Name = $player2->nom();
$player3Name = $player3->nom();
$player4Name = $player4->nom();
$player5Name = $player5->nom();

$roundNbr = 0

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/style.css">
    <title>Baston</title>
</head>
<body>
    <div class="stats">
        <div class="stats_p1"><?php $player1->afficherStats() ?></div>
        <div class="stats_p2"><?php $player4->afficherStats() ?></div>
    </div>
    <div class="lvlEnemy"><?= $playerName ?> rentre dans l'arène ! Combien d'ennemis va t-il pouvoir battre ?!</div>
    <div class="lvlEnemy">Son premier ennemi est<?= $playerName ?> !</div>
    <div class="board">
        <?php while($player1->vie() > 0 && $player4->vie() > 0): ?>
            <div class="roundNbr">ROUND <?= $roundNbr?></div>
            <div class="round">
                <div class="board_p1">
                    <?= combat($player1, $player4) ?>
                </div>
                <?php if($player4->vie() > 0): ?>
                    <div class="board_p2">
                        <?= combat($player4, $player1);
                        $roundNbr ++ ?>
                    </div>
                <?php endif ?>
            </div>  
        <?php endwhile ?>
        <div class="stats"></div>
    </div>
    
    <?php if($player1->vie() > 0): ?>                   
    <div class="board">
        <div class="lvlUp"><?= $player3->gagnerExperience(1) ?></div>
        <div class="lvlEnemy">L'adversaire est plus fort cette fois, il est niveau 2!</div>
        <div class="stats">
            <div class="stats_p1"><?php $player1->afficherStats() ?></div>
            <div class="stats_p2"><?php $player3->afficherStats() ?></div>
        </div>
        <?php $roundNbr = 0 ?>
        <?php while($player1->vie() > 0 && $player3->vie() > 0): ?>
            <div class="roundNbr">ROUND <?= $roundNbr?></div>
            <div class="round">
                <div class="board_p1">
                    <?= combat($player1, $player3) ?>
                </div>
                <?php if($player3->vie() > 0): ?>
                    <div class="board_p2">
                        <?= combat($player3, $player1);
                        $roundNbr ++ ?>
                    </div>
                <?php endif ?>
            </div>    
        <?php endwhile ?>
        <div class="stats"></div>
    </div>
    <?php endif ?>

    <?php if($player1->vie() > 0): ?>                    
        <div class="board">
            <div class="lvlEnemy">L'adversaire est plus fort cette fois, il est niveau 3!</div>
            <div class="lvlUp"><?= $player2->gagnerExperience(2) ?></div>
            <div class="stats">
                <div class="stats_p1"><?php $player1->afficherStats() ?></div>
                <div class="stats_p2"><?php $player2->afficherStats() ?></div>
            </div>
            <?php $roundNbr = 0 ?>
            <?php while($player1->vie() > 0 && $player2->vie() > 0): ?>
                <div class="roundNbr">ROUND <?= $roundNbr?></div>
                <div class="round">
                    <div class="board_p1">
                        <?= combat($player1, $player2) ?>
                    </div>
                    <?php if($player2->vie() > 0): ?>
                        <div class="board_p2">
                            <?= combat($player2, $player1);
                            $roundNbr ++ ?>
                        </div>
                    <?php endif ?>
                </div>    
            <?php endwhile ?>
            <div class="stats"></div>
        </div>
    <?php endif ?>

    <?php if($player1->vie() > 0): ?>                    
        <div class="board">
            <div class="lvlEnemy">L'adversaire est plus fort cette fois, il est niveau 3!</div>
            <div class="lvlUp"><?= $player5->gagnerExperience(3) ?></div>
            <div class="stats">
                <div class="stats_p1"><?php $player1->afficherStats() ?></div>
                <div class="stats_p2"><?php $player5->afficherStats() ?></div>
            </div>
            <?php $roundNbr = 0 ?>
            <?php while($player1->vie() > 0 && $player5->vie() > 0): ?>
                <div class="roundNbr">ROUND <?= $roundNbr?></div>
                <div class="round">
                    <div class="board_p1">
                        <?= combat($player1, $player5) ?>
                    </div>
                    <?php if($player5->vie() > 0): ?>
                        <div class="board_p2">
                            <?= combat($player5, $player1);
                            $roundNbr ++ ?>
                        </div>
                    <?php endif ?>
                </div>    
            <?php endwhile ?>
            <div class="stats"></div>
        </div>
    <?php endif ?>
</body>
</html>


