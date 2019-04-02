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
	characters int not null,
	name varchar(50) not null,
	description varchar(255)
);

create table klasses(
	id int not null primary key auto_increment,
	name varchar(50) not null,
	hit_die varchar(3) not null,
	bab int,
	fort_save int,
	ref_save int,
	will_save int,
	special varchar(50),
	description varchar(50)
);

create table character_klass(
	characters int not null,
	klasses int not null,
	level int not null,
	bab int not null
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

insert into klasses(name, bab, fort_save, ref_save, will_save)
 values("Ranger", 1,2,2,0),
 		("Fighter", 1,2,0,0);

  insert into races(name, description)
 values("Half-orc",""),
 		("Dwarf","");


  insert into characters(users, name, races, aligment, hp) 
 values(1, "Bark", 1,"CG", 12),
 		(1, "Stronghold", 2,"NG", 18);

 insert into character_klass(characters, klasses, level) values(1,1,1), (2,2,1);

insert into abilities(characters,strength,dexterity, constitution, intelligence, wisdom, charisma) 
	values(1,15,12,10,8,14,13), (2,16,13,18,9,16,9);

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

