#language: es
@asambleas
Característica: Comprobar el funcionamiento de asambleas
    Para poder ver las asambleas disponibles
    Como representante de estudiantes
    Quiero ver el listado de asambleas

Antecedentes:
    Dado existen las asambleas:
      | nombre  | fechaInicio | fechaFin       |   dominio      |
      | Cádiz   | now         | +3 days        |   cadiz2014    |
      | Málaga  | now         | +3 days        |   malaga2016   |
      | Córdoba | -3 days     | -1 days        |   cordoba2013  |
    Y estoy en el sitio de cordoba2013

    Escenario: Mostrar listado de asambleas
        Dado estoy en la página de inicio
        Entonces debería ver 2 asambleas