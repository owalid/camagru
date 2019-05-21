#------------------------------------------------------------
#        Script MySQL.
#------------------------------------------------------------


#------------------------------------------------------------
# Table: User
#------------------------------------------------------------

CREATE TABLE User(
        id_usr     Int  Auto_increment  NOT NULL ,
        login      Varchar (90) NOT NULL ,
        email      Varchar (90) NOT NULL ,
        passwd     Varchar (516) NOT NULL ,
        img_profil Varchar (516) NOT NULL
	,CONSTRAINT User_PK PRIMARY KEY (id_usr)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: Image
#------------------------------------------------------------

CREATE TABLE Image(
        id_img  Int  Auto_increment  NOT NULL ,
        img     Varchar (516) NOT NULL ,
        nb_like Int NOT NULL ,
        id_usr  Int NOT NULL
	,CONSTRAINT Image_PK PRIMARY KEY (id_img)

	,CONSTRAINT Image_User_FK FOREIGN KEY (id_usr) REFERENCES User(id_usr)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: ImgSaver
#------------------------------------------------------------

CREATE TABLE ImgSaver(
        id_save Int  Auto_increment  NOT NULL ,
        id_usr  Int NOT NULL ,
        id_img  Int NOT NULL
	,CONSTRAINT ImgSaver_PK PRIMARY KEY (id_save)

	,CONSTRAINT ImgSaver_User_FK FOREIGN KEY (id_usr) REFERENCES User(id_usr)
	,CONSTRAINT ImgSaver_Image0_FK FOREIGN KEY (id_img) REFERENCES Image(id_img)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: Commentaire
#------------------------------------------------------------

CREATE TABLE Commentaire(
        id_commentaire Int  Auto_increment  NOT NULL ,
        commenatire    Varchar (516) NOT NULL ,
        id_img         Int NOT NULL ,
        id_usr         Int NOT NULL
	,CONSTRAINT Commentaire_PK PRIMARY KEY (id_commentaire)

	,CONSTRAINT Commentaire_Image_FK FOREIGN KEY (id_img) REFERENCES Image(id_img)
	,CONSTRAINT Commentaire_User0_FK FOREIGN KEY (id_usr) REFERENCES User(id_usr)
)ENGINE=InnoDB;

