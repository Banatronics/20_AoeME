<?php

function Scenario(){

	/* 
        Write scenario here as examples below, they show you how to make triggers, edit terrain, and add objects. If you write outside Scenario() it won't work.
        Do not forget to configure the compiler constants in Compiler.php (aok path, scenario filename, etc...)
        You may try to compile this code to check if your installation is good. You need to specify an input scenario. (Just put a blank map)
        PHP SCX Editor is mainly designed to write triggers, the script erase all existing triggers of the input file, and writes the ones you made here.
        Terrains, objects and properties of the input file pass-through the compilation except if you edit them.
        For beginner, it's advisable to use PHP SCX Editor only to write triggers. Aoc standard editor or aokts is very adequate to edit objects, terrains, properties or instructions.
        
        Library.php is the standard PHP SCX Editor library to make scenarios more easily. As well you can create your own and share it ;)
    */
    
    /*
    CentralEur_240px_upd_colors.bmp:
green: 		RGB(0,255,0)
red:			RGB(255,0,0)
blue:			RGB(0,0,255)

Indexed Color IDs (pallette) for BMP 16 saved images (in paint), converted to png (in GIMP)
(these IDs are tp be used in Scenario.php)

Black: 			0x00
Maroon: 		0x01
Green:	 		0x02
Olive:	 		0x03
Navy: 			0x04
Purple: 		0x05
Teal: 			0x06
Gray:	 		0x07
Silver: 		0x08
Red: 			0x09
Lime:	 		0x0A
Yellow: 		0x0B
Blue: 			0x0C
Fuchsia: 		0x0D
Aqua: 			0x0E
White: 			0x0F

    */
    define("C_Black",0);
    define("C_Maroon",1);
    define("C_Green",2);
    define("C_Olive",3);
    define("C_Navy",4);
    define("C_Purple",5);
    define("C_Teal",6);
    define("C_Gray",7);
    define("C_Silver",8);
    define("C_Red",9);
    define("C_Lime",10);
    define("C_Yellow",11);
    define("C_Blue",12);
    define("C_Fuchsia",13);
    define("C_Aqua",14);
    define("C_White",15);

    
	SetPlayersCount(2);
    SetMapSize(240);
    SetTerrainFromImage('c:\wamp64\www\Test2\Data\Denmark_v2_16_converted_upd_units_VF_90deg.png', array(
      C_Red =>      array(TERRAIN_ROAD,             0), # Bind color 9 (red) to TERRAIN_ROAD
      C_Yellow =>   array(TERRAIN_BEACH,            0), # Bind color 11 (yellow) to TERRAIN_BEACH
      C_Blue =>     array(TERRAIN_WATER_SHALLOW,    0), # Bind color 12 (blue) to TERRAIN_WATER_SHALLOW
      C_Green =>    array(TERRAIN_FOREST,           0), # Bind color 2 (green) to TERRAIN_FOREST
      C_Lime =>     array(TERRAIN_GRASS_1,          0),  # Bind color 10 (lime) to TERRAIN_GRASS_1
      
      C_Fuchsia =>  array(TERRAIN_GRASS_1,          U_FORAGE_BUSH),  # Bind color 13 (fuchsia) to TERRAIN_GRASS_1 and then create an U_FORAGE_BUSH object
      C_Black =>    array(TERRAIN_GRASS_1,          U_WALL_FORTIFIED),  # Bind color 0 (black) to TERRAIN_GRASS_1 and then create an U_WALL_FORTIFIED object
      C_Gray =>     array(TERRAIN_GRASS_1,          U_GATE_AA2),  # Bind color 7 (gray) to TERRAIN_GRASS_1 and then create an U_GATE_AA2 object
      C_Silver =>   array(TERRAIN_GRASS_1,          U_STONE_MINE),  # Bind color 7 (gray) to TERRAIN_GRASS_1 and then create an U_GATE_AA2 object
      C_Olive =>    array(TERRAIN_GRASS_1,          U_GOLD_MINE),  # Bind color 7 (gray) to TERRAIN_GRASS_1 and then create an U_GATE_AA2 object
      C_Maroon =>   array(TERRAIN_GRASS_1,          U_SHEEP),  # Bind color 7 (gray) to TERRAIN_GRASS_1 and then create an U_GATE_AA2 object
      C_Purple =>   array(TERRAIN_GRASS_1,          U_BOAR),  # Bind color 7 (gray) to TERRAIN_GRASS_1 and then create an U_GATE_AA2 object
      C_Aqua =>     array(TERRAIN_WATER_SHALLOW,    U_FISH_SALMON),  # Bind color 7 (gray) to TERRAIN_GRASS_1 and then create an U_GATE_AA2 object
      C_Teal =>     array(TERRAIN_WATER_SHALLOW,    U_FISH_TUNA),  # Bind color 7 (gray) to TERRAIN_GRASS_1 and then create an U_GATE_AA2 object
      C_White =>    array(TERRAIN_GRASS_1,          U_RELIC)  # Bind color 7 (gray) to TERRAIN_GRASS_1 and then create an U_GATE_AA2 object
)); 
/*
    
    # Examples:

    # For example we will make a tiny 8 players map:
    SetPlayersCount(8);
    SetMapSize(50);
    
    # Send a message at 10 seconds to all players
	Trig('Send a message to all players',1,0);
	Cond_Timer(10);
	foreach(range(1,8) as $p){
	   Efft_Chat($p,'Hello World');
    }

    # Kill all military units of player 2 at 20 seconds
	Trig('Kill player 2 military units',1,0);
	Cond_Timer(20);
	Efft_KillY(2,Y_MILITARY);
    
    # Kill all military units of all players at middle zone 16x16 of the map at 20 seconds
    $mapSize = GetMapSize();
	Trig('Kill all players military units at middle',1,0);
	Cond_Timer(20);
    $X1 = $Y1 = $mapSize/2 - 8;
    $X2 = $Y2 = $mapSize/2 + 8;
	foreach(range(1,8) as $player){
	   Efft_KillY($player,Y_MILITARY,Area($X1,$Y1,$X2,$Y2));
	}
    # With explosions effect
    for($y = $Y1; $y < $Y2; $y++)
        for($x = $X1; $x < $X2; $x++)
            Efft_Create(0,U_MACAW,array($x,$y));
    Efft_KillU(0,U_MACAW,Area($X1,$Y1,$X2,$Y2));
        
    # Activate "Send a message to all players" again at 30 seconds
	Trig('Reactivate Send a message to all players',1,0);
	Cond_Timer(30);
	Efft_Act('Send a message to all players');
	
    # Put dirt 1 everywhere (to make terrain from image use SetTerrainFromImage())
    $mapSize = GetMapSize();
    for($y = 0; $y < $mapSize; $y++)
       for($x = 0; $x < $mapSize; $x++)
           SetTerrainCell($x,$y,array('terrain' => TERRAIN_DIRT_1));

    # Add 100 militia to all players randomly everywhere on the map
    $mapSize = GetMapSize();
    foreach(range(1,8) as $player){
        for($i = 0; $i < 100; $i++){
            $x = rand(0,$mapSize - 1);
            $y = rand(0,$mapSize - 1);
            $r = rand(0,360);
            NewObject($player,U_MILITIA,array($x,$y),$r);
	   }
    }

    # Write instructions
    SetMessageObjective('Hello World');
    */
}
?>

