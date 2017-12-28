# Tabla Tareas

Tabla en la cual se puede tener una bitacora de tareas
con sus respecetivos estados y almacenar las mismas
en una base de datos.

## Como Empezar

Copiar el repositorio y tener una herramienta para poder montarlo.
### Prerequisitos

Servidor como Apache
```
https://httpd.apache.org/download.cgi
```

Tambien se necesita MYSQL
```
https://dev.mysql.com/downloads/windows/
```

Y crear la respectiva tabla
```
CREATE TABLE `tareas` (
  `idTareas` int(11) NOT NULL AUTO_INCREMENT,
  `Tarea` varchar(100) DEFAULT NULL,
  `Responsable` varchar(100) DEFAULT NULL,
  `Fecha` date DEFAULT NULL,
  `Estado` varchar(45) DEFAULT NULL,
  `Observacion` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`idTareas`)
) ENGINE=InnoDB AUTO_INCREMENT=86 DEFAULT CHARSET=utf8
```

## Hecho con

* [PHP7](http://php.net/downloads.php)
* [MySQL](https://dev.mysql.com/downloads/windows/)
* [Apache](https://httpd.apache.org/download.cgi ) 
* [Jquery](https://jquery.com/)
* [Bootstrap4](https://v4-alpha.getbootstrap.com/) 


## Autores

* **Jordan Esquivel** - *Trabajo Inicial*


## DISCLAIMER
 
 ```  
 La tarea puntual es que haga un formulario "TAREAS POR HACER" usando php, bootstrap y mysql que guarde una bitácora de tareas con los siguientes datos:
 Tabla Tareas: Campos (Tarea, Responsable, Fecha, Estado, ObservacionFinal)
 
 Con una tabla de Estados con los siguientes campos: abierto, cerrado, en proceso, anulado, fusionado, postergado
 Esta tabla de Estados la dejas en la base de datos, con estos datos. No es necesario un mantenedor aún. Pero si un mantenedor de Tareas.
 ```
 Esta es lo que se pidio, pero creo que me falto preguntar, en el sentido de que 
 no entendi del todo lo pedido. Se hizo esto: una tabla de tareas que es
 guardada en la base de datos, no encontre el sentido de guardar los estados
 en una tabla aparte ya que se accederian con el indice de la tarea. Se hicieron
 los mantenedores de tareas que tampoco tendrian sentido si esta no se guardara
 en algun lugar.               
                 