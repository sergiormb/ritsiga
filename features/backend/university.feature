#language: es
@backend
Característica: Comprobar universidades en el backend

    Antecedentes:
      Dado que estoy autenticado como administrador
      Y existen las universidades:
      | nombre  | ciudad   | provincia    |   cif      |
      | UCO     | Cordoba  | Cordoba      |   1        |
      | UMA     | Malaga   | Malaga       |   2        |

    Escenario: Ver listado de todas las universidades
        Cuando voy a "convention/ritsi/admin/dashboard"
        Y voy a "/convention/ritsi/admin/app/university/list"
        Entonces debo ver "2 resultados"

    Escenario: Enviar formulario de universidad vacío
        Cuando voy a "/convention/ritsi/admin/app/university/create"
        Y presiono "Crear y editar"
        Entonces debo ver "Se ha producido un error durante la creación del elemento"

    Escenario: Crear universidad
        Cuando voy a "/convention/ritsi/admin/app/university/create"
        Y relleno lo siguiente:
        | Nombre         | Prueba           |
        | Dirección      | C/Piruleta       |
        | Ciudad         | CiudadImaginaria |
        | Provincia      | Cordoba          |
        | Código Postal  | 14540            |
        | Cif            | 101010           |
        | Tipo           | publica          |
        | Slug           | prub             |

    Y presiono "Crear y regresar al listado"
        Entonces debo ver "Elemento creado satisfactoriamente"

    Escenario: Exportar archivos a JSON
        Cuando voy a "/convention/ritsi/admin/app/university/list"
        Y sigo "JSON"
        Entonces el código de estado de la respuesta debe ser 200

    Escenario: Exportar archivos a XML
        Cuando voy a "/convention/ritsi/admin/app/university/list"
        Y sigo "XML"
        Entonces el código de estado de la respuesta debe ser 200

    Escenario: Exportar archivos a CSV
        Cuando voy a "/convention/ritsi/admin/app/university/list"
        Y sigo "CSV"
        Entonces el código de estado de la respuesta debe ser 200

    Escenario: Exportar archivos a XLS
        Cuando voy a "/convention/ritsi/admin/app/university/list"
        Y sigo "XLS"
        Entonces el código de estado de la respuesta debe ser 200

    Escenario: Borrar universidad desde el listado
        Cuando voy a "/convention/ritsi/admin/app/university/list"
        Y relleno "filter_name_value" con "UCO"
        Y presiono "Filtrar"
        Y sigo "Editar"
        Y sigo "Borrar"
        Entonces presiono " Sí, borrar" con clase "btn btn-danger"
        Y debo estar en "/convention/ritsi/admin/app/university/list"
        Y debo ver "Elemento eliminado satisfactoriamente."
        Pero no debo ver "UCO"