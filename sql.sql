CREATE TABLE Customer(
  driverLiscense INTEGER(10) PRIMARY KEY,
  fName VARCHAR(30) NOT NULL,
  lName VARCHAR(30) NOT NULL,
  password VARCHAR(20) NOT NULL,
  address VARCHAR(128) NOT NULL

);
INSERT INTO Customer (driverLiscense, fName, lName, password, address) VALUES
(123456, 'Violet', 'Liu', '123456', '2205 Lower Mall, Vancouver, BC'),
(432143, 'Amy', 'Zhu', '432143', '6335 Thunderbird Crescent, Vancouver, BC'),
(987654, 'David', 'Kim', '987654', '5960 Student Union Blvd, Vancouver, BC');



CREATE TABLE Clerk(
  Cusername VARCHAR(30) PRIMARY KEY,
  password VARCHAR(20) NOT NULL
);

INSERT INTO Clerk (Cusername, password)VALUES ("Violet",199829);
INSERT INTO Clerk (Cusername, password)VALUES ("Amy","19930505");



CREATE TABLE Location(
  location VARCHAR(40),
  city VARCHAR(20),
  lc VARCHAR (60),
  PRIMARY KEY(lc)
);


INSERT INTO Location(location,city,lc) VALUES("1120 Homer Street", "Vancouver","1120 Homer Street,Vancouver");
INSERT INTO Location(location,city,lc) VALUES("8289 Granville Street", "Vancouver","8289 Granville Street,Vancouver");
INSERT INTO Location(location,city,lc) VALUES("13500 Commerce Pkwy", "Richmond","13500 Commerce Pkwy,Richmond");
INSERT INTO Location(location,city,lc) VALUES("5276 Kingsway", "Burnaby","5276 Kingsway,Burnaby");
INSERT INTO Location(location,city,lc) VALUES("457 SW Marine Dr", "Vancouver","457 SW Marine Dr,Vancouver");






CREATE TABLE Vtype (
  vtname VARCHAR(30) PRIMARY KEY,
  weekRate INTEGER(5),
  dayRate INTEGER(5),
  hourRate INTEGER(5),
  kiloRate INTEGER(5),
  winsRate INTEGER(5),
  hinsRate INTEGER(5),
  dinsRate INTEGER(5)
);
INSERT INTO Vtype(vtname,weekRate,dayRate,hourRate,kiloRate,winsRate,hinsRate,dinsRate)
VALUES("Economy","500","70","20","250","100","50","190");
INSERT INTO Vtype(vtname,weekRate,dayRate,hourRate,kiloRate,winsRate,hinsRate,dinsRate)
VALUES("Mid-size","500","70","60","250","100","50","190");
INSERT INTO Vtype(vtname,weekRate,dayRate,hourRate,kiloRate,winsRate,hinsRate,dinsRate)
VALUES("Standard","500","40","20","250","100","50","190");
INSERT INTO Vtype(vtname,weekRate,dayRate,hourRate,kiloRate,winsRate,hinsRate,dinsRate)
VALUES("Fullsize","500","70","20","250","100","50","130");
INSERT INTO Vtype(vtname,weekRate,dayRate,hourRate,kiloRate,winsRate,hinsRate,dinsRate)
VALUES("SUV","500","70","20","250","180","50","190");
INSERT INTO Vtype(vtname,weekRate,dayRate,hourRate,kiloRate,winsRate,hinsRate,dinsRate)
VALUES("Truck","440","70","20","250","100","50","190");







CREATE TABLE Vehicles (
  vlicence VARCHAR(4),
  make VARCHAR(20),
  model VARCHAR(20),
  year INTEGER (4),
  odemeter INTEGER (10),
  status VARCHAR (20),
  color VARCHAR(10),
  lc VARCHAR(60) NOT NULL,
  vtname VARCHAR(30) NOT NULL,
  PRIMARY KEY(vlicence),
  FOREIGN KEY(lc) REFERENCES Location(lc),
  FOREIGN KEY(vtname) REFERENCES Vtype(vtname)
);
INSERT INTO Vehicles(vlicence,make,model,year,odemeter,status,color,lc,vtname)
VALUES("001","Toyota","Camry","2017","4000","rented","Black","1120 Homer Street,Vancouver","Economy");
INSERT INTO Vehicles(vlicence,make,model,year,odemeter,status,color,lc,vtname)
VALUES("002","Audi","Q7","2018","4006","available","White","1120 Homer Street,Vancouver","Economy");
INSERT INTO Vehicles(vlicence,make,model,year,odemeter,status,color,lc,vtname)
VALUES("003","Audi","Q5","2011","13050","maintenance","Green","1120 Homer Street,Vancouver","Economy");
INSERT INTO Vehicles(vlicence,make,model,year,odemeter,status,color,lc,vtname)
VALUES("004","BMW","X5","2009","10000","available","Blue","8289 Granville Street,Vancouver","Economy");
INSERT INTO Vehicles(vlicence,make,model,year,odemeter,status,color,lc,vtname)
VALUES("005"," Ford","Fiesta","2011","3020","available","Red","13500 Commerce Pkwy,Richmond","SUV");
INSERT INTO Vehicles(vlicence,make,model,year,odemeter,status,color,lc,vtname)
VALUES("006"," Hyundai","Palisade","2011","7789","available","Red","5276 Kingsway,Burnaby","Standard");
INSERT INTO Vehicles(vlicence,make,model,year,odemeter,status,color,lc,vtname)
VALUES("007"," Jeep","Renegade","2019","10","available","Grey","13500 Commerce Pkwy,Richmond","Truck");
INSERT INTO Vehicles(vlicence,make,model,year,odemeter,status,color,lc,vtname)
VALUES("008"," Jeep","Renegade","2010","100","rented","Black","13500 Commerce Pkwy,Richmond","Truck");
INSERT INTO Vehicles(vlicence,make,model,year,odemeter,status,color,lc,vtname)
VALUES("009"," BWM","X3","2017","1422","available","Red","8289 Granville Street,Vancouver","SUV");
INSERT INTO Vehicles(vlicence,make,model,year,odemeter,status,color,lc,vtname)
VALUES("010","Toyota","Avalon","2015","3453","available","Grey","8289 Granville Street,Vancouver","Economy");
INSERT INTO Vehicles(vlicence,make,model,year,odemeter,status,color,lc,vtname)
VALUES("011","BWM","X2","2012","233","available","White","8289 Granville Street,Vancouver","SUV");
INSERT INTO Vehicles(vlicence,make,model,year,odemeter,status,color,lc,vtname)
VALUES("012","BWM","X1","2014","3241","available","Black","8289 Granville Street,Vancouver","SUV");
INSERT INTO Vehicles(vlicence,make,model,year,odemeter,status,color,lc,vtname)
VALUES("013","Chevrolet","Traverse","2019","564","available","Black","1120 Homer Street,Vancouver","SUV");
INSERT INTO Vehicles(vlicence,make,model,year,odemeter,status,color,lc,vtname)
VALUES("014","Ford","Escape","2013","12864","available","Grey","1120 Homer Street,Vancouver","SUV");
INSERT INTO Vehicles(vlicence,make,model,year,odemeter,status,color,lc,vtname)
VALUES("015","Ford","Explorer","2011","14380","available","Blue","8289 Granville Street,Vancouver","SUV");
INSERT INTO Vehicles(vlicence,make,model,year,odemeter,status,color,lc,vtname)
VALUES("016","Chevrolet","Bolt","2017","9830","available","Orange","1120 Homer Street,Vancouver","Standard");
INSERT INTO Vehicles(vlicence,make,model,year,odemeter,status,color,lc,vtname)
VALUES("017","Chevrolet","Spark","2018","830","available","Purple","1120 Homer Street,Vancouver","Standard");
INSERT INTO Vehicles(vlicence,make,model,year,odemeter,status,color,lc,vtname)
VALUES("018","Fiat","500L","2018","6789","available","Black","8289 Granville Street,Vancouver","Standard");
INSERT INTO Vehicles(vlicence,make,model,year,odemeter,status,color,lc,vtname)
VALUES("019","Honda","Crosstour","2012","3446","available","Blue","8289 Granville Street,Vancouver","Mid-size");
INSERT INTO Vehicles(vlicence,make,model,year,odemeter,status,color,lc,vtname)
VALUES("020","Honda","Fit","2015","10044","available","Blue","8289 Granville Street,Vancouver","Mid-size");
INSERT INTO Vehicles(vlicence,make,model,year,odemeter,status,color,lc,vtname)
VALUES("021","Kia","Niro","2017","14034","available","Blue","8289 Granville Street,Vancouver","SUV");
INSERT INTO Vehicles(vlicence,make,model,year,odemeter,status,color,lc,vtname)
VALUES("022","Kia","Rio","2018","7044","available","White","8289 Granville Street,Vancouver","Standard");
INSERT INTO Vehicles(vlicence,make,model,year,odemeter,status,color,lc,vtname)
VALUES("023","Mercedes-Benz","Fit","2015","9742","available","Blue","8289 Granville Street,Vancouver","SUV");
INSERT INTO Vehicles(vlicence,make,model,year,odemeter,status,color,lc,vtname)
VALUES("024","Mercedes-Benz","Fit","2015","10214","available","White","1120 Homer Street,Vancouver","Economy");
INSERT INTO Vehicles(vlicence,make,model,year,odemeter,status,color,lc,vtname)
VALUES("025","Mercedes-Benz","E-Class","2017","12324","available","Blue","5276 Kingsway,Burnaby","Economy");
INSERT INTO Vehicles(vlicence,make,model,year,odemeter,status,color,lc,vtname)
VALUES("026","Honda","Fit","2015","22344","available","Blue","5276 Kingsway,Burnaby","Economy");
INSERT INTO Vehicles(vlicence,make,model,year,odemeter,status,color,lc,vtname)
VALUES("027","Toyota","C-HR","2017","9814","available","Black","1120 Homer Street,Vancouver","SUV");
INSERT INTO Vehicles(vlicence,make,model,year,odemeter,status,color,lc,vtname)
VALUES("028","Toyota","C-HR","2017","10214","available","Black","1120 Homer Street,Vancouver","SUV");
INSERT INTO Vehicles(vlicence,make,model,year,odemeter,status,color,lc,vtname)
VALUES("029","Toyota","Matrix","2009","20214","available","White","1120 Homer Street,Vancouver","Economy");
INSERT INTO Vehicles(vlicence,make,model,year,odemeter,status,color,lc,vtname)
VALUES("030","Toyota","Matrix","2009","16214","available","White","1120 Homer Street,Vancouver","Mid-size");
INSERT INTO Vehicles(vlicence,make,model,year,odemeter,status,color,lc,vtname)
VALUES("031","Toyota","Prius","2016","18314","available","Blue","1120 Homer Street,Vancouver","Standard");
INSERT INTO Vehicles(vlicence,make,model,year,odemeter,status,color,lc,vtname)
VALUES("032","Toyota","Fit","2015","10214","available","White","1120 Homer Street,Vancouver","Economy");
INSERT INTO Vehicles(vlicence,make,model,year,odemeter,status,color,lc,vtname)
VALUES("033","Dodge","Dakota","2005","13242","available","White","1120 Homer Street,Vancouver","Truck");
INSERT INTO Vehicles(vlicence,make,model,year,odemeter,status,color,lc,vtname)
VALUES("034","Ford","Explorer","2007","28714","available","Black","8289 Granville Street,Vancouver","Truck");
INSERT INTO Vehicles(vlicence,make,model,year,odemeter,status,color,lc,vtname)
VALUES("035","Mercedes-Benz","Fit","2015","9214","available","White","1120 Homer Street,Vancouver","Economy");
INSERT INTO Vehicles(vlicence,make,model,year,odemeter,status,color,lc,vtname)
VALUES("036","Ford","F-150","2015","9874","available","Black","8289 Granville Street,Vancouver","Truck");
INSERT INTO Vehicles(vlicence,make,model,year,odemeter,status,color,lc,vtname)
VALUES("037","Ford","Ranger","2019","2214","available","White","1120 Homer Street,Vancouver","Truck");
INSERT INTO Vehicles(vlicence,make,model,year,odemeter,status,color,lc,vtname)
VALUES("038","Ford","Ranger","2019","5214","available","White","1120 Homer Street,Vancouver","Truck");
INSERT INTO Vehicles(vlicence,make,model,year,odemeter,status,color,lc,vtname)
VALUES("039","Ford","Ranger","2019","8214","available","White","1120 Homer Street,Vancouver","Truck");
INSERT INTO Vehicles(vlicence,make,model,year,odemeter,status,color,lc,vtname)
VALUES("040","GMC","Canyon","2015","9254","available","Black","8289 Granville Street,Vancouver","Truck");
INSERT INTO Vehicles(vlicence,make,model,year,odemeter,status,color,lc,vtname)
VALUES("041","GMC","Canyon","2015","13241","available","Black","1120 Homer Street,Vancouver","Truck");
INSERT INTO Vehicles(vlicence,make,model,year,odemeter,status,color,lc,vtname)
VALUES("042","Dodge","Dart","2013","9234","available","White","1120 Homer Street,Vancouver","Mid-size");
INSERT INTO Vehicles(vlicence,make,model,year,odemeter,status,color,lc,vtname)
VALUES("043","Dodge","Dart","2013","10234","available","Orange","8289 Granville Street,Vancouver","Mid-size");
INSERT INTO Vehicles(vlicence,make,model,year,odemeter,status,color,lc,vtname)
VALUES("044","Dodge","Dart","2013","8232","available","White","8289 Granville Street,Vancouver","Mid-size");
INSERT INTO Vehicles(vlicence,make,model,year,odemeter,status,color,lc,vtname)
VALUES("045","Dodge","Dart","2013","9234","available","Black","1120 Homer Street,Vancouver","Mid-size");
INSERT INTO Vehicles(vlicence,make,model,year,odemeter,status,color,lc,vtname)
VALUES("046","Mercedes-Benz","Fit","2015","25214","available","White","1120 Homer Street,Vancouver","Economy");
INSERT INTO Vehicles(vlicence,make,model,year,odemeter,status,color,lc,vtname)
VALUES("047","Fiat","500L","2014","9344","available","White","8289 Granville Street,Vancouver","Mid-size");
INSERT INTO Vehicles(vlicence,make,model,year,odemeter,status,color,lc,vtname)
VALUES("048","Fiat","500L","2014","7623","available","White","8289 Granville Street,Vancouver","Mid-size");
INSERT INTO Vehicles(vlicence,make,model,year,odemeter,status,color,lc,vtname)
VALUES("049","Fiat","500L","2014","9821","available","White","8289 Granville Street,Vancouver","Mid-size");
INSERT INTO Vehicles(vlicence,make,model,year,odemeter,status,color,lc,vtname)
VALUES("050","Fiat","500L","2014","12414","available","White","5276 Kingsway,Burnaby","Mid-size");
INSERT INTO Vehicles(vlicence,make,model,year,odemeter,status,color,lc,vtname)
VALUES("051","Mercedes-Benz","Fit","2015","23424","available","White","8289 Granville Street,Vancouver","Economy");
INSERT INTO Vehicles(vlicence,make,model,year,odemeter,status,color,lc,vtname)
VALUES("052","Honda","Civic","2016","2124","available","Black","8289 Granville Street,Vancouver","Economy");
INSERT INTO Vehicles(vlicence,make,model,year,odemeter,status,color,lc,vtname)
VALUES("053","Honda","Civic","2016","13424","available","Black","8289 Granville Street,Vancouver","Economy");
INSERT INTO Vehicles(vlicence,make,model,year,odemeter,status,color,lc,vtname)
VALUES("054","Honda","Civic","2016","54424","available","White","5276 Kingsway,Burnaby","Economy");
INSERT INTO Vehicles(vlicence,make,model,year,odemeter,status,color,lc,vtname)
VALUES("055","Audi","Q5","2018","12314","available","White","5276 Kingsway,Burnaby","SUV");
INSERT INTO Vehicles(vlicence,make,model,year,odemeter,status,color,lc,vtname)
VALUES("056","Audi","Q5","2018","6424","available","Black","5276 Kingsway,Burnaby","SUV");
INSERT INTO Vehicles(vlicence,make,model,year,odemeter,status,color,lc,vtname)
VALUES("057","Audi","Q5","2018","7674","available","Black","8289 Granville Street,Vancouver","SUV");
INSERT INTO Vehicles(vlicence,make,model,year,odemeter,status,color,lc,vtname)
VALUES("058","Ford","Ranger","2017","8624","available","Blue","1120 Homer Street,Vancouver","Truck");
INSERT INTO Vehicles(vlicence,make,model,year,odemeter,status,color,lc,vtname)
VALUES("059","Ford","Ranger","2017","9424","available","Blue","8289 Granville Street,Vancouver","Truck");
INSERT INTO Vehicles(vlicence,make,model,year,odemeter,status,color,lc,vtname)
VALUES("060","Ford","R-350","2019","5424","available","Blue","1120 Homer Street,Vancouver","Truck");

INSERT INTO Vehicles(vlicence,make,model,year,odemeter,status,color,lc,vtname)
VALUES('061', 'Toyota', 'Matrix', 2009, 20214, 'available', 'White', '13500 Commerce Pkwy,Richmond', 'Economy');

INSERT INTO Vehicles(vlicence,make,model,year,odemeter,status,color,lc,vtname)
VALUES('062', 'Toyota', 'Matrix', 2009, 16214, 'available', 'White', '13500 Commerce Pkwy,Richmond', 'Mid-size');

INSERT INTO Vehicles(vlicence,make,model,year,odemeter,status,color,lc,vtname)
VALUES('063', 'Ford', 'Ranger', 2017, 9424, 'available', 'Blue', '13500 Commerce Pkwy,Richmond', 'Truck');

INSERT INTO Vehicles(vlicence,make,model,year,odemeter,status,color,lc,vtname)
VALUES('064', 'Ford', 'Ranger', 2017, 9424, 'available', 'Blue', '5276 Kingsway,Burnaby', 'Truck');






CREATE TABLE Reservation(
  confNum INTEGER(4) AUTO_INCREMENT,
  driverLiscense INTEGER(10) NOT NULL,
  fdatetime VARCHAR(40) NOT NULL,
  edatetime VARCHAR(40) NOT NULL,
  lc VARCHAR (60) NOT NULL,
  vtname VARCHAR(20) NOT NULL,
  rdate VARCHAR(40) NOT NULL,
  cardType VARCHAR(4) NOT NULL,
  cardNo VARCHAR(16) NOT NULL,
  ExpDate VARCHAR(8) NOT NULL,
  cvv INTEGER(3) NOT NULL,

  PRIMARY KEY(confNum),
  FOREIGN KEY(vtname) REFERENCES Vtype(vtname),
  FOREIGN KEY(driverLiscense) REFERENCES Customer(driverLiscense)
);

INSERT INTO `Reservation` (`confNum`, `driverLiscense`, `fdatetime`, `edatetime`, `lc`, `vtname`, `rdate`, `cardType`, `cardNo`, `ExpDate`, `cvv`) VALUES
(7, 123456, '2019-11-18 00:12:00', '2019-11-30 13:21:00', '1120 Homer Street,Vancouver', 'Economy', '2019-11-16 03:38:02', 'VISA', '4321432112341234', '2021-12', '234'),
(8, 123456, '2019-11-21 00:12:00', '2019-11-28 13:21:00', '1120 Homer Street,Vancouver', 'Economy', '2019-11-20 03:38:02', 'VISA', '4321432112341234', '2021-12', '234'),
(9, 123456, '2019-11-21 00:23:00', '2019-11-30 02:13:00', '1120 Homer Street,Vancouver', 'SUV', '2019-11-21 09:56:04', 'AMEX', '3214123423453456', '2022-05', '768'),
(10, 123456, '2019-11-21 04:32:00', '2019-12-01 04:53:00', '8289 Granville Street,Vancouver', 'Standard', '2019-11-21 09:56:50', 'MSTR', '5432234565433456', '2021-09', '341'),
(11, 123456, '2019-11-27 12:31:00', '2019-12-01 12:31:00', '1120 Homer Street,Vancouver', 'Economy', '2019-11-24 06:10:35', 'VISA', '4321543265437654', '2021-12', '745'),
(12, 123456, '2019-11-29 06:53:00', '2019-11-30 06:54:00', '8289 Granville Street,Vancouver', 'Standard', '2019-11-24 06:11:17', 'MSTR', '5476345212349876', '2020-08', '425');

CREATE TABLE Rentals(
  rid INTEGER(100) AUTO_INCREMENT,
  vlicence VARCHAR(4) NOT NULL,
  driverLiscense INTEGER(10) NOT NULL,
  fdatetime VARCHAR(40),
  edatetime VARCHAR(40),
  cardType VARCHAR(10) NOT NULL,
  cardNo CHAR(16) NOT NULL,
  ExpDate VARCHAR(8) NOT NULL,
  cvv INTEGER(3) NOT NULL,
  confNum INTEGER(4),
  odemeter INTEGER(10) DEFAULT NULL,
  rdatetime VARCHAR(40) DEFAULT NULL,
  fulltank varchar(3) DEFAULT NULL,
  cost INTEGER (10)DEFAULT NULL,

  PRIMARY KEY(rid),
  FOREIGN KEY(confNum) REFERENCES Reservation (confNum),
  FOREIGN KEY(vlicence) REFERENCES Vehicles(vlicence),
  FOREIGN KEY(driverLiscense) REFERENCES Customer(driverLiscense)
);
  INSERT INTO `Rentals` (`rid`, `vlicence`, `driverLiscense`, `fdatetime`, `edatetime`, `cardType`, `cardNo`, `ExpDate`, `cvv`, `confNum`, `odemeter`, `rdatetime`, `fulltank`, `cost`) VALUES
(8, '009', 123456, '2019-11-18 00:12:00', '2019-11-22 00:00:00', 'VISA', '4321432112341234', '2021-12', 234, 7, 120, '2019-11-22 00:00:00', 'yes', 5010),
(15, '002', 432143, '2019-11-19 10:36:16', '2019-11-22 00:20:00', 'MSTR', '5431123456788754', '2020-06', 513, NULL, 41, '2019-11-22 00:20:00', 'yes', 1780),
(16, '001', 123456, '2019-11-21 00:12', '2019-11-28 13:21:00', 'VISA', '4321432112341234', '2021-12', 234, 8, NULL, NULL, NULL, NULL),
(17, '013', 123456, '2019-11-22 00:23:00', '2019-11-30 02:13:00', 'AMEX', '3214123423453456', '2022-05', 768, 9, NULL, NULL, NULL, NULL),
(18, '018', 123456, '2019-11-22 04:32:00', '2019-12-01 04:53:00', 'MSTR', '5432234565433456', '2021-09', 341, 10, NULL, NULL, NULL, NULL),
(19, '004', 432143, '2019-11-22 11:13:19', '2019-11-26 14:13:00', 'VISA', '4321123456788765', '2022-11', 421, NULL, NULL, NULL, NULL, NULL),
(20, '051', 432143, '2019-11-22 11:15:10', '2019-11-26 14:13:00', 'VISA', '4321123456788765', '2022-11', 421, NULL, NULL, NULL, NULL, NULL),
(21, '052', 432143, '2019-11-22 11:15:22', '2019-11-26 14:13:00', 'VISA', '4321123456788765', '2022-11', 421, NULL, NULL, NULL, NULL, NULL);

