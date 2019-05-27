#------------------------------------------------------------
#        Script MySQL.
#------------------------------------------------------------


#------------------------------------------------------------
# Table: User
#------------------------------------------------------------

CREATE TABLE User(
        idUsr      Int  Auto_increment  NOT NULL ,
        login      Varchar (90) NOT NULL UNIQUE,
        email      Varchar (90) NOT NULL UNIQUE,
        passwd     Varchar (516) NOT NULL ,
        hash       Varchar (516) NOT NULL ,
        isVerif    Bool NOT NULL DEFAULT false ,
        bio        Varchar (516) NOT NULL ,
        pp         MEDIUMTEXT NOT NULL
	,CONSTRAINT User_PK PRIMARY KEY (idUsr)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: Image
#------------------------------------------------------------

CREATE TABLE Image(
        idImg           Int  Auto_increment  NOT NULL ,
        img             MEDIUMTEXT NOT NULL ,
        nbLike          Int NOT NULL  ,
        idUsr           Int NOT NULL  ,
        description     VARCHAR(516)
	,CONSTRAINT Image_PK PRIMARY KEY (idImg)

	,CONSTRAINT Image_User_FK FOREIGN KEY (idUsr) REFERENCES User(idUsr)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: ImgSaver
#------------------------------------------------------------

CREATE TABLE ImgSaver(
        idSave Int  Auto_increment  NOT NULL ,
        idUsr  Int NOT NULL ,
        idImg  Int NOT NULL
	,CONSTRAINT ImgSaver_PK PRIMARY KEY (idSave)

	,CONSTRAINT ImgSaver_User_FK FOREIGN KEY (idUsr) REFERENCES User(idUsr)
	,CONSTRAINT ImgSaver_Image0_FK FOREIGN KEY (idImg) REFERENCES Image(idImg)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: Commentaire
#------------------------------------------------------------

CREATE TABLE Commentaire(
        idCommentaire Int  Auto_increment  NOT NULL ,
        commentaire   MEDIUMTEXT NOT NULL ,
        idImg         Int NOT NULL ,
        idUsr         Int NOT NULL
	,CONSTRAINT Commentaire_PK PRIMARY KEY (idCommentaire)

	,CONSTRAINT Commentaire_Image_FK FOREIGN KEY (idImg) REFERENCES Image(idImg)
	,CONSTRAINT Commentaire_User0_FK FOREIGN KEY (idUsr) REFERENCES User(idUsr)
)ENGINE=InnoDB;

#------------------------------------------------------------
# Table: `Like`
#------------------------------------------------------------

CREATE TABLE `Like`(
        idLike  Int  Auto_increment  NOT NULL ,
        isLiked Bool NOT NULL ,
        idUsr  Int ,
        idImg  Int
	,CONSTRAINT Like_PK PRIMARY KEY (idLike)

	,CONSTRAINT Like_User_FK FOREIGN KEY (idUsr) REFERENCES User(idUsr)
	,CONSTRAINT Like_Image0_FK FOREIGN KEY (idImg) REFERENCES Image(idImg)
)ENGINE=InnoDB;
