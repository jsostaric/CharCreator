<?php include_once '../../config.php'; checkLogin();

if(isset($_GET["id"])) {
    $stmt = $conn->prepare("select a.id, a.name, a.users,a.races, a.aligment, a.hp, b.name as race, c.level, d.name as class, d.bab, d.fort_save, d.ref_save, d.will_save from characters a
    left join races b on b.id = a.races
    left join character_klass c on c.characters=a.id
    left join klasses d on d.id=c.klasses where a.id = :id");
    $stmt->execute(["id" => $_GET["id"]]);
    $character = $stmt->fetch(PDO::FETCH_OBJ);

    $fort = $character->fort_save;
    $ref = $character->ref_save;
    $will = $character->will_save;
    $bab = $character->bab;
}
?>

<!doctype html>
<html class="no-js" lang="en" dir="ltr">
	<head>
		<?php include_once '../../templates/_head.php'; ?>
	</head>
	<body>
		
		<?php include_once '../../templates/_nav.php'; ?>
		<div class="col-md-8 offset-2">
			<div class="jumbotron">
                <div class="row">
                    <h1 id="name" class="display-4"><strong> <?php echo $character->name; ?></h1>
                    <h5><span class="icon"><a href="#"><i class="fas fa-pencil-alt"></i></a></span></h5>
                </div>
                
                <p><?php                 
                echo "<span class=\"badge badge-primary\"> $character->aligment</span>";  
                echo "<span class=\"badge badge-primary\"> $character->race</span>";  
                echo "<span class=\"badge badge-primary\"> $character->class $character->level</span>";    
                echo "";               
                ?></p>
                <div class="row">
                    <div class="col-sm-2">
                        <p>Hit points: <?php echo $character->hp; ?></p>
                    </div>
                    <div class="col-sm-2">
                        <p>Initiative: 0</p>
                    </div>
                    <div class="col-sm-2">
                        <p>speed 30 ft. 4 sq.</p>
                    </div>
                </div>
                
                <!-- Ability Scores -->
                <div class="row">
                    <div class="card" style="height: 20em;">
                        <div class="card-body">
                            <h5><strong>Abilities</strong><span class="icon"><a href="#"><i class="fas fa-pencil-alt"></i></a></span></h5> <!-- edit icon -->
                            <table class="table table-sm">
                                <thead>
                                    <tr>
                                    <th scope="col"></th>
                                    <th scope="col">Score</th>
                                    <th scope="col">Modifier</th>                                    
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    $stmt = $conn->prepare("select a.* from abilities a
                                    inner join characters b on a.characters = b.id where a.characters = :id");
                                    $stmt->execute(["id" => $_GET["id"]]);
                                    $result = $stmt->fetchAll(PDO::FETCH_OBJ);



                                    foreach($result as $row): ?>
                                    <tr>
                                    <th scope="row">Strength</th>
                                    <td id="abilities"><?php echo $row->strength; ?></td>
                                    <td id="abilities"><?php echo $strength = calculateModifier($row->strength); ?></td>                                    
                                    </tr>
                                    <tr>
                                    <th scope="row">Dexterity</th>
                                    <td id="abilities"><?php echo $row->dexterity; ?></td>
                                    <td id="abilities"><?php echo $dexterity = calculateModifier($row->dexterity); ?></td>                                    
                                    </tr>
                                    <tr>
                                    <th scope="row">Constitution</th>
                                    <td id="abilities"><?php echo $row->constitution; ?></td>
                                    <td id="abilities"><?php echo $constitution = calculateModifier($row->constitution); ?></td>                                    
                                    </tr>
                                    <tr>
                                    <th scope="row">Intelligence</th>
                                    <td id="abilities"><?php echo $row->intelligence; ?></td>
                                    <td id="abilities"><?php echo $intelligence = calculateModifier($row->intelligence); ?></td>                                    
                                    </tr>
                                    <tr>
                                    <th scope="row">Wisdom</th>
                                    <td id="abilities"><?php echo $row->wisdom; ?></td>
                                    <td id="abilities"><?php echo $wisdom = calculateModifier($row->wisdom); ?></td>                                    
                                    </tr>
                                    <tr>
                                    <th scope="row">Charisma</th>
                                    <td id="abilities"><?php echo $row->charisma; ?></td>
                                    <td id="abilities"><?php echo $charisma = calculateModifier($row->charisma); ?></td>                                    
                                    </tr>
                                <?php endforeach; ?>
                                </tbody>
                            </table>                            
                        </div>
                    </div> <!-- end of ability scores card -->
                

                    <!-- defense -->                
                    <div class="card" style="height: 20em;">
                        <div class="card-body">
                            <h5 class="card-title"><strong>Defense</strong>
                                <span class="icon"><a href="#"><i class="fas fa-pencil-alt"></i></a></span></h5><!-- edit icon -->
                            <?php $baseArmor = 10; ?>
                            <div class="row">
                                <p class="title">AC</p><p>14 =</p>
                                <p><?php echo $baseArmor; ?> + shield bonus + <?php echo $dexterity; ?> + size modifier + natural armor + deflection modifier + misc</p>
                            </div>

                            <div class="row">
                                <p class="title">Touch</p>= <p>10</p>
                                <p class="title">Flat-Footed</p> = <p>14</p>
                            </div>
                            <hr>
                            <h6>Saving throws</h6>
                            <div class="row">
                                <p class="title">Fortitude</p>
                                <p>total =</p>
                                <p><?php echo $fort; ?></p>+
                                <p><?php echo $constitution; ?></p>+
                                <p>magic mod</p>+
                                <p>misc</p>+
                                <p>temp mod</p>
                            </div>
                            <div class="row">
                                <p class="title">Reflex</p>
                                <p>total =</p>
                                <p><?php echo $ref; ?></p>+
                                <p><?php echo $dexterity; ?></p>+
                                <p>magic mod</p>+
                                <p>misc</p>+
                                <p>temp mod</p>
                            </div>
                            <div class="row">
                                <p class="title">Will</p>
                                <p>total =</p>
                                <p><?php echo $will; ?></p>+
                                <p><?php echo $wisdom; ?></p>+
                                <p>magic mod</p>+
                                <p>misc</p>+
                                <p>temp mod</p>
                            </div>                          
                        </div>
                    </div> <!-- end of defense card -->
                </div> <!-- end of first row -->

                     <!-- Combat -->                
                <div class="row">

                    <div class="card" style="height: 20em;">
                        <div class="card-body">
                            <h5 class="card-title"><strong>Offense</strong>
                                <span class="icon"><a href="#"><i class="fas fa-pencil-alt"></i></a></span></h5><!-- edit icon -->
                            
                            <div class="row">
                                <p class="title">BAB</p>
                                <p><?php echo $bab; ?></p>
                                <p class="title">Spell Resistance</p>
                                <p>0</p>
                            </div>
                            <div class="row">
                                <p class="title">CMB</p>
                                <p><?php echo $bab + $strength; ?> = </p>
                                <p><?php echo $bab; ?></p>+
                                <p><?php echo $strength; ?></p>+
                                <p>size mod</p>
                            </div>
                            <div class="row">
                                <p class="title">CMD</p>
                                <p><?php echo $bab + $strength + $dexterity + 10; ?> = </p>
                                <p><?php echo $bab; ?></p>+
                                <p><?php echo $strength; ?></p>+
                                <p><?php echo $dexterity; ?></p>+
                                <p>10</p>
                            </div>                                     
                        </div>
                    </div> <!-- end of combat card -->
                

                
                    <!-- skills -->
                    <div class="card" >
                        <div class="card-body">
                            <h5 class="card-title"><strong>Skills</strong></h5>
                            <table class="table table-sm">
                                <thead>
                                    <tr>
                                    <th scope="col"></th>
                                    <th scope="col"></th>
                                    
                                    <th scope="col">Ability</th>
                                    <th></th>
                                    <th scope="col">Ranks</th>
                                    <th></th>
                                    <th scope="col">Misc</th>  
                                    <th></th>   
                                    <th scope="col">Total</th>
                                                                   
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 

                                    $stmt = $conn->prepare("select a.id, a.name, a.description, a.modifier, b.ranks, b.isClassAbility, d.strength, d.dexterity, d.constitution, d.intelligence, d.wisdom, d.charisma from skills a
                                    left join character_skill b on a.id = b.skills
                                    inner join characters c on b.characters = c.id
                                    left join abilities d on d.characters=c.id where c.id = :id");
                                    $stmt->execute(["id" => $_GET["id"]]);
                                    $result = $stmt->fetchAll(PDO::FETCH_OBJ);

                                    foreach($result as $row): ?>

                                    <tr>
                                    <td>
                                        <input type="checkbox" 
                                            <?php if($row->isClassAbility == 1): ?> checked <?php endif;?> />                                    
                                    </td>
                                    <th scope="row"><?php echo $row->name . "<small><span id =\"desc\">".$row->modifier."</span></small>"; ?></th>
                                    
                                    
                                    <td><?php 
                                            switch($row->modifier) {
                                                case 'strength':
                                                $total = 0;
                                                $total = $total + $strength;
                                                    echo $strength;
                                                    break;
                                                case 'dexterity':
                                                $total = 0;
                                                     $total = $total + $dexterity;
                                                    echo $dexterity;
                                                    break;
                                                case 'constitution':
                                                $total = 0;
                                                $total = $total + $constitution;
                                                    echo $constitution;
                                                    break;
                                                case 'intelligence':
                                                $total = 0;
                                                $total = $total + $intelligence;
                                                    echo $intelligence;
                                                    break;
                                                case 'wisdom':
                                                $total = 0;
                                                $total = $total + $wisdom;
                                                    echo $wisdom;
                                                    break;
                                                case 'charisma':
                                                $total = 0;
                                                $total = $total + $charisma;
                                                    echo $charisma;
                                                    break;
                                            }
                                     ?></td>
                                     <td>+</td>
                                    <td><?php echo $rank = $row->ranks; ?></td>  
                                    <td>+</td>
                                    <td><?php if($row->isClassAbility == 1 && $row->ranks > 0){echo $misc = 3;} else{echo $misc = 0;}?></td>                                   
                                    <td>=</td>
                                    <td><?php echo  $total = $total + $rank + $misc; ; ?></td>
                                    </tr>                                    
                                <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div> <!-- end of skills card -->                
                </div>    <!-- end of second row with cards -->            
			</div>
		</div>
		<?php include_once '../../templates/_scripts.php'; ?>
	</body>
</html>