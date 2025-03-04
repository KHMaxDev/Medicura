<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Medicura</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/css/bootstrap.min.css">
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Styles / Scripts -->
        @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @else
        @endif
        <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f5faff;
        }

        nav.navbar {
            background-color: #1E90FF;
            color: white;
            padding: 10px 20px;
        }

        nav.navbar ul {
            display: flex;
            justify-content: space-between;
            list-style: none;
            margin: 0;
            padding: 0;
        }

        nav.navbar ul li {
            margin: 0 15px;
        }

        nav.navbar ul li a {
            color: white;
            text-decoration: none;
            font-weight: bold;
        }

        nav.navbar ul li a:hover {
            text-decoration: underline;
        }

        .hero-section {
            background: url('/wpp1.jpg') no-repeat center center/cover;
            height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            color: white;
        }

        .hero-section h1 {
            font-size: 4rem;
            margin-bottom: 20px;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.6);
        }

        .hero-section p {
            font-size: 1.5rem;
            margin-bottom: 30px;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.6);
        }

        .hero-section .btn {
            background-color: #1E90FF;
            color: white;
            padding: 10px 20px;
            text-transform: uppercase;
            border: none;
            border-radius: 5px;
        }

        .hero-section .btn:hover {
            background-color: #187bcd;
        }

        section {
            padding: 50px 20px;
            text-align: center;
        }

        section h2 {
            margin-bottom: 30px;
            color: #1E90FF;
            font-size: 2rem;
        }

        .team-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 20px;
        }

        .team-member {
            background: white;
            border: 1px solid #ddd;
            border-radius: 10px;
            padding: 15px;
            text-align: center;
            width: 200px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .team-member img {
            border-radius: 50%;
            width: 100px;
            height: 100px;
            margin-bottom: 15px;
        }

        form {
            max-width: 500px;
            margin: auto;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        form .form-group {
            margin-bottom: 15px;
            text-align: left;
        }

        form .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        form .form-group input,
        form .form-group textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        form button {
            background-color: #1E90FF;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
        }

        form button:hover {
            background-color: #187bcd;
        }
    </style>
    </head>
    <body>
    <nav class="navbar">
        <ul>
            <li><a href="#sobre-nosotros">Sobre Nosotros</a></li>
            <li><a href="#equipo">Equipo</a></li>
            <li><a href="#contactanos">Contáctanos</a></li>
            <li><a href="{{ url('login') }}">Inicio de Sesión</a></li>
        </ul>
    </nav>

    <section class="hero-section">
        <h1>Bienvenido a Mediocura</h1>
        <p>Mejoramos tu salud con innovación y cuidado</p>
        <a href="" class="btn">Regístrate Ahora</a>
    </section>

    <section id="sobre-nosotros">
        <h2>Sobre Nosotros</h2>
        <p>En Medicura, nuestro objetivo es facilitar la interacción directa, proporcionando una plataforma completa y
            eficiente para gestionar todos los aspectos relacionados con la salud. Sabemos lo importante que es la
            comunicación y la organización en el ámbito médico, y por eso hemos diseñado herramientas innovadoras que
            hacen este proceso más sencillo y accesible para ti.</p><br>
        <p>Estamos aquí para ayudarte a optimizar tu tiempo y esfuerzo, ya sea que seas un profesional de la salud
            buscando organizar mejor tu consulta o un paciente que necesita un acceso rápido y seguro a su información
            médica. Con Medicura, cada interacción está diseñada para ser intuitiva, confiable y enfocada en mejorar tu
            experiencia en el cuidado de la salud.</p>
    </section>

    <section id="equipo">
        <h2>Conoce a Nuestro Equipo</h2>
        <div class="team-container">
            <?php
            $equipo = [
                ["nombre" => "Pedro Dzul", "rol" => "Líder", "imagen" => "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQYVYxhM7Gr3AGVnVwMxuzNF3SP9dLhw2Pf3g&s"],
                ["nombre" => "Angel", "rol" => "Líder", "imagen" => "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTJOUqH_zWYTlVMdVJ7ZE2xrY1PVgZFSySJiQ&s"],
                ["nombre" => "Steven", "rol" => "Líder", "imagen" => "https://antipode-peru.com/info/c-est-quoi-un-gringo--1.jpeg"],
                ["nombre" => "Madox", "rol" => "Líder", "imagen" => "https://i.pinimg.com/280x280_RS/f5/fa/1e/f5fa1e1989495b2ce6b32fba901981e6.jpg"],
                ["nombre" => "Anderson", "rol" => "Líder", "imagen" => "https://cdn.proboxtv.com/uploads/canelo_alvarez_ac939468f5.jpg"],
                ["nombre" => "Salvador", "rol" => "Líder", "imagen" => "https://phantom-marca-mx.unidadeditorial.es/8b0fabe7b7e710222127b342ffe35a67/resize/828/f/jpg/mx/assets/multimedia/imagenes/2023/02/20/16769270250490.jpg"],
            ];

            foreach ($equipo as $miembro) {
                echo "<div class='team-member'>";
                echo "<img src='" . $miembro['imagen'] . "' alt='" . $miembro['nombre'] . "'>";
                echo "<h3>" . $miembro['nombre'] . "</h3>";
                echo "<p>" . $miembro['rol'] . "</p>";
                echo "</div>";
            }
            ?>
        </div>
    </section>

    <section id="contactanos">
        <h2>Contáctanos</h2>
        <form method="POST" action="contacto.php">
            <div class="form-group">
                <label for="nombre">Nombre:</label>
                <input type="text" id="nombre" name="nombre" placeholder="Tu nombre" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" placeholder="Tu email" required>
            </div>
            <div class="form-group">
                <label for="mensaje">Mensaje:</label>
                <textarea id="mensaje" name="mensaje" placeholder="Tu mensaje" required></textarea>

            </div>
            <button type="submit">Enviar</button>
        </form>
    </section>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
</body>
</html>
