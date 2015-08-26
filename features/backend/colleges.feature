#language: es
@backend
Característica: Comprobar facultades en el backend

Antecedentes:
    Dado que estoy autenticado como administrador
    Y existen las facultades:
    | nombre  | ciudad   | provincia    |
    | EPS     | Cordoba  | Cordoba      |
    | EPM     | Malaga   | Malaga       |

    Escenario: Ver listado de todas las facultades
        Cuando voy a "convention/ritsi/admin/dashboard"
        Y voy a "/convention/ritsi/admin/app/college/list"
        Entonces debo ver "2 resultados"

    Escenario: Enviar formulario de facultad vacío
        Cuando voy a "/convention/ritsi/admin/app/college/create"
        Y presiono "Crear y editar"
        Entonces debo ver "Se ha producido un error durante la creación del elemento"

    Escenario: Crear facultad
        Cuando voy a "/convention/ritsi/admin/app/college/create"
        Y relleno lo siguiente:
        | Nombre         | Prueba           |
        | Dirección      | C/Piruleta       |
        | Ciudad         | CiudadImaginaria |
        | Provincia      | Cordoba          |
        | Código Postal  | 14540            |
        | Slug           | prub             |
        Y presiono "Crear y regresar al listado"
        Entonces debo ver "Elemento creado satisfactoriamente"

    Escenario: Borrar facultad desde el listado
        Cuando voy a "/convention/ritsi/admin/app/convention/create"
        Y presiono "Borrar" junto a "Cádiz"
        Entonces debo ver "¿Está seguro de que quiere borrar el elemento seleccionado?"
        Cuando presiono "Sí, borrar"
        Entonces debería estar en "/convention/ritsi/admin/app/convention/create"
        Y debo ver "Elemento eliminado satisfactoriamente."
        Pero no debo ver "Cordoba"