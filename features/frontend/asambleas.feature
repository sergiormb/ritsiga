#language: es
@asambleas
Característica: Comprobar el funcionamiento de asambleas
    Para poder ver las asambleas disponibles
    Como representante de estudiantes
    Quiero ver el listado de asambleas

Antecedentes:
    Dado existen las asambleas:
      | nombre  | fechaInicio | fechaFin  |
      | Cádiz   | now         | +3 days        |
      | Málaga  | now         | +3 days       |
      | Córdoba | -3 days          | -1 days        |

    Escenario: Mostrar listado de asambleas
        Dado estoy en la página de inicio
        Entonces debería ver 2 asambleas