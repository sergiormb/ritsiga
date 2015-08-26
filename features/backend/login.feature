#language: es
@backend
Característica: Comprobar login
    Para iniciar sesión en el panel de administración
    Como usuario autentificado
    Necesito tener una cuenta

    @200
    Escenario: Comprobar accesibilidad de la página
        Dado estoy en "/"
        Cuando voy a "convention/ritsi/admin/dashboard"
        Entonces el código de estado de la respuesta debe ser 200
        Y la respuesta debe contener "Username"
        Y debo estar en "/login"

    Esquema del escenario: Comprobar acceso con diferentes usuarios y contraseñas
        Dado estoy en "/login"
        Y relleno "_username" con "<username>"
        Y relleno "_password" con "<password>"
        Y presiono "_submit"
        Entonces la respuesta debe contener "<message>"

        Ejemplos:
            | username |    password    | message |
            |   admin  |    test    | Bad credentials |

    Escenario: Comprobar logout de usuario
        Dado que estoy autenticado como administrador
        Cuando voy a "convention/ritsi/admin/dashboard"
        Y voy a "logout"
        Entonces debo ver "Inicio"

    Esquema del escenario: Comprobar elementos en el menu
        Dado que estoy autenticado como administrador
        Cuando voy a "convention/ritsi/admin/dashboard"
        Entonces la respuesta debe contener "<message>"

        Ejemplos:
            | message |
            |   User  |


    Escenario: Comprobar inicio sesión correcto
        Dado que estoy autenticado como administrador
        Cuando voy a "convention/ritsi/admin/dashboard"
        Entonces debo ver "Asambleas"
        Y debo ver "Entidades"
        Y debo ver "Usuario"
