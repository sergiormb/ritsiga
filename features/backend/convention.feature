#language: es
@backend
Característica: Comprobar asambleas en el backend

Antecedentes:
    Dado que estoy autenticado como administrador
    Y que existen los siguientes usuarios:
    | username  |     email     |   plainPassword   |  enabled  |  role             |
    |   user1   | user1@uco.es  | secret1           |   1       |  ROLE_ORGANIZER   |
    |   admin   | user2@uco.es  | admin             |   1       |  ROLE_ADMIN       |
    Y existen las asambleas:
    | nombre  | fechaInicio | fechaFin       |   dominio      |   email        |
    | Cádiz   | now         | +3 days        |   cadiz2014    |   1@riti.com   |
    | Málaga  | now         | +3 days        |   malaga2016   |   2@riti.com   |
    | Córdoba | -3 days     | -1 days        |   cordoba2013  |   3@riti.com   |

    Escenario: Ver listado de todas las asambleas
        Cuando voy a "convention/ritsi/admin/dashboard"
        Y voy a "/convention/ritsi/admin/app/convention/list"
        Entonces debo ver "3 resultados"

    Escenario: Enviar formulario de asamblea vacío
        Cuando voy a "/convention/ritsi/admin/app/convention/create"
        Y presiono "Crear y editar"
        Entonces debo ver "Se ha producido un error durante la creación del elemento"

    Escenario: Crear asamblea
        Cuando voy a "/convention/ritsi/admin/app/convention/create"
        Y relleno lo siguiente:
        | Nombre                 | Prueba           |
        | Fecha de comienzo      | 4/8/2015         |
        | Fecha de finalización  | 4/9/2015         |
        | Email                  | ejemplo@gmail.com|
        | Dominio                | prueba           |
        Y presiono "Crear y regresar al listado"
        Entonces debo ver "Elemento creado satisfactoriamente"