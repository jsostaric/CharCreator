drop database if exists pathfinder;
create database pathfinder default character set utf8;
use pathfinder;

#za byethost server
#alter database default character set utf8;

create table users(
	id int not null primary key auto_increment,
	name varchar(50) not null,
	email varchar(50) not null,
	password varchar(50) not null
);

create table characters(
	id int not null primary key auto_increment,
	users int not null,
	races int not null,
	name varchar(50) not null,
	aligment varchar(50),
	hp int	
);

create table races(
	id int not null primary key auto_increment,
	name varchar(50) not null,
	size int default 0,
	description text(65535)
);

create table klasses(
	id int not null primary key auto_increment,
	name varchar(50) not null,
	hit_die varchar(3) not null,
	description varchar(50)
);

create table character_klass(
	characters int not null,
	klasses int not null,
	level int not null,
	bab int not null,	
	fort_save int,
	ref_save int,
	will_save int,
	special varchar(50)
);

create table abilities(
	id int not null primary key auto_increment,
	characters int not null,
	strength int not null,
	dexterity int not null,
	constitution int not null,
	intelligence int not null,
	wisdom int not null,
	charisma int not null
);

create table equipment(
	id int not null primary key auto_increment,
	name varchar(50) not null,
	type varchar(50) not null,
	distance int,
	dmg varchar(50),
	ac int
);

create table character_equipment(
	characters int not null,
	equipment int not null,
	quantity int
);

create table feats(
	id int not null primary key auto_increment,
	name varchar(50) not null,
	description text,
	prerequisite varchar(50)
);

create table character_feat(
	characters int not null,
	feats int not null
);

create table spells(
	id int not null primary key auto_increment,
	name varchar(50) not null,
	level int not null,
	school varchar(50) not null
);

create table character_spell(
	characters int not null,
	spells int not null
);

create table skills(
	id int not null primary key auto_increment,
	name varchar(50) not null,
	modifier varchar(50) not null,
	description varchar(255)
);

create table character_skill(
	characters int not null,
	skills int not null,
	ranks int not null default 0,
	isClassAbility boolean default false
);



alter table characters add foreign key(users) references users(id);
alter table abilities add foreign key(characters) references characters(id);

alter table character_equipment add foreign key(characters) references characters(id);
alter table character_equipment add foreign key(equipment) references equipment(id);

alter table character_feat add foreign key(characters) references characters(id);
alter table character_feat add foreign key(feats) references feats(id);

alter table character_spell add foreign key(characters) references characters(id);
alter table character_spell add foreign key(spells) references spells(id);

alter table character_skill add foreign key(characters) references characters(id);
alter table character_skill add foreign key(skills) references skills(id);

alter table characters add foreign key(races) references races(id);

alter table character_klass add foreign key(characters) references characters(id);
alter table character_klass add foreign key(klasses) references klasses(id);


insert into users(name, email, password) values("jurica","juraos1@yahoo.com", md5("j"));

insert into klasses(name, description)
 values("Ranger", ""),
 		("Fighter", "");

  insert into races(name, size, description)
 values("Half-Orc",0,"Ability Score Modifiers: +2 to one ability.<br>Size: Medium.<br>Type: Humanoid.<br>Base Speed: 30ft.<br>Intimidating: +2 on Intimidate.<br>Orc Ferocity: 1/day when is brough below 0hp but not killed, can fight 1 more round as if disabled. next round, unless brought above 0hp, falls unconscious and begins dying.<br>Weapon Familiarity: greataxe, falchion, orc weapons are martial weapons.<br>Darkvision: 60ft.<br>Orc Blood: count as humans and orcs for effects realted to race."),
 		("Dwarf",0,"Ability Score Modifiers: +2 Constitution, +2 Wisdom, -2 Charisma.<br>Size: Medium.<br>Base Speed: 20ft.<br>Defensive Training: +4 to AC vs. Giants.<br>Hardy: +2 on saving throws vs poison, spells, spell-like abilities.<br> Stability: +4 on CMD vs. bull rush or trip.<br> greed: +2 on Appraise non-magical metals or gemstones.<br> Stonecunning: +2 on Perception on stone walls or floors.<br>Darkvision: 60ft.<br>Hatred: +1 on attack rolls vs Orcs and golinoids.<br> Weapon familiarity: battleaxe, heavy picks, warhammers and all dwarven are martial weapons."),
 		("Elf",0, "Ability Score Modifiers: +2 dexterity, +2 intelligence, -2 constitution.<br>Size: Medium.<br>Type: Humanoid.<br>Base Speed: 30ft.<br>Elven Immunities: immune to sleep, gain +2 on saving throws vs enchantment spells and effects.<br>Keen Senses: +2 on perception.<br>Elven Magic: +2 on caster level check made to overcome spell resistance, +2 on spellcraft to identify magic items.<br>Weapon Familiarity: longbow, longsword, rapier, shortbow, any elven weapon is treated as martial weapon.<br>Low-Light Vision: can see twice as far as humans in dim light."),
 		("Gnome", 1, "Ability Score Modifiers: +2 constitution, +2 charisma, -2 strength.<br>Type: Humanoid.<br>Size: Small, +1 size bonus to AC, +1 size bonus on attack rolls, -1 to CMB and CMD, +4 on stealth.<br>Base Speed: 20ft.<br>Defensive training: +4 dodge to AC vs giant subtype.<br>Illusio Resistance: +2 saving throw vs illusion spells and effects.<br>Keen Senses: +2 perception.<br>Obsessive: +2 on craft or profession skill of their choice.<br>Gnome Magic: +1 to DC of any saving throws against illusion spells they cast.  Gnomes with Charisma scores of 11 or higher also gain the following spell-like abilities: 1/day—dancing lights, ghost sound, prestidigitation, and speak with animals. The caster level for these effects is equal to the gnome’s level. The DC for these spells is equal to 10 + the spell’s level + the gnome’s Charisma modifier.<br>Hatred: +1 attack rolls vs reptilian and goblinoid subtypes.<br>Weapon Familiarity: weapons with name gnome in its name is martial weapon.<br>Low-Light Vision: can see twice as far as humans in dim light."),
 		("Half-Elf",0, "Ability Score Modifiers: +2 to one ability.<br>Type: Humanoid.<br>Size: Medium.<br>Base Speed: 30ft.Elven Immunities: immune to sleep, +2 on saving throw vs enchantment spells and effects.<br>Adaptability: gets Skill Focus as bonus feat at 1st level.<br>Keen Senses: +2 perception.<br>Low-Light Vision: can see twice as far as humans in dim light.<br>Elf Blood: count as humans and elves for any effect related to race.<br>Multitalented: can choose two favored classes at first level, gain +1 hp or +1 skill point whenever they take a level in either one of those classes."),
 		("Halfling",1, "Ability Score Modifiers: +2 dexterity, +2 charisma, -2 strength.<br>Size: Small. +1 on AC, +1 to attack rolls, -1 to CMB and CMD, +4 on stealth.<br>Type: Humanoid.<br>Base Speed: 20ft.<br>Fearless: +2 on all saving throws vs fear. stacks with bonus by halfling luck.<br>Halfling Luck: +1 on all saving throws.<br>Sure-Footed: +2 on Acrobatics and Climb.<br>Weapon Familiarity: sling, any weapon with halfling in its name is martial weapon.<br>Keen Senses: +2 on perception."),
 		("Human",0, "Ability Score Modifiers: +2 to one ability score.<br>Size: Medium.<br>Base Speed: 30ft.<br>Bonus Feat: can select one extra feat at 1st level.<br>Skilled: gain an additional skill rank at first level and one additional rank whenever they gain a level.");


  insert into characters(users, name, races, aligment, hp) 
 values(1, "Bark", 1,"CG", 11),
 		(1, "Stronghold", 2,"NG", 18);

 insert into character_klass(characters, klasses, level, bab, fort_save, ref_save, will_save) values(1,1,1,1,2,2,0), (2,2,1,1,2,0,0);

insert into abilities(characters,strength,dexterity, constitution, intelligence, wisdom, charisma) 
	values(1,17,11,11,8,12,10), (2,16,13,18,9,16,9);

insert into equipment(name, type, distance, dmg, ac)
	values("Longbow", "P",60, "1d8",null),
		("Greataxe", "S", 0, "1d12", null),
        ("Dagger", "P", 20, "1d4", null),
        ("Leather Armor", "A", 0, null, 11),
        ("Studded Leather", "A", 0, null, 12),
        ("Shortsword", "P", 0, "1d6", null),
        ("Unarmed", "B", 0, "1d4", null),
        ("Dart", "P", 20, "1d4", null),
        ("Healing potion", "H", 0, "2d4 + 2", null),
        ("Rapier", "P", 0,"1d8",null ),
       	("Heavy Crossbow", "P", 100,"1d6",null ),
       	("Longsword", "S", 0,"1d8",null ),
       	("Pike", "P", 10,"1d10",null ),
       	("Javelin", "P", 30,"1d6",null ),
       	("Chainmail", "A", 0, null, 16),
       	("Shield", "A", 0,null,2),
       	("Maul", "B", 0,"2d6",null ),
	    ("Halberd", "S", 10,"1d10",null ),
	    ("Spear", "P", 20,"1d6",null ),
	    ("Warhammer", "B", 0,"1d8",null ),
("Handaxe", "S", 0,"1d6",null );

insert into character_equipment(characters, equipment, quantity) values (1,1,1), (1,2,1), (1,3,1);


insert into skills(name, modifier, description ) 
		values("Acrobatics","dexterity", ""),
			("Appraise","intelligence", ""),
            ("Bluff","charisma", ""),
            ("Climb","strength", ""),
            ("Craft","intelligence", ""),
            ("Diplomacy","charisma", ""),
            ("Disable Device","dexterity", ""),
            ("Disguise","charisma", ""),
            ("Escape Artist", "dexterity",""),
            ("Fly", "dexterity",""),
            ("Handle Animal", "charisma",""),
            ("Heal", "wisdom",""),
            ("Intimidate", "charisma",""),
            ("Knowledge(arcana)", "intelligence",""),
            ("Knowledge(dungeoneering", "intelligence",""),
            ("Knowledge(engineering)", "intelligence",""),
            ("Knowledge(geography)", "intelligence",""),
            ("Knowledge(history)", "intelligence",""),
            ("Knowledge(local)", "intelligence",""),
            ("Knowledge(nature)", "intelligence",""),
            ("Knowledge(nobility)", "intelligence",""),
            ("Knowledge(planes)", "intelligence",""),
            ("Knowledge(religion)", "intelligence",""),
            ("Linguistics","intelligence",""),
            ("Perception", "wisdom",""),
            ("Perform","charisma",""),
            ("Profession", "wisdom",""),
            ("Ride", "dexterity",""),
            ("Sense Motive", "wisdom",""),
            ("Sleight Of Hand", "dexterity",""),
            ("Spellcraft", "intelligence",""),
            ("Stealth", "dexterity",""),
            ("Survival","wisdom",""),
            ("Swim", "strength",""),
            ("Use Magic Device", "charisma","");

insert into character_skill(characters, skills, ranks, isClassAbility) values (1,1,0,0),
			(1,2,0,0),
			(1,3,0,0),
			(1,4,1,1),
			(1,5,0,1),
			(1,6,0,0),
			(1,7,0,0),
			(1,8,0,0),
			(1,9,0,0),
			(1,10,0,0),
			(1,11,1,1),
			(1,12,0,1),
			(1,13,0,1),
			(1,14,0,0),
			(1,15,0,1),
			(1,16,0,0),
			(1,17,0,1),
			(1,18,0,0),
			(1,19,0,0),
			(1,20,1,1),
			(1,21,0,0),
			(1,22,0,0),
			(1,23,1,1),
			(1,24,0,0),
			(1,25,0,1),
			(1,26,0,0),
			(1,27,0,0),
			(1,28,0,1),
			(1,29,0,0),
			(1,30,0,0),
			(1,31,0,1),
			(1,32,0,1),
			(1,33,1,1),
			(1,34,0,1),
			(1,35,0,0);

