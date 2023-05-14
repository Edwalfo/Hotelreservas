create database hoteleria;
use hoteleria;
CREATE TABLE factura (
  idFactura int(11) NOT NULL,
  numeroFactura int(11) NOT NULL,
  fecha date NOT NULL,
  valor_efectivo double DEFAULT NULL,
  valor_tarjeta double DEFAULT NULL,
  valor_transferencia double DEFAULT NULL,
  valor_otros double DEFAULT NULL,
  descuento double DEFAULT NULL,
  valortotal double NOT NULL,
  impuesto double NOT NULL,
  estadoFactura varchar(45) NOT NULL DEFAULT 'activo',
  reserva_id int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



CREATE TABLE habitacion (
  idHabitacion int(11) NOT NULL,
  numeroHabitacion varchar(45) NOT NULL,
  estado int(11) NOT NULL,
  estadoHabitacion varchar(45) NOT NULL DEFAULT 'activo',
  tipohabitacion_id int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



CREATE TABLE huesped (
  idHuesped int(11) NOT NULL,
  nombreHuesped varchar(60) NOT NULL,
  documentoHuesped varchar(45) NOT NULL,
  fecha_nacimiento date NOT NULL,
  direccionHuesped varchar(60) DEFAULT NULL,
  telefonoHuesped varchar(45) DEFAULT NULL,
  correoHuesped varchar(45) DEFAULT NULL,
  estadoHuesped varchar(45) NOT NULL DEFAULT 'activo',
  tipodocumento_id int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



CREATE TABLE reserva (
  idReserva int(11) NOT NULL,
  fecha_reserva date NOT NULL,
  fecha_ingreso date NOT NULL,
  fecha_salida date NOT NULL,
  numeroReserva int(11) NOT NULL,
  estadoReserva varchar(45) NOT NULL DEFAULT 'estado',
  huesped_id int(11) NOT NULL,
  estado_reserva int(11) NOT NULL,
  habitacion_id int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;




CREATE TABLE tipohabitacion (
  idTipoHabitacion int(11) NOT NULL,
  nombreTipoHabitacion varchar(45) NOT NULL,
  valorTipoHabitacion varchar(45) NOT NULL,
  descripcion varchar(100) DEFAULT NULL,
  estadoTipoHabitacion varchar(45) NOT NULL DEFAULT 'activo'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



CREATE TABLE usuario (
  idusuario int(11) NOT NULL,
  nombreUsuario varchar(45) NOT NULL,
  tipoUsuario varchar(45) NOT NULL,
  correoUsuario varchar(45) DEFAULT NULL,
  usuario varchar(45) NOT NULL,
  contrasena varchar(45) NOT NULL,
  estadoUsuario varchar(45) NOT NULL DEFAULT 'activo'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla usuario
--

INSERT DELAYED IGNORE INTO usuario (idusuario, nombreUsuario, tipoUsuario, correoUsuario, usuario, contrasena, estadoUsuario) VALUES
(1, 'Administrador', '1', 'admin@admin.com', 'Admin', 'N25FeXV2V21tT1NISTdZMWY1UFhhQT09', 'activo'),
