#language: es
@backend @login
Característica: Comprobar asambleas en el backend

    Escenario: Comprobar listado de asambleas cuando no esta conectado
        Cuando voy a "convention/ritsi/admin/app/convention/list"
        Entonces el código de estado de la respuesta debe ser 200
        Y debo ver "Iniciar Sesión"

Escenario: Comprobar listado de asambleas cuando estoy conectado
        Dado estoy conectado con "admin" y "admin" en "/login"
        Cuando voy a "convention/ritsi/admin/app/convention/list"
        Entonces el código de estado de la respuesta debe ser 200
        Y debo ver "Iniciar Sesión"