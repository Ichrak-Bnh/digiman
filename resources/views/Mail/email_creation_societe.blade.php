
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenue sur DIGIMAN !</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container">
        <div class="row col-sm-8 mx-auto mt-3" style="background-color: white;">
            <div class="text-center">
                <img src="https://blog-fr.orson.io/wp-content/uploads/2020/07/logostarbuck.png" class="logo1">
                <br><br>
                <h4>
                    <b>Bienvenue sur DIGIMAN !</b>
                </h4>
            </div>
            <div>
                <p>
                    Nous sommes ravis de vous accueillir sur <b>DIGIMAN</b> ! Vous trouverez ci-dessous les
                    informations de connexion nécessaires pour accéder à votre compte :
                </p>
            </div>
            <div class="p-2">
                <div class="text-center p-2 " style="background-color: #312585;color: white;">
                    Information de connexion
                </div>
                <div>
                    <b>Adresse Email : </b>{{ $data['email'] }} <br>
                    <b>Mot de passe : </b>{{ $data['password'] }}
                </div>
            </div>
                <hr>
                <div class="small">
                    <p>
                        Nous tenons à souligner l'importance de garder ces informations en lieu sûr et de ne les
                        partager avec personne. Ces détails sont essentiels pour garantir la sécurité de votre compte et
                        de vos données personnelles. <br>
                       <p>
                        Si vous avez des questions ou si vous rencontrez des problèmes lors de la connexion, n'hésitez
                        pas à nous contacter à [ <b>contact@digiman-solution-ebuild.com</b> ]. Nous sommes là pour vous aider.
                       </p>

                        Nous vous recommandons de changer votre mot de passe régulièrement et de ne jamais divulguer vos
                        informations de connexion à des tiers. La sécurité de votre compte est notre priorité.
                    </p>
                </div>

        </div>
    </div>
</body>
<style>
    .logo1 {
        width: 30%;
    }

    div {
        width: 100% !important;
    }
    body{
        background-color: #c4ffff;
    }
</style>

</html>
